@extends('layouts.app')

@section('title', 'Detail Pendaftaran | SAPA')

@section('content')

<div class="detail-page">

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="page-header">

        <div class="header-left">

            <span class="page-label">
                RIWAYAT
            </span>

            <h1>
                Detail Pendaftaran
            </h1>

            <p>
                Informasi lengkap pengajuan pemakaian aula.
            </p>

        </div>

        <div class="header-actions">

            <a href="{{ route('dashboard') }}" class="back-btn">
                ← Dashboard
            </a>

            <a href="{{ route('pendaftaran.history') }}"
               class="back-btn secondary">
                ← Riwayat
            </a>

        </div>

    </div>


    {{-- =====================================================
         STATUS
    ====================================================== --}}

    <div class="status-card">

        <div class="status-icon
            @if($pendaftaran->status === 'disetujui')
                status-icon-success
            @elseif($pendaftaran->status === 'ditolak' || $pendaftaran->status === 'dibatalkan')
                status-icon-danger
            @else
                status-icon-warning
            @endif
        ">

            @if($pendaftaran->status === 'disetujui')
                ✓
            @elseif($pendaftaran->status === 'ditolak' || $pendaftaran->status === 'dibatalkan')
                ×
            @else
                !
            @endif

        </div>

        <div class="status-content">

            <span class="status-label">
                STATUS PENGAJUAN
            </span>

            @if($pendaftaran->status === 'disetujui')

                <strong class="status-success">
                    Disetujui
                </strong>

                <p>
                    Pengajuan pemakaian aula telah disetujui oleh administrator.
                </p>

            @elseif($pendaftaran->status === 'ditolak')

                <strong class="status-danger">
                    Ditolak
                </strong>

                <p>
                    Pengajuan pemakaian aula tidak disetujui oleh administrator.
                    Silakan lihat catatan administrator di bawah ini untuk mengetahui keterangannya.
                </p>

            @elseif($pendaftaran->status === 'dibatalkan')

                <strong class="status-danger">
                    Dibatalkan
                </strong>

                <p>
                    Pengajuan pemakaian aula telah dibatalkan.
                </p>

            @else

                <strong class="status-warning">
                    Menunggu Persetujuan
                </strong>

                <p>
                    Pengajuan Anda sedang menunggu pemeriksaan administrator.
                </p>

            @endif

        </div>

    </div>

     {{-- =================================================
             CATATAN ADMIN
        ================================================== --}}

        @if($pendaftaran->catatan_admin)

            <div class="admin-note">

                <div class="note-icon">
                    i
                </div>

                <div>

                    <h3>
                        Catatan Administrator
                    </h3>

                    <p>
                        {{ $pendaftaran->catatan_admin }}
                    </p>

                </div>

            </div>

        @endif


    {{-- =====================================================
         DETAIL CARD
    ====================================================== --}}

    <div class="detail-card">

        {{-- CARD HEADER --}}

        <div class="card-header">

            <div>

                <h2>
                    Informasi Pengajuan
                </h2>

                <p>
                    Data lengkap pemakaian aula yang diajukan.
                </p>

            </div>

            <span class="number-badge">
                #{{ $pendaftaran->id }}
            </span>

        </div>

        
        {{-- =================================================
             DETAIL GRID
        ================================================== --}}

        <div class="detail-grid">


            {{-- =================================================
                 INFORMASI AULA
            ================================================== --}}

            <div class="detail-section">

                <div class="section-title">

                    <div class="section-icon">
                        ▦
                    </div>

                    <div>

                        <h3>
                            Informasi Aula
                        </h3>

                        <span>
                            Data aula yang digunakan
                        </span>

                    </div>

                </div>


                <div class="info-list">

                    <div class="info-item">

                        <span>
                            Nama Aula
                        </span>

                        <strong>
                            {{ $pendaftaran->aula->nama_aula ?? '-' }}
                        </strong>

                    </div>


                    <div class="info-item">

                        <span>
                            Kapasitas Aula
                        </span>

                        <strong>
                            {{ $pendaftaran->aula->kapasitas ?? '-' }} orang
                        </strong>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 DATA PEMOHON
            ================================================== --}}

            <div class="detail-section">

                <div class="section-title">

                    <div class="section-icon">
                        ◉
                    </div>

                    <div>

                        <h3>
                            Data Pemohon
                        </h3>

                        <span>
                            Informasi pemohon
                        </span>

                    </div>

                </div>


                <div class="info-list">

                    <div class="info-item">

                        <span>
                            Nama Lengkap Pemohon
                        </span>

                        <strong>
                            {{ $pendaftaran->nama_pemohon ?? '-' }}
                        </strong>

                    </div>


                    <div class="info-item">

                        <span>
                            NIP
                        </span>

                        <strong>
                            {{ $pendaftaran->nip ?? '-' }}
                        </strong>

                    </div>


                    <div class="info-item">

                        <span>
                            Jabatan
                        </span>

                        <strong>
                            {{ $pendaftaran->jabatan ?? '-' }}
                        </strong>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 ORGANISASI
            ================================================== --}}

            <div class="detail-section">

                <div class="section-title">

                    <div class="section-icon">
                        ▤
                    </div>

                    <div>

                        <h3>
                            Organisasi
                        </h3>

                        <span>
                            Unit kerja pemohon
                        </span>

                    </div>

                </div>


                <div class="info-list">

                    <div class="info-item">

                        <span>
                            Instansi / Organisasi
                        </span>

                        <strong>
                            {{ $pendaftaran->instansi ?? '-' }}
                        </strong>

                    </div>


                    <div class="info-item">

                        <span>
                            Bidang / Unit
                        </span>

                        <strong>
                            {{ $pendaftaran->unit_organisasi ?? '-' }}
                        </strong>

                    </div>


                    <div class="info-item">

                        <span>
                            Bagian / Seksi
                        </span>

                        <strong>
                            {{ $pendaftaran->bagian_seksi ?? '-' }}
                        </strong>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 JADWAL PEMAKAIAN
            ================================================== --}}

            <div class="detail-section">

                <div class="section-title">

                    <div class="section-icon">
                        ◷
                    </div>

                    <div>

                        <h3>
                            Waktu Pemakaian
                        </h3>

                        <span>
                            Waktu penggunaan aula
                        </span>

                    </div>

                </div>


                <div class="info-list">

                    <div class="info-item">

                        <span>
                            Tanggal Mulai
                        </span>

                        <strong>
                            {{ \Carbon\Carbon::parse($pendaftaran->tanggal_mulai)
                                ->locale('id')
                                ->translatedFormat('l, d F Y') }}
                        </strong>

                    </div>


                    <div class="info-item">

                        <span>
                            Tanggal Selesai
                        </span>

                        <strong>
                            {{ \Carbon\Carbon::parse($pendaftaran->tanggal_selesai)
                                ->locale('id')
                                ->translatedFormat('l, d F Y') }}
                        </strong>

                    </div>


                    <div class="info-item">

                        <span>
                            Kriteria Waktu
                        </span>

                        <strong>

                            @php
                                $kriteriaWaktu = [
                                    'pagi_siang' => 'Pagi (08.00 – 13.00)',
                                    'siang_sore' => 'Siang (14.00 – 16.00)',
                                    'malam' => 'Malam (18.00 – 21.00)',
                                    'gabungan_pagi_siang' => 'Pagi – Siang (08.00 – 16.00)',
                                    'gabungan_siang_malam' => 'Siang – Malam (14.00 – 21.00)',
                                    'gabungan_pagi_malam' => 'Pagi – Malam (08.00 – 21.00)',
                                    // Data lama sebelum migrasi kriteria waktu
                                    'pagi' => 'Pagi (08.00 – 13.00)',
                                    'siang' => 'Siang (14.00 – 16.00)',
                                    'sore' => 'Siang (14.00 – 16.00)',
                                ];
                            @endphp

                            {{ $kriteriaWaktu[$pendaftaran->kriteria_waktu] ?? '-' }}

                        </strong>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 INFORMASI PESERTA
            ================================================== --}}

            <div class="detail-section">

                <div class="section-title">

                    <div class="section-icon">
                        ♙
                    </div>

                    <div>

                        <h3>
                            Data Peserta
                        </h3>

                        <span>
                            Jumlah dan asal peserta rapat
                        </span>

                    </div>

                </div>


                <div class="info-list">

                    <div class="info-item">

                        <span>
                            Asal Peserta
                        </span>

                        <strong>

                            @php
                                // Baris lama belum punya peserta_asal,
                                // diturunkan dari unit_organisasi/instansi
                                // sama seperti di riwayat admin.
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

                            @if($asal === 'internal')

                                Internal

                            @elseif($asal === 'eksternal')

                                Eksternal

                            @elseif($asal === 'internal_eksternal')

                                Internal & Eksternal

                            @else

                                -

                            @endif

                        </strong>

                    </div>


                    <div class="info-item">

                        <span>
                            Jumlah Peserta
                        </span>

                        <strong>
                            {{ $pendaftaran->jumlah_peserta ?? 0 }} orang
                        </strong>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 INFORMASI SISTEM
            ================================================== --}}

            <div class="detail-section">

                <div class="section-title">

                    <div class="section-icon">
                        ◫
                    </div>

                    <div>

                        <h3>
                            Informasi Sistem
                        </h3>

                        <span>
                            Informasi pencatatan sistem
                        </span>

                    </div>

                </div>


                <div class="info-list">

                    <div class="info-item">

                        <span>
                            Pengajuan Dibuat
                        </span>

                        <strong>
                            {{ $pendaftaran->created_at?->format('d/m/Y H:i') ?? '-' }}
                        </strong>

                    </div>


                    <div class="info-item">

                        <span>
                            Terakhir Diperbarui
                        </span>

                        <strong>
                            {{ $pendaftaran->updated_at?->format('d/m/Y H:i') ?? '-' }}
                        </strong>

                    </div>

                </div>

            </div>

        </div>


        {{-- =================================================
             KEPERLUAN
        ================================================== --}}

        <div class="purpose-box">

            <div class="purpose-header">

                <div class="purpose-icon">
                    ▤
                </div>

                <div>

                    <h3>
                        Keperluan Pemakaian
                    </h3>

                    <span>
                        Tujuan penggunaan aula
                    </span>

                </div>

            </div>


            <div class="purpose-content">
                {{ $pendaftaran->keperluan ?? '-' }}
            </div>

        </div>


        {{-- =================================================
             FOOTER BUTTON
        ================================================== --}}

        <div class="detail-footer">

            <a
                href="{{ route('dashboard') }}"
                class="dashboard-btn"
            >
                ← Dashboard
            </a>


            @if($pendaftaran->status === 'menunggu')

                <form
                    action="{{ route('pendaftaran.cancel', $pendaftaran) }}"
                    method="POST"
                    onsubmit="return confirm('Yakin ingin membatalkan pengajuan ini? Status akan berubah menjadi Dibatalkan dan tidak dapat diubah lagi.')"
                >
                    @csrf
                    @method('PUT')

                    <button
                        type="submit"
                        class="cancel-btn"
                    >
                        Batalkan Pengajuan
                    </button>
                </form>

            @endif

        </div>

    </div>

