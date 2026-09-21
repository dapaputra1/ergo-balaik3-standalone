<?php

namespace App\Http\Controllers\Ergo;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ErgoAssessmentController extends Controller
{
    /**
     * Tampilkan daftar data asesmen.
     */
    public function index(): View
    {
        $assessments = DB::table('ergo_assessments')
            ->join('ergo_companies', 'ergo_assessments.company_id', '=', 'ergo_companies.id')
            ->leftJoin('ergo_workers', 'ergo_workers.assessment_id', '=', 'ergo_assessments.id')
            ->leftJoin('ergo_reba_scores', 'ergo_reba_scores.worker_id', '=', 'ergo_workers.id')
            ->select([
                'ergo_assessments.id',
                'ergo_assessments.assessment_date',
                'ergo_companies.name as company_name',
                'ergo_workers.name as worker_name',
                'ergo_workers.position',
                'ergo_reba_scores.final_score as total_score',
                'ergo_reba_scores.risk_level',
                DB::raw('(SELECT COUNT(*) FROM ergo_assessment_photos WHERE ergo_assessment_photos.assessment_id = ergo_assessments.id) as photos_count'),
            ])
            ->latest('ergo_assessments.created_at')
            ->paginate(10);

        return view('ergo.index', compact('assessments'));
    }

    /**
     * Form pembuatan asesmen baru.
     */
    public function create(): View
    {
        return view('ergo.create');
    }

