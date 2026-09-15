<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Asesmen Ergonomi - Balai K3 Surabaya</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
    <div class="max-w-6xl mx-auto p-6">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-blue-900">Asesmen Faktor Ergonomi Balai K3</h1>
                <p class="text-sm text-gray-600">Berdasarkan Standar SNI 9011:2021</p>
            </div>
            <a href="{{ route('ergo.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium shadow">
                + Tambah Asesmen Baru
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded shadow-sm">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow overflow-hidden border border-gray-100">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-100 text-gray-700 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="p-4">No. LHU</th>
                        <th class="p-4">Tanggal</th>
                        <th class="p-4">Perusahaan</th>
                        <th class="p-4">Departemen</th>
                        <th class="p-4">Pekerja</th>
                        <th class="p-4 text-center">Skor Total</th>
                        <th class="p-4">Interpretasi Hasil</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm">
                    @forelse($assessments as $assessment)
                        @foreach($assessment->workers as $worker)
                            <tr class="hover:bg-gray-50">
                                <td class="p-4 font-mono text-xs">{{ $assessment->lhu_number ?? '-' }}</td>
                                <td class="p-4 text-gray-500">{{ $assessment->assessment_date }}</td>
                                <td class="p-4 font-semibold text-gray-900">{{ $assessment->company->name ?? '-' }}</td>
                                <td class="p-4">{{ $assessment->department }}</td>
                                <td class="p-4">{{ $worker->name }}</td>
                                <td class="p-4 text-center font-bold">
                                    <span class="px-2.5 py-1 bg-blue-100 text-blue-800 rounded">
                                        {{ $worker->rebaScore->final_score ?? 0 }}
                                    </span>
                                </td>
                                <td class="p-4">
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full 
                                        {{ str_contains($worker->rebaScore->risk_level ?? '', 'berbahaya') ? 'bg-red-100 text-red-800' : 
                                           (str_contains($worker->rebaScore->risk_level ?? '', 'perlu pengamatan') ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                                        {{ $worker->rebaScore->risk_level ?? 'Aman' }}
                                    </span>
                                </td>
                                <td class="p-4 text-center">
                                    <a href="{{ route('ergo.result', $assessment->id) }}" class="text-blue-600 hover:underline text-xs font-semibold">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="8" class="p-6 text-center text-gray-400">Belum ada data asesmen ergonomi tersimpan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>