@extends('layouts.app')

@section('title', 'Detail Pengajuan | SAPA')

@section('content')

<div class="detail-page">

    {{-- =========================================================
         HEADER
    ========================================================== --}}

    <div class="page-header">

        <div class="header-left">

            <span class="page-label">
                ADMINISTRATOR
            </span>

            <h1>
                Detail Pengajuan
            </h1>

            <p>
                Informasi lengkap pengajuan pemakaian aula.
            </p>

        </div>

        <div class="header-actions">

            <a href="{{ route('admin.dashboard') }}" class="back-btn">
                ← Dashboard Admin
            </a>

            <a href="{{ route('admin.history') }}" class="back-btn secondary">
                ← Riwayat Admin
            </a>

        </div>

    </div>


    {{-- =========================================================
         STATUS
    ========================================================== --}}

    <div class="status-card">

        <div class="status-icon
            @if($pendaftaran->status === 'disetujui')
                success
            @elseif($pendaftaran->status === 'ditolak' || $pendaftaran->status === 'dibatalkan')
                danger
            @else
                warning
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
                    Pengajuan pemakaian aula telah disetujui.
                </p>


            @elseif($pendaftaran->status === 'ditolak')

                <strong class="status-danger">
                    Ditolak
                </strong>

                <p>
                    Pengajuan pemakaian aula tidak disetujui.
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
                    Pengajuan ini menunggu pemeriksaan administrator.
                </p>

            @endif

        </div>

    </div>


    {{-- =========================================================
         DETAIL CARD
    ========================================================== --}}

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


        {{-- =====================================================
             DETAIL GRID
        ====================================================== --}}

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
                 DATA PESERTA
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

                            @if($pendaftaran->jenis_pemohon === 'internal')

                                Internal

                            @elseif($pendaftaran->jenis_pemohon === 'eksternal')

                                Eksternal

                            @elseif($pendaftaran->jenis_pemohon === 'internal_eksternal')

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


        {{-- =====================================================
             KEPERLUAN
        ====================================================== --}}

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


        {{-- =====================================================
             CATATAN ADMIN
        ====================================================== --}}

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
             AKSI ADMIN
        ====================================================== --}}

        @if($pendaftaran->status === 'menunggu')

            <div class="admin-action-card">

                <div class="action-header">

                    <div>

                        <h3>
                            Tindakan Administrator
                        </h3>

                        <p>
                            Periksa data pengajuan sebelum memberikan keputusan.
                        </p>

                    </div>

                </div>


                <div class="action-buttons">

                    {{-- SETUJUI --}}

                    <form
                        action="{{ route('admin.pendaftaran.approve', $pendaftaran) }}"
                        method="POST"
                    >

                        @csrf
                        @method('PUT')

                        <button
                            type="submit"
                            class="approve-btn"
                            onclick="return confirm('Apakah Anda yakin ingin menyetujui pengajuan ini?')"
                        >
                            ✓ Setujui Pengajuan
                        </button>

                    </form>


                    {{-- TOLAK --}}

                    <button
                        type="button"
                        class="reject-btn"
                        onclick="openRejectModal()"
                    >
                        × Tolak Pengajuan
                    </button>

                </div>

            </div>

        @endif


        {{-- =====================================================
             FOOTER
        ====================================================== --}}

        <div class="detail-footer">

            <a
                href="{{ route('admin.dashboard') }}"
                class="dashboard-btn"
            >
                ← Dashboard Admin
            </a>

            <a
                href="{{ route('admin.history') }}"
                class="history-btn"
            >
                ← Kembali ke Riwayat
            </a>

        </div>

    </div>

</div>


{{-- =========================================================
     MODAL TOLAK PENGAJUAN
========================================================= --}}

@if($pendaftaran->status === 'menunggu')

<div
    class="modal-overlay"
    id="rejectModal"