</div>


<style>

/* =====================================================
   DETAIL PAGE
===================================================== */

.detail-page {
    max-width: 1150px;
    margin: 0 auto;
    padding: 34px 6px 50px;
}


/* =====================================================
   HEADER
===================================================== */

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    gap: 25px;
    margin-bottom: 24px;
}

.header-left {
    flex: 1;
}

.page-label {
    display: block;
    color: #2563eb;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 2px;
    margin-bottom: 8px;
}

.page-header h1 {
    margin: 0;
    color: #12355b;
    font-size: 28px;
    font-weight: 700;
    letter-spacing: -.4px;
}

.page-header p {
    margin: 8px 0 0;
    color: #64748b;
    font-size: 13px;
}


/* =====================================================
   HEADER BUTTON
===================================================== */

.header-actions {
    display: flex;
    gap: 9px;
    flex-wrap: wrap;
}

.back-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 40px;
    padding: 0 17px;
    background: #12355b;
    color: white;
    border: 1px solid #12355b;
    border-radius: 8px;
    text-decoration: none;
    font-size: 12px;
    font-weight: 700;
    transition: .2s ease;
}

.back-btn:hover {
    background: #0e2947;
    border-color: #0e2947;
    color: white;
    transform: translateY(-1px);
}

.back-btn.secondary {
    background: white;
    color: #12355b;
    border-color: #d5dee8;
}

