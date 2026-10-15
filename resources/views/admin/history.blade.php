@extends('layouts.app')

@section('title', 'Riwayat Pendaftaran | SAPA')

@section('content')

<div class="admin-history">

    {{-- HEADER --}}
    <div class="page-top">

        <a href="{{ route('admin.dashboard') }}" class="back-link">
            ← Kembali ke Dashboard Admin
        </a>

        <div class="history-header">
            <div>
                <span class="page-label">
                    ADMINISTRATOR
                </span>

                <h1>
                    Data Pengajuan Pemakaian Aula
                </h1>

                <p>
                    Lihat, filter, dan proses seluruh pengajuan pemakaian aula.
                </p>
            </div>

            <div class="history-icon">
                📋
            </div>
        </div>

    </div>


    {{-- FILTER --}}
    <div class="filter-card">

        <div class="filter-heading">

            <div class="filter-title">
                Filter Status Pengajuan
            </div>

            <span class="filter-description">
                Pilih status untuk menampilkan data tertentu.
            </span>

        </div>

        <div class="filter-buttons">

            <a
                href="{{ route('admin.history') }}"
                class="filter-btn {{ $statusAktif === 'semua' ? 'active' : '' }}"
            >
                Semua
            </a>

            <a
                href="{{ route('admin.history', ['status' => 'menunggu']) }}"
                class="filter-btn {{ $statusAktif === 'menunggu' ? 'active' : '' }}"
            >
                <span class="dot yellow"></span>
                Menunggu
            </a>

            <a
                href="{{ route('admin.history', ['status' => 'disetujui']) }}"
                class="filter-btn {{ $statusAktif === 'disetujui' ? 'active' : '' }}"
            >
                <span class="dot green"></span>
                Disetujui
            </a>

            <a
                href="{{ route('admin.history', ['status' => 'ditolak']) }}"
                class="filter-btn {{ $statusAktif === 'ditolak' ? 'active' : '' }}"
            >
                <span class="dot red"></span>
                Ditolak
            </a>

            <a
                href="{{ route('admin.history', ['status' => 'dibatalkan']) }}"
                class="filter-btn {{ $statusAktif === 'dibatalkan' ? 'active' : '' }}"
            >
                <span class="dot gray"></span>
                Dibatalkan
            </a>

        </div>

    </div>


    {{-- DATA --}}
    <div class="data-card">

        <div class="card-header">

            <div>
                <div class="card-label">
                    DATA PENDAFTARAN
                </div>

                <h2>
                    Daftar Pengajuan
                </h2>

                <p>
                    Seluruh pengajuan pemakaian aula yang masuk ke sistem.
                </p>
            </div>

            <div class="total-badge">
                {{ $pendaftarans->count() }} Pengajuan
            </div>

        </div>


        <div class="table-wrapper">

            <table>

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pemohon</th>
                        <th>Unit Organisasi</th>
                        <th>Aula</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Peserta</th>
                        <th>Keperluan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>


                <tbody>

                    @forelse($pendaftarans as $index => $pendaftaran)

                        <tr class="row-{{ $pendaftaran->status }}">

                            @php
                                $asal = $pendaftaran->peserta_asal;

                                if (!$asal) {
                                    if (!$pendaftaran->unit_organisasi) {
                                        $asal = 'eksternal';
                                    } elseif (
                                        $pendaftaran->instansi &&
                                        $pendaftaran->instansi !== 'DISKOMINFO'
                                    ) {
                                        $asal = 'internal_eksternal';
                                    } else {
                                        $asal = 'internal';
                                    }
                                }
                            @endphp

                            {{-- NO --}}
                            <td>
                                <span class="number-cell">
                                    {{ $index + 1 }}
                                </span>
                            </td>


                            {{-- PEMOHON --}}
                            <td>

                                <div class="applicant">

                                    <strong>
                                        {{ $pendaftaran->nama_pemohon }}
                                    </strong>

                                    <span>
                                        NIP: {{ $pendaftaran->nip ?: '-' }}
                                    </span>

                                    <span>
                                        {{ $pendaftaran->jabatan }}
                                    </span>

                                </div>

                            </td>


                            {{-- UNIT ORGANISASI --}}
                            <td>

                                @if($pendaftaran->unit_organisasi)

                                    <span class="unit">
                                        {{ $pendaftaran->unit_organisasi }}
                                    </span>

                                    @if($pendaftaran->bagian_seksi)

                                        <small class="section">
                                            {{ $pendaftaran->bagian_seksi }}
                                        </small>

                                    @endif

                                @else

                                    <span class="unit external-unit">
                                        {{ $pendaftaran->instansi ?? 'Eksternal' }}
                                    </span>

                                    <small class="section">
                                        Pemohon Eksternal
                                    </small>

                                @endif

                            </td>


                            {{-- AULA --}}
                            <td>

                                <strong class="aula-name">
                                    {{ $pendaftaran->aula->nama_aula ?? '-' }}
                                </strong>

                                @if($pendaftaran->aula)

                                    <small class="capacity">
                                        Kapasitas:
                                        {{ $pendaftaran->aula->kapasitas }}
                                        orang
                                    </small>

                                @endif

                            </td>


                            {{-- TANGGAL --}}
                            <td>

                                <div class="date-cell">

                                    @if($pendaftaran->tanggal_mulai)

                                        <strong>
                                            {{ \Carbon\Carbon::parse($pendaftaran->tanggal_mulai)->translatedFormat('d F Y') }}
                                        </strong>

                                        <span>
                                            s/d
                                            {{ \Carbon\Carbon::parse($pendaftaran->tanggal_selesai ?? $pendaftaran->tanggal_mulai)->translatedFormat('d F Y') }}
                                        </span>

                                        <small>
                                            {{ \Carbon\Carbon::parse($pendaftaran->tanggal_mulai)->translatedFormat('l') }}
                                        </small>

                                    @else

                                        <strong>
                                            -
                                        </strong>

                                    @endif

                                </div>

                            </td>


                            {{-- WAKTU --}}
                            <td>

                                <div class="time-cell">

                                    @switch($pendaftaran->kriteria_waktu)

                                        @case('pagi_siang')
                                            <span class="time-badge pagi">
                                                Pagi
                                                (08.00 – 13.00)
                                            </span>
                                            @break

                                        @case('siang_sore')
                                            <span class="time-badge siang">
                                                Siang
                                                (14.00 – 16.00)
                                            </span>
                                            @break

                                        @case('malam')
                                            <span class="time-badge malam">
                                                Malam
                                                (18.00 – 21.00)
                                            </span>
                                            @break

                                        @case('gabungan_pagi_siang')
                                            <span class="time-badge pagi">
                                                Pagi – Siang
                                                (08.00 – 16.00)
                                            </span>
                                            @break

                                        @case('gabungan_siang_malam')
                                            <span class="time-badge siang">
                                                Siang – Malam
                                                (14.00 – 21.00)
                                            </span>
                                            @break

                                        @case('gabungan_pagi_malam')
                                            <span class="time-badge malam">
                                                Pagi – Malam
                                                (08.00 – 21.00)
                                            </span>
                                            @break

                                        @default
                                            <span class="time-badge">
                                                -
                                            </span>

                                    @endswitch

                                </div>

                            </td>


                            {{-- PESERTA --}}
                            <td>

                                <div class="participant-cell">

                                    <strong>
                                        {{ $pendaftaran->jumlah_peserta }}
                                    </strong>

                                    <small>
                                        orang
                                    </small>

                                    <span class="asal-badge">
                                        @if($asal === 'internal_eksternal')
                                            Internal & Eksternal
                                        @elseif($asal === 'eksternal')
                                            Eksternal
                                        @elseif($asal === 'internal')
                                            Internal
                                        @else
                                            -
                                        @endif
                                    </span>

                                </div>

                            </td>


                            {{-- KEPERLUAN --}}
                            <td class="purpose">

                                <div class="purpose-text">
                                    {{ $pendaftaran->keperluan }}
                                </div>

                            </td>


                            {{-- STATUS --}}
                            <td>

                                @if($pendaftaran->status === 'disetujui')

                                    <span class="badge badge-success">
                                        ✓ DISETUJUI
                                    </span>

                                @elseif($pendaftaran->status === 'ditolak')

                                    <span class="badge badge-danger">
                                        × DITOLAK
                                    </span>

                                @elseif($pendaftaran->status === 'dibatalkan')

                                    <span class="badge badge-neutral">
                                        × DIBATALKAN
                                    </span>

                                @else

                                    <span class="badge badge-warning">
                                        ⏳ MENUNGGU
                                    </span>

                                @endif

                            </td>


                            {{-- AKSI --}}
                            <td>

                                <a
                                    href="{{ route('admin.pendaftaran.show', $pendaftaran) }}"
                                    class="detail-btn"
                                >
                                    Detail
                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="10">

                                <div class="empty">

                                    <div class="empty-icon">
                                        📋
                                    </div>

                                    <h3>
                                        Tidak Ada Pengajuan
                                    </h3>

                                    <p>
                                        Belum ada pengajuan dengan status yang dipilih.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>


