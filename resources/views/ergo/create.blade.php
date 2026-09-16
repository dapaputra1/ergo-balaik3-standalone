<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Pengujian Ergonomi — Balai K3 Surabaya</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <!-- MediaPipe Pose untuk AI Deteksi Sudut -->
    <script src="https://cdn.jsdelivr.net/npm/@mediapipe/camera_utils/camera_utils.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@mediapipe/pose/pose.js" crossorigin="anonymous"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .radio-custom input:checked + label {
            background-color: #153e67;
            color: #ffffff;
            border-color: #153e67;
        }
        /* Panel Gotrak Nordic Body Map */
        .gotrak-panel {
            border: 2px solid #000000;
            background-color: #ffffff;
            padding: 8px 10px;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            position: relative;
            z-index: 10;
        }
        .gotrak-title-bar {
            border-bottom: 2px solid #000000;
            font-weight: 800;
            text-transform: uppercase;
            padding-bottom: 4px;
            margin-bottom: 6px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 11px;
            color: #000000;
        }
        .gotrak-check-label {
            display: flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            margin-bottom: 3px;
            font-size: 10px;
            color: #000000;
        }
        .gotrak-check-label input[type="radio"], 
        .gotrak-check-label input[type="checkbox"] {
            accent-color: #153e67;
            width: 13px;
            height: 13px;
        }
    </style>
</head>
<body class="bg-[#f8fafc] text-slate-800 antialiased min-h-screen py-8">

