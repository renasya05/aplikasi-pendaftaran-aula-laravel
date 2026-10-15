@extends('layouts.app')

@section('title', 'Laporan Per Bulan | SAPA')

@section('content')

<style>
    .laporan-page {
        max-width: 1250px;
        margin: 0 auto;
    }

    /* =========================
       HEADER
    ========================= */
    .laporan-header {
        background: linear-gradient(135deg, #12355b, #1d4f7a);
        border-radius: 16px;
        padding: 28px 30px;
        margin-bottom: 22px;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .laporan-header::after {
        content: "";
        position: absolute;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        border: 35px solid rgba(255, 255, 255, 0.05);
        right: -55px;
        top: -75px;
    }

    .header-content {
        position: relative;
        z-index: 1;
    }

    .header-label {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 8px;
        color: #bfdbfe;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1.3px;
        text-transform: uppercase;
    }

    .laporan-header h1 {
        margin: 0 0 7px;
        font-size: 27px;
        font-weight: 750;
    }

    .laporan-header p {
        max-width: 700px;
        margin: 0;
        color: #dbeafe;
        font-size: 14px;
        line-height: 1.6;
    }

    /* =========================
       BUTTON
    ========================= */
    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        min-height: 42px;
        padding: 10px 18px;
        border-radius: 9px;
        border: none;
        text-decoration: none;
        font-family: inherit;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
    }

    .btn-print {
        background: #2563eb;
        color: #ffffff;
    }

    .btn-print:hover {
        background: #1d4ed8;
    }

    /* =========================
       PILIH AULA
    ========================= */
    .selector-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 15px;
        padding: 20px 22px;
        margin-bottom: 18px;
        box-shadow: 0 4px 15px rgba(15, 23, 42, 0.05);
    }

    .selector-title {
        margin-bottom: 12px;
        color: #334155;
        font-size: 13px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.6px;
    }

    .aula-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .aula-btn {
        display: inline-block;
        border: 1px solid #cbd5e1;
        background: #ffffff;
        color: #334155;
        border-radius: 9px;
        padding: 11px 20px;
        font-size: 14px;
        font-weight: 750;
        text-decoration: none;
        cursor: pointer;
        transition: .2s ease;
    }

    .aula-btn:hover {
        border-color: #12355b;
        color: #12355b;
    }

    .aula-btn.active {
        background: #12355b;
        border-color: #12355b;
        color: #ffffff;
    }

    /* =========================
       NAVIGASI TAHUN
    ========================= */
    .month-navigation {
        margin-bottom: 18px;
        padding: 9px;
        display: grid;
        grid-template-columns: 1fr auto 1fr;
        align-items: center;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(15, 23, 42, 0.05);
    }

    .month-navigation a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 40px;
        padding: 8px 14px;
        background: #ffffff;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        color: #12355b;
        text-decoration: none;
        font-size: 14px;
        font-weight: 750;
        transition: .2s ease;
    }

    .month-navigation a:hover {
        background: #12355b;
        border-color: #12355b;
        color: #ffffff;
    }

    .month-navigation a:first-child {
        justify-self: start;
    }

    .month-navigation a:last-child {
        justify-self: end;
    }

    .month-navigation.month-current {
        display: block;
    }

    .month-title {
        color: #12355b;
        font-size: 20px;
        font-weight: 800;
        text-align: center;
        text-transform: uppercase;
    }

    /* =========================
       REPORT CARD
    ========================= */
    .report-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(15, 23, 42, 0.05);
        overflow: hidden;
    }

    .report-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        padding: 21px 22px;
        border-bottom: 1px solid #e2e8f0;
    }

    .report-title {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .report-icon {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        background: #f1f5f9;
        color: #12355b;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 19px;
    }

    .report-title h2 {
        margin: 0;
        color: #12355b;
        font-size: 18px;
    }

    .report-title p {
        margin: 4px 0 0;
        color: #64748b;
        font-size: 12px;
    }

    /* =========================
       LEGEND + BULAN
    ========================= */
    .rekap-legend {
        margin: 18px 22px 6px;
        color: #334155;
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
    }

    .legend-status {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 8px 16px;
        margin-top: 4px;
        margin-bottom: 12px;
    }

    .legend-item {
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .legend-box {
        width: 16px;
        height: 16px;
        border-radius: 4px;
        border: 1px solid #cbd5e1;
    }

    .box-disetujui {
        background: #dcfce7;
    }

    .box-menunggu {
        background: #fef9c3;
    }

    .box-ditolak {
        background: #fee2e2;
    }

    .rekap-month {
        padding: 0 22px;
        margin-bottom: 26px;
    }

    .rekap-month:last-child {
        margin-bottom: 22px;
    }

    .rekap-month-title {
        margin-bottom: 10px;
        color: #12355b;
        font-size: 16px;
        font-weight: 800;
        letter-spacing: 0.6px;
        text-transform: uppercase;
    }

    /* =========================
       TABEL REKAP
    ========================= */
    .rekap-table-scroll {
        overflow-x: auto;
        border: 1px solid #dbe3ec;
        border-radius: 10px;
    }

    .rekap-table {
        width: 100%;
        min-width: 720px;
        border-collapse: collapse;
        background: #ffffff;
    }

    .rekap-table thead th {
        padding: 12px 14px;
        background: #12355b;
        color: #ffffff;
        font-size: 13px;
        font-weight: 800;
        text-align: left;
        text-transform: uppercase;
        border-right: 1px solid rgba(255, 255, 255, .14);
    }

    .rekap-table thead th:last-child {
        border-right: none;
    }

    .rekap-table thead th span {
        display: block;
        font-size: 11px;
        font-weight: 600;
        opacity: .85;
    }

    .rekap-table tbody td {
        padding: 10px 14px;
        color: #1e293b;
        font-size: 13px;
        font-weight: 600;
        border-right: 1px solid #e2e8f0;
        border-bottom: 1px solid #e2e8f0;
        vertical-align: top;
    }

    .rekap-table tbody td:last-child {
        border-right: none;
    }

    .rekap-table tbody tr:last-child td {
        border-bottom: none;
    }

    .rekap-table tbody tr.weekend td {
        background: #f8fafc;
    }

    .col-tanggal {
        width: 130px;
        white-space: nowrap;
    }

    .col-hari {
        width: 90px;
    }

    .cell-used {
        color: #1d4ed8;
        font-weight: 750;
    }

    .rekap-table tbody td.cell-disetujui {
        background: #dcfce7;
        color: #166534;
        font-weight: 750;
    }

    .rekap-table tbody td.cell-menunggu {
        background: #fef9c3;
        color: #854d0e;
        font-weight: 750;
    }

    .rekap-table tbody td.cell-ditolak {
        background: #fee2e2;
        color: #991b1b;
        font-weight: 750;
    }

    /* =========================
       PRINT
    ========================= */
    .print-header {
        display: none;
    }

    @media (max-width: 650px) {
        .laporan-header {
            padding: 23px 20px;
        }

        .laporan-header h1 {
            font-size: 23px;
        }

        .month-navigation {
            grid-template-columns: 1fr;
            gap: 8px;
        }

        .month-navigation a:first-child,
        .month-navigation a:last-child {
            justify-self: stretch;
        }

        .report-top {
            flex-direction: column;
            align-items: stretch;
        }

        .report-top .btn {
            width: 100%;
        }

        .rekap-month {
            padding: 0 14px;
        }

        .rekap-legend {
            margin-left: 14px;
            margin-right: 14px;
        }
    }

    @page {
        size: A4 landscape;
        margin: 10mm;
    }

    @media print {
        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        body {
            background: #ffffff !important;
        }

        /* sembunyikan kerangka aplikasi (sidebar, nav, dll) */
        .sidebar,
        nav,
        .navbar,
        header,
        footer,
        .no-print {
            display: none !important;
        }

        .app-wrapper {
            margin-left: 0 !important;
        }

        .main-content {
            width: 100% !important;
            max-width: none !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        .laporan-page {
            max-width: none;
            margin: 0;
            padding: 0;
        }

        .laporan-header,
        .selector-card,
        .month-navigation {
            display: none !important;
        }

        .report-card {
            border: none;
            box-shadow: none;
            border-radius: 0;
        }

        .report-top {
            display: none;
        }

        .print-header {
            display: block;
            text-align: center;
            margin-bottom: 14px;
            padding: 12px 14px;
            background: #eef4fb;
            border: 1px solid #c9d8ea;
            border-radius: 8px;
        }

        .print-header h1 {
            margin: 0;
            font-size: 19px;
            color: #12355b;
        }

        .print-header h2 {
            margin: 4px 0 0;
            font-size: 13px;
            color: #1d4f7a;
        }

        .print-header p {
            margin: 4px 0 0;
            font-size: 11px;
            color: #334155;
        }

        .rekap-legend {
            margin: 0 0 10px;
            color: #334155;
            font-size: 9px;
        }

        .rekap-month {
            padding: 0;
            margin-bottom: 16px;
        }

        .rekap-month-title {
            color: #12355b;
            font-size: 12px;
            font-weight: 800;
            margin-bottom: 5px;
            padding: 4px 8px;
            background: #e3ecf7;
            border-left: 3px solid #12355b;
        }

        .rekap-table-scroll {
            overflow: visible;
            border: none;
            border-radius: 0;
        }

        .rekap-table {
            min-width: 0;
            width: 100%;
            border-collapse: collapse;
        }

        .rekap-table thead {
            display: table-header-group;
        }

        .rekap-table tr {
            break-inside: avoid;
        }

        .rekap-table thead th {
            background: #12355b !important;
            color: #ffffff !important;
            border: 1px solid #12355b;
            padding: 6px;
            font-size: 9px;
        }

        .rekap-table thead th span {
            color: #dbeafe;
        }

        .rekap-table tbody td {
            border: 1px solid #b9c6d6;
            padding: 5px 6px;
            font-size: 9px;
            color: #1e293b;
        }

        .rekap-table tbody tr:nth-child(even) td {
            background: #f4f7fb;
        }

        .rekap-table tbody tr.weekend td {
            background: #eef1f5;
        }

        .rekap-table tbody td.cell-disetujui {
            background: #dcfce7 !important;
            color: #166534;
            font-weight: 700;
        }

        .rekap-table tbody td.cell-menunggu {
            background: #fef9c3 !important;
            color: #854d0e;
            font-weight: 700;
        }

        .rekap-table tbody td.cell-ditolak {
            background: #fee2e2 !important;
            color: #991b1b;
            font-weight: 700;
        }

        .cell-used {
            color: #1d4ed8;
            font-weight: 700;
        }
    }
</style>

<div class="laporan-page">

    {{-- =========================
         HEADER
    ========================= --}}
    <div class="laporan-header no-print">
        <div class="header-content">

            <div class="header-label">
                <span>▣</span>
                Administrator
            </div>

            <h1>
                Laporan Pemakaian Aula per Bulan
            </h1>

            <p>
                Rekap ketersediaan harian untuk bulan berjalan,
                sesuai aula yang dipilih.
            </p>

        </div>
    </div>


    {{-- =========================
         PILIH AULA
    ========================= --}}
    <div class="selector-card no-print">

        <div class="selector-title">
            Pilih Aula
        </div>

        <div class="aula-buttons">

            @foreach ($aulas as $aula)

                <a
                    href="{{ route('admin.laporan', [
                        'aula' => $aula->id,
                    ]) }}"
                    class="aula-btn {{ $aulaTerpilih && $aulaTerpilih->id === $aula->id ? 'active' : '' }}"
                >
                    {{ $aula->nama_aula }}
                </a>

            @endforeach

        </div>

    </div>


    {{-- =========================
         BULAN BERJALAN
    ========================= --}}
    <div class="month-navigation month-current no-print">

        <div class="month-title">
            {{ $judulBulan }}
        </div>

    </div>


    {{-- =========================
         REPORT
    ========================= --}}
    <div class="report-card">

        {{-- HEADER CETAK --}}
        <div class="print-header">

            <h1>
                LAPORAN PEMAKAIAN AULA PER BULAN
            </h1>

            <h2>
                SAPA — Sistem Aplikasi untuk Layanan Akomodasi (Aula)
            </h2>

            <p>
                {{ $judulBulan }}
                —
                {{ $aulaTerpilih->nama_aula ?? 'Semua Aula' }}
            </p>

        </div>


        {{-- REPORT HEADER --}}
        <div class="report-top">

            <div class="report-title">

                <div class="report-icon">
                    ▤
                </div>

                <div>

                    <h2>
                        Rekap Pemakaian per Bulan
                    </h2>

                    <p>
                        Menampilkan bulan
                        {{ $judulBulan }}
                        untuk
                        {{ $aulaTerpilih->nama_aula ?? 'semua aula' }}.
                    </p>

                </div>

            </div>


            <button
                type="button"
                class="btn btn-print no-print"
                onclick="window.print()"
            >
                🖨 Cetak Laporan
            </button>

        </div>


        {{-- LEGEND --}}
        <div class="rekap-legend">
            Keterangan Unit:
            Sekretariat, Inpub, Konpub, Aptika, Sandikami
        </div>

        <div class="rekap-legend legend-status">
            <span class="legend-title">Keterangan Status:</span>

            <span class="legend-item">
                <span class="legend-box box-disetujui"></span>
                Disetujui
            </span>

            <span class="legend-item">
                <span class="legend-box box-menunggu"></span>
                Menunggu
            </span>

            <span class="legend-item">
                <span class="legend-box box-ditolak"></span>
                Ditolak
            </span>
        </div>


        {{-- DATA PER BULAN --}}
        @foreach ($rekapBulanan as $bulanItem)

            <div class="rekap-month">

                <div class="rekap-month-title">
                    {{ $bulanItem['judul'] }}
                </div>

                <div class="rekap-table-scroll">

                    <table class="rekap-table">

                        <thead>

                            <tr>
                                <th class="col-tanggal">
                                    Tanggal
                                </th>

                                <th class="col-hari">
                                    Hari
                                </th>

                                <th>
                                    Pagi
                                    <span>08.00 - 13.00</span>
                                </th>

                                <th>
                                    Siang
                                    <span>14.00 - 16.00</span>
                                </th>

                                <th>
                                    Malam
                                    <span>18.00 - 21.00</span>
                                </th>
                            </tr>

                        </thead>


                        <tbody>

                            @forelse ($bulanItem['rows'] as $row)

                                <tr class="{{ in_array($row['hari'], ['Sabtu', 'Minggu']) ? 'weekend' : '' }}">
                                    <td class="col-tanggal">
                                        {{ $row['tanggal'] }}
                                    </td>

                                    <td class="col-hari">
                                        {{ $row['hari'] }}
                                    </td>

                                    <td class="{{ $row['pagiStatus'] ? 'cell-' . $row['pagiStatus'] : '' }}">
                                        {{ $row['pagi'] }}
                                    </td>

                                    <td class="{{ $row['siangStatus'] ? 'cell-' . $row['siangStatus'] : '' }}">
                                        {{ $row['siang'] }}
                                    </td>

                                    <td class="{{ $row['malamStatus'] ? 'cell-' . $row['malamStatus'] : '' }}">
                                        {{ $row['malam'] }}
                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td colspan="5">
                                        Belum ada data untuk ditampilkan.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        @endforeach

    </div>

</div>

@endsection