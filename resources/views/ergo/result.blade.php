<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Asesmen Ergonomi - Balai K3 Surabaya</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
    <div class="max-w-3xl mx-auto p-6 my-6 bg-white rounded-xl shadow border border-gray-100">
        <div class="flex justify-between items-center pb-4 mb-6 border-b">
            <div>
                <span class="text-xs font-bold text-blue-600 uppercase">Laporan Hasil Uji (LHU) Instan</span>
                <h1 class="text-xl font-bold text-gray-900">Balai Hiperkes dan K3 Surabaya</h1>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('ergo.index') }}" class="px-3 py-1.5 border rounded-lg text-xs font-medium hover:bg-gray-50">&larr; Daftar Asesmen</a>
                <button onclick="window.print()" class="px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-xs font-medium shadow">Cetak / PDF</button>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-3 mb-4 rounded text-sm">
                {{ session('success') }}
            </div>
        @endif

        @foreach($assessment->workers as $worker)
            @php $ergo = $worker->rebaScore; @endphp
            
            <div class="grid grid-cols-2 gap-4 bg-gray-50 p-4 rounded-lg mb-6 text-sm border">
                <div>
                    <p class="text-gray-500 text-xs">No. Dokumen LHU</p>
                    <p class="font-bold text-gray-900">{{ $assessment->lhu_number ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500 text-xs">Perusahaan / Instansi</p>
                    <p class="font-bold text-gray-900">{{ $assessment->company->name }}</p>
                </div>
                <div>
                    <p class="text-gray-500 text-xs">Departemen / Bagian</p>
                    <p class="font-bold text-gray-900">{{ $assessment->department }}</p>
                </div>
                <div>
                    <p class="text-gray-500 text-xs">Pekerja Diamati</p>
                    <p class="font-bold text-gray-900">{{ $worker->name }} ({{ $worker->age ?? '-' }} Thn)</p>
                </div>
            </div>

            <!-- KOTAK HASIL INSTAN (DIRECT RESULT) -->
            <div class="p-6 rounded-xl mb-6 text-center shadow-sm border 
                {{ str_contains($ergo->risk_level ?? '', 'berbahaya') ? 'bg-red-50 border-red-200 text-red-900' : 
                   (str_contains($ergo->risk_level ?? '', 'perlu pengamatan') ? 'bg-yellow-50 border-yellow-200 text-yellow-900' : 'bg-green-50 border-green-200 text-green-900') }}">
                
                <p class="text-xs uppercase tracking-widest font-bold opacity-75 mb-1">Total Skor Penilaian</p>
                <h2 class="text-5xl font-extrabold mb-2">{{ $ergo->final_score ?? 0 }}</h2>
                
                <hr class="my-3 opacity-30">
                
                <p class="text-xs uppercase tracking-widest font-bold opacity-75 mb-1">Interpretasi Hasil (SNI 9011)</p>
                <p class="text-lg font-bold uppercase">{{ $ergo->risk_level ?? 'Aman' }}</p>
            </div>

            @if($ergo && $ergo->photo_path)
                <div class="mb-6">
                    <p class="text-xs font-semibold text-gray-600 mb-2">Dokumentasi Foto Postur Kerja:</p>
                    <img src="{{ asset('storage/' . $ergo->photo_path) }}" alt="Foto Postur" class="w-48 h-48 object-cover rounded-lg border shadow-sm">
                </div>
            @endif

            <a href="{{ route('ergo.pdf', $assessment->id) }}" target="_blank" class="px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-xs font-medium shadow">
    Cetak / Download LHU PDF
</a>

            <div class="bg-blue-50 border border-blue-200 p-4 rounded-lg">
                <h3 class="text-xs font-bold text-blue-900 uppercase mb-1">Catatan & Rekomendasi Tindakan Perbaikan:</h3>
                <p class="text-sm text-blue-900">{{ $ergo->notes ?? 'Tidak ada catatan khusus.' }}</p>
            </div>
        @endforeach
    </div>
</body>
</html>