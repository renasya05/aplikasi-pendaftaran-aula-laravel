@extends('layouts.app')

@section('title', 'Riwayat Pemakaian Aula | SAPA')

@section('content')

<div class="history-page">

    {{-- =========================================================
         HEADER
    ========================================================== --}}

    <div class="page-header">

        <div class="header-left">

            <div class="page-label">
                RIWAYAT PEMAKAIAN
            </div>

            <h1>
                Riwayat Pemakaian Aula
            </h1>

            <p>
                Daftar seluruh pengajuan pemakaian aula yang telah Anda lakukan.
            </p>

        </div>

        <div class="header-action">

            <a
                href="{{ route('aulas') }}"
                class="primary-btn"
            >
                + Ajukan Pemakaian
            </a>

        </div>

    </div>


    {{-- =========================================================
         BACK TO DASHBOARD
    ========================================================== --}}

    <div class="back-dashboard">

        <a
            href="{{ route('dashboard') }}"
            class="back-link"
        >
            <span class="back-arrow">←</span>
            Kembali ke Dashboard
        </a>

    </div>


    {{-- =========================================================
         SUMMARY
    ========================================================== --}}

    <div class="summary-grid">

        <div class="summary-card">

            <div class="summary-icon">
                📋
            </div>

            <div class="summary-content">

                <span class="summary-label">
                    Total Pengajuan
                </span>

                <strong>
                    {{ $pendaftarans->count() }}
                </strong>

            </div>

        </div>


        <div class="summary-card">

            <div class="summary-icon waiting">
                ⏳
            </div>

            <div class="summary-content">

                <span class="summary-label">
                    Menunggu
                </span>

                <strong>
                    {{ $pendaftarans->where('status', 'menunggu')->count() }}
                </strong>

            </div>

        </div>


        <div class="summary-card">

            <div class="summary-icon approved">
                ✓
            </div>

            <div class="summary-content">

                <span class="summary-label">
                    Disetujui
                </span>

                <strong>
                    {{ $pendaftarans->where('status', 'disetujui')->count() }}
                </strong>

            </div>

        </div>


        <div class="summary-card">

            <div class="summary-icon rejected">
                ✕
            </div>

            <div class="summary-content">

                <span class="summary-label">
                    Ditolak
                </span>

                <strong>
                    {{ $pendaftarans->where('status', 'ditolak')->count() }}
                </strong>

            </div>

        </div>

    </div>


    {{-- =========================================================
         HISTORY CARD
    ========================================================== --}}

    <div class="history-card">

        {{-- CARD HEADER --}}

        <div class="card-header">

            <div>

                <div class="card-title-row">

                    <div class="card-title-icon">
                        📋
                    </div>

                    <div>

                        <h2>
                            Daftar Pengajuan
                        </h2>

                        <p>
                            Riwayat pemakaian aula Anda
                        </p>

                    </div>

                </div>

            </div>


            <div class="total-badge">

                {{ $pendaftarans->count() }}
                Pengajuan

            </div>

        </div>


        {{-- =====================================================
             DATA
        ====================================================== --}}

        @if($pendaftarans->count() > 0)

            <div class="table-wrapper">

                <table class="history-table">

                    <thead>

                        <tr>

                            <th class="number-column">
                                No
                            </th>

                            <th>
                                Aula
                            </th>

                            <th>
                                Tanggal
                            </th>

                            <th>
                                Waktu
                            </th>

                            <th>
                                Unit Organisasi
                            </th>

                            <th>
                                Peserta
                            </th>

                            <th>
                                Pihak Luar
                            </th>

                            <th>
                                Keperluan
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($pendaftarans as $index => $pendaftaran)

                            <tr>

                                {{-- NO --}}

                                <td class="number-column">

                                    <span class="number-badge">
                                        {{ $index + 1 }}
                                    </span>

                                </td>


                                {{-- AULA --}}

                                <td>

                                    <div class="aula-cell">

                                        <div class="aula-icon">
                                            🏢
                                        </div>

                                        <div>

                                            <div class="aula-name">
                                                {{ $pendaftaran->aula->nama_aula ?? '-' }}
                                            </div>

                                            <div class="aula-caption">
                                                Aula SAPA
                                            </div>

                                        </div>

                                    </div>

                                </td>


                                {{-- TANGGAL --}}

                                <td>

                                    <div class="date-wrapper">

                                        @if($pendaftaran->tanggal_mulai)

                                            <span class="day-name">

                                                {{
                                                    \Carbon\Carbon::parse(
                                                        $pendaftaran->tanggal_mulai
                                                    )
                                                    ->locale('id')
                                                    ->translatedFormat('l')
                                                }}

                                            </span>

                                            <strong>

                                                {{
                                                    \Carbon\Carbon::parse(
                                                        $pendaftaran->tanggal_mulai
                                                    )
                                                    ->locale('id')
                                                    ->translatedFormat('d F Y')
                                                }}

                                            </strong>


                                            @if(
                                                $pendaftaran->tanggal_selesai &&
                                                $pendaftaran->tanggal_selesai !=
                                                $pendaftaran->tanggal_mulai
                                            )

                                                <span class="date-to">
                                                    sampai
                                                </span>

                                                <strong>

                                                    {{
                                                        \Carbon\Carbon::parse(
                                                            $pendaftaran->tanggal_selesai
                                                        )
                                                        ->locale('id')
                                                        ->translatedFormat('d F Y')
                                                    }}

                                                </strong>

                                            @endif

                                        @else

                                            <span class="empty-value">
                                                -
                                            </span>

                                        @endif

                                    </div>

                                </td>


                                {{-- WAKTU --}}

                                <td>

                                    @if(
                                        $pendaftaran->jam_mulai &&
                                        $pendaftaran->jam_selesai
                                    )

                                        <div class="time-box">

                                            <span class="time-icon">
                                                🕐
                                            </span>

                                            <span class="time-text">

                                                {{
                                                    \Carbon\Carbon::parse(
                                                        $pendaftaran->jam_mulai
                                                    )->format('H:i')
                                                }}

                                                -

                                                {{
                                                    \Carbon\Carbon::parse(
                                                        $pendaftaran->jam_selesai
                                                    )->format('H:i')
                                                }}

                                            </span>

                                        </div>

                                    @else

                                        <span class="empty-value">
                                            -
                                        </span>

                                    @endif

                                </td>


                                {{-- UNIT ORGANISASI --}}

                                <td>

                                    <div class="organization-text">

                                        @if($pendaftaran->unit_organisasi)

                                            <div class="organization-main">
                                                {{ $pendaftaran->unit_organisasi }}
                                            </div>

                                            @if($pendaftaran->bagian_seksi)

                                                <div class="organization-sub">
                                                    {{ $pendaftaran->bagian_seksi }}
                                                </div>

                                            @endif

                                        @else

                                            <div class="organization-main">
                                                {{ $pendaftaran->instansi ?? 'Eksternal' }}
                                            </div>

                                            <div class="organization-sub external">
                                                Pemohon Eksternal
                                            </div>

                                        @endif

                                    </div>

                                </td>


                                {{-- PESERTA --}}

                                <td>

                                    <div class="participant">

                                        <strong>
                                            {{ $pendaftaran->jumlah_peserta ?? 0 }}
                                        </strong>

                                        <span>
                                            orang
                                        </span>

                                    </div>

                                </td>


                                {{-- PIHAK LUAR --}}

                                <td>

                                    @if($pendaftaran->peserta_pihak_luar === 'ada')

                                        <span class="badge badge-warning">
                                            Ada
                                        </span>

                                    @else

                                        <span class="badge badge-neutral">
                                            Tidak Ada
                                        </span>

                                    @endif

                                </td>


                                {{-- KEPERLUAN --}}

                                <td>

                                    <div
                                        class="purpose-text"
                                        title="{{ $pendaftaran->keperluan }}"
                                    >
                                        {{ $pendaftaran->keperluan ?? '-' }}
                                    </div>

                                </td>


                                {{-- STATUS --}}

                                <td>

                                    @if($pendaftaran->status === 'disetujui')

                                        <span class="badge badge-success">
                                            ✓ Disetujui
                                        </span>

                                    @elseif($pendaftaran->status === 'ditolak')

                                        <span class="badge badge-danger">
                                            ✕ Ditolak
                                        </span>

                                    @elseif($pendaftaran->status === 'dibatalkan')

                                        <span class="badge badge-cancelled">
                                            Dibatalkan
                                        </span>

                                    @else

                                        <span class="badge badge-pending">
                                            ⏳ Menunggu
                                        </span>

                                    @endif

                                </td>


                                {{-- AKSI --}}

                                <td>

                                    <a
                                        href="{{ route('pendaftaran.show', $pendaftaran) }}"
                                        class="view-btn"
                                    >
                                        Lihat Detail
                                    </a>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            {{-- =================================================
                 TABLE FOOTER
            ================================================== --}}

            <div class="table-footer">

                <div class="footer-description">

                    <span class="footer-icon">
                        ℹ
                    </span>

                    Menampilkan seluruh riwayat pengajuan
                    pemakaian aula Anda.

                </div>

                <div class="status-info">

                    Status diperbarui oleh administrator.

                </div>

            </div>


        @else

            {{-- =================================================
                 EMPTY STATE
            ================================================== --}}

            <div class="empty-state">

                <div class="empty-icon">
                    📋
                </div>

                <h3>
                    Belum Ada Pengajuan
                </h3>

                <p>
                    Anda belum memiliki riwayat pengajuan
                    pemakaian aula.
                </p>

                <a
                    href="{{ route('aulas') }}"
                    class="primary-btn empty-btn"
                >
                    Lihat Daftar Aula
                </a>

            </div>

        @endif

    </div>

