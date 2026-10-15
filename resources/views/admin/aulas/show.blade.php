<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Detail Aula | SAPA</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f6f9;
            color: #1f2937;
        }

        /* =========================
           SIDEBAR
        ========================= */

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 240px;
            height: 100vh;
            background: #193b63;
            color: white;
            padding: 28px 15px;
        }

        .logo {
            text-align: center;
            margin-bottom: 35px;
        }

        .logo h1 {
            font-size: 25px;
            margin-bottom: 8px;
        }

        .logo p {
            font-size: 11px;
            line-height: 1.5;
            color: #dbe7f3;
        }

        .menu {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .menu a {
            text-decoration: none;
            color: white;
            padding: 13px 15px;
            border-radius: 6px;
            font-size: 14px;
        }

        .menu a:hover {
            background: #28598a;
        }

        .menu a.active {
            background: #28598a;
            font-weight: bold;
        }

        /* =========================
           MAIN
        ========================= */

        .main {
            margin-left: 240px;
            min-height: 100vh;
        }

        .topbar {
            height: 72px;
            background: white;
            border-bottom: 1px solid #dfe4ea;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 30px;
        }

        .topbar h2 {
            color: #12355b;
            font-size: 20px;
        }

        .admin-area {
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 13px;
            font-weight: bold;
        }

        .logout {
            background: #dc3545;
            color: white;
            border: none;
            padding: 9px 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        .logout:hover {
            background: #bb2d3b;
        }

        /* =========================
           CONTENT
        ========================= */

        .content {
            padding: 30px;
            max-width: 1000px;
        }

        .back {
            display: inline-block;
            margin-bottom: 20px;
            color: #12355b;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
        }

        .back:hover {
            color: #0d2946;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .page-title h1 {
            color: #12355b;
            font-size: 26px;
            margin-bottom: 7px;
        }

        .page-title p {
            color: #6b7280;
            font-size: 14px;
        }

        /* =========================
           CARD
        ========================= */

        .card {
            background: white;
            border: 1px solid #dfe4ea;
            border-radius: 8px;
            margin-bottom: 25px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .card-title {
            padding: 18px 22px;
            background: #f8fafc;
            border-bottom: 1px solid #e5e7eb;
            color: #12355b;
            font-size: 16px;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-body {
            padding: 22px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .item {
            border-bottom: 1px solid #edf0f2;
            padding-bottom: 12px;
        }

        .item.full {
            grid-column: 1 / -1;
        }

        .label {
            display: block;
            color: #6b7280;
            font-size: 11px;
            margin-bottom: 6px;
            text-transform: uppercase;
            font-weight: bold;
        }

        .value {
            color: #1f2937;
            font-size: 15px;
            font-weight: 600;
        }

        .value.desc {
            font-weight: normal;
            line-height: 1.6;
        }

        /* =========================
           BUTTONS
        ========================= */

        .btn {
            display: inline-block;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            padding: 9px 15px;
            font-size: 12px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-edit {
            background: #12355b;
            color: white;
        }

        .btn-edit:hover {
            background: #0d2946;
        }

        .btn-hapus {
            background: #fef2f2;
            color: #b91c1c;
        }

        .btn-hapus:hover {
            background: #fee2e2;
        }

        .btn-detail {
            background: #12355b;
            color: white;
            font-size: 11px;
            padding: 7px 11px;
        }

        .btn-detail:hover {
            background: #0d2946;
        }

        .header-actions {
            display: flex;
            gap: 10px;
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
            min-width: 700px;
        }

        thead {
            background: #12355b;
            color: white;
        }

        th {
            padding: 12px 14px;
            text-align: left;
            font-size: 12px;
        }

        td {
            padding: 13px 14px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 13px;
            vertical-align: middle;
        }

        tbody tr:hover {
            background: #f8fafc;
        }

        .status {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .menunggu {
            background: #fff7ed;
            color: #c2410c;
        }

        .disetujui {
            background: #ecfdf5;
            color: #047857;
        }

        .ditolak {
            background: #fef2f2;
            color: #b91c1c;
        }

        .empty {
            padding: 40px 20px;
            text-align: center;
            color: #6b7280;
            font-size: 13px;
        }

        @media (max-width: 800px) {
            .sidebar {
                width: 190px;
            }
            .main {
                margin-left: 190px;
            }
            .grid {
                grid-template-columns: 1fr;
            }
            .content {
                padding: 20px;
            }
            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
        }

    </style>

</head>

<body>

<!-- SIDEBAR -->
<aside class="sidebar">

    <div class="logo">
        <h1>SAPA</h1>
        <p>Sistem Aplikasi untuk Layanan Akomodasi (Aula)</p>
    </div>

    <nav class="menu">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.history') }}">Riwayat Pendaftaran</a>
        <a href="{{ route('admin.aulas') }}" class="active">Data Aula</a>
    </nav>

</aside>

<!-- MAIN -->
<main class="main">

    <div class="topbar">
        <h2>Data Aula</h2>

        <div class="admin-area">
            <span>{{ auth()->user()->name }}</span>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout">Logout</button>
            </form>
        </div>
    </div>

    <div class="content">

        <a href="{{ route('admin.aulas') }}" class="back">
            ← Kembali ke Data Aula
        </a>

        <div class="page-header">
            <div class="page-title">
                <h1>{{ $aula->nama_aula }}</h1>
                <p>Informasi detail fasilitas, kapasitas, dan status peminjaman aula.</p>
            </div>

            <div class="header-actions">
                <a href="{{ route('admin.aulas.edit', $aula->id) }}" class="btn btn-edit">
                    EDIT AULA
                </a>

                <form
                    action="{{ route('admin.aulas.destroy', $aula->id) }}"
                    method="POST"
                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus aula ini?')"
                >
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-hapus">
                        HAPUS
                    </button>
                </form>
            </div>
        </div>

        <!-- DETAIL INFORMASI AULA -->
        <div class="card">
            <div class="card-title">
                <span>Informasi Aula</span>
                <span style="font-size:12px; color:#6b7280; font-weight:normal;">
                    ID Aula: #{{ $aula->id }}
                </span>
            </div>

            <div class="card-body">
                <div class="grid">
                    <div class="item">
                        <span class="label">Nama Aula</span>
                        <div class="value">{{ $aula->nama_aula }}</div>
                    </div>

                    <div class="item">
                        <span class="label">Kapasitas Maksimal</span>
                        <div class="value">{{ $aula->kapasitas }} Orang</div>
                    </div>

                    <div class="item full">
                        <span class="label">Keterangan / Lokasi</span>
                        <div class="value desc">{{ $aula->keterangan }}</div>
                    </div>

                    <div class="item full">
                        <span class="label">Fasilitas</span>
                        <div class="value desc">
                            {{ $aula->fasilitas ?? 'Belum ada catatan fasilitas khusus.' }}
                        </div>
                    </div>

                    <div class="item">
                        <span class="label">Tanggal Dibuat</span>
                        <div class="value desc">
                            {{ $aula->created_at ? $aula->created_at->format('d F Y, H:i') : '-' }}
                        </div>
                    </div>

                    <div class="item">
                        <span class="label">Terakhir Diperbarui</span>
                        <div class="value desc">
                            {{ $aula->updated_at ? $aula->updated_at->format('d F Y, H:i') : '-' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- DAFTAR PENDAFTARAN PADA AULA INI -->
        <div class="card">
            <div class="card-title">
                <span>Riwayat Pengajuan Peminjaman pada Aula Ini</span>
                <span style="font-size:12px; color:#6b7280; font-weight:normal;">
                    {{ $aula->pendaftarans->count() }} pengajuan
                </span>
            </div>

            @if($aula->pendaftarans->count() > 0)
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pemohon</th>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Peserta</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($aula->pendaftarans as $index => $pendaftaran)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <strong>{{ $pendaftaran->nama_pemohon }}</strong>
                                        <div style="font-size:11px; color:#6b7280;">{{ $pendaftaran->jabatan }}</div>
                                    </td>
                                   <td>
                                        @if ($pendaftaran->tanggal_mulai && $pendaftaran->tanggal_selesai)

                                            @if ($pendaftaran->tanggal_mulai == $pendaftaran->tanggal_selesai)

                                                {{ \Carbon\Carbon::parse($pendaftaran->tanggal_mulai)
                                                    ->locale('id')
                                                    ->translatedFormat('d-m-Y') }}

                                            @else

                                                {{ \Carbon\Carbon::parse($pendaftaran->tanggal_mulai)
                                                    ->locale('id')
                                                    ->translatedFormat('d-m-Y') }}
                                                –
                                                {{ \Carbon\Carbon::parse($pendaftaran->tanggal_selesai)
                                                    ->locale('id')
                                                    ->translatedFormat('d-m-Y') }}

                                            @endif

                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            // Kolom jam_mulai/jam_selesai sudah
                                            // dihapus; waktu ada di kriteria_waktu.
                                            $jam = [
                                                'pagi_siang' => '08.00 - 13.00',
                                                'siang_sore' => '14.00 - 16.00',
                                                'malam' => '18.00 - 21.00',
                                                'gabungan_pagi_siang' => '08.00 - 16.00',
                                                'gabungan_siang_malam' => '14.00 - 21.00',
                                                'gabungan_pagi_malam' => '08.00 - 21.00',
                                            ][$pendaftaran->kriteria_waktu] ?? '-';
                                        @endphp
                                        {{ $jam }}
                                    </td>
                                    <td>{{ $pendaftaran->jumlah_peserta }} orang</td>
                                    <td>
                                        <span class="status {{ $pendaftaran->status }}">
                                            {{ ucfirst($pendaftaran->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.pendaftaran.show', $pendaftaran->id) }}" class="btn btn-detail">
                                            DETAIL
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty">
                    Belum ada riwayat pengajuan peminjaman untuk aula ini.
                </div>
            @endif
        </div>

    </div>

</main>

</body>
</html>
