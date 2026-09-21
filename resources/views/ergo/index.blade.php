<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengujian Faktor Ergonomi — Balai K3 Surabaya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#f8fafc] text-slate-800 antialiased min-h-screen py-8">

<div class="max-w-6xl mx-auto px-4 sm:px-6 space-y-6">

    <!-- Header Halaman -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
        <div>
            <span class="px-2.5 py-0.5 rounded text-[11px] font-bold bg-[#e8f1f9] text-[#153e67] border border-[#d1e3f3]">
                SNI 9011:2021
            </span>
            <h1 class="text-xl font-bold text-slate-900 mt-1">Daftar Hasil Pengujian Ergonomi</h1>
            <p class="text-xs text-slate-500">Rekapitulasi evaluasi potensi bahaya ergonomi dan formulir Gotrak.</p>
        </div>
        <a href="{{ route('ergo.create') }}" class="px-4 py-2 rounded-lg bg-[#153e67] hover:bg-[#0f2e4d] text-white text-xs font-semibold shadow-sm transition flex items-center gap-1.5 w-fit">
            <i class="ph-bold ph-plus"></i> Tambah Pengujian Baru
        </a>
    </div>

    <!-- Notifikasi Flash Message -->
    @if(session('success'))
        <div class="p-4 rounded-lg bg-emerald-50 border border-emerald-200 text-xs font-semibold text-emerald-800 flex items-center gap-2">
            <i class="ph-bold ph-check-circle text-base"></i> {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="p-4 rounded-lg bg-rose-50 border border-rose-200 text-xs font-semibold text-rose-800 flex items-center gap-2">
            <i class="ph-bold ph-warning-circle text-base"></i> {{ session('error') }}
        </div>
    @endif

    <!-- Kontainer Tabel Data -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead class="bg-slate-50 border-b border-slate-200 text-slate-700 font-bold uppercase text-[10px] tracking-wider">
                    <tr>
                        <th class="py-3 px-4">Tanggal</th>
                        <th class="py-3 px-4">Perusahaan</th>
                        <th class="py-3 px-4">Tenaga Kerja</th>
                        <th class="py-3 px-4">Jabatan</th>
                        <th class="py-3 px-4 text-center">Skor Akhir</th>
                        <th class="py-3 px-4 text-center">Tingkat Risiko</th>
                        <th class="py-3 px-4 text-center">Foto</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse($assessments as $item)
                        <tr class="hover:bg-slate-50/70 transition">
                            <td class="py-3 px-4 text-slate-600 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($item->assessment_date)->isoFormat('D MMMM Y') }}
                            </td>
                            <td class="py-3 px-4 font-bold text-slate-900">{{ $item->company_name }}</td>
                            <td class="py-3 px-4 text-slate-800">{{ $item->worker_name }}</td>
                            <td class="py-3 px-4 text-slate-600">{{ $item->position }}</td>
                            <td class="py-3 px-4 text-center font-bold text-[#153e67]">{{ $item->total_score }}</td>
                            <td class="py-3 px-4 text-center whitespace-nowrap">
                                @if($item->risk_level === 'Aman')
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-300">Aman</span>
                                @elseif($item->risk_level === 'Perlu Pengamatan Lanjut')
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800 border border-amber-300">Pengamatan Lanjut</span>
                                @else
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-800 border border-rose-300">Berbahaya</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 text-center whitespace-nowrap">
                                <span class="px-2 py-0.5 rounded bg-slate-100 font-semibold text-slate-700 text-[10px]">
                                    {{ $item->photos_count ?? 0 }} Foto
                                </span>
                            </td>
                            <td class="py-3 px-4 text-center whitespace-nowrap">
                                <div class="inline-flex items-center gap-1">
                                    <!-- Tombol Detail -->
                                    <a href="{{ route('ergo.result', $item->id) }}" class="p-1.5 text-slate-500 hover:text-[#153e67] hover:bg-slate-100 rounded-md transition" title="Lihat Detail">
                                        <i class="ph-bold ph-eye text-base"></i>
                                    </a>

                                    <!-- Tombol Edit -->
                                    <a href="{{ route('ergo.edit', $item->id) }}" class="p-1.5 text-slate-500 hover:text-amber-600 hover:bg-amber-50 rounded-md transition" title="Edit Asesmen">
                                        <i class="ph-bold ph-pencil-simple text-base"></i>
                                    </a>

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('ergo.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pengujian ini beserta lampiran fotonya?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-slate-500 hover:text-rose-600 hover:bg-rose-50 rounded-md transition" title="Hapus Data">
                                            <i class="ph-bold ph-trash text-base"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-10 text-slate-400">
                                <i class="ph-bold ph-folder-open text-3xl mb-1.5 block"></i>
                                Belum ada data pengujian ergonomi yang tersimpan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Bar -->
        @if(method_exists($assessments, 'hasPages') && $assessments->hasPages())
            <div class="p-4 border-t border-slate-200 bg-slate-50/50">
                {{ $assessments->links() }}
            </div>
        @endif
    </div>

</div>

</body>
</html>