<div class="max-w-6xl mx-auto px-4 sm:px-6 space-y-6">

    <!-- ================= HEADER HALAMAN ================= -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-6 rounded-xl border border-slate-200 shadow-xs">
        <div>
            <div class="flex items-center gap-2 mb-1.5">
                <span class="px-2.5 py-0.5 rounded text-[11px] font-bold bg-[#e8f1f9] text-[#153e67] border border-[#d1e3f3]">
                    Formulir F/7.3.10/BK3-SBY
                </span>
                <span class="text-xs text-slate-400 font-medium">Revisi: -/1</span>
            </div>
            <h1 class="text-xl font-bold text-slate-900">Input Data Pengujian Faktor Ergonomi</h1>
            <p class="text-xs text-slate-500">Lembar pengamatan lapangan berbasis SNI 9011:2021 dan formulir keluhan Gotrak.</p>
        </div>

        <div class="flex items-center gap-2.5">
            <a href="{{ route('ergo.index') }}" class="px-4 py-2 rounded-lg border border-slate-300 text-xs font-semibold text-slate-700 bg-white hover:bg-slate-50 transition shadow-xs">
                Batal
            </a>
            <button type="submit" form="ergoForm" class="px-4 py-2 rounded-lg bg-[#153e67] hover:bg-[#0f2e4d] text-white text-xs font-semibold shadow-xs transition flex items-center gap-1.5">
                <i class="ph-bold ph-floppy-disk"></i> Simpan Data Asesmen
            </button>
        </div>
    </div>

    <form id="ergoForm" action="{{ route('ergo.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- =========================================================================
             BAGIAN 1: DATA UMUM PERUSAHAAN (BUTIR 1 - 5)
             ========================================================================= -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-xs overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200 bg-[#fbfcfd] flex items-center gap-2.5">
                <span class="w-6 h-6 rounded bg-[#153e67] text-white flex items-center justify-center text-xs font-bold">1</span>
                <h2 class="text-sm font-bold text-slate-900">Data Umum Perusahaan & Sampling Pengujian</h2>
            </div>

            <div class="p-6 space-y-4 text-xs">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-2 items-center">
                    <label class="font-semibold text-slate-700">1. Nama Perusahaan <span class="text-rose-500">*</span></label>
                    <input type="text" name="company_name" required placeholder="Contoh: Perumda Air Minum Surya Sembada Kota Surabaya" class="md:col-span-2 border border-slate-300 rounded-lg p-2.5 text-xs focus:border-[#153e67] outline-none">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-2 items-center">
                    <label class="font-semibold text-slate-700">2. Alamat Perusahaan</label>
                    <input type="text" name="address" placeholder="Contoh: Jl. Mayjend Prof. Dr. Moestopo No. 2 Surabaya" class="md:col-span-2 border border-slate-300 rounded-lg p-2.5 text-xs focus:border-[#153e67] outline-none">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-2 items-center">
                    <label class="font-semibold text-slate-700">3. Jenis Perusahaan</label>
                    <input type="text" name="company_type" placeholder="Contoh: Pengolahan Air Bersih (PDAM)" class="md:col-span-2 border border-slate-300 rounded-lg p-2.5 text-xs focus:border-[#153e67] outline-none">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-2 items-center">
                    <label class="font-semibold text-slate-700">4. Tanggal Sampling</label>
                    <input type="date" name="assessment_date" value="{{ date('Y-m-d') }}" class="md:col-span-2 border border-slate-300 rounded-lg p-2.5 text-xs focus:border-[#153e67] outline-none">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-2 items-center">
                    <label class="font-semibold text-slate-700">5. Metode yang Digunakan</label>
                    <input type="text" value="SNI 9011:2021" readonly class="md:col-span-2 bg-slate-100 border border-slate-300 rounded-lg p-2.5 text-xs font-bold text-slate-700 select-none">
                </div>
            </div>
        </div>

        <!-- =========================================================================
             BAGIAN 2: PROFIL PEKERJA & URAIAN TUGAS (BUTIR 6 - 13)
             ========================================================================= -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-xs overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200 bg-[#fbfcfd] flex items-center gap-2.5">
                <span class="w-6 h-6 rounded bg-[#153e67] text-white flex items-center justify-center text-xs font-bold">2</span>
                <h2 class="text-sm font-bold text-slate-900">Profil Tenaga Kerja & Pola Tugas</h2>
            </div>

            <div class="p-6 space-y-5 text-xs">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="font-semibold text-slate-700 block mb-1.5">6. Nama Tenaga Kerja <span class="text-rose-500">*</span></label>
                        <input type="text" name="worker_name" required placeholder="Contoh: M. Jazuli" class="w-full border border-slate-300 rounded-lg p-2.5 text-xs focus:border-[#153e67] outline-none">
                    </div>
                    <div>
                        <label class="font-semibold text-slate-700 block mb-1.5">7. Posisi / Jabatan <span class="text-rose-500">*</span></label>
                        <input type="text" name="position" required placeholder="Contoh: Analis Fisika Kimia" class="w-full border border-slate-300 rounded-lg p-2.5 text-xs focus:border-[#153e67] outline-none">
                    </div>
                </div>

                <div class="bg-slate-50 p-4 rounded-lg border border-slate-200 space-y-3">
                    <span class="font-bold text-slate-800 block">8. Deskripsikan tugas yang dilakukan dan durasi waktu per shift:</span>
                    <div class="space-y-2">
                        <div>
                            <span class="text-slate-600 block mb-1">a. Deskripsi Tugas:</span>
                            <textarea name="job_tasks" rows="2" placeholder="Uraikan tugas operasional yang dilaksanakan..." class="w-full border border-slate-300 rounded-lg p-2.5 text-xs bg-white outline-none focus:border-[#153e67]"></textarea>
                        </div>
                        <div>
                            <span class="text-slate-600 block mb-1">b. Alokasi Waktu:</span>
                            <input type="text" name="job_duration" placeholder="Contoh: Dalam 1 hari kerja melakukan analisa dengan durasi 2-3 jam" class="w-full border border-slate-300 rounded-lg p-2 text-xs bg-white outline-none focus:border-[#153e67]">
                        </div>
                    </div>
                </div>

                <div>
                    <span class="font-semibold text-slate-700 block mb-2">9. Manakah yang merupakan tangan dominan Anda?</span>
                    <div class="grid grid-cols-3 gap-3">
                        @foreach(['Kanan', 'Kiri', 'Keduanya'] as $hand)
                            <div class="radio-custom">
                                <input type="radio" name="dominant_hand" value="{{ $hand }}" id="dh_{{ $hand }}" class="hidden" {{ $hand === 'Kanan' ? 'checked' : '' }}>
                                <label for="dh_{{ $hand }}" class="flex items-center justify-center p-2 rounded-lg border border-slate-300 cursor-pointer text-center transition">
                                    {{ $hand }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div>
                    <span class="font-semibold text-slate-700 block mb-2">10. Sudah berapa lama Anda bekerja pada posisi/jabatan saat ini?</span>
                    <div class="grid grid-cols-2 sm:grid-cols-5 gap-2">
                        @foreach(['Kurang dari 3 bulan', '3 bulan - 1 tahun', '1 - 5 tahun', '5 - 10 tahun', 'Lebih dari 10 tahun'] as $val)
                            <div class="radio-custom">
                                <input type="radio" name="work_duration_level" value="{{ $val }}" id="dur_{{ Str::slug($val) }}" class="hidden" {{ $val === '1 - 5 tahun' ? 'checked' : '' }}>
                                <label for="dur_{{ Str::slug($val) }}" class="flex items-center justify-center p-2 rounded-lg border border-slate-300 cursor-pointer text-center transition">
                                    {{ $val }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-3 border-t border-slate-200">
                    <div>
                        <span class="font-semibold text-slate-700 block mb-2">11. Frekuensi kelelahan mental setelah bekerja?</span>
                        <div class="grid grid-cols-2 gap-2">
                            @foreach(['Tidak pernah', 'Kadang-kadang', 'Sering', 'Selalu'] as $idx => $opt)
                                <div class="radio-custom">
                                    <input type="radio" name="mental_fatigue" value="{{ $opt }}" id="m_{{ $idx }}" class="hidden" {{ $idx === 0 ? 'checked' : '' }}>
                                    <label for="m_{{ $idx }}" class="flex items-center justify-center p-2 rounded-lg border border-slate-300 cursor-pointer transition text-center">
                                        {{ $opt }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <span class="font-semibold text-slate-700 block mb-2">12. Frekuensi kelelahan fisik setelah bekerja?</span>
                        <div class="grid grid-cols-2 gap-2">
                            @foreach(['Tidak pernah', 'Kadang-kadang', 'Sering', 'Selalu'] as $idx => $opt)
                                <div class="radio-custom">
                                    <input type="radio" name="physical_fatigue" value="{{ $opt }}" id="f_{{ $idx }}" class="hidden" {{ $idx === 1 ? 'checked' : '' }}>
                                    <label for="f_{{ $idx }}" class="flex items-center justify-center p-2 rounded-lg border border-slate-300 cursor-pointer transition text-center">
                                        {{ $opt }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="p-4 rounded-lg bg-amber-50/70 border border-amber-200 space-y-2">
                    <span class="font-bold text-slate-900 block">
                        13. Pernahkah Anda mengalami rasa sakit/nyeri atau ketidaknyamanan yang berhubungan dengan pekerjaan dalam satu tahun terakhir?
                    </span>
                    <div class="flex gap-4 pt-1">
                        <label class="flex-1 flex items-center justify-center gap-2 p-2.5 bg-white rounded-lg border border-slate-300 cursor-pointer transition has-[:checked]:border-[#153e67] has-[:checked]:bg-[#153e67] has-[:checked]:text-white font-bold">
                            <input type="radio" name="has_pain_last_year" value="1" onchange="toggleGotrak(true)" class="hidden"> Ya
                        </label>
                        <label class="flex-1 flex items-center justify-center gap-2 p-2.5 bg-white rounded-lg border border-slate-300 cursor-pointer transition has-[:checked]:border-slate-800 has-[:checked]:bg-slate-800 has-[:checked]:text-white font-bold">
                            <input type="radio" name="has_pain_last_year" value="0" checked onchange="toggleGotrak(false)" class="hidden"> Tidak
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- =========================================================================
             BAGIAN 3: NORDIC BODY MAP (SVG-FIRST DENGAN PANAH PRESISI & ELEGAN)
             ========================================================================= -->
        <div id="gotrak_section" class="bg-white rounded-xl border border-slate-200 shadow-xs overflow-hidden transition-all duration-300 opacity-40 pointer-events-none">
            <div class="px-6 py-4 border-b border-slate-200 bg-[#fbfcfd] flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <span class="w-6 h-6 rounded bg-[#153e67] text-white flex items-center justify-center text-xs font-bold">3</span>
                    <h2 class="text-sm font-bold text-slate-900">14. Pemetaan Keluhan Bagian Tubuh (Nordic Body Map / Gotrak)</h2>
                </div>
                <span class="text-[11px] font-bold text-rose-600 bg-rose-50 border border-rose-200 px-2.5 py-0.5 rounded">
                    Gotrak Diagram
                </span>
            </div>

            <div class="p-6 space-y-6">
                <p class="text-slate-600 text-xs font-medium">
                    Catatan: 'sakit' dapat berupa nyeri, kaku, mati rasa, kesemutan, atau rasa terbakar. Setiap kotak dihubungkan langsung dengan garis penunjuk ke bagian tubuh terkait:
                </p>

                <!-- KONTEN DIAGRAM 3 KOLOM: KOTAK KIRI (4) - SILUET PUSAT (3) - KOTAK KANAN (4) -->
                <div class="border-2 border-black p-4 sm:p-6 bg-white overflow-x-auto">
                    <div id="gotrakArea" class="min-w-[1020px] grid grid-cols-11 gap-4 items-stretch relative">
                        
                        <!-- Layer SVG Panah Penunjuk Dinamis -->
                        <svg id="pointerSvg"
                             class="absolute inset-0 w-full h-full pointer-events-none z-20 overflow-visible"
                             xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <!-- Marker Panah Ramping & Tajam (Warna Navy Balai K3 #153e67) -->
                                <marker id="arrowHead" markerWidth="9" markerHeight="9" refX="8" refY="4.5" orient="auto">
                                    <path d="M 1 1.5 L 8 4.5 L 1 7.5 L 2.8 4.5 Z" fill="#153e67" />
                                </marker>
                            </defs>
                        </svg>

                        @php
                            $leftBoxes = [
                                'leher' => ['title' => 'LEHER', 'has_side' => false, 'id' => 'box_leher'],
                                'siku' => ['title' => 'SIKU', 'has_side' => true, 'id' => 'box_siku'],
                                'lengan' => ['title' => 'LENGAN', 'has_side' => true, 'id' => 'box_lengan'],
                                'tangan' => ['title' => 'TANGAN', 'has_side' => true, 'id' => 'box_tangan'],
                                'paha' => ['title' => 'PAHA', 'has_side' => true, 'id' => 'box_paha'],
                                'betis' => ['title' => 'BETIS', 'has_side' => true, 'id' => 'box_betis'],
                            ];
                            $rightBoxes = [
                                'bahu' => ['title' => 'BAHU', 'has_side' => true, 'id' => 'box_bahu'],
                                'punggung_atas' => ['title' => 'PUNGGUNG ATAS', 'has_side' => false, 'id' => 'box_punggung_atas'],
                                'punggung_bawah' => ['title' => 'PUNGGUNG BAWAH', 'has_side' => false, 'id' => 'box_punggung_bawah'],
                                'pinggul' => ['title' => 'PINGGUL', 'has_side' => true, 'id' => 'box_pinggul'],
                                'lutut' => ['title' => 'LUTUT', 'has_side' => true, 'id' => 'box_lutut'],
                                'kaki' => ['title' => 'KAKI', 'has_side' => true, 'id' => 'box_kaki'],
                            ];
                            $freqOptions = ['Tidak pernah', 'Terkadang', 'Sering', 'Selalu'];
                            $sevOptions = ['Tidak ada masalah', 'Tidak nyaman', 'Sakit', 'Sakit parah'];
                        @endphp

                        <!-- KOLOM SISI KIRI (4 KOLOM DARI 11) -->
                        <div class="col-span-4 flex flex-col justify-between py-1 pr-2 space-y-4">
                            @foreach($leftBoxes as $key => $box)
                                <div id="{{ $box['id'] }}" class="gotrak-panel">
                                    <div class="gotrak-title-bar">
                                        <span>{{ $box['title'] }}</span>
                                        @if($box['has_side'])
                                            <div class="flex gap-2 text-[10px] font-normal normal-case">
                                                <label class="flex items-center gap-1 cursor-pointer"><input type="checkbox" name="gotrak[{{ $key }}][side][]" value="Kanan"> Kanan</label>
                                                <label class="flex items-center gap-1 cursor-pointer"><input type="checkbox" name="gotrak[{{ $key }}][side][]" value="Kiri"> Kiri</label>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="grid grid-cols-2 gap-2 text-[10px]">
                                        <div>
                                            <span class="font-bold block mb-1 text-slate-900">Seberapa sering?</span>
                                            @foreach($freqOptions as $idx => $f)
                                                <label class="gotrak-check-label">
                                                    <input type="radio" name="gotrak[{{ $key }}][freq]" value="{{ $f }}" {{ $idx === 0 ? 'checked' : '' }}> {{ $f }}
                                                </label>
                                            @endforeach
                                        </div>
                                        <div>
                                            <span class="font-bold block mb-1 text-slate-900">Seberapa parah?</span>
                                            @foreach($sevOptions as $idx => $s)
                                                <label class="gotrak-check-label">
                                                    <input type="radio" name="gotrak[{{ $key }}][severity]" value="{{ $s }}" {{ $idx === 0 ? 'checked' : '' }}> {{ $s }}
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- KOLOM TENGAH (3 KOLOM): SILUET DENGAN ANCHOR TERKALIBRASI PRESISI -->
                        <div id="bodyCenterCol" class="col-span-3 relative flex items-center justify-center select-none py-1">
                            <svg id="silhouetteCanvas" viewBox="0 0 300 900" class="w-full h-auto max-h-[900px] drop-shadow-sm" xmlns="http://www.w3.org/2000/svg">
                                <!-- Siluet Tubuh Terkunci Rapat Tanpa Margin Kosong Vertikal -->
                                <image href="{{ asset('images/ergo-checklist/nordic_body_clean.png') }}" x="0" y="0" width="300" height="900" preserveAspectRatio="none" />

                                <!-- TITIK TARGET SENDI (Presisi piksel anatomi tubuh yang telah dikalibrasi) -->
                                <!-- 1. Leher: Tengkuk leher tepat di batas garis kerah -->
                                <circle id="anchor_box_leher" cx="150" cy="148" r="1" opacity="0" />
                                
                                <!-- 2. Siku Kiri: Tepi luar lekukan siku kiri -->
                                <circle id="anchor_box_siku" cx="88" cy="320" r="1" opacity="0" />

                                <!-- 3. Lengan Bawah Kiri: Sisi luar lengan bawah kiri -->
                                <circle id="anchor_box_lengan" cx="80" cy="350" r="1" opacity="0" />

                                <!-- 4. Tangan Kiri: Telapak / pergelangan tangan kiri luar -->
                                <circle id="anchor_box_tangan" cx="65" cy="430" r="1" opacity="0" />

                                <!-- 5. Paha Kiri: Bagian tengah paha belakang kiri -->
                                <circle id="anchor_box_paha" cx="136" cy="520" r="1" opacity="0" />

                                <!-- 6. Betis Kiri: Perut otot betis kiri -->
                                <circle id="anchor_box_betis" cx="124" cy="670" r="1" opacity="0" />

                                <!-- 7. Bahu Kanan: Puncak luar tulang bahu kanan -->
                                <circle id="anchor_box_bahu" cx="200" cy="175" r="1" opacity="0" />

                                <!-- 8. Punggung Atas: Punggung atas antara tulang belikat -->
                                <circle id="anchor_box_punggung_atas" cx="150" cy="225" r="1" opacity="0" />

                                <!-- 9. Punggung Bawah: Pinggang / lumbal tengah -->
                                <circle id="anchor_box_punggung_bawah" cx="150" cy="330" r="1" opacity="0" />

                                <!-- 10. Pinggul: Garis panggul / sabuk bokong -->
                                <circle id="anchor_box_pinggul" cx="150" cy="395" r="1" opacity="0" />

                                <!-- 11. Lutut Kanan: Lekuk belakang lutut kanan -->
                                <circle id="anchor_box_lutut" cx="176" cy="595" r="1" opacity="0" />

                                <!-- 12. Kaki Kanan: Tumit / mata kaki kanan -->
                                <circle id="anchor_box_kaki" cx="165" cy="810" r="1" opacity="0" />
                            </svg>
                        </div>

                        <!-- KOLOM SISI KANAN (4 KOLOM DARI 11) -->
                        <div class="col-span-4 flex flex-col justify-between py-1 pl-2 space-y-4">
                            @foreach($rightBoxes as $key => $box)
                                <div id="{{ $box['id'] }}" class="gotrak-panel">
                                    <div class="gotrak-title-bar">
                                        <span>{{ $box['title'] }}</span>
                                        @if($box['has_side'])
                                            <div class="flex gap-2 text-[10px] font-normal normal-case">
                                                <label class="flex items-center gap-1 cursor-pointer"><input type="checkbox" name="gotrak[{{ $key }}][side][]" value="Kanan"> Kanan</label>
                                                <label class="flex items-center gap-1 cursor-pointer"><input type="checkbox" name="gotrak[{{ $key }}][side][]" value="Kiri"> Kiri</label>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="grid grid-cols-2 gap-2 text-[10px]">
                                        <div>
                                            <span class="font-bold block mb-1 text-slate-900">Seberapa sering?</span>
                                            @foreach($freqOptions as $idx => $f)
                                                <label class="gotrak-check-label">
                                                    <input type="radio" name="gotrak[{{ $key }}][freq]" value="{{ $f }}" {{ $idx === 0 ? 'checked' : '' }}> {{ $f }}
                                                </label>
                                            @endforeach
                                        </div>
                                        <div>
                                            <span class="font-bold block mb-1 text-slate-900">Seberapa parah?</span>
                                            @foreach($sevOptions as $idx => $s)
                                                <label class="gotrak-check-label">
                                                    <input type="radio" name="gotrak[{{ $key }}][severity]" value="{{ $s }}" {{ $idx === 0 ? 'checked' : '' }}> {{ $s }}
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>

                <!-- TABEL RIWAYAT CEDERA -->
                <div class="space-y-2 pt-3 border-t border-slate-200">
                    <p class="text-xs text-black font-semibold">
                        Pada setiap bagian tubuh dengan keterangan "sakit" atau "sakit parah", atau "selalu" merasakan "tidak nyaman", jelaskan pekerjaan yang menurut Anda menyebabkan masalah tersebut, dan apakah sebelumnya Anda pernah mengalami cedera di bagian tubuh tersebut:
                    </p>
                    <div class="border-2 border-black rounded overflow-hidden">
                        <table class="w-full text-left border-collapse text-xs">
                            <thead class="bg-slate-100 font-bold border-b-2 border-black text-[11px] text-black">
                                <tr>
                                    <th class="py-2 px-3 border-r-2 border-black w-1/4">Bagian Tubuh</th>
                                    <th class="py-2 px-3 border-r-2 border-black w-1/4 text-center">Pernah Mengalami Cedera?</th>
                                    <th class="py-2 px-3">Kemungkinan Pekerjaan yang Menyebabkan Masalah</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-black bg-white">
                                @for($i = 0; $i < 4; $i++)
                                    <tr>
                                        <td class="p-2 border-r-2 border-black">
                                            <input type="text" name="injury[{{ $i }}][part]" placeholder="Contoh: Punggung Bawah" class="w-full border border-slate-300 rounded p-1 text-xs outline-none focus:border-[#153e67]">
                                        </td>
                                        <td class="p-2 border-r-2 border-black text-center">
                                            <div class="flex justify-center gap-4 text-xs">
                                                <label class="flex items-center gap-1 cursor-pointer"><input type="radio" name="injury[{{ $i }}][history]" value="Ya" class="accent-[#153e67]"> Ya</label>
                                                <label class="flex items-center gap-1 cursor-pointer"><input type="radio" name="injury[{{ $i }}][history]" value="Tidak" checked class="accent-[#153e67]"> Tidak</label>
                                            </div>
                                        </td>
                                        <td class="p-2">
                                            <input type="text" name="injury[{{ $i }}][cause]" placeholder="Uraikan faktor kerja..." class="w-full border border-slate-300 rounded p-1 text-xs outline-none focus:border-[#153e67]">
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

        <!-- =========================================================================
             BAGIAN 4: DAFTAR PERIKSA LENGKAP 31 BUTIR SNI 9011:2021 DENGAN GAMBAR
             ========================================================================= -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-xs overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200 bg-[#fbfcfd] flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <span class="w-6 h-6 rounded bg-[#153e67] text-white flex items-center justify-center text-xs font-bold">4</span>
                    <h2 class="text-sm font-bold text-slate-900">Daftar Periksa Potensi Bahaya Faktor Ergonomi (Lengkap 31 Butir)</h2>
                </div>
                <span class="text-[11px] font-semibold text-slate-500">SNI 9011:2021</span>
            </div>

            <div class="p-6 space-y-6 text-xs">
                @php
                    $ergoItemsA = [
                        1 => ['img' => 'image21.png', 'title' => 'Leher: Memuntir atau Menekuk', 'desc' => 'Leher memuntir > 20°, atau menekuk ke depan > 20° / ke belakang > 5°.'],
                        2 => ['img' => 'image17.png', 'title' => 'Bahu: Lengan / Siku Tidak Ditopang', 'desc' => 'Lengan/siku tidak ditopang, dengan posisi di atas tinggi perut.'],
                        3 => ['img' => 'image20.png', 'title' => 'Rotasi Lengan Bawah Secara Cepat', 'desc' => 'Gerakan pronasi atau supinasi berulang dengan cepat.'],
                        4 => ['img' => 'image19.png', 'title' => 'Pergelangan Tangan Menekuk', 'desc' => 'Pergelangan menekuk ke depan (fleksi) atau ke samping.'],
                        5 => ['img' => 'placeholder',  'title' => 'Gerakan Lengan Sedang', 'desc' => 'Gerakan lengan yang stabil dan ritmis dengan jeda yang teratur.'],
                        6 => ['img' => 'placeholder',  'title' => 'Gerakan Lengan Intensif', 'desc' => 'Gerakan lengan cepat yang berlangsung terus-menerus tanpa jeda.'],
                        7 => ['img' => 'image16.png', 'title' => 'Penggunaan Keyboard (Berselang)', 'desc' => 'Mengetik di komputer secara berselang (diselingi jeda).'],
                        8 => ['img' => 'placeholder',  'title' => 'Mengetik Secara Intensif', 'desc' => 'Mengetik secara konstan dalam waktu lama.'],
                        9 => ['img' => 'image5.png',  'title' => 'Menggenggam Kuat (Power Grip)', 'desc' => 'Menggenggam benda dengan gaya lebih dari 5 kg.'],
                        10 => ['img' => 'placeholder', 'title' => 'Menjepit dengan Jari (Pinch Grip)', 'desc' => 'Memencet objek dengan ujung jari dengan gaya lebih dari 1 kg.'],
                        11 => ['img' => 'image4.png',  'title' => 'Tekanan Kontak Benda Keras', 'desc' => 'Kulit tertekan oleh benda yang keras atau runcing.'],
                        12 => ['img' => 'placeholder', 'title' => 'Menggunakan Tangan Memukul', 'desc' => 'Menggunakan tangan untuk memukul (berfungsi seperti palu).'],
                        13 => ['img' => 'image3.png',  'title' => 'Getaran Lokal (Hand-Arm)', 'desc' => 'Paparan getaran lokal pada tangan dan lengan.'],
                        14 => ['img' => 'placeholder', 'title' => 'Ritme Kerja Tidak Terkontrol', 'desc' => 'Ritme kerja dipacu oleh mesin (conveyor).'],
                        15 => ['img' => 'placeholder', 'title' => 'Kondisi Pencahayaan', 'desc' => 'Pencahayaan kurang memadai atau silau.'],
                        16 => ['img' => 'placeholder', 'title' => 'Temperatur Ekstrem', 'desc' => 'Suhu area kerja terlalu tinggi (panas) atau rendah (dingin).'],
                    ];
                    
                    $ergoItemsB = [
                        17 => ['img' => 'image25.png', 'title' => 'Tubuh Membungkuk Sedang', 'desc' => 'Tubuh membungkuk antara 20° hingga 45°.'],
                        18 => ['img' => 'image26.png', 'title' => 'Tubuh Membungkuk Berat', 'desc' => 'Tubuh membungkuk ke depan lebih dari 45°.'],
                        19 => ['img' => 'image24.png', 'title' => 'Tubuh Menekuk ke Belakang', 'desc' => 'Tubuh menekuk ke belakang (ekstensi) hingga 30°.'],
                        20 => ['img' => 'image15.png', 'title' => 'Pemuntiran Torso', 'desc' => 'Batang tubuh berputar saat memindahkan barang.'],
                        21 => ['img' => 'image1.png',  'title' => 'Gerakan Abduksi Paha', 'desc' => 'Gerakan paha menjauhi tubuh ke samping.'],
                        22 => ['img' => 'image14.png', 'title' => 'Posisi Berlutut atau Jongkok', 'desc' => 'Bekerja dalam posisi berlutut/jongkok terus menerus.'],
                        23 => ['img' => 'image13.png', 'title' => 'Pergelangan Kaki Menekuk', 'desc' => 'Pergelangan kaki menekuk ke atas/bawah berulang.'],
                        24 => ['img' => 'image11.png', 'title' => 'Aktivitas Pedal / Pijakan Labil', 'desc' => 'Menginjak pedal kaki atau pijakan kaki tidak stabil.'],
                        25 => ['img' => 'image6.png',  'title' => 'Duduk Lama Tanpa Sandaran', 'desc' => 'Duduk lama tanpa penopang punggung memadai.'],
                        26 => ['img' => 'image9.png',  'title' => 'Berdiri Diam Dalam Jangka Lama', 'desc' => 'Berdiri statis lama tanpa tumpuan kaki.'],
                        27 => ['img' => 'image2.png',  'title' => 'Tubuh Bawah Tertekan', 'desc' => 'Paha/lutut tertekan permukaan benda keras.'],
                        28 => ['img' => 'image7.png',  'title' => 'Lutut Menendang/Memukul', 'desc' => 'Menggunakan lutut untuk menghentak.'],
                        29 => ['img' => 'image8.png',  'title' => 'Getaran Seluruh Tubuh', 'desc' => 'Paparan getaran mekanis pada seluruh tubuh (WBV).'],
                        30 => ['img' => 'placeholder', 'title' => 'Mendorong Beban Sedang', 'desc' => 'Mendorong/menarik troli beban sedang.'],
                        31 => ['img' => 'placeholder', 'title' => 'Mendorong Beban Berat', 'desc' => 'Mendorong/menarik beban berat butuh tenaga penuh.'],
                    ];
                @endphp

                <!-- SUB A: TUBUH BAGIAN ATAS -->
                <div class="space-y-3">
                    <span class="font-bold text-[#153e67] uppercase tracking-wider block bg-slate-100 p-2 rounded">
                        A. Potensi Bahaya Tubuh Bagian Atas (Butir 1 – 16)
                    </span>
                    @foreach($ergoItemsA as $no => $item)
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 p-3 rounded-lg border border-slate-200 items-center">
                            <div class="md:col-span-3 text-center bg-slate-50 p-1.5 rounded border border-slate-100 flex justify-center items-center h-20">
                                @if($item['img'] !== 'placeholder')
                                    <img src="{{ asset('images/ergo-checklist/'.$item['img']) }}" class="max-h-full object-contain" alt="{{ $item['title'] }}" onerror="this.style.display='none'">
                                @else
                                    <span class="text-[10px] text-slate-400 font-bold uppercase">Tanpa Gambar</span>
                                @endif
                            </div>
                            <div class="md:col-span-5">
                                <span class="font-bold text-slate-900 block mb-0.5">{{ $no }}. {{ $item['title'] }}</span>
                                <p class="text-slate-500">{{ $item['desc'] }}</p>
                            </div>
                            <div class="md:col-span-4">
                                <select name="ergo_items[{{ $no }}]" class="w-full border border-slate-300 rounded-lg p-2 text-xs bg-white outline-none focus:border-[#153e67]">
                                    <option value="0">0% – 25% Waktu (Skor 0)</option>
                                    <option value="1">25% – 50% Waktu (Skor 1)</option>
                                    <option value="2">50% – 100% Waktu (Skor 2)</option>
                                    <option value="3">&gt; 100% / Sangat Parah (Skor 3)</option>
                                </select>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- SUB B: PUNGGUNG & TUBUH BAWAH -->
                <div class="space-y-3 pt-4 border-t border-slate-200">
                    <span class="font-bold text-[#153e67] uppercase tracking-wider block bg-slate-100 p-2 rounded">
                        B. Potensi Bahaya Punggung & Tubuh Bawah (Butir 17 – 31)
                    </span>
                    @foreach($ergoItemsB as $no => $item)
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 p-3 rounded-lg border border-slate-200 items-center">
                            <div class="md:col-span-3 text-center bg-slate-50 p-1.5 rounded border border-slate-100 flex justify-center items-center h-20">
                                @if($item['img'] !== 'placeholder')
                                    <img src="{{ asset('images/ergo-checklist/'.$item['img']) }}" class="max-h-full object-contain" alt="{{ $item['title'] }}" onerror="this.style.display='none'">
                                @else
                                    <span class="text-[10px] text-slate-400 font-bold uppercase">Tanpa Gambar</span>
                                @endif
                            </div>
                            <div class="md:col-span-5">
                                <span class="font-bold text-slate-900 block mb-0.5">{{ $no }}. {{ $item['title'] }}</span>
                                <p class="text-slate-500">{{ $item['desc'] }}</p>
                            </div>
                            <div class="md:col-span-4">
                                <select name="ergo_items[{{ $no }}]" class="w-full border border-slate-300 rounded-lg p-2 text-xs bg-white outline-none focus:border-[#153e67]">
                                    <option value="0">0% – 25% Waktu (Skor 0)</option>
                                    <option value="1">25% – 50% Waktu (Skor 1)</option>
                                    <option value="2">50% – 100% Waktu (Skor 2)</option>
                                    <option value="3">&gt; 100% / Sangat Parah (Skor 3)</option>
                                </select>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- SUB C: PENGANGKATAN BEBAN MANUAL (MMH) -->
                <div class="space-y-3 pt-4 border-t border-slate-200">
                    <span class="font-bold text-[#153e67] uppercase tracking-wider block bg-slate-100 p-2 rounded">
                        C. Pengangkatan Beban Manual (MMH)
                    </span>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="p-3 border border-slate-200 rounded-lg bg-slate-50">
                            <label class="font-bold text-slate-800 block mb-1">Berat Beban & Jarak Angkat</label>
                            <select name="mmh_weight_score" class="w-full border border-slate-300 rounded p-2 text-xs bg-white outline-none">
                                <option value="0">&lt; 7 kg dengan jarak dekat (Skor 0)</option>
                                <option value="1">7 – 13 kg jarak dekat (Skor 1)</option>
                                <option value="2">14 – 23 kg jarak dekat (Skor 2)</option>
                                <option value="3">&gt; 23 kg jarak dekat / rotasi (Skor 3)</option>
                            </select>
                        </div>
                        <div class="p-3 border border-slate-200 rounded-lg bg-slate-50">
                            <label class="font-bold text-slate-800 block mb-1">Jarak Angkut / Membawa Benda</label>
                            <select name="mmh_distance_score" class="w-full border border-slate-300 rounded p-2 text-xs bg-white outline-none">
                                <option value="0">Tidak membawa beban / &lt; 3 meter (Skor 0)</option>
                                <option value="1">Membawa beban 3 – 9 meter (Skor 1)</option>
                                <option value="2">Membawa beban &gt; 9 meter (Skor 2)</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- =========================================================================
             BAGIAN 5: UPLOAD FOTO & AI SUDUT MEDIAPIPE
             ========================================================================= -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-xs overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200 bg-[#fbfcfd] flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <span class="w-6 h-6 rounded bg-[#153e67] text-white flex items-center justify-center text-xs font-bold">5</span>
                    <h2 class="text-sm font-bold text-slate-900">Dokumentasi Foto Postur & Anotasi Sudut Otomatis</h2>
                </div>
                <span class="text-[11px] font-semibold text-blue-700 bg-blue-50 border border-blue-200 px-2 py-0.5 rounded">AI Auto-Pose</span>
            </div>

            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6 text-xs items-start">
                <div class="space-y-2 relative">
                    <label class="font-bold text-slate-700 block">Foto Pengamatan Lapangan & Analisis Sudut</label>
                    <div class="relative border-2 border-dashed border-slate-300 rounded-xl p-4 text-center bg-slate-50 min-h-[220px] flex flex-col justify-center">
                        <input type="file" id="imageUploader" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="handleImageUpload(event)">
                        <input type="hidden" name="annotated_photo_data" id="annotatedPhotoData">

                        <div id="uploadPrompt" class="space-y-2 pointer-events-none">
                            <i class="ph-bold ph-camera text-3xl text-[#153e67]"></i>
                            <p class="font-bold text-slate-800 text-sm">Pilih berkas foto pekerja</p>
                            <p class="text-slate-500 text-[10px]">Garis sendi & sudut akan digambar otomatis (AI)</p>
                        </div>
                        <div id="aiLoading" class="hidden space-y-2">
                            <div class="w-6 h-6 border-2 border-[#153e67] border-t-transparent rounded-full animate-spin mx-auto"></div>
                            <p class="text-[10px] text-slate-600">Menghitung derajat postur...</p>
                        </div>
                        <div id="canvasContainer" class="hidden relative">
                            <canvas id="poseCanvas" class="rounded shadow border border-slate-200 mx-auto max-h-[300px]"></canvas>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="font-bold text-slate-700 block mb-1">Pengambil Contoh Uji (Surveyor K3)</label>
                        <input type="text" name="sampler_name" placeholder="Nama lengkap petugas penguji..." class="w-full border border-slate-300 rounded-lg p-2.5 text-xs outline-none focus:border-[#153e67]">
                    </div>

                    <div>
                        <label class="font-bold text-slate-700 block mb-1">Metode Pengendalian yang Sudah Ada</label>
                        <input type="text" name="existing_control" value="Adanya waktu istirahat/peregangan" class="w-full border border-slate-300 rounded-lg p-2 text-xs outline-none focus:border-[#153e67]">
                    </div>

                    <div class="pt-4 flex justify-end gap-2 border-t border-slate-200">
                        <a href="{{ route('ergo.index') }}" class="px-4 py-2 border border-slate-300 rounded-lg text-slate-600 hover:bg-slate-50 font-semibold">Batal</a>
                        <button type="submit" class="px-5 py-2 bg-[#153e67] hover:bg-[#0f2e4d] text-white rounded-lg font-bold shadow-sm transition flex items-center gap-1.5">
                            <i class="ph-bold ph-floppy-disk"></i> Simpan Data Pengujian
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>

<!-- =========================================================================
     JAVASCRIPT: TOGGLE GOTRAK, DYNAMIC SVG CONNECTOR & MEDIAPIPE POSE
     ========================================================================= -->
<script>
    // 1. Fungsi Toggle Tampil/Sembunyi Nordic Body Map
    function toggleGotrak(show) {
        const sec = document.getElementById('gotrak_section');
        if (show) {
            sec.classList.remove('opacity-40', 'pointer-events-none');
            setTimeout(drawDynamicPointers, 200);
        } else {
            sec.classList.add('opacity-40', 'pointer-events-none');
        }
    }

    // Daftar ID Kotak yang Dihubungkan ke Titik Sendi Target
    const boxIds = [
        'box_leher', 'box_siku', 'box_lengan', 'box_tangan', 'box_paha', 'box_betis',
        'box_bahu', 'box_punggung_atas', 'box_punggung_bawah', 'box_pinggul', 'box_lutut', 'box_kaki'
    ];

    // 2. Logika Penarikan Garis Panah Dinamis Berpenampilan Ramping & Presisi
    function drawDynamicPointers() {
        const svg = document.getElementById('pointerSvg');
        const container = document.getElementById('gotrakArea');

        if (!svg || !container) return;

        const contRect = container.getBoundingClientRect();
        if (contRect.width <= 0 || contRect.height <= 0) {
            requestAnimationFrame(drawDynamicPointers);
            return;
        }

        // Sinkronkan viewBox SVG overlay secara 1:1 dengan kontainer diagram
        svg.setAttribute('viewBox', `0 0 ${contRect.width} ${contRect.height}`);

        let elements = `
            <defs>
                <!-- Marker Panah Ramping & Tajam (Warna Navy Balai K3 #153e67) -->
                <marker id="arrowHead" markerWidth="9" markerHeight="9" refX="8" refY="4.5" orient="auto">
                    <path d="M 1 1.5 L 8 4.5 L 1 7.5 L 2.8 4.5 Z" fill="#153e67" />
                </marker>
            </defs>
        `;

        boxIds.forEach(boxId => {
            const boxEl = document.getElementById(boxId);
            const anchorEl = document.getElementById('anchor_' + boxId);

            if (!boxEl || !anchorEl) return;

            const boxRect = boxEl.getBoundingClientRect();
            const anchorRect = anchorEl.getBoundingClientRect();

            // Cek apakah kartu berada di sisi kiri atau kanan siluet
            const isLeft = boxRect.left < anchorRect.left;

            // Titik awal garis: dari tepi kartu yang menghadap ke arah siluet
            const startX = isLeft 
                ? (boxRect.right - contRect.left) 
                : (boxRect.left - contRect.left);
            const startY = (boxRect.top + boxRect.height / 2) - contRect.top;

            // Titik akhir garis: tepat di koordinat pusat jangkar sendi siluet
            const endX = (anchorRect.left + anchorRect.width / 2) - contRect.left;
            const endY = (anchorRect.top + anchorRect.height / 2) - contRect.top;

            // Garis lurus yang bersih & halus
            elements += `
                <line x1="${startX}" y1="${startY}" x2="${endX}" y2="${endY}" 
                      stroke="#153e67" stroke-width="1.6" stroke-linecap="round" marker-end="url(#arrowHead)" />
                <circle cx="${startX}" cy="${startY}" r="3" fill="#153e67" stroke="#ffffff" stroke-width="1" />
            `;
        });

        svg.innerHTML = elements;
    }

    // Inisialisasi saat window selesai dimuat
    window.addEventListener('load', () => {
        setTimeout(drawDynamicPointers, 200);
    });

    // Responsif terhadap perbesaran/pengecilan jendela & scroll horizontal tabel
    window.addEventListener('resize', () => {
        clearTimeout(window.__nbmResize);
        window.__nbmResize = setTimeout(drawDynamicPointers, 80);
    });

    const scrollArea = document.querySelector('.overflow-x-auto');
    if (scrollArea) {
        scrollArea.addEventListener('scroll', drawDynamicPointers);
    }

    // 3. Inisialisasi MediaPipe Pose AI (Anotasi Sudut Kuning Otomatis)
    let rawImageElement = new Image();
    let detectedLandmarks = null;

    const pose = new Pose({ locateFile: (file) => `https://cdn.jsdelivr.net/npm/@mediapipe/pose/${file}` });
    pose.setOptions({ modelComplexity: 1, smoothLandmarks: true, minDetectionConfidence: 0.5 });
    pose.onResults(onPoseResults);

    function handleImageUpload(event) {
        const file = event.target.files[0];
        if (!file) return;

        document.getElementById('uploadPrompt').classList.add('hidden');
        document.getElementById('aiLoading').classList.remove('hidden');
        document.getElementById('canvasContainer').classList.add('hidden');

        const reader = new FileReader();
        reader.onload = function(e) {
            rawImageElement.src = e.target.result;
            rawImageElement.onload = function() {
                pose.send({ image: rawImageElement });
            };
        };
        reader.readAsDataURL(file);
    }

    function findAngle(p1, p2, p3) {
        let radians = Math.atan2(p3.y - p2.y, p3.x - p2.x) - Math.atan2(p1.y - p2.y, p1.x - p2.x);
        let angle = Math.abs((radians * 180.0) / Math.PI);
        if (angle > 180.0) angle = 360 - angle;
        return Math.round(angle);
    }
    function findVerticalAngle(pTop, pBottom) {
        let dx = pTop.x - pBottom.x;
        let dy = pBottom.y - pTop.y;
        let angle = Math.atan2(Math.abs(dx), Math.abs(dy)) * (180.0 / Math.PI);
        return Math.round(angle);
    }

    function onPoseResults(results) {
        document.getElementById('aiLoading').classList.add('hidden');
        document.getElementById('canvasContainer').classList.remove('hidden');

        detectedLandmarks = results.poseLandmarks;
        const canvas = document.getElementById('poseCanvas');
        const ctx = canvas.getContext('2d');
        canvas.width = rawImageElement.naturalWidth;
        canvas.height = rawImageElement.naturalHeight;
        
        ctx.drawImage(rawImageElement, 0, 0, canvas.width, canvas.height);

        if (detectedLandmarks) {
            const lm = detectedLandmarks;
            const W = canvas.width, H = canvas.height;
            const pts = lm.map(p => ({ x: p.x * W, y: p.y * H }));

            const isRight = lm[12].visibility > lm[11].visibility;
            const ear = isRight ? pts[8] : pts[7];
            const shoulder = isRight ? pts[12] : pts[11];
            const elbow = isRight ? pts[14] : pts[13];
            const wrist = isRight ? pts[16] : pts[15];
            const hip = isRight ? pts[24] : pts[23];
            const knee = isRight ? pts[26] : pts[25];
            const ankle = isRight ? pts[28] : pts[27];

            ctx.strokeStyle = '#facc15'; ctx.fillStyle = '#facc15';
            ctx.lineWidth = Math.max(3, Math.round(W / 250));
            ctx.font = `bold ${Math.max(16, Math.round(W / 35))}px Arial`;

            ctx.setLineDash([8, 6]);
            ctx.beginPath(); ctx.moveTo(hip.x, hip.y); ctx.lineTo(hip.x, hip.y - 250); ctx.stroke();
            ctx.setLineDash([]);

            [
                [ear, shoulder], [shoulder, hip], [shoulder, elbow], 
                [elbow, wrist], [hip, knee], [knee, ankle]
            ].forEach(([pA, pB]) => {
                ctx.beginPath(); ctx.moveTo(pA.x, pA.y); ctx.lineTo(pB.x, pB.y); ctx.stroke();
            });

            [ear, shoulder, elbow, wrist, hip, knee, ankle].forEach(p => {
                ctx.beginPath(); ctx.arc(p.x, p.y, Math.max(4, Math.round(W/250)), 0, 2*Math.PI); ctx.fill();
            });

            const drawTxt = (txt, p) => {
                ctx.shadowColor = 'black'; ctx.shadowBlur = 4;
                ctx.fillText(txt + '°', p.x + 10, p.y - 10);
                ctx.shadowBlur = 0;
            };

            drawTxt(findVerticalAngle(ear, shoulder), { x: (ear.x+shoulder.x)/2, y: (ear.y+shoulder.y)/2 });
            drawTxt(findVerticalAngle(shoulder, hip), { x: (shoulder.x+hip.x)/2, y: (shoulder.y+hip.y)/2 });
            drawTxt(findAngle(shoulder, elbow, wrist), elbow);
            drawTxt(findAngle(hip, knee, ankle), knee);
        }

        document.getElementById('annotatedPhotoData').value = canvas.toDataURL('image/jpeg', 0.9);
    }
</script>
</body>
</html>