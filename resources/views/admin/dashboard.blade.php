@extends('layouts.app')

@section('title', 'Dashboard Admin | SAPA')

@section('content')

<style>
    .admin-dashboard {
        max-width: 1250px;
        margin: 0 auto;
    }

    .admin-hero {
        background: linear-gradient(135deg, #0d2946, #12355b);
        border-radius: 20px;
        padding: 30px 34px;
        color: white;
        margin-bottom: 25px;
        box-shadow: 0 10px 30px rgba(15, 23, 42, .12);
    }

    .admin-hero h1 {
        margin: 0 0 8px;
        font-size: 28px;
        font-weight: 800;
    }

    .admin-hero p {
        margin: 0;
        color: #dbeafe;
        font-size: 14px;
        line-height: 1.6;
    }

    .section-title {
        margin-bottom: 15px;
    }

    .section-title h2 {
        margin: 0;
        color: #12355b;
        font-size: 18px;
        font-weight: 800;
    }

    .section-title p {
        margin: 5px 0 0;
        color: #64748b;
        font-size: 12px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
        margin-bottom: 25px;
    }

    .stat-card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 6px 20px rgba(15, 23, 42, .06);
    }

    .stat-icon {
        width: 42px;
        height: 42px;
        border-radius: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 19px;
        font-weight: 800;
        margin-bottom: 14px;
    }

    .stat-number {
        font-size: 27px;
        font-weight: 800;
        color: #172033;
    }

    .stat-label {
        margin-top: 6px;
        color: #64748b;
        font-size: 12px;
        font-weight: 600;
    }

    .stat-total .stat-icon {
        background: #eaf2fb;
        color: #12355b;
    }

    .stat-waiting .stat-icon {
        background: #fef3c7;
        color: #b45309;
    }

    .stat-approved .stat-icon {
        background: #dcfce7;
        color: #15803d;
    }

    .stat-rejected .stat-icon {
        background: #fee2e2;
        color: #dc2626;
    }

    .notif-card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 6px 20px rgba(15, 23, 42, .05);
    }

    .notif-item {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 16px 20px;
        text-decoration: none;
        border-bottom: 1px solid #f1f5f9;
        transition: background .15s ease;
    }

    .notif-item:last-child {
        border-bottom: none;
    }

    .notif-item:hover {
        background: #f8fafc;
    }

    .notif-icon {
        flex: 0 0 42px;
        width: 42px;
        height: 42px;
        border-radius: 11px;
        background: #fef3c7;
        color: #b45309;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .notif-body {
        flex: 1;
        min-width: 0;
    }

    .notif-title {
        color: #12355b;
        font-size: 14px;
        font-weight: 800;
    }

    .notif-meta {
        margin-top: 3px;
        color: #64748b;
        font-size: 12px;
        line-height: 1.5;
    }

    .notif-time {
        flex: 0 0 auto;
        color: #94a3b8;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }

    .notif-empty {
        padding: 34px 20px;
        text-align: center;
        color: #64748b;
        font-size: 13px;
        font-weight: 600;
    }

    .admin-info {
        margin-top: 20px;
        padding: 17px;
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        border-radius: 14px;
        color: #475569;
        font-size: 11px;
        line-height: 1.6;
    }

    .admin-info strong {
        color: #12355b;
    }

    @media(max-width: 950px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .notif-time {
            display: none;
        }
    }

    @media(max-width: 550px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }

        .admin-hero {
            padding: 25px;
        }

        .admin-hero h1 {
            font-size: 23px;
        }
    }
</style>

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
                ▣
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
                ◷
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
                ✓
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
                !
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
                    'pagi_siang' => 'Pagi - Siang',
                    'siang_sore' => 'Siang - Sore',
                    'malam' => 'Malam',
                ][$item->kriteria_waktu] ?? $item->kriteria_waktu;
            @endphp

            <a
                href="{{ route('admin.pendaftaran.show', $item) }}"
                class="notif-item"
            >
                <div class="notif-icon">
                    🔔
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