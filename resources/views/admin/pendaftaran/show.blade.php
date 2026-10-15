@extends('layouts.app')

@section('title', 'Detail Pengajuan | SAPA')

@section('content')

<div class="detail-page">

    {{-- =========================================================
         HEADER
    ========================================================== --}}

    <div class="page-header">

        <div class="header-left">

            <h1>
                Detail Pengajuan
            </h1>

            <p>
                Informasi lengkap pengajuan pemakaian aula.
            </p>

        </div>

        <div class="header-actions">

            <a href="{{ route('admin.dashboard') }}" class="back-btn">
                <x-icon name="arrow-left" size="16" />
                Dashboard Admin
            </a>

            <a href="{{ route('admin.pendaftaran.index') }}" class="back-btn secondary">
                <x-icon name="arrow-left" size="16" />
                Riwayat Admin
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
                <x-icon name="check" />
            @elseif($pendaftaran->status === 'ditolak' || $pendaftaran->status === 'dibatalkan')
                <x-icon name="x" />
            @else
                <x-icon name="clock" />
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
                        <x-icon name="building" />
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
                        <x-icon name="user" />
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
                        <x-icon name="briefcase" />
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
                        <x-icon name="clock" />
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
                        <x-icon name="users" />
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
                        <x-icon name="info" />
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
                    <x-icon name="checklist" />
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
                    <x-icon name="info" size="18" />
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
                            <x-icon name="check" size="17" />
                            Setujui Pengajuan
                        </button>

                    </form>


                    {{-- TOLAK --}}

                    <button
                        type="button"
                        class="reject-btn"
                        onclick="openRejectModal()"
                    >
                        <x-icon name="x" size="17" />
                        Tolak Pengajuan
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
                <x-icon name="arrow-left" size="16" />
                Dashboard Admin
            </a>

            <a
                href="{{ route('admin.pendaftaran.index') }}"
                class="history-btn"
            >
                <x-icon name="arrow-left" size="16" />
                Kembali ke Riwayat
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

                <h2>
                    Tolak Pengajuan
                </h2>

            </div>

            <button
                type="button"
                class="close-modal"
                onclick="closeRejectModal()"
                aria-label="Tutup"
            >
                <x-icon name="x" size="18" />
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
                    maxlength="1000"
                    placeholder="Contoh: Jadwal penggunaan aula tidak tersedia pada tanggal yang diajukan."
                    required
                >{{ old('catatan_admin') }}</textarea>

                @error('catatan_admin')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror


                <div class="modal-actions">

                    <button
                        type="button"
                        class="btn btn-secondary"
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

@if ($errors->has('catatan_admin'))
    <script>
        // Validasi gagal: modal penolakan langsung dibuka lagi
        // supaya pesan error dan isi textarea kelihatan.
        document.addEventListener('DOMContentLoaded', function () {
            openRejectModal();
        });
    </script>
@endif

</div>

@endif




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