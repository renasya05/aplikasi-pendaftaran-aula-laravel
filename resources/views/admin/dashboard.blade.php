@extends('layouts.app')

@section('title', 'Dashboard Admin | SAPA')

@section('content')


<div class="admin-dashboard">

    {{-- HERO --}}
    <section class="admin-hero">
        <h1>Dashboard Admin</h1>

        <p>
            Selamat datang di panel administrator SAPA.
            Kelola pengajuan penggunaan aula, data aula,
            dan laporan melalui halaman ini.
        </p>
    </section>

    {{-- STATISTIK --}}
    <div class="section-title">
        <h2>Ringkasan Pengajuan</h2>

        <p>
            Statistik penggunaan aula dan pengajuan pendaftaran.
        </p>
    </div>

    <div class="stats-grid">

        <div class="stat-card stat-total">
            <div class="stat-icon">
                <x-icon name="dashboard" />
            </div>

            <div class="stat-number">
                {{ $stats['totalPendaftar'] }}
            </div>

            <div class="stat-label">
                Total Pendaftaran
            </div>
        </div>

        <div class="stat-card stat-waiting">
            <div class="stat-icon">
                <x-icon name="clock" />
            </div>

            <div class="stat-number">
                {{ $stats['menunggu'] }}
            </div>

            <div class="stat-label">
                Menunggu Persetujuan
            </div>
        </div>

        <div class="stat-card stat-approved">
            <div class="stat-icon">
                <x-icon name="check" />
            </div>

            <div class="stat-number">
                {{ $stats['disetujui'] }}
            </div>

            <div class="stat-label">
                Disetujui
            </div>
        </div>

        <div class="stat-card stat-rejected">
            <div class="stat-icon">
                <x-icon name="alert" />
            </div>

            <div class="stat-number">
                {{ $stats['ditolak'] }}
            </div>

            <div class="stat-label">
                Ditolak
            </div>
        </div>

    </div>

    {{-- NOTIFIKASI PENGAJUAN BARU --}}
    <div class="section-title">
        <h2>Notifikasi Pengajuan Baru</h2>

        <p>
            Pengajuan yang baru masuk dan menunggu persetujuan.
            Klik untuk melihat detail.
        </p>
    </div>

    <div class="notif-card">

        @forelse($notifikasi as $item)

            @php
                $labelWaktu = [
                    'pagi_siang' => 'Pagi (08.00 - 13.00)',
                    'siang_sore' => 'Siang (14.00 - 16.00)',
                    'malam' => 'Malam (18.00 - 21.00)',
                    'gabungan_pagi_siang' => 'Pagi - Siang (08.00 - 16.00)',
                    'gabungan_siang_malam' => 'Siang - Malam (14.00 - 21.00)',
                    'gabungan_pagi_malam' => 'Pagi - Malam (08.00 - 21.00)',
                ][$item->kriteria_waktu] ?? $item->kriteria_waktu;
            @endphp

            <a
                href="{{ route('admin.pendaftaran.show', $item) }}"
                class="notif-item"
            >
                <div class="notif-icon">
                    <x-icon name="bell" />
                </div>

                <div class="notif-body">
                    <div class="notif-title">
                        {{ $item->nama_pemohon }}
                    </div>

                    <div class="notif-meta">
                        {{ $item->aula?->nama_aula }}
                        ·
                        {{ \Illuminate\Support\Carbon::parse($item->tanggal_mulai)->format('d M Y') }}
                        ·
                        {{ $labelWaktu }}
                    </div>
                </div>

                <div class="notif-time">
                    {{ $item->created_at->format('d/m/Y H:i') }}
                </div>
            </a>

        @empty

            <div class="notif-empty">
                Tidak ada pengajuan baru saat ini.
            </div>

        @endforelse

    </div>

    <div class="admin-info">
        <strong>Informasi:</strong>
        Pengajuan baru akan memiliki status
        <strong>Menunggu</strong> sampai diperiksa dan
        diproses oleh administrator.
    </div>

</div>

@endsection