</div>


<style>

/* =========================================================
   PAGE
========================================================= */

.history-page {
    max-width: 1250px;
    margin: 0 auto;
    padding: 35px 0 55px;
}


/* =========================================================
   HEADER
========================================================= */

.page-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 25px;
    margin-bottom: 15px;
}

.page-label {
    display: inline-flex;
    align-items: center;
    color: #12355b;
    background: #eef4f9;
    border: 1px solid #d9e5ef;
    border-radius: 6px;
    padding: 5px 9px;
    font-size: 9px;
    font-weight: 800;
    letter-spacing: 1px;
    margin-bottom: 9px;
}

.page-header h1 {
    margin: 0;
    color: #12355b;
    font-size: 27px;
    font-weight: 800;
    line-height: 1.25;
}

.page-header p {
    margin: 7px 0 0;
    color: #64748b;
    font-size: 12px;
    line-height: 1.6;
}


/* =========================================================
   PRIMARY BUTTON
========================================================= */

.primary-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 40px;
    padding: 0 17px;
    background: #12355b;
    color: #ffffff;
    border: 1px solid #12355b;
    border-radius: 7px;
    text-decoration: none;
    font-size: 11px;
    font-weight: 700;
    transition: all .2s ease;
    white-space: nowrap;
}

.primary-btn:hover {
    background: #0d2947;
    border-color: #0d2947;
    color: #ffffff;
    transform: translateY(-1px);
}