<style>

/* =========================
   CONTAINER
========================= */

.admin-history {
    max-width: 1250px;
    margin: 0 auto;
}


/* =========================
   HEADER
========================= */

.page-top {
    margin-bottom: 22px;
}

.back-link {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    margin-bottom: 18px;
    color: #12355b;
    text-decoration: none;
    font-size: 13px;
    font-weight: 700;
    transition: .2s ease;
}

.back-link:hover {
    color: #2563eb;
    transform: translateX(-2px);
}

.history-header {
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 18px;
    padding: 25px 28px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
}

.page-label {
    color: #2563eb;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 1.8px;
}

.page-top h1 {
    color: #12355b;
    font-size: 25px;
    margin-top: 6px;
    margin-bottom: 0;
}

.page-top p {
    color: #64748b;
    font-size: 13px;
    margin-top: 6px;
}

.history-icon {
    width: 56px;
    height: 56px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #eff6ff;
    font-size: 23px;
    flex-shrink: 0;
}


/* =========================
   FILTER
========================= */

.filter-card {
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 15px;
    padding: 18px 20px;
    margin-bottom: 20px;
}

.filter-heading {
    display: flex;
    align-items: baseline;
    gap: 10px;
    margin-bottom: 12px;
}

.filter-title {
    color: #12355b;
    font-size: 13px;
    font-weight: 800;
}

