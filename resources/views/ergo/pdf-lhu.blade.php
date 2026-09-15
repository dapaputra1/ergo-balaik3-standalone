<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Hasil Uji Ergonomi - Balai K3 Surabaya</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 14mm 14mm 16mm 14mm;
        }
        body {
            font-family: 'Times New Roman', Times, serif;
            color: #000;
            font-size: 9.5pt;
            line-height: 1.25;
            margin: 0;
            padding: 0;
        }

        /* Kop Surat Halaman 1 */
        .kop-p1 { text-align: center; margin-bottom: 2px; }
        .kop-p1 h4 { margin: 1px 0; font-size: 10.5pt; font-weight: bold; letter-spacing: 0.3px; }
        .kop-p1 h3 { margin: 2px 0; font-size: 11pt; font-weight: bold; }
        .kop-p1 .alamat { margin-top: 2px; font-size: 7.5pt; }
        .line-double {
            border-top: 2px solid #000;
            border-bottom: 0.8px solid #000;
            height: 2px;
            margin-top: 4px;
            margin-bottom: 8px;
        }

        /* Header Tabel Halaman 2 sampai 8 */
        table.header-box {
            width: 100%;
            border-collapse: collapse;
            font-size: 8pt;
            margin-bottom: 8px;
        }
        table.header-box td {
            border: 1px solid #000;
            padding: 4px 6px;
            vertical-align: middle;
        }

        /* Judul Laporan */
        .title-block { text-align: center; margin-bottom: 10px; }
        .title-block h2 { margin: 0; font-size: 12pt; font-weight: bold; text-decoration: underline; }
        .title-block .sub-title { margin: 1px 0; font-size: 10pt; font-weight: bold; }
        .title-block .no-lab { margin: 1px 0; font-size: 9.5pt; }

        .sec-title { font-weight: bold; font-size: 9.5pt; margin-top: 6px; margin-bottom: 2px; }

        /* Tabel Data Meta */
        table.meta-table { width: 100%; border-collapse: collapse; font-size: 9.5pt; margin-bottom: 4px; }
        table.meta-table td { vertical-align: top; padding: 1.5px 0; }

        /* Tabel Hasil Pengukuran */
        table.report-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 8pt;
            margin-top: 4px;
            margin-bottom: 6px;
        }
        table.report-table th, table.report-table td {
            border: 1px solid #000;
            padding: 3px 2px;
            vertical-align: middle;
        }
        table.report-table th { text-align: center; font-weight: bold; }
        table.report-table td.center { text-align: center; }

        .text-justify { text-align: justify; }
        ol.sub-list { margin: 2px 0; padding-left: 18px; }
        ol.sub-list li { margin-bottom: 4px; }

        /* Footer Baku Balai K3 */
        .footer-fixed {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            font-size: 7.5pt;
            border-top: 0.5px solid #000;
            padding-top: 2px;
        }
        .footer-left { float: left; }
        .footer-right { float: right; }
        .clearfix { clear: both; }
        .page-break { page-break-after: always; }

        /* Klausul Catatan & Tanda Tangan */
        .bottom-wrap { width: 100%; margin-top: 10px; }
        .clause-box { width: 56%; float: left; font-size: 7.5pt; line-height: 1.25; text-align: justify; }
        .sign-box { width: 40%; float: right; text-align: center; font-size: 9pt; }
        .sign-space { height: 50px; }
    </style>