/* =========================================================
   BACK
========================================================= */

.back-dashboard {
    margin-bottom: 18px;
}

.back-link {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    color: #12355b;
    text-decoration: none;
    font-size: 11px;
    font-weight: 700;
    transition: all .2s ease;
}

.back-link:hover {
    color: #2563eb;
}

.back-arrow {
    font-size: 16px;
    line-height: 1;
}


/* =========================================================
   SUMMARY GRID
========================================================= */

.summary-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 13px;
    margin-bottom: 18px;
}

.summary-card {
    display: flex;
    align-items: center;
    gap: 12px;
    min-height: 80px;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 14px;
    box-shadow: 0 3px 12px rgba(15, 23, 42, .035);
}

.summary-icon {
    width: 40px;
    height: 40px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #eef4f9;
    border-radius: 8px;
    font-size: 17px;
}

.summary-icon.waiting {
    background: #fef3c7;
}

.summary-icon.approved {
    background: #dcfce7;
    color: #15803d;
    font-weight: 800;
}

.summary-icon.rejected {
    background: #fee2e2;
    color: #dc2626;
    font-weight: 800;
}

.summary-content {
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.summary-label {
    color: #64748b;
    font-size: 9px;
    font-weight: 600;
}

.summary-content strong {
    color: #12355b;
    font-size: 20px;
    font-weight: 800;
}


/* =========================================================
   HISTORY CARD
========================================================= */

.history-card {
    background: #ffffff;
    border: 1px solid #dfe5ec;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(15, 23, 42, .045);
}


/* =========================================================
   CARD HEADER
========================================================= */

.card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    padding: 18px 21px;
    background: #ffffff;
    border-bottom: 1px solid #edf1f5;
}