>

    <div class="reject-modal">

        <div class="modal-header">

            <div>

                <span class="modal-label">
                    ADMINISTRATOR
                </span>

                <h2>
                    Tolak Pengajuan
                </h2>

            </div>

            <button
                type="button"
                class="close-modal"
                onclick="closeRejectModal()"
            >
                ×
            </button>

        </div>


        <div class="modal-body">

            <p class="modal-description">
                Masukkan alasan atau catatan penolakan pengajuan ini.
            </p>


            <form
                action="{{ route('admin.pendaftaran.reject', $pendaftaran) }}"
                method="POST"
                id="rejectForm"
            >

                @csrf
                @method('PUT')


                <label for="catatan_admin">
                    Catatan Penolakan
                    <span>*</span>
                </label>


                <textarea
                    name="catatan_admin"
                    id="catatan_admin"
                    rows="5"
                    placeholder="Contoh: Jadwal penggunaan aula tidak tersedia pada tanggal yang diajukan."
                    required
                ></textarea>


                <div class="modal-actions">

                    <button
                        type="button"
                        class="cancel-btn"
                        onclick="closeRejectModal()"
                    >
                        Batal
                    </button>


                    <button
                        type="submit"
                        class="confirm-reject-btn"
                    >
                        Tolak Pengajuan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endif


<style>

/* =========================================================
   DETAIL PAGE
========================================================= */

.detail-page {
    max-width: 1150px;
    margin: 0 auto;
    padding: 30px 6px 50px;
}


/* =========================================================
   HEADER
========================================================= */

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    gap: 25px;
    margin-bottom: 22px;
}

.header-left {
    flex: 1;
}

.page-label {
    display: block;
    color: #2563eb;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 2px;
    margin-bottom: 7px;
}

.page-header h1 {
    margin: 0;
    color: #12355b;
    font-size: 28px;
    font-weight: 700;
}

.page-header p {
    margin: 7px 0 0;
    color: #64748b;
    font-size: 12px;
}


/* =========================================================
   HEADER BUTTON
========================================================= */

.header-actions {
    display: flex;
    gap: 9px;
    flex-wrap: wrap;
}

.back-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 38px;
    padding: 0 16px;
    background: #12355b;
    color: white;
    border: 1px solid #12355b;
    border-radius: 8px;
    text-decoration: none;
    font-size: 11px;
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


/* =========================================================
   STATUS
========================================================= */

.status-card {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 18px 20px;
    margin-bottom: 18px;
    background: white;
    border: 1px solid #dfe6ee;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(15, 23, 42, .04);
}

.status-icon {
    width: 44px;
    height: 44px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    font-size: 20px;
    font-weight: 800;
}

.status-icon.success {
    background: #dcfce7;
    color: #15803d;
}

.status-icon.warning {
    background: #fef3c7;
    color: #b45309;
}

.status-icon.danger {
    background: #fee2e2;
    color: #dc2626;
}

.status-content {
    min-width: 0;
}

.status-label {
    display: block;
    color: #64748b;
    font-size: 9px;
    font-weight: 800;
    letter-spacing: 1.4px;
}

.status-content strong {
    display: block;
    margin-top: 4px;
    font-size: 16px;
}

.status-content p {
    margin: 4px 0 0;
    color: #64748b;
    font-size: 11px;
    line-height: 1.5;
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


/* =========================================================
   DETAIL CARD
========================================================= */

.detail-card {
    background: white;
    border: 1px solid #dfe6ee;
    border-radius: 13px;
    overflow: hidden;
    box-shadow: 0 7px 25px rgba(15, 23, 42, .05);
}


/* =========================================================
   CARD HEADER
========================================================= */

.card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px 22px;
    border-bottom: 1px solid #e8edf3;
}

.card-header h2 {
    margin: 0;
    color: #12355b;
    font-size: 16px;
    font-weight: 700;
}

.card-header p {
    margin: 5px 0 0;
    color: #64748b;
    font-size: 11px;
}

.number-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 45px;
    padding: 7px 11px;
    background: #eff6ff;
    color: #12355b;
    border-radius: 20px;
    font-size: 10px;
    font-weight: 800;
}


/* =========================================================
   DETAIL GRID
========================================================= */

.detail-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
}


/* =========================================================
   DETAIL SECTION
========================================================= */

.detail-section {
    padding: 24px 26px;
    border-bottom: 1px solid #edf1f5;
}

.detail-section:nth-child(odd) {
    border-right: 1px solid #edf1f5;
}


/* =========================================================
   SECTION TITLE
========================================================= */

.section-title {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 20px;
    padding-bottom: 13px;
    border-bottom: 2px solid #eff6ff;
}

