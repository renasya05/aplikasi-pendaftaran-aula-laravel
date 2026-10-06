@extends('layouts.app')

@section('title', 'Data Aula | SAPA')

@section('content')

<style>
    /* =====================================================
       PAGE
    ===================================================== */

    .admin-aula-page {
        max-width: 1250px;
        margin: 0 auto;
    }


    /* =====================================================
       HEADER
    ===================================================== */

    .admin-aula-header {
        background: linear-gradient(135deg, #12355b, #1d4f7a);
        border-radius: 16px;
        padding: 28px 30px;
        margin-bottom: 22px;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .admin-aula-header::after {
        content: "";
        position: absolute;
        width: 190px;
        height: 190px;
        border-radius: 50%;
        border: 35px solid rgba(255,255,255,0.05);
        right: -55px;
        top: -80px;
    }

    .header-content {
        position: relative;
        z-index: 1;
    }

    .page-label {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 8px;
        color: #bfdbfe;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1.5px;
        text-transform: uppercase;
    }

    .admin-aula-header h1 {
        margin: 0 0 7px;
        color: #ffffff;
        font-size: 27px;
        font-weight: 750;
        letter-spacing: -0.3px;
    }

    .admin-aula-header p {
        margin: 0;
        max-width: 700px;
        color: #dbeafe;
        font-size: 13px;
        line-height: 1.6;
    }


    /* =====================================================
       HEADER ACTION
    ===================================================== */

    .header-action {
        position: absolute;
        right: 30px;
        bottom: 28px;
        z-index: 2;
    }

    .add-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        min-height: 42px;
        padding: 10px 17px;
        background: #ffffff;
        color: #12355b;
        border-radius: 9px;
        text-decoration: none;
        font-size: 12px;
        font-weight: 750;
        transition: 0.2s ease;
    }

    .add-btn:hover {
        background: #eff6ff;
        color: #12355b;
        transform: translateY(-1px);
    }


    /* =====================================================
       SUMMARY
    ===================================================== */

    .summary-card {
        display: flex;
        align-items: center;
        gap: 13px;
        width: fit-content;
        margin-bottom: 22px;
        padding: 14px 17px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(15,23,42,0.04);
    }

    .summary-icon {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eff6ff;
        color: #12355b;
        border-radius: 10px;
        font-size: 18px;
    }

    .summary-card span {
        display: block;
        margin-bottom: 2px;
        color: #64748b;
        font-size: 10px;
    }

    .summary-card strong {
        color: #12355b;
        font-size: 20px;
        font-weight: 800;
    }


    /* =====================================================
       DATA CARD
    ===================================================== */

    .data-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 15px;
        overflow: hidden;
        box-shadow:
            0 5px 18px rgba(15,23,42,0.05);
    }


    .card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 20px 22px;
        border-bottom: 1px solid #e2e8f0;
    }

    .card-header h2 {
        margin: 0;
        color: #12355b;
        font-size: 18px;
        font-weight: 750;
    }

    .card-header p {
        margin: 4px 0 0;
        color: #64748b;
        font-size: 12px;
    }

    .total-badge {
        display: inline-flex;
        align-items: center;
        padding: 7px 11px;
        background: #eff6ff;
        border-radius: 999px;
        color: #12355b;
        font-size: 10px;
        font-weight: 750;
        white-space: nowrap;
    }


    /* =====================================================
       TABLE
    ===================================================== */

    .table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    table {
        width: 100%;
        min-width: 980px;
        border-collapse: collapse;
    }

    th {
        padding: 13px 12px;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        color: #475569;
        text-align: left;
        font-size: 11px;
        font-weight: 750;
        white-space: nowrap;
    }

    td {
        padding: 14px 12px;
        border-bottom: 1px solid #f1f5f9;
        color: #334155;
        font-size: 12px;
        vertical-align: top;
        line-height: 1.5;
    }

    tbody tr {
        transition: background 0.15s ease;
    }

    tbody tr:hover {
        background: #f8fafc;
    }


    /* =====================================================
       TABLE CONTENT
    ===================================================== */

    .number-cell {
        width: 45px;
        color: #64748b;
        text-align: center;
        font-weight: 700;
    }

    .aula-name {
        display: block;
        color: #12355b;
        font-size: 13px;
        font-weight: 750;
    }

    .capacity {
        color: #334155;
        font-weight: 700;
        white-space: nowrap;
    }

    .capacity small {
        color: #64748b;
        font-size: 10px;
        font-weight: 500;
    }

    .description-cell {
        max-width: 270px;
        color: #64748b;
        line-height: 1.6;
    }

    .facility-cell {
        max-width: 240px;
        color: #64748b;
        line-height: 1.6;
    }

    .empty-value {
        color: #94a3b8;
    }


    /* =====================================================
       ACTION BUTTONS
    ===================================================== */

    .action-buttons {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .action-buttons form {
        margin: 0;
    }

    .action-buttons a,
    .action-buttons button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 34px;
        padding: 7px 10px;
        border: none;
        border-radius: 7px;
        font-family: inherit;
        font-size: 10px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        white-space: nowrap;
        transition: 0.2s ease;
    }

    .action-detail {
        background: #12355b;
        color: #ffffff;
    }

    .action-detail:hover {
        background: #2563eb;
        color: #ffffff;
        transform: translateY(-1px);
    }

    .action-edit {
        background: #eff6ff;
        color: #12355b;
    }

    .action-edit:hover {
        background: #dbeafe;
        color: #12355b;
    }

    .action-delete {
        background: #fef2f2;
        color: #dc2626;
    }

    .action-delete:hover {
        background: #fee2e2;
        color: #b91c1c;
    }


    /* =====================================================
       EMPTY STATE
    ===================================================== */

    .empty {
        padding: 65px 20px;
        text-align: center;
    }

    .empty-icon {
        width: 62px;
        height: 62px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        background: #eff6ff;
        border-radius: 15px;
        font-size: 28px;
    }

    .empty h3 {
        margin: 0 0 7px;
        color: #12355b;
        font-size: 17px;
        font-weight: 750;
    }

    .empty p {
        margin: 0;
        color: #64748b;
        font-size: 12px;
    }


    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media (max-width: 850px) {

        .admin-aula-header {
            padding: 24px;
        }

        .header-action {
            position: static;
            margin-top: 18px;
        }

        .add-btn {
            width: 100%;
        }

    }

    @media (max-width: 600px) {

        .admin-aula-page {
            padding: 0;
        }

        .admin-aula-header {
            border-radius: 13px;
            padding: 21px;
        }

        .admin-aula-header h1 {
            font-size: 23px;
        }

        .admin-aula-header p {
            font-size: 12px;
        }

        .summary-card {
            width: 100%;
            box-sizing: border-box;
        }

        .card-header {
            align-items: flex-start;
            flex-direction: column;
        }

    }