.back-btn.secondary:hover {
    background: #f8fafc;
    color: #12355b;
}


/* =====================================================
   STATUS CARD
===================================================== */

.status-card {
    display: flex;
    align-items: center;
    gap: 17px;
    padding: 20px 22px;
    margin-bottom: 20px;
    background: white;
    border: 1px solid #dfe6ee;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(15, 23, 42, .04);
}

.status-icon {
    width: 46px;
    height: 46px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    font-size: 21px;
    font-weight: 800;
}

.status-icon-success {
    background: #dcfce7;
    color: #15803d;
}

.status-icon-danger {
    background: #fee2e2;
    color: #dc2626;
}

.status-icon-warning {
    background: #fef3c7;
    color: #b45309;
}

.status-content {
    min-width: 0;
}

.status-label {
    display: block;
    color: #64748b;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 1.4px;
}

.status-content strong {
    display: block;
    margin-top: 5px;
    font-size: 17px;
}

.status-content p {
    margin: 5px 0 0;
    color: #64748b;
    font-size: 12px;
    line-height: 1.6;
}

.status-success {
    color: #15803d;
}

.status-warning {
    color: #b45309;
}

.status-danger {
    color: #dc2626;
}


/* =====================================================
   DETAIL CARD
===================================================== */

.detail-card {
    background: white;
    border: 1px solid #dfe6ee;
    border-radius: 13px;
    overflow: hidden;
    box-shadow: 0 7px 25px rgba(15, 23, 42, .05);
}


