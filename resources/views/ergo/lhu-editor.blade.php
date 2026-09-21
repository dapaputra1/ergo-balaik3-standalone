<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Editor Laporan Hasil Uji — {{ $assessment->worker_name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style> 
        body { font-family: 'Plus Jakarta Sans', sans-serif; } 
    </style>
</head>
<body class="bg-slate-100 text-slate-800 antialiased min-h-screen py-8">

<div class="max-w-5xl mx-auto px-4 space-y-6">

    <!-- BAR NAVIGASI ATAS -->
    <div class="flex items-center justify-between bg-white p-4 rounded-xl border border-slate-200 shadow-xs">
        <div>
            <div class="flex items-center gap-2 mb-0.5">
                <span class="px-2.5 py-0.5 rounded text-[11px] font-bold bg-[#e8f1f9] text-[#153e67] border border-[#d1e3f3]">
                    Live Editor LHU
                </span>
                <span class="text-xs text-slate-400 font-medium">Balai K3 Surabaya</span>
            </div>
            <h1 class="text-lg font-bold text-slate-900">Penyuntingan Draf Laporan Hasil Uji Resmi</h1>
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ route('ergo.result', $assessment->id) }}" class="px-3.5 py-2 rounded-lg border border-slate-200 text-xs font-semibold text-slate-600 hover:bg-slate-50 transition">
                <i class="ph-bold ph-arrow-left"></i> Kembali
            </a>
            <button type="submit" form="lhuForm" class="px-4 py-2 rounded-lg bg-[#153e67] hover:bg-[#0f2e4d] text-white text-xs font-bold shadow-xs transition flex items-center gap-1.5">
                <i class="ph-bold ph-floppy-disk"></i> Simpan Perubahan
            </button>
            <a href="{{ route('ergo.pdf', $assessment->id) }}" target="_blank" class="px-4 py-2 rounded-lg bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold shadow-xs transition flex items-center gap-1.5">
                <i class="ph-bold ph-file-pdf"></i> Cetak / Unduh PDF
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-300 text-xs text-emerald-800 font-semibold flex items-center gap-2">
            <i class="ph-bold ph-check-circle text-lg"></i> {{ session('success') }}
        </div>
    @endif

    <!-- FORM DOKUMEN MIRIP LEMBAR KERJA -->
    <form id="lhuForm" action="{{ route('ergo.lhu.update', $assessment->id) }}" method="POST" class="bg-white rounded-2xl border border-slate-300 p-8 shadow-sm space-y-6">
        @csrf
        @method('PUT')

        <!-- KOP DOKUMEN -->
        <div class="border-b-2 border-black pb-4 text-center space-y-1">
            <div class="text-xs font-bold uppercase tracking-wide">KEMENTERIAN KETENAGAKERJAAN REPUBLIK INDONESIA</div>
            <div class="text-xs font-bold uppercase tracking-wide">DIREKTORAT JENDERAL PEMBINAAN PENGAWASAN KETENAGAKERJAAN DAN K3</div>
            <div class="text-sm font-black uppercase text-[#153e67]">BALAI HIPERKES DAN KESELAMATAN KERJA SURABAYA</div>
            <div class="text-[10px] text-slate-500">Jl. Dukuh Menanggal No. 122, Kec. Gayungan, Surabaya 60234 | Laman: balaik3surabaya@kemnaker.go.id</div>
        </div>

        <!-- JUDUL & NOMOR SURAT -->
        <div class="text-center space-y-1 pt-2">
            <h2 class="text-sm font-black uppercase underline">LAPORAN HASIL</h2>
            <div class="text-xs font-bold">Pengujian Faktor Ergonomi di Tempat Kerja</div>
            <div class="flex justify-center items-center gap-2 pt-1">
                <label class="text-xs font-bold text-slate-600">Nomor Laporan:</label>
                <input type="text" name="lhu_doc_number" value="{{ old('lhu_doc_number', $assessment->lhu_doc_number) }}" class="border border-slate-300 rounded px-2.5 py-1 text-xs font-bold text-center w-64 focus:border-[#153e67] outline-none">
            </div>
        </div>

        <!-- 1. DATA UMUM -->
        <div class="space-y-3 pt-2">
            <div class="text-xs font-bold text-slate-900 uppercase">1. Data Umum</div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs bg-slate-50 p-4 rounded-xl border border-slate-200">
                <div>
                    <span class="text-slate-500 block font-medium">a. Perusahaan:</span>
                    <strong class="text-slate-800">{{ $assessment->company_name }}</strong>
                </div>
                <div>
                    <span class="text-slate-500 block font-medium">b. Alamat:</span>
                    <strong class="text-slate-800">{{ $assessment->company_address ?? '-' }}</strong>
                </div>
                <div class="sm:col-span-2">
                    <label class="text-slate-700 font-bold block mb-1">c. Pengurus / Penanggung Jawab Perusahaan:</label>
                    <input type="text" name="company_pic" value="{{ old('company_pic', $assessment->company_pic) }}" class="w-full border border-slate-300 rounded-lg p-2 text-xs bg-white focus:border-[#153e67] outline-none">
                </div>
            </div>
        </div>

        <!-- 4. REKAPITULASI HASIL PENGUKURAN (READ ONLY) -->
        <div class="space-y-2 pt-2">
            <div class="text-xs font-bold text-slate-900 uppercase">4. Hasil Pengukuran Ergonomi (Tabel Rekapitulasi)</div>
            <table class="w-full text-left border-collapse text-xs border border-slate-300">
                <thead class="bg-slate-100 font-bold border-b border-slate-300 text-center">
                    <tr>
                        <th class="p-2 border-r border-slate-300">Nama Tenaga Kerja</th>
                        <th class="p-2 border-r border-slate-300">Jabatan</th>
                        <th class="p-2 border-r border-slate-300">Tubuh Atas</th>
                        <th class="p-2 border-r border-slate-300">Punggung/Bawah</th>
                        <th class="p-2 border-r border-slate-300">MMH</th>
                        <th class="p-2 border-r border-slate-300">Total Skor</th>
                        <th class="p-2">Interpretasi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 text-center">
                    <tr>
                        <td class="p-2 border-r border-slate-200 font-semibold">{{ $assessment->worker_name }}</td>
                        <td class="p-2 border-r border-slate-200">{{ $assessment->position }}</td>
                        <td class="p-2 border-r border-slate-200 font-bold">{{ $assessment->upper_body_score ?? 0 }}</td>
                        <td class="p-2 border-r border-slate-200 font-bold">{{ $assessment->lower_body_score ?? 0 }}</td>
                        <td class="p-2 border-r border-slate-200 font-bold">{{ $assessment->mmh_score ?? 0 }}</td>
                        <td class="p-2 border-r border-slate-200 font-black text-[#153e67]">{{ $assessment->total_score }}</td>
                        <td class="p-2 font-bold">{{ $assessment->risk_level }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- 5. ANALISIS (EDITABLE) -->
        <div class="space-y-1.5 pt-2">
            <div class="text-xs font-bold text-slate-900 uppercase">5. Narasi Analisis Potensi Bahaya (Butir 5)</div>
            <p class="text-[11px] text-slate-500">Uraikan secara spesifik sikap janggal leher, bahu, pergelangan tangan, dan keluhan Nordic Body Map:</p>
            <textarea name="lhu_analysis" rows="4" class="w-full border border-slate-300 rounded-xl p-3 text-xs focus:border-[#153e67] outline-none font-sans leading-relaxed">{{ old('lhu_analysis', $assessment->lhu_analysis) }}</textarea>
        </div>

        <!-- 6. KESIMPULAN (EDITABLE) -->
        <div class="space-y-1.5 pt-2">
            <div class="text-xs font-bold text-slate-900 uppercase">6. Kesimpulan (Butir 6)</div>
            <textarea name="lhu_conclusion" rows="2" class="w-full border border-slate-300 rounded-xl p-3 text-xs focus:border-[#153e67] outline-none font-sans leading-relaxed">{{ old('lhu_conclusion', $assessment->lhu_conclusion) }}</textarea>
        </div>

        <!-- 7. SARAN & TINDAKAN PERBAIKAN (EDITABLE) -->
        <div class="space-y-1.5 pt-2">
            <div class="text-xs font-bold text-slate-900 uppercase">7. Saran dan Tindakan Perbaikan (Butir 7)</div>
            <p class="text-[11px] text-slate-500">Rekomendasi teknis ergonomi postur statis (kantor), postur dinamis, dan cara angkat beban:</p>
            <textarea name="lhu_recommendation" rows="6" class="w-full border border-slate-300 rounded-xl p-3 text-xs focus:border-[#153e67] outline-none font-sans leading-relaxed">{{ old('lhu_recommendation', $assessment->lhu_recommendation) }}</textarea>
        </div>

        <!-- PEJABAT PENANDATANGAN RESMI -->
        <div class="space-y-2 pt-4 border-t border-slate-200">
            <div class="text-xs font-bold text-slate-900 uppercase">Pengesahan Manajer Teknis</div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 text-xs bg-slate-50 p-4 rounded-xl border border-slate-200">
                <div>
                    <label class="font-bold text-slate-700 block mb-1">Jabatan Penandatangan</label>
                    <input type="text" name="signer_position" value="{{ old('signer_position', $assessment->signer_position) }}" class="w-full border border-slate-300 rounded p-2 text-xs outline-none bg-white">
                </div>
                <div>
                    <label class="font-bold text-slate-700 block mb-1">Nama Lengkap & Gelar</label>
                    <input type="text" name="signer_name" value="{{ old('signer_name', $assessment->signer_name) }}" class="w-full border border-slate-300 rounded p-2 text-xs outline-none bg-white">
                </div>
                <div>
                    <label class="font-bold text-slate-700 block mb-1">Nomor Induk Pegawai (NIP)</label>
                    <input type="text" name="signer_nip" value="{{ old('signer_nip', $assessment->signer_nip) }}" class="w-full border border-slate-300 rounded p-2 text-xs outline-none bg-white">
                </div>
            </div>
        </div>

        <!-- TOMBOL SIMPAN DI BAWAH -->
        <div class="flex justify-end gap-3 pt-4 border-t border-slate-200">
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#153e67] hover:bg-[#0f2e4d] text-white text-xs font-bold shadow-sm transition flex items-center gap-1.5">
                <i class="ph-bold ph-floppy-disk"></i> Simpan Draf Narasi LHU
            </button>
        </div>
    </form>

</div>
</body>
</html>