.filter-description {
    color: #94a3b8;
    font-size: 11px;
}

.filter-buttons {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.filter-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    padding: 9px 14px;
    border-radius: 8px;
    border: 1px solid #cbd5e1;
    background: white;
    color: #475569;
    font-size: 11px;
    font-weight: 700;
    text-decoration: none;
    transition: .2s ease;
}

.filter-btn:hover {
    border-color: #12355b;
    color: #12355b;
    background: #f8fafc;
}

.filter-btn.active {
    background: #12355b;
    border-color: #12355b;
    color: white;
}

.dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    display: inline-block;
}

.dot.yellow {
    background: #f59e0b;
}

.dot.green {
    background: #22c55e;
}

.dot.red {
    background: #ef4444;
}

.dot.gray {
    background: #94a3b8;
}


/* =========================
   DATA CARD
========================= */

.data-card {
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 17px;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(15,23,42,.05);
}

.card-header {
    padding: 19px 21px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    border-bottom: 1px solid #e5e7eb;
}

.card-label {
    color: #2563eb;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 1.2px;
    margin-bottom: 4px;
}

.card-header h2 {
    color: #12355b;
    font-size: 16px;
    margin: 0;
}

.card-header p {
    color: #64748b;
    font-size: 12px;
    margin-top: 4px;
}

.total-badge {
    background: #eff6ff;
    color: #12355b;
    padding: 8px 13px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 800;
    white-space: nowrap;
}


/* =========================
   TABLE
========================= */

.table-wrapper {
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    min-width: 1150px;
}

th {
    background: #12355b;
    color: white;
    padding: 13px 12px;
    text-align: left;
    font-size: 11px;
    font-weight: 700;
    white-space: nowrap;
}

td {
    padding: 14px 12px;
    border-bottom: 1px solid #e5e7eb;
    color: #334155;
    font-size: 11px;
    vertical-align: top;
    line-height: 1.5;
}

tbody tr {
    transition: background .15s ease;
}

tbody tr:hover {
    background: #f8fafc;
}

.number-cell {
    width: 28px;
    height: 28px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    background: #f1f5f9;
    color: #475569;
    font-size: 10px;
    font-weight: 700;
}


/* =========================
   PEMOHON
========================= */

.applicant strong {
    display: block;
    color: #12355b;
    font-size: 12px;
    margin-bottom: 4px;
}

.applicant span {
    display: block;
    color: #64748b;
    font-size: 10px;
    line-height: 1.5;
}


/* =========================
   UNIT
========================= */

.unit {
    display: block;
    color: #334155;
    line-height: 1.5;
    font-weight: 600;
}

.external-unit {
    color: #475569;
}

.section {
    display: block;
    color: #64748b;
    margin-top: 4px;
    line-height: 1.5;
}


/* =========================
   AULA
========================= */

.aula-name {
    display: block;
    color: #12355b;
    font-size: 12px;
}

.capacity {
    display: block;
    color: #64748b;
    margin-top: 4px;
    font-size: 10px;
}


/* =========================
   TANGGAL
========================= */

.date-cell strong {
    display: block;
    color: #12355b;
}

.date-cell span {
    display: block;
    color: #64748b;
    margin-top: 3px;
}

.date-cell small {
    display: block;
    color: #64748b;
    margin-top: 3px;
}


