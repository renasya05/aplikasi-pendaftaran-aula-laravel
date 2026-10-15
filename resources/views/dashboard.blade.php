@extends('layouts.app')

@section('title', 'Dashboard | SAPA')

@section('content')

<style>

    /* =====================================================
       DASHBOARD
    ===================================================== */

    .dashboard-page {
        max-width: 1180px;
        margin: 0 auto;
        padding: 40px 28px 60px;
    }

    .welcome-section {
        margin-bottom: 26px;
    }

    .welcome-eyebrow {
        margin: 0 0 6px;

        color: #12355b;
        font-size: 13px;
        font-weight: 800;
        letter-spacing: 0.8px;
        text-transform: uppercase;
    }

    .welcome-section h1 {
        margin: 0;
        color: #12355b;
        font-size: 28px;
        font-weight: 800;
    }

    .welcome-section p {
        margin: 8px 0 0;
        color: #64748b;
        font-size: 15px;
    }


    /* =====================================================
       STATISTIK
    ===================================================== */

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: #e9eef6;
        border: none;
        border-radius: 10px;
        padding: 16px 18px;
    }

    .stat-label {
        color: #64748b;
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 8px;
        text-transform: uppercase;
    }

    .stat-number {
        color: #12355b;
        font-size: 26px;
        font-weight: 800;
        line-height: 1;
    }

    .stat-card.is-menunggu .stat-number {
        color: #b45309;
    }

    .stat-card.is-disetujui .stat-number {
        color: #16a34a;
    }

    .stat-card.is-ditolak .stat-number {
        color: #dc2626;
    }


    /* =====================================================
       STATISTIK PER AULA
    ===================================================== */

    .aula-stats-section {
        margin-bottom: 30px;

        padding-top: 26px;
        border-top: 1px solid #dbe3ec;
    }

    .aula-stats-heading {
        margin: 0 0 6px;

        color: #12355b;
        font-size: 20px;
        font-weight: 800;
    }

    .aula-stats-description {
        margin: 0 0 18px;

        color: #64748b;
        font-size: 14px;
    }

    .aula-stats-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 16px;
    }

    .aula-stat-card {
        background: #ffffff;
        border: 1px solid #dbe3ec;
        border-radius: 12px;
        padding: 18px 20px;

        box-shadow:
            0 4px 14px rgba(15, 23, 42, .05);
    }

    .aula-stat-head {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .aula-stat-icon {
        display: flex;
        align-items: center;
        justify-content: center;

        width: 42px;
        height: 42px;
        flex: 0 0 42px;

        background: #e3ecf7;
        border-radius: 10px;

        color: #12355b;
        font-size: 20px;
    }

    .aula-stat-titles {
        flex: 1;
        min-width: 0;
    }

    .aula-stat-name {
        color: #12355b;
        font-size: 16px;
        font-weight: 800;
    }

    .aula-stat-sub {
        margin-top: 2px;

        color: #64748b;
        font-size: 12px;
    }

    .aula-stat-total {
        color: #12355b;
        font-size: 24px;
        font-weight: 800;
        line-height: 1;
    }

    .aula-stat-rows {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;

        margin-top: 14px;
    }

    .aula-stat-item {
        padding: 10px 12px;

        background: #f1f5f9;
        border: none;
        border-radius: 8px;
    }

    .aula-stat-item .lbl {
        display: block;

        color: #64748b;
        font-size: 12px;
        font-weight: 600;
    }

    .aula-stat-item .num {
        display: block;

        margin-top: 4px;

        color: #12355b;
        font-size: 17px;
        font-weight: 800;
    }

    .aula-stat-item.is-menunggu .num {
        color: #b45309;
    }

    .aula-stat-item.is-disetujui .num {
        color: #16a34a;
    }

    .aula-stat-item.is-ditolak .num {
        color: #dc2626;
    }


    /* =====================================================
       REKAP
    ===================================================== */

    .schedule-section {
        background: #ffffff;
        border: 1px solid #dbe3ec;
        border-radius: 15px;

        box-shadow:
            0 5px 18px rgba(15, 23, 42, .05);

        overflow: hidden;
    }

    #rekap {
        scroll-margin-top: 24px;
    }

    .schedule-header {
        padding: 28px;
        border-bottom: 1px solid #e2e8f0;
    }

    .schedule-title {
        margin: 0;
        color: #12355b;
        font-size: 25px;
        font-weight: 800;
        text-transform: uppercase;
    }

    .schedule-description {
        margin: 7px 0 0;
        color: #64748b;
        font-size: 15px;
    }


    /* =====================================================
       PILIH AULA
    ===================================================== */

    .aula-selector {
        padding: 22px 28px;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
    }

    .aula-selector-title {
        margin-bottom: 10px;
        color: #334155;
        font-size: 14px;
        font-weight: 800;
        text-transform: uppercase;
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

        font-size: 15px;
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


    .aula-info {
        margin-top: 16px;

        padding: 14px 16px;

        background: #ffffff;
        border: 1px solid #dbe3ec;
        border-radius: 10px;
    }

    .aula-info-title {
        margin-bottom: 8px;

        color: #12355b;
        font-size: 13px;
        font-weight: 800;

        text-transform: uppercase;
    }

    .aula-info p {
        margin: 0 0 4px;

        color: #475569;
        font-size: 13px;
        line-height: 1.55;
    }

    .aula-info p:last-child {
        margin-bottom: 0;
    }


    /* =====================================================
       FILTER
    ===================================================== */

    .filter-area {
        display: flex;
        align-items: center;
        flex-wrap: wrap;

        gap: 8px;

        padding: 18px 28px;

        border-bottom: 1px solid #e2e8f0;
    }

    .filter-label {
        color: #334155;
        font-size: 14px;
        font-weight: 800;
        margin-right: 3px;
        text-transform: uppercase;
    }

    .filter-btn {
        border: 1px solid #cbd5e1;
        background: #ffffff;
        color: #475569;

        border-radius: 8px;
        padding: 9px 13px;

        font-size: 14px;
        font-weight: 700;

        cursor: pointer;
        transition: .2s ease;
    }

    .filter-btn:hover {
        border-color: #12355b;
        color: #12355b;
    }

    .filter-btn.active {
        background: #12355b;
        border-color: #12355b;
        color: #ffffff;
    }

    .filter-dot {
        display: inline-block;
        width: 9px;
        height: 9px;
        border-radius: 50%;
        margin-right: 5px;
    }

    .dot-empty {
        background: #ffffff;
        border: 1px solid #94a3b8;
    }

    .dot-disetujui {
        background: #16a34a;
    }

    .dot-menunggu {
        background: #facc15;
    }

    .dot-ditolak {
        background: #dc2626;
    }


    /* =====================================================
       NAVIGASI BULAN
    ===================================================== */

    .month-navigation {
        margin: 20px 28px;

        padding: 9px;

        display: grid;
        grid-template-columns: 1fr auto 1fr;
        align-items: center;

        background: #f8fafc;
        border: 1px solid #dbe3ec;
        border-radius: 10px;
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

    .month-title {
        color: #12355b;
        font-size: 20px;
        font-weight: 800;
        text-align: center;
        text-transform: uppercase;
    }


    /* =====================================================
       TABEL REKAP
    ===================================================== */

    .rekap-wrapper {
        padding: 0;
    }

    .rekap-legend {
        margin: 0 28px 18px;

        color: #334155;
        font-size: 13px;
        font-weight: 800;

        text-transform: uppercase;
    }

    .rekap-month {
        padding: 0 28px;

        margin-bottom: 28px;
    }

    .rekap-month:last-child {
        margin-bottom: 6px;
    }

    .rekap-month-title {
        margin-bottom: 10px;

        color: #12355b;
        font-size: 16px;
        font-weight: 800;

        letter-spacing: 0.6px;
        text-transform: uppercase;
    }

    .rekap-table-scroll {
        overflow-x: auto;

        border: 1px solid #dbe3ec;
        border-radius: 10px;
    }

    .rekap-table {
        width: 100%;
        min-width: 1000px;

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

        border-right: 1px solid
            rgba(255,255,255,.14);
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

    .rekap-table tbody tr.hidden-by-filter {
        display: none;
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

    .cell-disetujui {
        background: #dcfce7;
        color: #166534;
        font-weight: 750;
    }

    .cell-menunggu {
        background: #fef9c3;
        color: #854d0e;
        font-weight: 750;
    }

    .cell-ditolak {
        background: #fee2e2;
        color: #991b1b;
        font-weight: 750;
    }

    /* warna tetap tampil di baris Sabtu/Minggu */
    .rekap-table tbody tr.weekend td.cell-disetujui {
        background: #dcfce7;
    }

    .rekap-table tbody tr.weekend td.cell-menunggu {
        background: #fef9c3;
    }

    .rekap-table tbody tr.weekend td.cell-ditolak {
        background: #fee2e2;
    }


    /* =====================================================
       LEGENDA WARNA
    ===================================================== */

    .rekap-legend {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 16px;
    }

    .legend-item {
        display: inline-flex;
        align-items: center;
        gap: 6px;

        text-transform: none;
        font-weight: 700;
    }

    .legend-box {
        display: inline-block;
        width: 16px;
        height: 16px;
        border-radius: 4px;
        border: 1px solid rgba(15, 23, 42, .15);
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

    .box-kosong {
        background: #ffffff;
    }

    .rekap-empty-note {
        padding: 26px;

        text-align: center;

        color: #64748b;
        font-size: 14px;
        font-weight: 700;
    }


    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media (max-width: 900px) {

        .dashboard-page {
            padding-left: 18px;
            padding-right: 18px;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

    }


    @media (max-width: 600px) {

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .aula-stats-grid {
            grid-template-columns: 1fr;
        }

        .aula-stat-rows {
            grid-template-columns: repeat(2, 1fr);
        }

        .schedule-header,
        .aula-selector,
        .filter-area {
            padding-left: 18px;
            padding-right: 18px;
        }

        .month-navigation {
            margin-left: 18px;
            margin-right: 18px;

            grid-template-columns: 1fr;

            gap: 8px;
        }

        .month-navigation a:first-child,
        .month-navigation a:last-child {
            justify-self: stretch;
        }

        .rekap-legend {
            margin-left: 18px;
            margin-right: 18px;
        }

        .rekap-month {
            padding-left: 18px;
            padding-right: 18px;
        }

    }

</style>


<div class="dashboard-page">

    {{-- Navbar kanan atas: hari, notifikasi, profil --}}
    @include('partials.topbar')


    {{-- =================================================
         WELCOME
    ================================================== --}}

    <section class="welcome-section">

        <p class="welcome-eyebrow">
            Dashboard SAPA
        </p>

        <h1>
            Selamat Datang, {{ Auth::user()->name }}
        </h1>

        <p>
            Kelola pemakaian aula dan lihat jadwal kegiatan melalui SAPA.
        </p>

    </section>


    {{-- =================================================
         STATISTIK
    ================================================== --}}

    <section class="stats-grid">

        <div class="stat-card">

            <div class="stat-label">
                Total Pendaftaran
            </div>

            <div class="stat-number">
                {{ $totalPendaftaran }}
            </div>

        </div>


        <div class="stat-card is-menunggu">

            <div class="stat-label">
                Menunggu
            </div>

            <div class="stat-number">
                {{ $menunggu }}
            </div>

        </div>


        <div class="stat-card is-disetujui">

            <div class="stat-label">
                Disetujui
            </div>

            <div class="stat-number">
                {{ $disetujui }}
            </div>

        </div>


        <div class="stat-card is-ditolak">

            <div class="stat-label">
                Ditolak
            </div>

            <div class="stat-number">
                {{ $ditolak }}
            </div>

        </div>

    </section>


    {{-- =================================================
         STATISTIK PER AULA
    ================================================== --}}

    <section class="aula-stats-section">

        <h2 class="aula-stats-heading">
            Ringkasan Pendaftaran per Aula
        </h2>

        <p class="aula-stats-description">
            Lihat jumlah pendaftaran dan statusnya untuk setiap aula.
        </p>

        <div class="aula-stats-grid">

            @foreach($aulas as $aula)

                @php
                    $stat = $statistikAula[$aula->id] ?? [
                        'total' => 0,
                        'menunggu' => 0,
                        'disetujui' => 0,
                        'ditolak' => 0,
                    ];
                @endphp

                <div class="aula-stat-card">

                    <div class="aula-stat-head">

                        <div class="aula-stat-icon">
                            &#127970;
                        </div>

                        <div class="aula-stat-titles">

                            <div class="aula-stat-name">
                                {{ $aula->nama_aula }}
                            </div>

                            <div class="aula-stat-sub">
                                Total {{ $stat['total'] }} pendaftaran
                            </div>

                        </div>

                        <div class="aula-stat-total">
                            {{ $stat['total'] }}
                        </div>

                    </div>

                    <div class="aula-stat-rows">

                        <div class="aula-stat-item is-menunggu">
                            <span class="lbl">Menunggu</span>
                            <span class="num">{{ $stat['menunggu'] }}</span>
                        </div>

                        <div class="aula-stat-item is-disetujui">
                            <span class="lbl">Disetujui</span>
                            <span class="num">{{ $stat['disetujui'] }}</span>
                        </div>

                        <div class="aula-stat-item is-ditolak">
                            <span class="lbl">Ditolak</span>
                            <span class="num">{{ $stat['ditolak'] }}</span>
                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    </section>


    {{-- =================================================
         REKAP
    ================================================== --}}

    <section class="schedule-section" id="rekap">


        {{-- HEADER --}}

        <div class="schedule-header">

            <h2 class="schedule-title">
                Rekap Ketersediaan Aula
            </h2>

            <p class="schedule-description">
                Data untuk bulan
                {{ $rekapBulanIni['judul'] ?? \Carbon\Carbon::now()->translatedFormat('F Y') }}.
            </p>

        </div>


        {{-- =================================================
             PILIH AULA
        ================================================== --}}

        <div class="aula-selector">

            <div class="aula-selector-title">
                Pilih Aula
            </div>


            <div class="aula-buttons">

                @foreach($aulas as $aula)

                    <a
                        href="{{ route('dashboard', [
                            'aula' => $aula->id,
                        ]) }}#rekap"
                        class="aula-btn {{ $aulaTerpilih && $aulaTerpilih->id === $aula->id ? 'active' : '' }}"
                    >
                        {{ $aula->nama_aula }}
                    </a>

                @endforeach

            </div>


            {{-- DATA AULA TERPILIH --}}

            @if($aulaTerpilih)

                @php
                    $namaAulaTerpilih = strtolower(
                        $aulaTerpilih->nama_aula ?? ''
                    );

                    if (str_contains($namaAulaTerpilih, 'kecil')) {
                        $ukuranTerpilih = '7,6 x 4 m';
                        $fasilitasTerpilih = 'TV 65 inch';
                        $kapasitasTerpilih = '≤ 30 orang';
                    } else {
                        $ukuranTerpilih = '15 x 10 m';
                        $fasilitasTerpilih = 'Sistem Audio, Videotron, Lighting, Panggung';
                        $kapasitasTerpilih = '> 100 orang';
                    }
                @endphp

                <div class="aula-info">

                    <div class="aula-info-title">
                        Data Aula
                    </div>

                    <p>
                        <strong>{{ $aulaTerpilih->nama_aula }}</strong>
                        — Kap {{ $kapasitasTerpilih }}
                        ({{ $ukuranTerpilih }})
                    </p>

                    <p>
                        Fasilitas: {{ $fasilitasTerpilih }}
                    </p>

                    @if($aulaTerpilih->keterangan)
                        <p>
                            Keterangan: {{ $aulaTerpilih->keterangan }}
                        </p>
                    @endif

                </div>

            @endif

        </div>


        {{-- =================================================
             FILTER
        ================================================== --}}

        <div class="filter-area">

            <span class="filter-label">
                Tampilkan:
            </span>


            <button
                type="button"
                class="filter-btn active"
                data-filter="all"
            >
                Semua
            </button>


            <button
                type="button"
                class="filter-btn"
                data-filter="disetujui"
            >
                <span class="filter-dot dot-disetujui"></span>
                Disetujui
            </button>


            <button
                type="button"
                class="filter-btn"
                data-filter="menunggu"
            >
                <span class="filter-dot dot-menunggu"></span>
                Menunggu
            </button>


            <button
                type="button"
                class="filter-btn"
                data-filter="ditolak"
            >
                <span class="filter-dot dot-ditolak"></span>
                Ditolak
            </button>


            <button
                type="button"
                class="filter-btn"
                data-filter="kosong"
            >
                <span class="filter-dot dot-empty"></span>
                Kosong
            </button>

        </div>


        {{-- =================================================
             TABEL REKAP HARIAN BULAN INI
        ================================================== --}}

        <div class="rekap-legend">
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

            <span class="legend-item">
                <span class="legend-box box-kosong"></span>
                Kosong
            </span>
        </div>


        @if($rekapBulanIni)

            <div class="rekap-month">

                <div class="rekap-month-title">
                    {{ $rekapBulanIni['judul'] }}
                </div>


                <div class="rekap-wrapper">

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

                                    <th>
                                        Pagi - Siang
                                        <span>08.00 - 16.00</span>
                                    </th>

                                    <th>
                                        Siang - Malam
                                        <span>14.00 - 21.00</span>
                                    </th>

                                    <th>
                                        Pagi - Malam
                                        <span>08.00 - 21.00</span>
                                    </th>
                                </tr>

                            </thead>


                            <tbody>

                                @forelse($rekapBulanIni['rows'] as $row)

                                    <tr
                                        class="rekap-row {{ in_array($row['hari'], ['Sabtu', 'Minggu']) ? 'weekend' : '' }}"
                                        data-status="{{ $row['status'] }}"
                                        data-disetujui="{{ ($row['adaDisetujui'] ?? false) ? '1' : '0' }}"
                                        data-menunggu="{{ ($row['adaMenunggu'] ?? false) ? '1' : '0' }}"
                                        data-ditolak="{{ ($row['adaDitolak'] ?? false) ? '1' : '0' }}"
                                        data-booking="{{ ($row['adaBooking'] ?? false) ? '1' : '0' }}"
                                        data-tanggal="{{ $row['key'] }}"
                                    >
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

                                        <td class="{{ !empty($row['pagiSiangStatus']) ? 'cell-' . $row['pagiSiangStatus'] : '' }}">
                                            {{ $row['pagiSiang'] ?? '' }}
                                        </td>

                                        <td class="{{ !empty($row['siangMalamStatus']) ? 'cell-' . $row['siangMalamStatus'] : '' }}">
                                            {{ $row['siangMalam'] ?? '' }}
                                        </td>

                                        <td class="{{ !empty($row['pagiMalamStatus']) ? 'cell-' . $row['pagiMalamStatus'] : '' }}">
                                            {{ $row['pagiMalam'] ?? '' }}
                                        </td>
                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="8" class="rekap-empty-note">
                                            Belum ada data untuk ditampilkan.
                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        @endif

    </section>

</div>


<script>

    document
        .querySelectorAll('.filter-btn')
        .forEach(function (button) {

            button.addEventListener(
                'click',
                function () {

                    document
                        .querySelectorAll('.filter-btn')
                        .forEach(function (item) {
                            item.classList.remove('active');
                        });

                    button.classList.add('active');

                    var filter = button.dataset.filter;

                    document
                        .querySelectorAll('.rekap-row')
                        .forEach(function (row) {

                            var status = row.dataset.status;
                            var disetujui = row.dataset.disetujui;
                            var menunggu = row.dataset.menunggu;
                            var ditolak = row.dataset.ditolak;
                            var booking = row.dataset.booking;

                            var tampil;

                            if (filter === 'all') {
                                tampil = true;
                            } else if (filter === 'disetujui') {
                                tampil = (disetujui === '1');
                            } else if (filter === 'menunggu') {
                                tampil = (menunggu === '1');
                            } else if (filter === 'ditolak') {
                                tampil = (ditolak === '1');
                            } else if (filter === 'kosong') {
                                tampil = (booking !== '1');
                            } else {
                                tampil = (status === filter);
                            }

                            row.classList.toggle(
                                'hidden-by-filter',
                                !tampil
                            );

                        });

                }
            );

        });

</script>

@endsection