.section-icon {
    width: 34px;
    height: 34px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #eff6ff;
    color: #12355b;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 700;
}

.section-title h3 {
    margin: 0;
    color: #12355b;
    font-size: 16px;
    font-weight: 700;
}

.section-title span {
    display: block;
    margin-top: 2px;
    color: #94a3b8;
    font-size: 12px;
}


/* =========================================================
   INFO ITEM
========================================================= */

.info-list {
    display: flex;
    flex-direction: column;
}

.info-item {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 28px;
    padding: 12px 0;
    border-bottom: 1px solid #f1f5f9;
}

.info-item:last-child {
    border-bottom: none;
}

.info-item span {
    flex: 0 0 150px;
    color: #64748b;
    font-size: 14px;
    line-height: 1.6;
    font-weight: 600;
}

.info-item strong {
    flex: 1;
    color: #12355b;
    font-size: 16px;
    font-weight: 700;
    text-align: right;
    line-height: 1.6;
    overflow-wrap: anywhere;
}


/* =========================================================
   PURPOSE
========================================================= */

.purpose-box {
    margin: 20px 22px;
    padding: 17px;
    background: #f8fafc;
    border: 1px solid #e1e8ef;
    border-radius: 10px;
}

.purpose-header {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 12px;
}

.purpose-icon {
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #eff6ff;
    color: #12355b;
    border-radius: 8px;
    font-size: 13px;
}

.purpose-header h3 {
    margin: 0;
    color: #12355b;
    font-size: 12px;
}

.purpose-header span {
    display: block;
    margin-top: 2px;
    color: #94a3b8;
    font-size: 9px;
}

.purpose-content {
    padding: 12px 13px;
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    color: #475569;
    font-size: 12px;
    line-height: 1.7;
    white-space: pre-line;
}


/* =========================================================
   ADMIN NOTE
========================================================= */

.admin-note {
    display: flex;
    gap: 12px;
    margin: 0 22px 20px;
    padding: 15px;
    background: #eff6ff;
    border: 1px solid #dbeafe;
    border-radius: 10px;
}

.note-icon {
    width: 29px;
    height: 29px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: #dbeafe;
    color: #2563eb;
    font-size: 13px;
    font-weight: 800;
}

.admin-note h3 {
    margin: 0 0 5px;
    color: #12355b;
    font-size: 11px;
}

.admin-note p {
    margin: 0;
    color: #475569;
    font-size: 10px;
    line-height: 1.6;
}


/* =========================================================
   ADMIN ACTION
========================================================= */

.admin-action-card {
    margin: 0 22px 20px;
    padding: 18px;
    background: #f8fafc;
    border: 1px solid #dfe6ee;
    border-radius: 10px;
}

.action-header {
    margin-bottom: 15px;
}

.action-header h3 {
    margin: 0;
    color: #12355b;
    font-size: 14px;
}

.action-header p {
    margin: 5px 0 0;
    color: #64748b;
    font-size: 11px;
}

.action-buttons {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.action-buttons form {
    margin: 0;
}

.approve-btn,
.reject-btn {
    min-height: 38px;
    padding: 0 16px;
    border-radius: 8px;
    font-family: inherit;
    font-size: 11px;
    font-weight: 700;
    cursor: pointer;
    transition: .2s ease;
}

.approve-btn {
    background: #15803d;
    border: 1px solid #15803d;
    color: white;
}

.approve-btn:hover {
    background: #166534;
    border-color: #166534;
    transform: translateY(-1px);
}

.reject-btn {
    background: white;
    border: 1px solid #dc2626;
    color: #dc2626;
}

.reject-btn:hover {
    background: #dc2626;
    color: white;
    transform: translateY(-1px);
}


/* =========================================================
   FOOTER
========================================================= */

.detail-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 10px;
    padding: 16px 22px;
    background: #f8fafc;
    border-top: 1px solid #e5eaf0;
}

.dashboard-btn,
.history-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 36px;
    padding: 0 14px;
    border-radius: 8px;
    font-size: 10px;
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


/* =========================================================
   MODAL
========================================================= */