/* =====================================================
   CARD HEADER
===================================================== */

.card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 23px 27px;
    border-bottom: 1px solid #e8edf3;
}

.card-header h2 {
    margin: 0;
    color: #12355b;
    font-size: 20px;
    font-weight: 700;
}

.card-header p {
    margin: 6px 0 0;
    color: #64748b;
    font-size: 13px;
}

.number-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 48px;
    padding: 8px 12px;
    background: #eff6ff;
    color: #12355b;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 800;
}


/* =====================================================
   DETAIL GRID
===================================================== */

.detail-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
}


/* =====================================================
   DETAIL SECTION
===================================================== */

.detail-section {
    padding: 29px 32px;
    border-bottom: 1px solid #edf1f5;
    min-height: 210px;
}

.detail-section:nth-child(odd) {
    border-right: 1px solid #edf1f5;
}


/* =====================================================
   SECTION TITLE
===================================================== */

.section-title {
    display: flex;
    align-items: center;
    gap: 14px;
    margin-bottom: 22px;
    padding-bottom: 15px;
    border-bottom: 2px solid #eff6ff;
}

.section-icon {
    width: 38px;
    height: 38px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #eff6ff;
    color: #12355b;
    border-radius: 9px;
    font-size: 16px;
    font-weight: 700;
}

.section-title h3 {
    margin: 0;
    color: #12355b;
    font-size: 17px;
    font-weight: 700;
}

.section-title span {
    display: block;
    margin-top: 3px;
    color: #94a3b8;
    font-size: 12px;
}


/* =====================================================
   INFO ITEM
===================================================== */

.info-list {
    display: flex;
    flex-direction: column;
}

.info-item {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 35px;
    padding: 15px 0;
    border-bottom: 1px solid #f1f5f9;
}

.info-item span {
    flex: 0 0 155px;
    color: #64748b;
    font-size: 14px;
    line-height: 1.7;
    font-weight: 600;
}

.info-item:last-child {
    border-bottom: none;
}

.info-item strong {
    flex: 1;
    color: #12355b;
    font-size: 16px;
    font-weight: 700;
    text-align: right;
    line-height: 1.7;
    overflow-wrap: anywhere;
}


/* =====================================================
   PURPOSE
===================================================== */