.card-title-row {
    display: flex;
    align-items: center;
    gap: 10px;
}

.card-title-icon {
    width: 34px;
    height: 34px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #eef4f9;
    border-radius: 7px;
    font-size: 15px;
}

.card-header h2 {
    margin: 0;
    color: #12355b;
    font-size: 15px;
    font-weight: 800;
}

.card-header p {
    margin: 3px 0 0;
    color: #64748b;
    font-size: 10px;
}

.total-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 7px 12px;
    border-radius: 20px;
    background: #eff6ff;
    color: #12355b;
    font-size: 10px;
    font-weight: 700;
    white-space: nowrap;
}


/* =========================================================
   TABLE
========================================================= */

.table-wrapper {
    width: 100%;
    overflow-x: auto;
}

.history-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 1080px;
}

.history-table thead th {
    background: #12355b;
    color: #ffffff;
    padding: 12px 11px;
    text-align: left;
    font-size: 9px;
    font-weight: 700;
    white-space: nowrap;
}

.history-table tbody td {
    padding: 13px 11px;
    border-bottom: 1px solid #e7ebf0;
    color: #334155;
    font-size: 10px;
    vertical-align: middle;
    background: #ffffff;
}

.history-table tbody tr:last-child td {
    border-bottom: none;
}

.history-table tbody tr:hover td {
    background: #f8fafc;
}


/* =========================================================
   NUMBER
========================================================= */

.number-column {
    width: 45px;
    text-align: center !important;
}

.number-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 25px;
    height: 25px;
    border-radius: 6px;
    background: #f1f5f9;
    color: #64748b;
    font-size: 9px;
    font-weight: 700;
}


/* =========================================================
   AULA
========================================================= */

.aula-cell {
    display: flex;
    align-items: center;
    gap: 8px;
    min-width: 130px;
}

.aula-icon {
    width: 30px;
    height: 30px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #eef4f9;
    border-radius: 6px;
    font-size: 13px;
}

.aula-name {
    color: #12355b;
    font-weight: 700;
    white-space: nowrap;
}

.aula-caption {
    margin-top: 3px;
    color: #94a3b8;
    font-size: 8px;
}


/* =========================================================
   DATE
========================================================= */

.date-wrapper {
    display: flex;
    flex-direction: column;
    gap: 2px;
    min-width: 110px;
}

.day-name {
    color: #64748b;
    font-size: 9px;
}

.date-wrapper strong {
    color: #12355b;
    font-size: 10px;
    font-weight: 700;
}

.date-to {
    color: #94a3b8;
    font-size: 8px;
    margin-top: 2px;
}

.empty-value {
    color: #94a3b8;
}


/* =========================================================
   TIME
========================================================= */

.time-box {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    white-space: nowrap;
}

.time-icon {
    font-size: 11px;
}

.time-text {
    color: #12355b;
    font-size: 10px;
    font-weight: 700;
}


/* =========================================================
   ORGANIZATION
========================================================= */

.organization-text {
    color: #475569;
    line-height: 1.45;
    min-width: 140px;
    max-width: 190px;
}

.organization-main {
    color: #334155;
    font-weight: 600;
}

.organization-sub {
    display: block;
    margin-top: 4px;
    color: #94a3b8;
    font-size: 8px;
    line-height: 1.4;
}

.organization-sub.external {
    color: #c2410c;
}


/* =========================================================
   PARTICIPANT
========================================================= */

.participant {
    display: flex;
    align-items: baseline;
    gap: 3px;
    white-space: nowrap;
}

.participant strong {
    color: #12355b;
    font-size: 12px;
}

.participant span {
    color: #64748b;
    font-size: 9px;
}


/* =========================================================
   PURPOSE
========================================================= */