    /**
     * Simpan data asesmen baru.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'company_name'  => 'required|string|max:255',
            'worker_name'   => 'required|string|max:255',
            'position'      => 'required|string|max:255',
            'ergo_photos.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        try {
            DB::beginTransaction();

            // 1. Kalkulasi Skor SNI 9011:2021
            $ergoItems  = (array) $request->input('ergo_items', []);
            $scoreUpper = 0;
            $scoreLower = 0;

            foreach ($ergoItems as $no => $score) {
                if ((int) $no <= 16) {
                    $scoreUpper += (int) $score;
                } else {
                    $scoreLower += (int) $score;
                }
            }

            $scoreMmh   = (int) $request->input('mmh_weight_score', 0);
            $shiftHours = (float) $request->input('shift_hours', 8);

            $calculated = $this->calculateErgoScore($scoreUpper, $scoreLower, $scoreMmh, $shiftHours);

            // 2. Simpan atau Ambil Perusahaan
            $company = DB::table('ergo_companies')->where('name', $request->input('company_name'))->first();

            $companyId = $company ? $company->id : DB::table('ergo_companies')->insertGetId([
                'name'       => $request->input('company_name'),
                'address'    => $request->input('address'),
                'sector'     => $request->input('company_type'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // 3. Simpan Asesmen Utama
            $assessmentId = DB::table('ergo_assessments')->insertGetId([
                'company_id'       => $companyId,
                'assessment_date'  => $request->input('assessment_date', now()->toDateString()),
                'shift_hours'      => $shiftHours,
                'method'           => 'SNI 9011:2021',
                'existing_control' => $request->input('existing_control'),
                'surveyor_id'      => auth()->id() ?? 1,
                'department'       => $request->input('position', 'Operasional'),
                'status'           => 'submitted',
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);

            // 4. Simpan Profil Pekerja
            $workerId = DB::table('ergo_workers')->insertGetId([
                'assessment_id'       => $assessmentId,
                'name'                => $request->input('worker_name'),
                'position'            => $request->input('position'),
                'job_tasks'           => $request->input('job_tasks'),
                'dominant_hand'       => $request->input('dominant_hand', 'Kanan'),
                'work_duration_level' => $request->input('work_duration_level', '1 - 5 tahun'),
                'created_at'          => now(),
                'updated_at'          => now(),
            ]);

            // 5. Simpan Skor
            DB::table('ergo_reba_scores')->insert([
                'worker_id'        => $workerId,
                'upper_body_score' => $scoreUpper,
                'lower_body_score' => $scoreLower,
                'mmh_score'        => $scoreMmh,
                'final_score'      => $calculated['total_score'],
                'risk_level'       => $calculated['risk_level'],
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);

            // 6. Unggah Foto Asesmen
            if ($request->hasFile('ergo_photos')) {
                $photos = is_array($request->file('ergo_photos')) 
                    ? $request->file('ergo_photos') 
                    : [$request->file('ergo_photos')];

                $photoRecords = [];
                foreach ($photos as $file) {
                    if ($file && $file->isValid()) {
                        $storedPath = $file->store('ergo-photos', 'public');
                        $photoRecords[] = [
                            'assessment_id' => $assessmentId,
                            'photo_name'    => $file->getClientOriginalName(),
                            'file_path'     => $storedPath,
                            'created_at'    => now(),
                            'updated_at'    => now(),
                        ];
                    }
                }

                if (!empty($photoRecords)) {
                    DB::table('ergo_assessment_photos')->insert($photoRecords);
                }
            }

            DB::commit();

            return redirect()->route('ergo.index')->with('success', 'Data pengujian ergonomi dan foto berhasil disimpan!');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    /**
     * Tampilkan detail hasil asesmen.
     */
    public function show(int|string $id): View|RedirectResponse
    {
        $assessment = DB::table('ergo_assessments')
            ->join('ergo_companies', 'ergo_assessments.company_id', '=', 'ergo_companies.id')
            ->leftJoin('ergo_workers', 'ergo_workers.assessment_id', '=', 'ergo_assessments.id')
            ->leftJoin('ergo_reba_scores', 'ergo_reba_scores.worker_id', '=', 'ergo_workers.id')
            ->where('ergo_assessments.id', $id)
            ->select([
                'ergo_assessments.*',
                'ergo_companies.name as company_name',
                'ergo_companies.address as company_address',
                'ergo_companies.sector as company_sector',
                'ergo_workers.name as worker_name',
                'ergo_workers.position',
                'ergo_workers.job_tasks',
                'ergo_workers.dominant_hand',
                'ergo_workers.work_duration_level',
                'ergo_reba_scores.upper_body_score',
                'ergo_reba_scores.lower_body_score',
                'ergo_reba_scores.mmh_score',
                'ergo_reba_scores.final_score as total_score',
                'ergo_reba_scores.risk_level',
                'ergo_reba_scores.notes',
            ])
            ->first();

        if (!$assessment) {
            return redirect()->route('ergo.index')->with('error', 'Data asesmen tidak ditemukan.');
        }

        $photos = DB::table('ergo_assessment_photos')
            ->where('assessment_id', $id)
            ->get();

        return view('ergo.result', compact('assessment', 'photos'));
    }

    /**
     * Menampilkan form edit lengkap identik dengan form create.
     */
    public function edit(int|string $id): View|RedirectResponse
    {
        $assessment = DB::table('ergo_assessments')
            ->join('ergo_companies', 'ergo_assessments.company_id', '=', 'ergo_companies.id')
            ->leftJoin('ergo_workers', 'ergo_workers.assessment_id', '=', 'ergo_assessments.id')
            ->leftJoin('ergo_reba_scores', 'ergo_reba_scores.worker_id', '=', 'ergo_workers.id')
            ->where('ergo_assessments.id', $id)
            ->select([
                'ergo_assessments.*',
                'ergo_companies.name as company_name',
                'ergo_companies.address as company_address',
                'ergo_companies.sector as company_sector',
                'ergo_workers.id as worker_id',
                'ergo_workers.name as worker_name',
                'ergo_workers.position',
                'ergo_workers.job_tasks',
                'ergo_workers.job_duration',
                'ergo_workers.dominant_hand',
                'ergo_workers.work_duration_level',
                'ergo_workers.mental_fatigue',
                'ergo_workers.physical_fatigue',
                'ergo_workers.has_pain_last_year',
                'ergo_reba_scores.upper_body_score',
                'ergo_reba_scores.lower_body_score',
                'ergo_reba_scores.mmh_score',
                'ergo_reba_scores.final_score as total_score',
                'ergo_reba_scores.risk_level',
            ])
            ->first();

        if (!$assessment) {
            return redirect()->route('ergo.index')->with('error', 'Data asesmen tidak ditemukan.');
        }

        $photos = DB::table('ergo_assessment_photos')
            ->where('assessment_id', $id)
            ->get();

        return view('ergo.edit', compact('assessment', 'photos'));
    }