.purpose-box {
    margin: 24px 27px;
    padding: 20px;
    background: #f8fafc;
    border: 1px solid #e1e8ef;
    border-radius: 10px;
}

.purpose-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 14px;
}

.purpose-icon {
    width: 34px;
    height: 34px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #eff6ff;
    color: #12355b;
    border-radius: 8px;
    font-size: 14px;
}

.purpose-header h3 {
    margin: 0;
    color: #12355b;
    font-size: 16px;
}

.purpose-header span {
    display: block;
    margin-top: 3px;
    color: #94a3b8;
    font-size: 12px;
}

.purpose-content {
    padding: 15px 16px;
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    color: #475569;
    font-size: 14px;
    line-height: 1.8;
    white-space: pre-line;
}


/* =====================================================
   ADMIN NOTE
===================================================== */

.admin-note {
    display: flex;
    gap: 13px;
    margin: 0 27px 22px;
    padding: 17px;
    background: #eff6ff;
    border: 1px solid #dbeafe;
    border-radius: 10px;
}

.note-icon {
    width: 31px;
    height: 31px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: #dbeafe;
    color: #2563eb;
    font-size: 14px;
    font-weight: 800;
}

.admin-note h3 {
    margin: 0 0 6px;
    color: #12355b;
    font-size: 13px;
}

.admin-note p {
    margin: 0;
    color: #475569;
    font-size: 12px;
    line-height: 1.7;
}


/* =====================================================
   FOOTER BUTTON
===================================================== */

.detail-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 10px;
    padding: 18px 27px;
    background: #f8fafc;
    border-top: 1px solid #e5eaf0;
}

.dashboard-btn,
.history-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 39px;
    padding: 0 16px;
    border-radius: 8px;
    font-size: 11px;
    font-weight: 700;
    text-decoration: none;
    transition: .2s ease;
}

.dashboard-btn {
    background: #12355b;
    border: 1px solid #12355b;
    color: white;
}

.dashboard-btn:hover {
    background: #0e2947;
    border-color: #0e2947;
    color: white;
    transform: translateY(-1px);
}

.cancel-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 39px;
    padding: 0 16px;
    border-radius: 8px;
    border: 1px solid #dc2626;
    background: #dc2626;
    color: white;
    font-family: inherit;
    font-size: 11px;
    font-weight: 700;
    cursor: pointer;
    transition: .2s ease;
}

.cancel-btn:hover {
    background: #b91c1c;
    border-color: #b91c1c;
    transform: translateY(-1px);
}

.history-btn {
    background: white;
    border: 1px solid #cbd5e1;
    color: #12355b;
}

.history-btn:hover {
    background: #12355b;
    border-color: #12355b;
    color: white;
}


/* =====================================================
   RESPONSIVE
===================================================== */

@media (max-width: 850px) {

    .page-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .header-actions {
        width: 100%;
    }

    .detail-grid {
        grid-template-columns: 1fr;
    }

    .detail-section:nth-child(odd) {
        border-right: none;
    }
}


/* =====================================================
   MOBILE
===================================================== */

@media (max-width: 600px) {

    .detail-page {
        padding: 24px 10px 40px;
    }

    .page-header h1 {
        font-size: 24px;
    }

    .header-actions {
        width: 100%;
        flex-direction: column;
    }

    .back-btn {
        width: 100%;
    }

    .status-card {
        align-items: flex-start;
    }

    .card-header {
        gap: 10px;
        padding: 20px;
    }

    .card-header h2 {
        font-size: 18px;
    }

    .detail-section {
        padding: 23px 20px;
        min-height: auto;
    }

    .section-title {
        margin-bottom: 18px;
    }

    .info-item {
        flex-direction: column;
        gap: 6px;
        padding: 13px 0;
    }

    .info-item span {
        flex: none;
        font-size: 13px;
    }

    .info-item strong {
        text-align: left;
        font-size: 15px;
    }

    .purpose-box {
        margin: 18px;
    }

    .admin-note {
        margin: 0 18px 18px;
    }

    .detail-footer {
        flex-direction: column;
        align-items: stretch;
    }

    .dashboard-btn,
    .history-btn {
        width: 100%;
    }
}

</style>

@endsection