.purpose-text {
    color: #475569;
    line-height: 1.5;
    min-width: 100px;
    max-width: 145px;

    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}


/* =========================================================
   BADGES
========================================================= */

.badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 62px;
    padding: 6px 9px;
    border-radius: 20px;
    font-size: 9px;
    font-weight: 700;
    white-space: nowrap;
}

.badge-success {
    background: #dcfce7;
    color: #15803d;
}

.badge-danger {
    background: #fee2e2;
    color: #b91c1c;
}

.badge-pending {
    background: #fef3c7;
    color: #b45309;
}

.badge-cancelled {
    background: #f1f5f9;
    color: #64748b;
}

.badge-warning {
    background: #fff7ed;
    color: #c2410c;
}

.badge-neutral {
    background: #f1f5f9;
    color: #475569;
}


/* =========================================================
   VIEW BUTTON
========================================================= */

.view-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 30px;
    padding: 0 11px;
    border-radius: 6px;
    background: #eff6ff;
    border: 1px solid #dbeafe;
    color: #12355b;
    text-decoration: none;
    font-size: 9px;
    font-weight: 700;
    transition: all .2s ease;
    white-space: nowrap;
}

.view-btn:hover {
    background: #12355b;
    border-color: #12355b;
    color: #ffffff;
}


/* =========================================================
   TABLE FOOTER
========================================================= */

.table-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    padding: 11px 20px;
    background: #f8fafc;
    border-top: 1px solid #e5e7eb;
    color: #64748b;
    font-size: 9px;
}

.footer-description {
    display: flex;
    align-items: center;
    gap: 6px;
}

.footer-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 16px;
    height: 16px;
    border-radius: 50%;
    background: #e2e8f0;
    color: #64748b;
    font-size: 9px;
    font-weight: 800;
}

.status-info {
    color: #94a3b8;
}


/* =========================================================
   EMPTY STATE
========================================================= */

.empty-state {
    padding: 65px 25px 70px;
    text-align: center;
}

.empty-icon {
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 16px;
    border-radius: 15px;
    background: #eef4f9;
    font-size: 25px;
}

.empty-state h3 {
    margin: 0;
    color: #12355b;
    font-size: 17px;
    font-weight: 800;
}

.empty-state p {
    max-width: 400px;
    margin: 7px auto 20px;
    color: #64748b;
    font-size: 11px;
    line-height: 1.6;
}

.empty-btn {
    display: inline-flex;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 1050px) {

    .history-page {
        padding-left: 18px;
        padding-right: 18px;
    }

    .summary-grid {
        grid-template-columns: repeat(2, 1fr);
    }

}


@media (max-width: 750px) {

    .page-header {
        align-items: flex-start;
        flex-direction: column;
        gap: 15px;
    }

    .header-action {
        width: 100%;
    }

    .primary-btn {
        width: fit-content;
    }

    .table-footer {
        align-items: flex-start;
        flex-direction: column;
        gap: 6px;
    }

}


@media (max-width: 600px) {

    .history-page {
        padding: 25px 12px 40px;
    }

    .page-header h1 {
        font-size: 23px;
    }

    .page-header p {
        font-size: 11px;
    }

    .summary-grid {
        grid-template-columns: 1fr 1fr;
        gap: 9px;
    }

    .summary-card {
        min-height: 70px;
        padding: 11px;
        gap: 8px;
    }

    .summary-icon {
        width: 34px;
        height: 34px;
        font-size: 14px;
    }

    .summary-label {
        font-size: 8px;
    }

    .summary-content strong {
        font-size: 17px;
    }

    .card-header {
        padding: 15px;
    }

    .card-title-icon {
        width: 30px;
        height: 30px;
    }

    .card-header h2 {
        font-size: 13px;
    }

    .card-header p {
        font-size: 9px;
    }

    .total-badge {
        font-size: 8px;
        padding: 6px 9px;
    }

    .back-dashboard {
        margin-bottom: 14px;
    }

}


@media (max-width: 420px) {

    .summary-grid {
        grid-template-columns: 1fr;
    }

    .summary-card {
        min-height: 64px;
    }

    .header-action .primary-btn {
        width: 100%;
    }

}

</style>

@endsection