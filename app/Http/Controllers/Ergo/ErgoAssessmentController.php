<?php

namespace App\Http\Controllers\Ergo;

use App\Http\Controllers\Controller;
use App\Models\Ergo\ErgoCompany;
use App\Models\Ergo\ErgoAssessment;
use App\Models\Ergo\ErgoWorker;
use App\Models\Ergo\ErgoRebaScore;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ErgoAssessmentController extends Controller
{
    public function index()
    {
        $assessments = ErgoAssessment::with(['company', 'workers.rebaScore'])->latest()->get();
        return view('ergo.index', compact('assessments'));
    }

    public function create()
    {
        $companies = ErgoCompany::all();
        return view('ergo.create', compact('companies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string',
            'department' => 'required|string',
            'worker_name' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $company = ErgoCompany::firstOrCreate(
            ['name' => $request->company_name],
            ['address' => $request->address, 'sector' => $request->sector]
        );

        $assessment = ErgoAssessment::create([
            'company_id' => $company->id,
            'lhu_number' => $request->lhu_number,
            'pic_name' => $request->pic_name,
            'surveyor_id' => 1,
            'department' => $request->department,
            'assessment_date' => now(),
            'status' => 'draft'
        ]);

        $worker = ErgoWorker::create([
            'assessment_id' => $assessment->id,
            'name' => $request->worker_name,
            'age' => $request->age,
            'gender' => $request->gender,
            'working_years' => $request->working_years
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('ergo-photos', 'public');
        }

        $ergoData = $this->calculateErgoScore($request);
        $ergoData['worker_id'] = $worker->id;
        $ergoData['photo_path'] = $photoPath;

        ErgoRebaScore::create($ergoData);

        return redirect()->route('ergo.result', $assessment->id)
                         ->with('success', 'Data asesmen berhasil dihitung secara instan!');
    }
    public function exportPdf($id)
    {
        $assessment = ErgoAssessment::with(['company', 'workers.rebaScore'])->findOrFail($id);
        
        // Render view khusus PDF dengan orientasi Portrait dan ukuran A4
        $pdf = Pdf::loadView('ergo.pdf-lhu', compact('assessment'))
                  ->setPaper('a4', 'portrait');

        // Nama file PDF otomatis sesuai No. LHU
        $fileName = 'LHU-Ergonomi-' . str_replace(['/', '\\'], '-', $assessment->lhu_number ?? $assessment->id) . '.pdf';

        return $pdf->stream($fileName); // Menampilkan preview PDF di browser (bisa diganti ->download($fileName))
    }

    public function show($id)
    {
        $assessment = ErgoAssessment::with(['company', 'workers.rebaScore'])->findOrFail($id);
        return view('ergo.result', compact('assessment'));
    }

    private function calculateErgoScore(Request $request)
    {
        $upper = (int) $request->input('upper_body_score', 0);
        $lower = (int) $request->input('lower_body_score', 0);
        $mmh = (int) $request->input('mmh_score', 0);

        $totalScore = $upper + $lower + $mmh;

        // Interpretasi Standar LHU Balai K3 Surabaya (SNI 9011)
        $riskLevel = 'Kondisi tempat kerja aman';
        if ($totalScore >= 3 && $totalScore <= 6) {
            $riskLevel = 'Kondisi tempat kerja perlu pengamatan lebih lanjut';
        } elseif ($totalScore >= 7) {
            $riskLevel = 'Kondisi tempat kerja berbahaya';
        }

        return [
            'upper_body_score' => $upper,
            'lower_body_score' => $lower,
            'mmh_score' => $mmh,
            'final_score' => $totalScore,
            'risk_level' => $riskLevel,
            'notes' => $request->input('notes'),
        ];
    }
}