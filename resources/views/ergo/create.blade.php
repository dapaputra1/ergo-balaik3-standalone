<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Asesmen Ergonomi - Balai K3 Surabaya</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
    <div class="max-w-3xl mx-auto p-6 my-6 bg-white rounded-xl shadow border border-gray-100">
        <div class="mb-6 pb-4 border-b border-gray-100 flex justify-between items-center">
            <div>
                <h1 class="text-xl font-bold text-blue-900">Form Daftar Periksa Potensi Bahaya Faktor Ergonomi</h1>
                <p class="text-xs text-gray-500">Sesuai Format LHU Balai Hiperkes dan K3 Surabaya (SNI 9011:2021)</p>
            </div>
            <a href="{{ route('ergo.index') }}" class="text-sm text-blue-600 hover:underline">&larr; Kembali</a>
        </div>

        <form action="{{ route('ergo.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Data Umum LHU -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold mb-1">Nomor Dokumen Pengujian (LHU)</label>
                    <input type="text" name="lhu_number" placeholder="Contoh: LAB. 0032/VII/2025" class="w-full border border-gray-300 p-2.5 rounded-lg text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Penanggung Jawab / Pengurus</label>
                    <input type="text" name="pic_name" placeholder="Contoh: Mohammad Nurul Huda" class="w-full border border-gray-300 p-2.5 rounded-lg text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Nama Perusahaan / Instansi</label>
                    <input type="text" name="company_name" required placeholder="Contoh: Perumda Air Minum" class="w-full border border-gray-300 p-2.5 rounded-lg text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Departemen / Bagian / Ruangan</label>
                    <input type="text" name="department" required placeholder="Contoh: Analis Fisika Kimia" class="w-full border border-gray-300 p-2.5 rounded-lg text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Nama / Inisial Pekerja</label>
                    <input type="text" name="worker_name" required placeholder="Contoh: M. Jazuli" class="w-full border border-gray-300 p-2.5 rounded-lg text-sm">
                </div>
                <div class="grid grid-cols-3 gap-2">
                    <div>
                        <label class="block text-xs font-semibold mb-1">Usia</label>
                        <input type="number" name="age" placeholder="Thn" class="w-full border border-gray-300 p-2.5 rounded-lg text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1">Gender</label>
                        <select name="gender" class="w-full border border-gray-300 p-2.5 rounded-lg text-sm">
                            <option value="L">L</option>
                            <option value="P">P</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1">Masa Kerja</label>
                        <input type="number" name="working_years" placeholder="Thn" class="w-full border border-gray-300 p-2.5 rounded-lg text-sm">
                    </div>
                </div>
            </div>

            <hr>

            <!-- Skor Daftar Periksa SNI 9011 -->
            <div class="space-y-4">
                <h3 class="text-md font-bold text-gray-800">Hasil Penilaian Potensi Bahaya (Daftar Periksa)</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <div>
                        <label class="block text-xs font-semibold mb-1">Skor Tubuh Bagian Atas</label>
                        <input type="number" name="upper_body_score" value="0" min="0" class="w-full border border-gray-300 p-2 rounded bg-white text-sm">
                        <span class="text-[10px] text-gray-500">Leher, Bahu, Pergelangan Tangan, dll</span>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1">Skor Punggung & Tubuh Bawah</label>
                        <input type="number" name="lower_body_score" value="0" min="0" class="w-full border border-gray-300 p-2 rounded bg-white text-sm">
                        <span class="text-[10px] text-gray-500">Mmembungkuk, Berdiri/Duduk lama</span>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1">Skor Manual Material Handling (MMH)</label>
                        <input type="number" name="mmh_score" value="0" min="0" class="w-full border border-gray-300 p-2 rounded bg-white text-sm">
                        <span class="text-[10px] text-gray-500">Pengangkatan Beban Manual</span>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Dokumentasi Foto Postur Kerja</label>
                <input type="file" name="photo" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700">
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Catatan & Rekomendasi Perbaikan</label>
                <textarea name="notes" rows="3" placeholder="Masukkan catatan atau saran teknis..." class="w-full border border-gray-300 p-2.5 rounded-lg text-sm"></textarea>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="{{ route('ergo.index') }}" class="px-4 py-2 border rounded-lg text-sm text-gray-700 hover:bg-gray-100">Batal</a>
                <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium shadow">Simpan & Lihat Hasil Instan</button>
            </div>
        </form>
    </div>
</body>
</html>