</style>


<div class="admin-aula-page">

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="admin-aula-header">

        <div class="header-content">

            <div class="page-label">
                <span>▣</span>
                ADMINISTRATOR
            </div>

            <h1>
                Data Aula
            </h1>

            <p>
                Kelola informasi aula yang tersedia untuk pemakaian
                dan pastikan data aula selalu diperbarui.
            </p>

        </div>


        <div class="header-action">

            <a
                href="{{ route('admin.aulas.create') }}"
                class="add-btn"
            >
                <span>＋</span>
                Tambah Aula
            </a>

        </div>

    </div>


    {{-- =====================================================
         SUMMARY
    ====================================================== --}}

    <div class="summary-card">

        <div class="summary-icon">
            ▦
        </div>

        <div>

            <span>
                Total Aula
            </span>

            <strong>
                {{ $aulas->count() }}
            </strong>

        </div>

    </div>


    {{-- =====================================================
         DATA CARD
    ====================================================== --}}

    <div class="data-card">

        <div class="card-header">

            <div>

                <h2>
                    Daftar Aula
                </h2>

                <p>
                    Informasi aula yang tersedia dalam sistem SAPA.
                </p>

            </div>

            <div class="total-badge">
                {{ $aulas->count() }} Aula
            </div>

        </div>


        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th style="width: 50px;">
                            No
                        </th>
                        <th>Nama Aula</th>
                        <th>Kapasitas</th>
                        <th>Keterangan</th>
                        <th>Fasilitas</th>
                        <th>Aksi</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($aulas as $index => $aula)

                        <tr>

                            {{-- NOMOR --}}
                            <td class="number-cell">
                                {{ $index + 1 }}
                            </td>


                            {{-- NAMA AULA --}}
                            <td>

                                <strong class="aula-name">
                                    {{ $aula->nama_aula }}
                                </strong>

                            </td>


                            {{-- KAPASITAS --}}
                            <td>

                                <span class="capacity">
                                    {{ $aula->kapasitas }}
                                    <small>orang</small>
                                </span>

                            </td>


                            {{-- KETERANGAN --}}
                            <td class="description-cell">

                                {{ $aula->keterangan }}

                            </td>


                            {{-- FASILITAS --}}
                            <td class="facility-cell">

                                @if($aula->fasilitas)

                                    {{ $aula->fasilitas }}

                                @else

                                    <span class="empty-value">
                                        Belum diisi
                                    </span>

                                @endif

                            </td>


                            {{-- AKSI --}}
                            <td>

                                <div class="action-buttons">

                                    <a
                                        href="{{ route('admin.aulas.show', $aula) }}"
                                        class="action-detail"
                                    >
                                        Detail
                                    </a>


                                    <a
                                        href="{{ route('admin.aulas.edit', $aula) }}"
                                        class="action-edit"
                                    >
                                        Edit
                                    </a>


                                    <form
                                        action="{{ route('admin.aulas.destroy', $aula) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus aula ini?')"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="action-delete"
                                        >
                                            Hapus
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6">

                                <div class="empty">

                                    <div class="empty-icon">
                                        🏢
                                    </div>

                                    <h3>
                                        Belum Ada Data Aula
                                    </h3>

                                    <p>
                                        Silakan tambahkan data aula baru
                                        melalui tombol Tambah Aula.
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

@endsection