/* =========================
   WAKTU
========================= */

.time-cell {
    white-space: nowrap;
}

.time-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 6px 10px;
    border-radius: 20px;
    background: #f1f5f9;
    color: #475569;
    font-size: 10px;
    font-weight: 800;
}

.time-badge.pagi {
    background: #fef3c7;
    color: #92400e;
}

.time-badge.siang {
    background: #dbeafe;
    color: #1d4ed8;
}

.time-badge.sore {
    background: #ffedd5;
    color: #c2410c;
}

.time-badge.malam {
    background: #ede9fe;
    color: #6d28d9;
}


/* =========================
   PESERTA
========================= */

.participant-cell {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 2px;
}

.participant-cell strong {
    color: #12355b;
    font-size: 13px;
}

.participant-cell small {
    color: #64748b;
    font-size: 10px;
}

.asal-badge {
    display: inline-flex;
    align-items: center;
    margin-top: 4px;
    padding: 4px 8px;
    border-radius: 20px;
    background: #e0e7ff;
    color: #3730a3;
    font-size: 9px;
    font-weight: 800;
    white-space: nowrap;
}


/* =========================
   KEPERLUAN
========================= */

.purpose {
    max-width: 180px;
}

.purpose-text {
    line-height: 1.55;
    color: #475569;
}


/* =========================
   BADGE
========================= */

.badge {
    display: inline-flex;
    align-items: center;
    padding: 6px 9px;
    border-radius: 20px;
    font-size: 9px;
    font-weight: 800;
    white-space: nowrap;
}

.badge-success {
    background: #dcfce7;
    color: #15803d;
}

.badge-warning {
    background: #fef3c7;
    color: #b45309;
}

.badge-danger {
    background: #fee2e2;
    color: #b91c1c;
}

.badge-neutral {
    background: #e2e8f0;
    color: #475569;
}


/* =========================
   WARNA BARIS PER STATUS
========================= */

tbody tr.row-disetujui td {
    background: #f0fdf4;
}

tbody tr.row-menunggu td {
    background: #fefce8;
}

tbody tr.row-ditolak td {
    background: #fef2f2;
}

tbody tr.row-dibatalkan td {
    background: #f1f5f9;
}

tbody tr.row-disetujui:hover td {
    background: #dcfce7;
}

tbody tr.row-menunggu:hover td {
    background: #fef9c3;
}

tbody tr.row-ditolak:hover td {
    background: #fee2e2;
}

tbody tr.row-dibatalkan:hover td {
    background: #e2e8f0;
}

tbody tr.row-disetujui td:first-child {
    border-left: 4px solid #16a34a;
}

tbody tr.row-menunggu td:first-child {
    border-left: 4px solid #facc15;
}

tbody tr.row-ditolak td:first-child {
    border-left: 4px solid #dc2626;
}

tbody tr.row-dibatalkan td:first-child {
    border-left: 4px solid #94a3b8;
}


/* =========================
   DETAIL BUTTON
========================= */

.detail-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 7px 12px;
    border-radius: 8px;
    background: #eff6ff;
    border: 1px solid #dbeafe;
    color: #12355b;
    font-size: 10px;
    font-weight: 800;
    text-decoration: none;
    white-space: nowrap;
    transition: .2s ease;
}

.detail-btn:hover {
    background: #12355b;
    border-color: #12355b;
    color: white;
}


/* =========================
   EMPTY STATE
========================= */

.empty {
    padding: 60px 30px;
    text-align: center;
}

.empty-icon {
    width: 55px;
    height: 55px;
    margin: 0 auto 12px;
    border-radius: 15px;
    background: #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 25px;
}

.empty h3 {
    color: #12355b;
    font-size: 16px;
    margin: 0;
}

.empty p {
    color: #64748b;
    font-size: 12px;
    margin-top: 5px;
}


/* =========================
   RESPONSIVE
========================= */

@media (max-width: 768px) {

    .admin-history {
        width: 100%;
    }

    .history-header {
        padding: 22px;
        border-radius: 15px;
    }

    .page-top h1 {
        font-size: 22px;
    }

    .history-icon {
        display: none;
    }

    .filter-heading {
        display: block;
    }

    .filter-description {
        display: block;
        margin-top: 4px;
    }

    .card-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .total-badge {
        align-self: flex-start;
    }
}

@media (max-width: 480px) {

    .filter-card {
        padding: 16px;
    }

    .filter-btn {
        font-size: 10px;
        padding: 8px 10px;
    }

    .history-header {
        padding: 20px;
    }

    .page-top h1 {
        font-size: 20px;
    }
}

</style>

@endsection