    /**
     * Memperbarui seluruh data asesmen, skor, serta foto teranotasi baru.
     */
    public function update(Request $request, int|string $id): RedirectResponse
    {
        $request->validate([
            'company_name'  => 'required|string|max:255',
            'worker_name'   => 'required|string|max:255',
            'position'      => 'required|string|max:255',
            'ergo_photos.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        try {
            DB::beginTransaction();

            $assessment = DB::table('ergo_assessments')->where('id', $id)->first();
            if (!$assessment) {
                return redirect()->route('ergo.index')->with('error', 'Data asesmen tidak ditemukan.');
            }

            // 1. Kalkulasi Ulang Skor SNI 9011:2021 & Lembur
            $shiftHours    = (float) $request->input('shift_hours', 8);
            $overtimeBonus = $shiftHours > 8 ? ($shiftHours - 8) * 0.5 : 0;

            $scoreUpper = 0;
            $scoreLower = 0;
            $ergoItems  = (array) $request->input('ergo_items', []);

            foreach ($ergoItems as $no => $score) {
                if ((int) $no <= 16) {
                    $scoreUpper += (int) $score;
                } else {
                    $scoreLower += (int) $score;
                }
            }

            $mmhWeight  = (int) $request->input('mmh_weight_score', 0);
            $mmhDist    = (int) $request->input('mmh_distance_score', 0);
            $scoreMMH   = $mmhWeight + $mmhDist;
            $totalScore = $scoreUpper + $scoreLower + $scoreMMH + $overtimeBonus;

            $riskLevel = 'Aman';
            if ($totalScore >= 2 && $totalScore <= 6) {
                $riskLevel = 'Perlu Pengamatan Lanjut';
            } elseif ($totalScore >= 7) {
                $riskLevel = 'Berbahaya';
            }

            // 2. Perbarui Perusahaan
            DB::table('ergo_companies')->where('id', $assessment->company_id)->update([
                'name'       => $request->input('company_name'),
                'address'    => $request->input('address'),
                'sector'     => $request->input('company_type'),
                'updated_at' => now(),
            ]);

            // 3. Perbarui Data Utama Asesmen
            DB::table('ergo_assessments')->where('id', $id)->update([
                'assessment_date'  => $request->input('assessment_date', now()->toDateString()),
                'shift_hours'      => $shiftHours,
                'existing_control' => $request->input('existing_control'),
                'updated_at'       => now(),
            ]);

            // 4. Perbarui Profil Tenaga Kerja
            DB::table('ergo_workers')->where('assessment_id', $id)->update([
                'name'                => $request->input('worker_name'),
                'position'            => $request->input('position'),
                'job_tasks'           => $request->input('job_tasks'),
                'job_duration'        => $request->input('job_duration'),
                'dominant_hand'       => $request->input('dominant_hand', 'Kanan'),
                'work_duration_level' => $request->input('work_duration_level', '1 - 5 tahun'),
                'mental_fatigue'      => $request->input('mental_fatigue', 'Tidak pernah'),
                'physical_fatigue'    => $request->input('physical_fatigue', 'Kadang-kadang'),
                'has_pain_last_year'  => $request->input('has_pain_last_year', 0),
                'updated_at'          => now(),
            ]);

            // 5. Perbarui Skor
            $worker = DB::table('ergo_workers')->where('assessment_id', $id)->first();
            if ($worker) {
                DB::table('ergo_reba_scores')->where('worker_id', $worker->id)->update([
                    'upper_body_score' => $scoreUpper,
                    'lower_body_score' => $scoreLower,
                    'mmh_score'        => $scoreMMH,
                    'final_score'      => $totalScore,
                    'risk_level'       => $riskLevel,
                    'notes'            => $request->input('existing_control'),
                    'updated_at'       => now(),
                ]);
            }

            // 6. Unggah Foto Baru & Anotasi Landmarks
            $uploadedFiles = $request->file('ergo_photos', []);
            if (is_array($uploadedFiles) && count($uploadedFiles) > 0) {
                $oldPhotos = DB::table('ergo_assessment_photos')->where('assessment_id', $id)->get();
                foreach ($oldPhotos as $old) {
                    if ($old->file_path && Storage::disk('public')->exists($old->file_path)) {
                        Storage::disk('public')->delete($old->file_path);
                    }
                }
                DB::table('ergo_assessment_photos')->where('assessment_id', $id)->delete();

                $photosJsonData = json_decode($request->input('annotated_photos_json', '[]'), true);
                foreach ($uploadedFiles as $index => $file) {
                    if ($file && $file->isValid()) {
                        $storedPath = $file->store('ergo-photos', 'public');
                        $landmarks  = isset($photosJsonData[$index]['landmarks'])
                            ? json_encode($photosJsonData[$index]['landmarks'])
                            : null;

                        DB::table('ergo_assessment_photos')->insert([
                            'assessment_id'  => $id,
                            'photo_name'     => $file->getClientOriginalName(),
                            'file_path'      => $storedPath,
                            'landmarks_json' => $landmarks,
                            'created_at'     => now(),
                            'updated_at'     => now(),
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect()->route('ergo.result', $id)->with('success', 'Data asesmen pengujian berhasil diperbarui!');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    /**
     * Menghapus data asesmen beserta file fisik foto di storage.
     */
    public function destroy(int|string $id): RedirectResponse
    {
        try {
            DB::beginTransaction();

            // 1. Hapus seluruh file fisik foto dari disk storage
            $photos = DB::table('ergo_assessment_photos')->where('assessment_id', $id)->get();
            foreach ($photos as $photo) {
                if ($photo->file_path && Storage::disk('public')->exists($photo->file_path)) {
                    Storage::disk('public')->delete($photo->file_path);
                }
            }

            // 2. Hapus catatan foto di database
            DB::table('ergo_assessment_photos')->where('assessment_id', $id)->delete();

            // 3. Hapus skor dan profil pekerja
            $worker = DB::table('ergo_workers')->where('assessment_id', $id)->first();
            if ($worker) {
                DB::table('ergo_reba_scores')->where('worker_id', $worker->id)->delete();
                DB::table('ergo_workers')->where('id', $worker->id)->delete();
            }

            // 4. Hapus data asesmen utama
            DB::table('ergo_assessments')->where('id', $id)->delete();

            DB::commit();

            return redirect()->route('ergo.index')->with('success', 'Data pengujian beserta berkas foto berhasil dihapus permanen.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('ergo.index')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    /**
     * Helper perhitungan total skor dan penetapan tingkat risiko ergonomi.
     */
    private function calculateErgoScore(int $upper, int $lower, int $mmh, float $shiftHours): array
    {
        $overtimeBonus = $shiftHours > 8 ? ($shiftHours - 8) * 0.5 : 0;
        $totalScore    = $upper + $lower + $mmh + $overtimeBonus;

        $riskLevel = 'Aman';
        if ($totalScore >= 2 && $totalScore <= 6) {
            $riskLevel = 'Perlu Pengamatan Lanjut';
        } elseif ($totalScore >= 7) {
            $riskLevel = 'Berbahaya';
        }

        return [
            'total_score' => $totalScore,
            'risk_level'  => $riskLevel,
        ];
    }
}