.modal-overlay {
    position: fixed;
    inset: 0;
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    background: rgba(15, 23, 42, .45);
    opacity: 0;
    visibility: hidden;
    transition: .2s ease;
}

.modal-overlay.show {
    opacity: 1;
    visibility: visible;
}

.reject-modal {
    width: 100%;
    max-width: 500px;
    background: white;
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(15, 23, 42, .20);
    transform: translateY(10px);
    transition: .2s ease;
}

.modal-overlay.show .reject-modal {
    transform: translateY(0);
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: 20px 22px;
    border-bottom: 1px solid #e5e7eb;
}

.modal-label {
    color: #dc2626;
    font-size: 9px;
    font-weight: 800;
    letter-spacing: 1.5px;
}

.modal-header h2 {
    margin: 5px 0 0;
    color: #12355b;
    font-size: 18px;
}

.close-modal {
    width: 32px;
    height: 32px;
    border: none;
    background: #f1f5f9;
    color: #475569;
    border-radius: 7px;
    font-size: 20px;
    cursor: pointer;
    line-height: 1;
}

.close-modal:hover {
    background: #fee2e2;
    color: #dc2626;
}

.modal-body {
    padding: 20px 22px;
}

.modal-description {
    margin: 0 0 15px;
    color: #64748b;
    font-size: 12px;
    line-height: 1.6;
}

.modal-body label {
    display: block;
    margin-bottom: 7px;
    color: #12355b;
    font-size: 12px;
    font-weight: 700;
}

.modal-body label span {
    color: #dc2626;
}

.modal-body textarea {
    width: 100%;
    min-height: 120px;
    padding: 11px 12px;
    box-sizing: border-box;
    resize: vertical;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    outline: none;
    font-family: inherit;
    font-size: 12px;
    color: #334155;
    transition: .2s ease;
}

.modal-body textarea:focus {
    border-color: #12355b;
    box-shadow: 0 0 0 3px rgba(18, 53, 91, .08);
}

.modal-actions {
    display: flex;
    justify-content: flex-end;
    gap: 8px;
    margin-top: 16px;
}

.cancel-btn,
.confirm-reject-btn {
    min-height: 36px;
    padding: 0 14px;
    border-radius: 8px;
    font-family: inherit;
    font-size: 11px;
    font-weight: 700;
    cursor: pointer;
}

.cancel-btn {
    background: white;
    border: 1px solid #cbd5e1;
    color: #475569;
}

.cancel-btn:hover {
    background: #f8fafc;
}

.confirm-reject-btn {
    background: #dc2626;
    border: 1px solid #dc2626;
    color: white;
}

.confirm-reject-btn:hover {
    background: #b91c1c;
    border-color: #b91c1c;
}


/* =========================================================
   RESPONSIVE
========================================================= */

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
    }

    .detail-section {
        padding: 20px 18px;
    }

    .info-item {
        flex-direction: column;
        gap: 6px;
        padding: 12px 0;
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
        margin: 16px;
    }

    .admin-note {
        margin: 0 16px 16px;
    }

    .admin-action-card {
        margin: 0 16px 16px;
    }

    .action-buttons {
        flex-direction: column;
    }

    .approve-btn,
    .reject-btn {
        width: 100%;
    }

    .detail-footer {
        flex-direction: column;
        align-items: stretch;
    }

    .dashboard-btn,
    .history-btn {
        width: 100%;
    }

    .modal-actions {
        flex-direction: column-reverse;
    }

    .cancel-btn,
    .confirm-reject-btn {
        width: 100%;
    }
}

</style>


<script>

function openRejectModal() {

    const modal = document.getElementById('rejectModal');

    if (modal) {

        modal.classList.add('show');

        setTimeout(function () {

            const textarea =
                document.getElementById('catatan_admin');

            if (textarea) {
                textarea.focus();
            }

        }, 100);

    }

}


function closeRejectModal() {

    const modal =
        document.getElementById('rejectModal');

    if (modal) {
        modal.classList.remove('show');
    }

}


document.addEventListener('keydown', function(event) {

    if (event.key === 'Escape') {
        closeRejectModal();
    }

});


document.addEventListener('click', function(event) {

    const modal =
        document.getElementById('rejectModal');

    if (modal && event.target === modal) {
        closeRejectModal();
    }

});

</script>

@endsection