</head>
<body>

    <!-- ==========================================
         HALAMAN 1
         ========================================== -->
    <div class="kop-p1">
        <h4>KEMENTERIAN KETENAGAKERJAAN REPUBLIK INDONESIA</h4>
        <h4>DIREKTORAT JENDERAL</h4>
        <h4>PEMBINAAN PENGAWASAN KETENAGAKERJAAN</h4>
        <h4>DAN KESELAMATAN DAN KESEHATAN KERJA</h4>
        <h3>BALAI HIGIENE PERUSAHAAN KESEHATAN DAN KESELAMATAN KERJA SURABAYA</h3>
        <div class="alamat">Jl. Dukuh Menanggal No. 122, Dukuh Menanggal, Kec. Gayungan, Kota SBY, Jawa Timur 60234, Laman: balaik3surabaya@kemnaker.go.id</div>
    </div>
    <div class="line-double"></div>

    <div class="title-block">
        <h2>LAPORAN HASIL</h2>
        <div class="sub-title">Pengujian Faktor Ergonomi di Tempat Kerja</div>
        <div class="no-lab">No. {{ $assessment->lhu_number ?? 'LAB. 0032/VII/2025' }}</div>
    </div>

    <div class="sec-title">1. DATA UMUM</div>
    <table class="meta-table">
        <tr>
            <td style="width: 25px;">a.</td>
            <td style="width: 230px;">Perusahaan</td>
            <td style="width: 15px;">:</td>
            <td><strong>{{ $assessment->company->name }}</strong></td>
        </tr>
        <tr>
            <td>b.</td>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $assessment->company->address ?? 'Jl. Mayjend Prof. Dr. Moestopo No. 2 Surabaya' }}</td>
        </tr>
        <tr>
            <td>c.</td>
            <td>Pengurus/Penanggung Jawab</td>
            <td>:</td>
            <td>{{ $assessment->pic_name ?? 'Mohammad Nurul Huda' }}</td>
        </tr>
        <tr>
            <td>d.</td>
            <td>Nomor Dokumen Pengujian Sebelumnya</td>
            <td>:</td>
            <td>{{ $assessment->previous_doc_number ?? 'LAB. 0051/VII/2024' }}</td>
        </tr>
    </table>

    <div class="sec-title">2. PENGUKURAN ERGONOMI</div>
    <table class="meta-table">
        <tr>
            <td style="width: 25px;">a.</td>
            <td style="width: 230px;">Tanggal Pengukuran</td>
            <td style="width: 15px;">:</td>
            <td>{{ \Carbon\Carbon::parse($assessment->assessment_date)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td>b.</td>
            <td>Jumlah Departemen</td>
            <td>:</td>
            <td>5</td>
        </tr>
        <tr>
            <td>c.</td>
            <td>Jumlah Pekerjaan</td>
            <td>:</td>
            <td>{{ $assessment->workers->count() > 0 ? $assessment->workers->count() : 8 }}</td>
        </tr>
    </table>

    <div class="sec-title">3. METODE PENGUKURAN YANG DIPAKAI</div>
    <p style="margin: 2px 0 6px 0; font-size: 9.5pt;">
        SNI 9011:2021 tentang Pengukuran dan evaluasi potensi bahaya ergonomi di tempat kerja
    </p>

    <div class="sec-title">4. HASIL PENGUKURAN ERGONOMI</div>
    <table class="report-table">
        <thead>
            <tr>
                <th rowspan="2" style="width: 4%;">No.</th>
                <th rowspan="2" style="width: 17%;">Departemen/<br>Bagian/<br>Ruangan</th>
                <th rowspan="2" style="width: 17%;">Jenis Pekerjaan</th>
                <th colspan="3" style="width: 24%;">Hasil Penilaian Potensi<br>Bahaya (Skor)</th>
                <th rowspan="2" style="width: 8%;">Total Hasil<br>Penilaian<br>(Skor)</th>
                <th rowspan="2" style="width: 16%;">Interpretasi Hasil</th>
                <th rowspan="2" style="width: 14%;">Metode Pengendalian<br>Yang Sudah Ada</th>
            </tr>
            <tr>
                <th style="width: 8%;">Tubuh Bagian Atas</th>
                <th style="width: 8%;">Tubuh Bagian Punggung dan Bawah</th>
                <th style="width: 8%;">Pengangkatan Beban Manual</th>
            </tr>
        </thead>
        <tbody>
            @php $workersP1 = $assessment->workers->take(4); @endphp
            @forelse($workersP1 as $index => $worker)
                @php $ergo = $worker->rebaScore; @endphp
                <tr>
                    <td class="center">{{ $index + 1 }}.</td>
                    <td>{{ $worker->name }}</td>
                    <td>{{ $assessment->department }}</td>
                    <td class="center">{{ $ergo->upper_body_score ?? 0 }}</td>
                    <td class="center">{{ $ergo->lower_body_score ?? 0 }}</td>
                    <td class="center">{{ $ergo->mmh_score ?? 0 }}</td>
                    <td class="center" style="font-weight: bold;">{{ $ergo->final_score ?? 0 }}</td>
                    <td>{{ $ergo->risk_level ?? 'Kondisi tempat kerja aman' }}</td>
                    <td>Adanya waktu istirahat/peregangan</td>
                </tr>
            @empty
                <tr>
                    <td class="center">1.</td>
                    <td>M. Jazuli</td>
                    <td>Analis Fisika Kimia</td>
                    <td class="center">4</td>
                    <td class="center">0</td>
                    <td class="center">0</td>
                    <td class="center" style="font-weight: bold;">4</td>
                    <td>Kondisi tempat kerja perlu pengamatan lebih lanjut</td>
                    <td>Adanya waktu istirahat/peregangan</td>
                </tr>
                <tr>
                    <td class="center">2.</td>
                    <td>M. Abdul Naif</td>
                    <td>Staff Senior Pemeliharaan IPAM NG 1</td>
                    <td class="center">0</td>
                    <td class="center">2</td>
                    <td class="center">3</td>
                    <td class="center" style="font-weight: bold;">5</td>
                    <td>Kondisi tempat kerja perlu pengamatan lebih lanjut</td>
                    <td>Adanya waktu istirahat/peregangan</td>
                </tr>
                <tr>
                    <td class="center">3.</td>
                    <td>Kenedy</td>
                    <td>Staff Laboratorium Kalibrasi Meter</td>
                    <td class="center">4</td>
                    <td class="center">4</td>
                    <td class="center">2</td>
                    <td class="center" style="font-weight: bold;">10</td>
                    <td>Kondisi tempat kerja berbahaya</td>
                    <td>Adanya waktu istirahat/peregangan</td>
                </tr>
                <tr>
                    <td class="center">4.</td>
                    <td>Angga Kusuma</td>
                    <td>Staff Operator Produksi NG 1</td>
                    <td class="center">0</td>
                    <td class="center">0</td>
                    <td class="center">2</td>
                    <td class="center" style="font-weight: bold;">2</td>
                    <td>Kondisi tempat kerja aman</td>
                    <td>Adanya waktu istirahat/peregangan</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer-fixed">
        <span class="footer-left">Tgl. terbit: 24 Desember 2024</span>
        <span class="footer-right">No.: F/7.8.38/BK3-SBY</span>
        <div class="clearfix"></div>
    </div>

    <!-- ==========================================
         HALAMAN 2
         ========================================== -->
    <div class="page-break"></div>
    <table class="header-box">
        <tr>
            <td style="text-align: center; width: 80%;">
                <strong>KEMENTERIAN KETENAGAKERJAAN RI<br>DIREKTORAT JENDERAL<br>PEMBINAAN PENGAWASAN KETENAGAKERJAAN DAN KESELAMATAN DAN KESEHATAN KERJA<br>BALAI HIPERKES DAN KESELAMATAN KERJA SURABAYA</strong>
            </td>
            <td style="width: 20%; vertical-align: top; font-size: 8pt;">
                Page: 2/16<br><br>
                Rev/Terb.: -/1
            </td>
        </tr>
    </table>

    <table class="report-table">
        <thead>
            <tr>
                <th rowspan="2" style="width: 4%;">No.</th>
                <th rowspan="2" style="width: 17%;">Departemen/<br>Bagian/<br>Ruangan</th>
                <th rowspan="2" style="width: 17%;">Jenis Pekerjaan</th>
                <th colspan="3" style="width: 24%;">Hasil Penilaian Potensi<br>Bahaya (Skor)</th>
                <th rowspan="2" style="width: 8%;">Total Hasil<br>Penilaian<br>(Skor)</th>
                <th rowspan="2" style="width: 16%;">Interpretasi Hasil</th>
                <th rowspan="2" style="width: 14%;">Metode Pengendalian<br>Yang Sudah Ada</th>
            </tr>
            <tr>
                <th style="width: 8%;">Tubuh Bagian Atas</th>
                <th style="width: 8%;">Tubuh Bagian Punggung dan Bawah</th>
                <th style="width: 8%;">Pengangkatan Beban Manual</th>
            </tr>
        </thead>
        <tbody>
            @php $workersP2 = $assessment->workers->slice(4); @endphp
            @forelse($workersP2 as $index => $worker)
                @php $ergo = $worker->rebaScore; @endphp
                <tr>
                    <td class="center">{{ $index + 5 }}.</td>
                    <td>{{ $worker->name }}</td>
                    <td>{{ $assessment->department }}</td>
                    <td class="center">{{ $ergo->upper_body_score ?? 0 }}</td>
                    <td class="center">{{ $ergo->lower_body_score ?? 0 }}</td>
                    <td class="center">{{ $ergo->mmh_score ?? 0 }}</td>
                    <td class="center" style="font-weight: bold;">{{ $ergo->final_score ?? 0 }}</td>
                    <td>{{ $ergo->risk_level ?? 'Kondisi tempat kerja aman' }}</td>
                    <td>Adanya waktu istirahat/peregangan</td>
                </tr>
            @empty
                <tr>
                    <td class="center">5.</td>
                    <td>Kharisma Edwin</td>
                    <td>Staff Logistik Gudang</td>
                    <td class="center">0</td>
                    <td class="center">1</td>
                    <td class="center">3</td>
                    <td class="center" style="font-weight: bold;">4</td>
                    <td>Kondisi tempat kerja perlu pengamatan lebih lanjut</td>
                    <td>Adanya waktu istirahat/peregangan</td>
                </tr>
                <tr>
                    <td class="center">6.</td>
                    <td>Mulya Sayid</td>
                    <td>Staff Senior Administrasi NG 3</td>
                    <td class="center">2</td>
                    <td class="center">1</td>
                    <td class="center">0</td>
                    <td class="center" style="font-weight: bold;">3</td>
                    <td>Kondisi tempat kerja perlu pengamatan lebih lanjut</td>
                    <td>Adanya waktu istirahat/peregangan</td>
                </tr>
                <tr>
                    <td class="center">7.</td>
                    <td>Teguh Wiyono</td>
                    <td>Staff Logistik-Gd. Ratna (Pipa & Meter)</td>
                    <td class="center">4</td>
                    <td class="center">3</td>
                    <td class="center">1</td>
                    <td class="center" style="font-weight: bold;">8</td>
                    <td>Kondisi tempat kerja berbahaya</td>
                    <td>Adanya waktu istirahat/peregangan</td>
                </tr>
                <tr>
                    <td class="center">8.</td>
                    <td>Farid Eksanto</td>
                    <td>Staff Senior Logistik-Gd. Ratna</td>
                    <td class="center">3</td>
                    <td class="center">0</td>
                    <td class="center">0</td>
                    <td class="center" style="font-weight: bold;">3</td>
                    <td>Kondisi tempat kerja perlu pengamatan lebih lanjut</td>
                    <td>Adanya waktu istirahat/peregangan</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="font-size: 8.5pt; margin-top: 6px; margin-bottom: 6px;">
        <strong>Catatan:</strong><br>
        Penilaian dari metode pengukuran ERFC atau Daftar Periksa Potensi Bahaya Faktor Ergonomi adalah sebagai berikut:<br>
        a. Nilai &le; 2, maka kondisi tempat kerja aman<br>
        b. Nilai 3 – 6, maka kondisi tempat kerja perlu pengamatan lebih lanjut<br>
        c. Nilai &ge; 7, maka kondisi tempat kerja berbahaya
    </div>

    <div class="sec-title">5. ANALISIS:</div>
    <div class="text-justify" style="font-size: 8.5pt;">
        <strong>a. Hasil penilaian potensi bahaya ergonomi M. Jazuli (Analis Fisika Kimia) tubuh bagian atas yang berpotensi bahaya adalah:</strong>
        <ul style="margin: 2px 0; padding-left: 18px;">
            <li>Leher menekuk ke depan &gt; 20° atau ke belakang &lt; 5°</li>
            <li>Bahu: Lengan atau siku yang tidak ditopang, dengan posisi di atas tinggi perut</li>
            <li>Pergelangan tangan: Menekuk ke depan atau kesamping</li>
        </ul>
        Dari hasil wawancara menggunakan formulir keluhan Gangguan Otot Rangka Akibat Kerja didapatkan keluhan tidak nyaman pada leher dan punggung bawah dengan frekuensi terkadang.<br><br>

        <strong>b. Hasil penilaian potensi bahaya ergonomi M. Abdul Naif (Staff Senior Pemeliharaan IPAM NG 1) tubuh bagian atas yang berpotensi bahaya adalah:</strong>
        <ul style="margin: 2px 0; padding-left: 18px;">
            <li>Bahu: Lengan atau siku yang tidak ditopang, dengan posisi di atas tinggi perut</li>
            <li>Pergelangan tangan: Menekuk ke depan atau kesamping</li>
            <li>Menggenggam dengan kuat dalam posisi "power grip" dengan gaya &gt; 5 kg</li>
        </ul>
        Hasil penilaian potensi bahaya ergonomi bagian bawah yang berpotensi bahaya adalah:
        <ul style="margin: 2px 0; padding-left: 18px;">
            <li>Duduk dalam waktu yang lama tanpa sandaran atau penopang punggung yang memadai</li>
            <li>Tubuh membungkuk ke depan dengan sudut antara 20 hingga 45 derajat</li>
        </ul>
    </div>

    <div class="footer-fixed">
        <span class="footer-left">Tgl. terbit: 24 Desember 2024</span>
        <span class="footer-right">No.: F/7.8.38/BK3-SBY</span>
        <div class="clearfix"></div>
    </div>

    <!-- ==========================================
         HALAMAN 3
         ========================================== -->
    <div class="page-break"></div>
    <table class="header-box">
        <tr>
            <td style="text-align: center; width: 80%;">
                <strong>KEMENTERIAN KETENAGAKERJAAN RI<br>DIREKTORAT JENDERAL<br>PEMBINAAN PENGAWASAN KETENAGAKERJAAN DAN KESELAMATAN DAN KESEHATAN KERJA<br>BALAI HIPERKES DAN KESELAMATAN KERJA SURABAYA</strong>
            </td>
            <td style="width: 20%; vertical-align: top; font-size: 8pt;">
                Page: 3/16<br><br>
                Rev/Terb.: -/1
            </td>
        </tr>
    </table>

    <div class="text-justify" style="font-size: 8.5pt;">
        Dari hasil wawancara menggunakan formulir keluhan Gangguan Otot Rangka Akibat Kerja didapatkan keluhan tidak nyaman pada punggung atas dan punggung bawah dengan frekuensi terkadang.<br><br>

        <strong>c. Hasil penilaian potensi bahaya ergonomi Kenedy (Staff Laboratorium Kalibrasi Meter) tubuh bagian atas yang berpotensi bahaya adalah:</strong>
        <ul style="margin: 2px 0; padding-left: 18px;">
            <li>Leher yang menekuk ke depan &gt; 20 derajat</li>
            <li>Bahu: Lengan atau siku yang tidak ditopang, dengan posisi di atas tinggi perut</li>
            <li>Pergelangan tangan: Menekuk ke depan atau kesamping</li>
        </ul>
        Hasil penilaian potensi bahaya ergonomi bagian bawah yang berpotensi bahaya adalah:
        <ul style="margin: 2px 0; padding-left: 18px;">
            <li>Tubuh membungkuk ke depan dengan sudut antara 20 hingga 45 derajat</li>
            <li>Tubuh tertekan oleh benda yang keras/runcing</li>
        </ul>
        Hasil Periksa Pengangkatan Beban Secara Manual yang berpotensi bahaya adalah:
        <ul style="margin: 2px 0; padding-left: 18px;">
            <li>Pengangkatan berat benda 8 kg dengan jarak dekat</li>
            <li>Pengangkatan sesekali dengan membawa benda dengan jarak 3–9 meter</li>
        </ul>
        Dari hasil wawancara menggunakan formulir keluhan tidak nyaman pada betis kiri, punggung atas dan punggung bawah dengan frekuensi terkadang.<br><br>

        <strong>d. Hasil penilaian potensi bahaya ergonomi Angga Kusuma (Staff Operator Produksi NG 1) tubuh bagian atas yang berpotensi bahaya adalah:</strong>
        <ul style="margin: 2px 0; padding-left: 18px;">
            <li>Bahu: Lengan atau siku yang tidak ditopang</li>
            <li>Pergelangan tangan: Menekuk ke depan atau kesamping</li>
        </ul>
        Dari hasil wawancara menggunakan formulir keluhan Gangguan Otot Rangka Akibat Kerja tidak didapatkan keluhan.<br><br>

        <strong>e. Hasil penilaian potensi bahaya ergonomi Kharisma Edwin (Staff Logistik Gudang) tubuh bagian bawah yang berpotensi bahaya adalah:</strong>
        <ul style="margin: 2px 0; padding-left: 18px;">
            <li>Tubuh membungkuk ke depan dengan sudut &gt; 45 derajat</li>
        </ul>
        Hasil Periksa Pengangkatan Beban Secara Manual yang berpotensi bahaya adalah:
        <ul style="margin: 2px 0; padding-left: 18px;">
            <li>Pengangkatan sesekali dengan membawa benda dengan jarak 3–9 meter</li>
        </ul>
        Dari hasil wawancara menggunakan formulir keluhan Gangguan Otot Rangka Akibat Kerja tidak didapatkan keluhan.<br><br>

        <strong>f. Hasil penilaian potensi bahaya ergonomi Mulya Sayid (Staff Senior Administrasi NG 3) tubuh bagian atas yang berpotensi bahaya adalah:</strong>
        <ul style="margin: 2px 0; padding-left: 18px;">
            <li>Pergelangan tangan: Menekuk ke depan atau kesamping</li>
            <li>Mengetik secara berselang (diselingi aktivitas lain atau istirahat)</li>
        </ul>
        Hasil penilaian potensi bahaya ergonomi bagian bawah yang berpotensi bahaya adalah:
        <ul style="margin: 2px 0; padding-left: 18px;">
            <li>Duduk dalam waktu yang lama tanpa sandaran atau penopang punggung yang memadai</li>
        </ul>
        Dari hasil wawancara menggunakan formulir keluhan tidak nyaman pada punggung bawah dengan frekuensi terkadang.<br><br>

        <strong>g. Hasil penilaian potensi bahaya ergonomi Teguh Wiyono (Staff Logistik Gudang Ratna Pipa dan Meter) tubuh bagian atas yang berpotensi bahaya adalah:</strong>
        <ul style="margin: 2px 0; padding-left: 18px;">
            <li>Leher menekuk ke depan &gt; 20° atau ke belakang &lt; 5°</li>
            <li>Bahu: Lengan atau siku yang tidak ditopang</li>
            <li>Pergelangan tangan: Menekuk ke depan atau kesamping</li>
        </ul>
        Hasil penilaian potensi bahaya ergonomi bagian bawah yang berpotensi bahaya adalah:
        <ul style="margin: 2px 0; padding-left: 18px;">
            <li>Tubuh membungkuk ke depan dengan sudut antara 20°–45°</li>
            <li>Tubuh membungkuk ke depan dengan sudut &gt; 45°</li>
        </ul>
    </div>

    <div class="footer-fixed">
        <span class="footer-left">Tgl. terbit: 24 Desember 2024</span>
        <span class="footer-right">No.: F/7.8.38/BK3-SBY</span>
        <div class="clearfix"></div>
    </div>

    <!-- ==========================================
         HALAMAN 4
         ========================================== -->
    <div class="page-break"></div>
    <table class="header-box">
        <tr>
            <td style="text-align: center; width: 80%;">
                <strong>KEMENTERIAN KETENAGAKERJAAN RI<br>DIREKTORAT JENDERAL<br>PEMBINAAN PENGAWASAN KETENAGAKERJAAN DAN KESELAMATAN DAN KESEHATAN KERJA<br>BALAI HIPERKES DAN KESELAMATAN KERJA SURABAYA</strong>
            </td>
            <td style="width: 20%; vertical-align: top; font-size: 8pt;">
                Page: 4/16<br><br>
                Rev/Terb.: -/1
            </td>
        </tr>
    </table>

    <div class="text-justify" style="font-size: 8.5pt;">
        <ul style="margin: 2px 0; padding-left: 18px;">
            <li>Duduk dalam waktu yang lama tanpa sandaran atau penopang punggung yang memadai</li>
        </ul>
        Hasil Periksa Pengangkatan Beban Secara Manual yang berpotensi bahaya adalah:
        <ul style="margin: 2px 0; padding-left: 18px;">
            <li>Pengangkatan sesekali dengan membawa benda dengan jarak 3–9 meter</li>
        </ul>
        Dari hasil wawancara menggunakan formulir keluhan Gangguan Otot Rangka Akibat Kerja didapatkan keluhan tidak nyaman pada tangan kanan dan punggung bawah dengan frekuensi terkadang.<br><br>

        <strong>h. Hasil penilaian potensi bahaya ergonomi Farid Eksanto (Staff Senior Logistik Gudang Ratna) tubuh bagian atas yang berpotensi bahaya adalah:</strong>
        <ul style="margin: 2px 0; padding-left: 18px;">
            <li>Pergelangan tangan: Menekuk ke depan atau kesamping</li>
            <li>Mengetik secara berselang (diselingi aktivitas lain atau istirahat)</li>
        </ul>
        Dari hasil wawancara menggunakan formulir keluhan Gangguan Otot Rangka Akibat Kerja didapatkan tidak ada keluhan.
    </div>

    <div class="sec-title" style="margin-top: 10px;">6. KESIMPULAN</div>
    <div class="text-justify" style="font-size: 8.5pt;">
        Penilaian potensi bahaya ergonomi pada Kenedy (Staff Laboratorium Kalibrasi Meter) dan Teguh Wiyono (Staff Logistik Gudang Ratna Pipa dan Meter) termasuk dalam kondisi tempat kerja tidak aman. Penilaian bahaya ergonomi pada M. Jazuli (Analis Fisika Kimia), M. Abdul Naif (Staff Senior Pemeliharaan IPAM NG 1), Kharisma Edwin (Staff Logistik Gudang), Mulya Sayid (Staff Senior Administrasi NG 3) dan Farid Eksanto (Staff Senior Logistik Gudang Ratna) dalam kondisi tempat kerja perlu pengamatan lebih lanjut. Penilaian potensi bahaya ergonomi pada Angga Kusuma (Staff Operator Produksi NG 1) termasuk dalam kondisi tempat kerja aman.
    </div>

    <div class="sec-title" style="margin-top: 10px;">7. SARAN dan TINDAKAN PERBAIKAN</div>
    <div class="text-justify" style="font-size: 8.5pt;">
        Secara umum terdapat 2 postur kerja yaitu postur kerja dinamis dan statis. Postur kerja statis teridentifikasi pada pekerja yang bekerja di perkantoran (Menyusun laporan, memverifikasi laporan, penerimaan dan pengeluaran barang logistik), sedangkan postur kerja dinamis teridentifikasi pada pekerja di bagian Analisa Fisika Kimia, Loading-Unloading Logistik, Service Kalibrasi Meter dan Teknisi Pemeliharaan.<br><br>

        <strong>A. Jenis Pekerjaan Perkantoran</strong><br>
        Tenaga kerja yang mempunyai aktivitas kerja berupa administrasi perkantoran, saran dan tindakan yang dapat dilakukan untuk pekerjaan administrasi perkantoran dengan kegiatan mengoperasikan computer adalah sebagai berikut:
        <ol type="a" class="sub-list">
            <li>Apabila kepala menunduk saat bekerja dengan layar monitor, maka angkat/turunkan tinggi monitor agar mata sejajar dengan bagian atas layar, dan atur dokumen lain agar tingginya sejajar monitor.</li>
            <li>Apabila kepala tidak sejajar dengan tulang belakang, maka atur stasiun kerja agar memungkinkan untuk postur yang lebih baik, misal: duduk bersandar di kursi, letakkan keyboard di dekat pengguna, atur sudut monitor, dsb.</li>
            <li>Apabila meraih kesamping atau kedepan saat menggunakan mouse atau keyboard (siku menjauhi bagian samping tubuh), maka letakkan mouse/peralatan lainnya di samping keyboard dengan tinggi yang sejajar dan gunakan alas mouse (mouse pad).</li>
            <li>Apabila pergelangan tangan tidak lurus (netral) saat mengetik, maka Lepaskan kaki penyangga keyboard dan Bila diperlukan, gunakan bantalan pada pergelangan tangan agar posisinya tetap lurus.</li>
        </ol>
    </div>

    <div class="footer-fixed">
        <span class="footer-left">Tgl. terbit: 24 Desember 2024</span>
        <span class="footer-right">No.: F/7.8.38/BK3-SBY</span>
        <div class="clearfix"></div>
    </div>

    <!-- ==========================================
         HALAMAN 5
         ========================================== -->
    <div class="page-break"></div>
    <table class="header-box">
        <tr>
            <td style="text-align: center; width: 80%;">
                <strong>KEMENTERIAN KETENAGAKERJAAN RI<br>DIREKTORAT JENDERAL<br>PEMBINAAN PENGAWASAN KETENAGAKERJAAN DAN KESELAMATAN DAN KESEHATAN KERJA<br>BALAI HIPERKES DAN KESELAMATAN KERJA SURABAYA</strong>
            </td>
            <td style="width: 20%; vertical-align: top; font-size: 8pt;">
                Page: 5/16<br><br>
                Rev/Terb.: -/1
            </td>
        </tr>
    </table>

    <div class="text-justify" style="font-size: 8.5pt;">
        <ol type="a" start="5" class="sub-list">
            <li>Apabila kulit tertekan ke benda yang tajam/keras. Misal: tangan disandarkan ke permukaan/ujung yang tajam maka Berikan bantalan pada permukaan yang tajam atau keras.</li>
            <li>Apabila terdapat celah antara tulang belakang dan sandaran punggung maka Atur stasiun kerja agar punggung dapat bersandar dengan baik. Misal: mengatur keyboard atau monitor agar lebih dekat dengan pengguna.</li>
            <li>Apabila Tidak ada ruang untuk kaki yang cukup di bawah meja maka Turunkan tinggi kursi setinggi antara lipatan lutut dengan kaki agar kaki bisa masuk ke kolong meja dan Pastikan sandaran lengan tidak menghalangi pengguna untuk duduk lebih dekat dengan meja.</li>
            <li>Apabila kaki tidak lurus menginjak lantai, maka angkat/turunkan kursi agar lutut dapat bersandar dengan sudut 90 derajat. Atau gunakan pijakan kaki apabila tinggi keyboard membuat kursi yang lebih tinggi dibutuhkan.</li>
            <li>Apabila duduk di kursi lebih dari satu jam tanpa berdiri, maka gunakan tanda-tanda yang sering muncul sebagai pengingat untuk beristirahat sejenak dari posisi duduk, misalnya: bunyi telepon masuk, alarm pengingat untuk berdiri, dan lain sebagainya.</li>
            <li>Apabila Tulang belakang melengkung dalam bentuk C, bukan bentuk S maka Pilih kursi dengan penyangga punggung yang baik, Jarak antara dagu dan dada setidaknya selebar kepalan tangan dengan posisi leher/kepala netral dan Lakukan istirahat dari posisi duduk secara rutin.</li>
            <li>Untuk menghindari kelelahan mata dapat dilakukan metode 20-20-20. Setelah mata fokus pada monitor selama 20 menit, alihkan pandangan mata ke obyek sejauh 20ft (6 meter), selama 20 detik. Selain itu, setelah 1 jam bekerja di depan komputer istirahat sejenak 5–10 menit, dan melakukan peregangan otot (stretching). Memastikan pekerja selalu makan – makanan bergizi dan terhidrasi dengan baik.</li>
        </ol>

        <p style="margin-top: 8px; margin-bottom: 6px;">
            Berikut ilustrasi gambar rekomendasi posisi kerja ergonomi sesuai dengan postur kerja statis yang teridentifikasi di tempat kerja:
        </p>
    </div>

    <!-- Zona jangkauan kerja statis -->
    <div style="text-align: center; margin-top: 10px; border: 1px solid #ddd; padding: 10px; background-color: #fafafa;">
        <div style="font-weight: bold; font-size: 8.5pt; margin-bottom: 5px;">ZONA JANGKAUAN MEJA KERJA (REACH ZONES)</div>
        <table style="width: 100%; font-size: 8pt; text-align: center; border-collapse: collapse;">
            <tr>
                <td style="border: 1px solid #aaa; padding: 6px; width: 33%;"><strong>Usual Zone (Area Utama)</strong><br>Hingga 10 inci (~25 cm)<br>Untuk keyboard & mouse</td>
                <td style="border: 1px solid #aaa; padding: 6px; width: 33%;"><strong>Occasional Zone (Area Sedang)</strong><br>10–20 inci (~25–50 cm)<br>Untuk dokumen & telpon</td>
                <td style="border: 1px solid #aaa; padding: 6px; width: 33%;"><strong>Rare Zone (Area Jarang)</strong><br>18 inci+ (&gt;45 cm)<br>Untuk barang display</td>
            </tr>
        </table>
        <div style="font-size: 7.5pt; color: #555; margin-top: 6px;">Posisi tangan saat memegang mouse: Lurus netral (RIGHT!), Jangan menekuk ke atas/samping (WRONG!)</div>
    </div>

    <div class="footer-fixed">
        <span class="footer-left">Tgl. terbit: 24 Desember 2024</span>
        <span class="footer-right">No.: F/7.8.38/BK3-SBY</span>
        <div class="clearfix"></div>
    </div>

    <!-- ==========================================
         HALAMAN 6
         ========================================== -->
    <div class="page-break"></div>
    <table class="header-box">
        <tr>
            <td style="text-align: center; width: 80%;">
                <strong>KEMENTERIAN KETENAGAKERJAAN RI<br>DIREKTORAT JENDERAL<br>PEMBINAAN PENGAWASAN KETENAGAKERJAAN DAN KESELAMATAN DAN KESEHATAN KERJA<br>BALAI HIPERKES DAN KESELAMATAN KERJA SURABAYA</strong>
            </td>
            <td style="width: 20%; vertical-align: top; font-size: 8pt;">
                Page: 6/16<br><br>
                Rev/Terb.: -/1
            </td>
        </tr>
    </table>

    <div class="sec-title">B. Jenis Pekerjaan Dinamis</div>
    <div class="text-justify" style="font-size: 8.5pt;">
        Sedangkan pada tenaga kerja yang mempunyai jenis postur dinamis yang teridentifikasi pada berupa aktivitas di bagian Analisa Fisika Kimia, penerimaan dan pengeluaran barang logistik, Service Kalibrasi Meter dan Teknisi Pemeliharaan saran dan tindakan perbaikan yang dapat dilaksanakan adalah sebagai berikut:
        <ol type="a" class="sub-list">
            <li>Hindari pekerjaan yang dilakukan dengan posisi membungkuk dengan memberikan meja kerja yang sesuai dengan tinggi siku tenaga kerja.</li>
            <li>Apabila terdapat pekerjaan yang memerlukan ketelitian (seperti melihat garis ukur pada pipet dan angka pada alat ukur vibrasi/suhu) sebaiknya dilaksanakan pada pandangan setinggi dada dengan mengurangi posisi siku menjauh dari tubuh.</li>
            <li>Apabila kepala menunduk saat bekerja dengan objek kerja, maka angkat/turunkan tinggi objek kerja agar mata sejajar dengan objek kerja.</li>
            <li>Apabila kepala tidak sejajar dengan tulang belakang, maka atur stasiun kerja agar memungkinkan untuk postur yang lebih baik.</li>
        </ol>

        <p style="margin-top: 8px; margin-bottom: 6px;">
            Berikut ilustrasi gambar rekomendasi posisi kerja ergonomi sesuai dengan postur kerja dinamis yang teridentifikasi di tempat kerja:
        </p>
    </div>

    <div style="text-align: center; margin-top: 6px; border: 1px solid #ddd; padding: 10px; background-color: #fafafa;">
        <div style="font-weight: bold; font-size: 8.5pt; margin-bottom: 4px;">AREA KERJA DINAMIS & PERAKITAN (ASSEMBLY WORKSPACE)</div>
        <table style="width: 100%; font-size: 8pt; text-align: center; border-collapse: collapse;">
            <tr>
                <td style="border: 1px solid #aaa; padding: 5px;"><strong>Normal Reach</strong><br>Radius ~15.8 inci (~40 cm) tanpa menjulurkan bahu</td>
                <td style="border: 1px solid #aaa; padding: 5px;"><strong>Maximum Reach</strong><br>Radius ~24.3 inci (~60 cm) dengan posisi siku teregang</td>
            </tr>
        </table>
        <div style="font-size: 7.5pt; color: #555; margin-top: 5px;">Ketinggian meja kerja berdiri harus disesuaikan dengan jenis pekerjaan (presisi: setinggi dada, ringan: setinggi siku, berat: di bawah siku).</div>
    </div>

    <div class="sec-title" style="margin-top: 10px;">C. Pengangkatan Beban Manual</div>
    <div class="text-justify" style="font-size: 8.5pt;">
        Sedangkan pada tenaga kerja yang mempunyai jenis pekerjaan pengangkatan beban secara manual yang teridentifikasi pada pekerjaan Loading Unloading Gudang dan Service Kalibrasi Meter, Tindakan perbaikan dan pengendalian adalah dengan prinsip sebagai berikut:<br>
        Secara umum hilangkan kebutuhan untuk secara manual mengangkat, menurunkan, atau membawa benda dengan menggunakan kontrol rekayasa seperti hoists, pallet jacks, kereta dorong, dan konveyor. Jika hal tersebut tidak dimungkinkan, pertimbangkan pilihan seperti berikut untuk meminimalkan potensi bahaya:
    </div>

    <div class="footer-fixed">
        <span class="footer-left">Tgl. terbit: 24 Desember 2024</span>
        <span class="footer-right">No.: F/7.8.38/BK3-SBY</span>
        <div class="clearfix"></div>
    </div>

    <!-- ==========================================
         HALAMAN 7
         ========================================== -->
    <div class="page-break"></div>
    <table class="header-box">
        <tr>
            <td style="text-align: center; width: 80%;">
                <strong>KEMENTERIAN KETENAGAKERJAAN RI<br>DIREKTORAT JENDERAL<br>PEMBINAAN PENGAWASAN KETENAGAKERJAAN DAN KESELAMATAN DAN KESEHATAN KERJA<br>BALAI HIPERKES DAN KESELAMATAN KERJA SURABAYA</strong>
            </td>
            <td style="width: 20%; vertical-align: top; font-size: 8pt;">
                Page: 7/16<br><br>
                Rev/Terb.: -/1
            </td>
        </tr>
    </table>

    <div class="text-justify" style="font-size: 8.5pt;">
        <ol type="a" class="sub-list">
            <li>Minimalkan jarak beban dari pekerja (misalnya, gunakan meja yang dapat diputar; pindahkan pekerja lebih dekat ke objek; jangan tempatkan penghalang dengan objek).</li>
            <li>Minimalkan jarak vertikal pengangkatan dan penurunan beban (misalnya, gunakan pallet jack; batasi tinggi rak).</li>
            <li>Hindari pekerjaan yang terlalu rendah; lebih rendah dari ketinggian tangan pada posisi netral (misalnya, gunakan scissor lift, pallet jack).</li>
            <li>Hindari pekerjaan di atas tinggi bahu (misalnya, Batasi ketinggian rak; gunakan penyangga yang dapat meninggikan posisi kerja).</li>
            <li>Hindari posisi membungkuk atau memuntir (misalnya, menyediakan ruang kerja yang luas; mengatur stasiun kerja untuk meminimalkan gerakan memuntir Ketika pekerja mengambil atau meletakkan beban).</li>
            <li>Meminimalkan ukuran beban (misalnya, gunakan kontainer/kotak yang kecil; mengatur agar pekerja mengangkat beban dengan dua perjalanan dengan beban lebih ringan dibandingkan satu perjalanan dengan beban berat).</li>
            <li>Meminimalkan jarak angkut (misalnya, mengatur alur kerja yang direncanakan dengan baik).</li>
            <li>Hindari menangani benda berat atau tidak seimbang sambil duduk (misalnya, gunakan postur berdiri sehingga otot yang lebih kuat dapat digunakan; hindari menangani lebih dari 4,5 kilogram sambil duduk). Meningkatkan cengkeraman tangan pada beban (misalnya, memberikan pegangan yang baik pada kontainer; menambahkan klem atau perangkat lain untuk meningkatkan cengkeraman).</li>
            <li>Mengubah desain pekerjaan (misalnya, dari tugas mengangkat beban menjadi menurunkan beban; dari mengangkat, menurunkan, atau mengangkut beban menjadi pekerjaan mendorong atau menarik beban).</li>
            <li>Gunakan periode istirahat/jeda atau perbaikan pekerjaan untuk memungkinkan otot pulih dari pekerjaan yang menerapkan kekuatan untuk waktu yang lama.</li>
        </ol>

        <p style="margin-top: 8px; margin-bottom: 6px;">
            Berikut ilustrasi gambar rekomendasi posisi kerja ergonomi pengangkatan beban secara manual (penerimaan dan pengeluaran barang logistik serta service kalibrasi meter) yang teridentifikasi di tempat kerja:
        </p>
    </div>

    <!-- Ilustrasi Membawa Beban -->
    <div style="text-align: center; margin-top: 10px; border: 1px solid #ddd; padding: 10px; background-color: #fafafa;">
        <div style="font-weight: bold; font-size: 8.5pt; margin-bottom: 4px;">METODE MEMBAWA BEBAN DENGAN CARA ERGONOMIS</div>
        <table style="width: 100%; font-size: 8pt; text-align: center; border-collapse: collapse;">
            <tr>
                <td style="border: 1px solid #aaa; padding: 6px; width: 50%;"><strong>Alat Bantu Beroda (Hand Truck / Troli)</strong><br>Gunakan troli tabung atau troli dorong untuk memindahkan benda silinder dan berat.</td>
                <td style="border: 1px solid #aaa; padding: 6px; width: 50%;"><strong>Bantalan Pelindung Bahu</strong><br>Gunakan rompi/bantalan pelindung pada bahu saat membawa objek berat dengan jarak angkut tertentu.</td>
            </tr>
        </table>
    </div>

    <div class="footer-fixed">
        <span class="footer-left">Tgl. terbit: 24 Desember 2024</span>
        <span class="footer-right">No.: F/7.8.38/BK3-SBY</span>
        <div class="clearfix"></div>
    </div>

    <!-- ==========================================
         HALAMAN 8 (HALAMAN PENGESAHAN & PENUTUP)
         ========================================== -->
    <div class="page-break"></div>
    <table class="header-box">
        <tr>
            <td style="text-align: center; width: 80%;">
                <strong>KEMENTERIAN KETENAGAKERJAAN RI<br>DIREKTORAT JENDERAL<br>PEMBINAAN PENGAWASAN KETENAGAKERJAAN DAN KESELAMATAN DAN KESEHATAN KERJA<br>BALAI HIPERKES DAN KESELAMATAN KERJA SURABAYA</strong>
            </td>
            <td style="width: 20%; vertical-align: top; font-size: 8pt;">
                Page: 8/16<br><br>
                Rev/Terb.: -/1
            </td>
        </tr>
    </table>

    <div style="font-size: 8.5pt; font-weight: bold; margin-bottom: 6px; text-align: center;">
        Metode pengangkatan beban secara manual sesuai dengan prinsip ergonomis
    </div>

    <!-- Tahapan Mengangkat Beban Manual -->
    <div style="border: 1px solid #aaa; padding: 8px; background-color: #fafafa; margin-bottom: 15px;">
        <table style="width: 100%; font-size: 7.5pt; text-align: center; border-collapse: collapse;">
            <tr>
                <td style="border: 1px solid #ccc; padding: 5px; width: 20%;"><strong>Langkah 1</strong><br>Berjongkok dekat beban dengan lutut ditekuk</td>
                <td style="border: 1px solid #ccc; padding: 5px; width: 20%;"><strong>Langkah 2</strong><br>Pegang beban kuat-kuat dekat dengan tubuh</td>
                <td style="border: 1px solid #ccc; padding: 5px; width: 20%;"><strong>Langkah 3</strong><br>Punggung tetap tegak saat mulai mengangkat</td>
                <td style="border: 1px solid #ccc; padding: 5px; width: 20%;"><strong>Langkah 4</strong><br>Gunakan kekuatan otot paha & kaki</td>
                <td style="border: 1px solid #ccc; padding: 5px; width: 20%;"><strong>Langkah 5</strong><br>Bawa beban menempel pada tubuh</td>
            </tr>
        </table>
    </div>

    <!-- 5 Klausul Catatan Laboratorium & Tanda Tangan Manajer Teknis -->
    <div class="bottom-wrap">
        <div class="clause-box">
            <strong>Catatan:</strong>
            <ol style="margin: 2px 0; padding-left: 12px;">
                <li>Data uji di atas hanya berlaku untuk contoh yang diuji.</li>
                <li>Laporan Hasil Uji ini tidak boleh digandakan, kecuali secara lengkap dan seijin tertulis dari Balai Hiperkes dan KK Surabaya.</li>
                <li>Laboratorium melayani pengaduan/complaint maksimum 1 (satu) minggu terhitung dari tanggal penyerahan LHU.</li>
                <li>Laboratorium menyerahkan Rekaman teknis bila diminta oleh pelanggan secara tertulis.</li>
                <li>Jika sampel diambil dan/atau dikirim oleh pelanggan, maka Laboratorium tidak bertanggung jawab terhadap proses pengambilan dan pengiriman sampel.</li>
            </ol>
        </div>

        <div class="sign-box">
            <div>Surabaya, 22 Agustus 2025</div>
            <div style="font-weight: bold; margin-top: 2px;">Manajer Teknis,</div>
            <div class="sign-space"></div>
            <div style="font-weight: bold; text-decoration: underline;">OKTOFA S. PAMUNGKAS S.T., M.Kes</div>
            <div>NIP. 19791003 200912 1 002</div>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="footer-fixed">
        <span class="footer-left">Tgl. terbit: 24 Desember 2024</span>
        <span class="footer-right">No.: F/7.8.38/BK3-SBY</span>
        <div class="clearfix"></div>
    </div>

</body>
</html>