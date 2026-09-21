<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Evaluasi Ergonomi — {{ $assessment->worker_name }} ({{ $assessment->company_name }})</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style> 
        body { font-family: 'Plus Jakarta Sans', sans-serif; } 
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; padding: 0 !important; }
            .shadow-xs, .shadow-sm { box-shadow: none !important; }
        }
    </style>
</head>
<body class="bg-[#f8fafc] text-slate-800 antialiased min-h-screen py-8">

<div class="max-w-5xl mx-auto px-4 sm:px-6 space-y-6">

    <!-- Top Action Bar -->
    <div class="flex items-center justify-between no-print">
        <a href="{{ route('ergo.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-slate-600 hover:text-[#153e67] bg-white border border-slate-200 px-3.5 py-2 rounded-lg shadow-sm transition">
            <i class="ph-bold ph-arrow-left"></i> Kembali ke Daftar
        </a>
        <div class="flex items-center gap-2">
            <!-- Tombol Edit LHU Resmi -->
            <a href="{{ route('ergo.lhu.edit', $assessment->id) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-700 bg-white border border-slate-200 hover:bg-slate-50 px-3.5 py-2 rounded-lg shadow-sm transition">
                <i class="ph-bold ph-pencil-simple text-base"></i> Edit Draf LHU
            </a>
            <!-- Tombol Unduh PDF Resmi -->
            <a href="{{ route('ergo.pdf', $assessment->id) }}" target="_blank" class="inline-flex items-center gap-1.5 text-xs font-bold text-white bg-rose-600 hover:bg-rose-700 px-4 py-2 rounded-lg shadow-sm transition">
                <i class="ph-bold ph-file-pdf text-base"></i> Unduh LHU (PDF)
            </a>
        </div>
    </div>

    <!-- Container Dokumen LHU -->
    <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-6">
        
        <!-- Header Dokumen -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 border-b border-slate-100 pb-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-[#153e67] text-white flex items-center justify-center font-black text-xl shadow-sm">
                    K3
                </div>
                <div>
                    <span class="px-2.5 py-0.5 rounded text-[11px] font-bold bg-[#e8f1f9] text-[#153e67] border border-[#d1e3f3]">
                        SNI 9011:2021
                    </span>
                    <h1 class="text-xl font-extrabold text-slate-900 mt-1">Laporan Hasil Uji (LHU) Faktor Ergonomi</h1>
                    <p class="text-xs text-slate-500">Balai Keselamatan dan Kesehatan Kerja Surabaya</p>
                </div>
            </div>

            <!-- Kartu Status Risiko -->
            <div class="flex items-center gap-3">
                <div class="text-right">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Tingkat Risiko</span>
                    <span class="text-sm font-black text-slate-800">{{ $assessment->risk_level }}</span>
                </div>
                <div class="w-14 h-14 rounded-xl flex items-center justify-center font-black text-xl border
                    @if($assessment->risk_level === 'Aman') bg-emerald-50 text-emerald-600 border-emerald-200
                    @elseif($assessment->risk_level === 'Perlu Pengamatan Lanjut') bg-amber-50 text-amber-600 border-amber-200
                    @else bg-rose-50 text-rose-600 border-rose-200 @endif">
                    {{ $assessment->total_score }}
                </div>
            </div>
        </div>

        <!-- Grid Info: Perusahaan & Pekerja -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-slate-50 p-4 rounded-xl border border-slate-200/80 space-y-2">
                <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wide flex items-center gap-1.5">
                    <i class="ph-bold ph-buildings text-[#153e67]"></i> Identitas Perusahaan
                </h3>
                <div class="text-xs space-y-1.5 text-slate-600">
                    <p><strong class="text-slate-800">Nama:</strong> {{ $assessment->company_name }}</p>
                    <p><strong class="text-slate-800">Alamat:</strong> {{ $assessment->company_address ?? '-' }}</p>
                    <p><strong class="text-slate-800">Sektor:</strong> {{ $assessment->company_sector ?? '-' }}</p>
                    <p><strong class="text-slate-800">Tanggal Sampling:</strong> {{ \Carbon\Carbon::parse($assessment->assessment_date)->isoFormat('D MMMM Y') }}</p>
                </div>
            </div>

            <div class="bg-slate-50 p-4 rounded-xl border border-slate-200/80 space-y-2">
                <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wide flex items-center gap-1.5">
                    <i class="ph-bold ph-user text-[#153e67]"></i> Profil Tenaga Kerja
                </h3>
                <div class="text-xs space-y-1.5 text-slate-600">
                    <p><strong class="text-slate-800">Nama Pekerja:</strong> {{ $assessment->worker_name }}</p>
                    <p><strong class="text-slate-800">Posisi:</strong> {{ $assessment->position }}</p>
                    <p><strong class="text-slate-800">Durasi Shift:</strong> {{ $assessment->shift_hours }} jam / hari</p>
                    <p><strong class="text-slate-800">Tangan Dominan:</strong> {{ $assessment->dominant_hand }}</p>
                </div>
            </div>
        </div>

        <!-- Rincian Skor Parameter Evaluasi -->
        <div class="space-y-3 pt-2">
            <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wide flex items-center gap-1.5">
                <i class="ph-bold ph-calculator text-[#153e67]"></i> Rincian Skor Evaluasi
            </h3>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                <div class="p-3 bg-slate-50 border border-slate-200 rounded-xl text-center">
                    <span class="text-[11px] font-semibold text-slate-500 block">Tubuh Bagian Atas</span>
                    <span class="text-lg font-bold text-slate-800">{{ $assessment->upper_body_score ?? 0 }}</span>
                </div>
                <div class="p-3 bg-slate-50 border border-slate-200 rounded-xl text-center">
                    <span class="text-[11px] font-semibold text-slate-500 block">Punggung & Bawah</span>
                    <span class="text-lg font-bold text-slate-800">{{ $assessment->lower_body_score ?? 0 }}</span>
                </div>
                <div class="p-3 bg-slate-50 border border-slate-200 rounded-xl text-center">
                    <span class="text-[11px] font-semibold text-slate-500 block">Beban Manual (MMH)</span>
                    <span class="text-lg font-bold text-slate-800">{{ $assessment->mmh_score ?? 0 }}</span>
                </div>
                <div class="p-3 bg-[#e8f1f9] border border-[#d1e3f3] rounded-xl text-center">
                    <span class="text-[11px] font-bold text-[#153e67] block">Skor Total Akhir</span>
                    <span class="text-lg font-black text-[#153e67]">{{ $assessment->total_score }}</span>
                </div>
            </div>
        </div>

        <!-- Lampiran Foto Dokumentasi Postur Kerja -->
        <div class="space-y-3 pt-4 border-t border-slate-100">
            <div class="flex items-center justify-between">
                <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wide flex items-center gap-1.5">
                    <i class="ph-bold ph-camera text-[#153e67]"></i> Lampiran Foto Dokumentasi Postur Kerja
                </h3>
                <span class="text-[11px] text-slate-500 font-medium">{{ count($photos) }} Berkas Tersimpan</span>
            </div>

            @if(count($photos) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($photos as $photo)
                        @php
                            $imageUrl = filter_var($photo->file_path, FILTER_VALIDATE_URL) 
                                ? $photo->file_path 
                                : asset('storage/' . ltrim($photo->file_path, '/'));
                        @endphp
                        <div class="border border-slate-200 rounded-xl overflow-hidden bg-slate-50 shadow-sm flex flex-col">
                            <div class="aspect-4/3 w-full bg-slate-900 flex items-center justify-center overflow-hidden relative">
                                <img src="{{ $imageUrl }}" 
                                     alt="{{ $photo->photo_name }}" 
                                     class="max-h-full max-w-full object-contain"
                                     loading="lazy"
                                     onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'text-center p-4 text-rose-400 text-xs font-semibold\'><i class=\'ph-bold ph-warning text-2xl block mb-1\'></i>Gambar tidak ditemukan di storage</div>';">
                            </div>
                            <div class="p-3 bg-white border-t border-slate-100 flex items-center justify-between text-xs mt-auto">
                                <span class="font-semibold text-slate-700 truncate max-w-[200px]" title="{{ $photo->photo_name }}">
                                    {{ $photo->photo_name }}
                                </span>
                                @if(!empty($photo->landmarks_json))
                                    <span class="px-2 py-0.5 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded text-[10px] font-bold flex items-center gap-1">
                                        <i class="ph-bold ph-check"></i> Sudut Teranalisis
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="p-8 text-center text-slate-400 border border-dashed border-slate-200 rounded-xl">
                    <i class="ph-bold ph-image text-3xl mb-1 block"></i>
                    Tidak ada lampiran foto untuk pengujian asesmen ini.
                </div>
            @endif
        </div>

        <!-- Rekomendasi & Pengendalian -->
        @if($assessment->existing_control || (!empty($assessment->notes)))
            <div class="space-y-2 pt-4 border-t border-slate-100">
                <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wide flex items-center gap-1.5">
                    <i class="ph-bold ph-shield-check text-[#153e67]"></i> Rekomendasi & Tindakan Pengendalian
                </h3>
                <p class="text-xs text-slate-600 leading-relaxed bg-slate-50 p-4 rounded-xl border border-slate-200/70 whitespace-pre-line">
                    {{ $assessment->existing_control ?? $assessment->notes }}
                </p>
            </div>
        @endif

    </div>

</div>

</body>
</html>