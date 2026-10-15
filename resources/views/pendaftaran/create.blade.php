<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pendaftaran Aula | SAPA</title>

   <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html {
        scroll-behavior: smooth;
    }

    body {
        font-family: Arial, Helvetica, sans-serif;
        background: #12355b;
        color: #1f2937;
        min-height: 100vh;
        line-height: 1.6;
        padding-bottom: 45px;
    }

    /* =========================
       HEADER
    ========================== */

    .header {
        background: transparent;
        color: white;
        padding: 30px 5% 20px;
    }

    .header-inner {
        width: 94%;
        max-width: 1240px;
        margin: auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 25px;
    }

    .header-brand {
        display: flex;
        flex-direction: column;
    }

    .header h1 {
        font-size: 32px;
        margin-bottom: 3px;
        font-weight: 800;
        letter-spacing: 0.5px;
    }

    .header p {
        font-size: 17px;
        opacity: 0.92;
    }

    /* =========================
       CONTAINER
    ========================== */

    .container {
        width: 94%;
        max-width: 1240px;
        margin: 8px auto 0;
    }

    .card {
        background: #ffffff;
        border-radius: 18px;
        padding: 38px 42px 42px;
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.18);
    }

    /* =========================
       TOMBOL KEMBALI
    ========================== */

    .top-action {
        margin-bottom: 24px;
    }

    .btn-back-top {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        min-height: 42px;
        padding: 9px 16px;
        background: #e8edf3;
        color: #334155;
        border: 1px solid #d5dde7;
        border-radius: 8px;
        text-decoration: none;
        font-size: 15px;
        font-weight: 700;
        transition: all 0.2s ease;
    }

    .btn-back-top:hover {
        background: #dce4ed;
        color: #12355b;
        transform: translateY(-1px);
    }

    /* =========================
       INFO AULA
    ========================== */

    .aula-info {
        background: #f1f6fa;
        border: 1px solid #d9e4ee;
        border-left: 6px solid #12355b;
        padding: 21px 23px;
        border-radius: 10px;
        margin-bottom: 34px;
    }

    .aula-info .label {
        display: block;
        color: #64748b;
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .aula-info h2 {
        color: #12355b;
        font-size: 25px;
        font-weight: 800;
    }

    /* =========================
       ALERT
    ========================== */

    .alert {
        padding: 16px 18px;
        border-radius: 10px;
        margin-bottom: 26px;
        font-size: 16px;
    }

    .alert-danger {
        background: #fee2e2;
        border: 1px solid #fecaca;
        color: #991b1b;
    }

    .alert-danger strong {
        display: block;
        margin-bottom: 6px;
    }

    .alert-danger ul {
        padding-left: 22px;
    }

    /* =========================
       SECTION
    ========================== */

    .section {
        margin-bottom: 36px;
        padding-bottom: 34px;
        border-bottom: 1px solid #e2e8f0;
    }

    .section:last-of-type {
        border-bottom: none;
        margin-bottom: 5px;
    }

    .section-title {
        color: #12355b;
        font-size: 22px;
        font-weight: 800;
        margin-bottom: 23px;
        padding-left: 13px;
        border-left: 5px solid #12355b;
        line-height: 1.35;
        text-transform: uppercase;
    }

    /* =========================
       FORM
    ========================== */

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 23px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group.full {
        grid-column: 1 / -1;
    }

    label {
        font-size: 17px;
        font-weight: 700;
        margin-bottom: 9px;
        color: #334155;
    }

    .required {
        color: #dc2626;
        margin-left: 2px;
    }

    input,
    select,
    textarea {
        width: 100%;
        padding: 14px 16px;
        border: 1px solid #cbd5e1;
        border-radius: 9px;
        font-size: 17px;
        font-family: inherit;
        background: #ffffff;
        color: #1f2937;
        outline: none;
        transition: all 0.2s ease;
    }

    input,
    select {
        min-height: 52px;
    }

    input::placeholder,
    textarea::placeholder {
        color: #94a3b8;
    }

    input:hover,
    select:hover,
    textarea:hover {
        border-color: #94a3b8;
    }

    input:focus,
    select:focus,
    textarea:focus {
        border-color: #12355b;
        box-shadow: 0 0 0 3px rgba(18, 53, 91, 0.11);
    }

    textarea {
        min-height: 145px;
        resize: vertical;
        line-height: 1.6;
    }

    .hint {
        margin-top: 7px;
        font-size: 14px;
        color: #64748b;
        line-height: 1.5;
    }

    .hidden {
        display: none !important;
    }

    /* =========================
       PESERTA RAPAT
    ========================== */

    .radio-group {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
    }

    .radio-card {
        position: relative;
    }

    .radio-card input {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .radio-label {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 62px;
        padding: 14px 16px;
        text-align: center;
        border: 1px solid #cbd5e1;
        border-radius: 10px;
        cursor: pointer;
        background: #ffffff;
        color: #334155;
        font-size: 16px;
        font-weight: 700;
        transition: all 0.2s ease;
        margin: 0;
    }

    .radio-label:hover {
        border-color: #12355b;
        background: #f5f8fb;
    }

    .radio-card input:checked + .radio-label {
        border: 2px solid #12355b;
        background: #eef4f8;
        color: #12355b;
        box-shadow: 0 3px 10px rgba(18, 53, 91, 0.08);
    }

    /* =========================
       HARI
    ========================== */

    .hari-display {
        margin-top: 8px;
        padding: 9px 13px;
        min-height: 40px;
        background: #eef4f8;
        border-left: 4px solid #12355b;
        border-radius: 6px;
        color: #12355b;
        font-size: 15px;
        font-weight: 700;
    }

    .hari-display.empty {
        color: #64748b;
        font-weight: 400;
    }

    /* =========================
       WAKTU
    ========================== */

    .waktu-container {
        margin-top: 25px;
    }

    .waktu-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 17px;
        margin-top: 13px;
    }

    .waktu-card {
        position: relative;
    }

    .waktu-card input {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .waktu-label {
        min-height: 132px;
        padding: 20px;
        border: 1px solid #cbd5e1;
        border-radius: 11px;
        background: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 14px;
        cursor: pointer;
        transition: all 0.2s ease;
        margin: 0;
    }

    .waktu-label:hover {
        border-color: #12355b;
        background: #f7f9fb;
        transform: translateY(-1px);
    }

    .waktu-icon {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eef4f8;
        border-radius: 50%;
        font-size: 23px;
        flex-shrink: 0;
    }

    .waktu-content {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .waktu-content strong {
        color: #12355b;
        font-size: 17px;
    }

    .waktu-content span {
        color: #475569;
        font-size: 15px;
    }

    .waktu-card input:checked + .waktu-label {
        border: 2px solid #12355b;
        background: #eef4f8;
        box-shadow: 0 4px 12px rgba(18, 53, 91, 0.08);
    }

    .waktu-card input:checked + .waktu-label .waktu-icon {
        background: #dbe7f2;
    }

    /* =========================
       WAKTU SUDAH DIGUNAKAN
    ========================== */

    .waktu-card.disabled .waktu-label {
        background: #e5e7eb;
        border-color: #d1d5db;
        cursor: not-allowed;
        opacity: 0.65;
        transform: none;
    }

    .waktu-card.disabled .waktu-icon {
        background: #d1d5db;
    }

    .waktu-card.disabled .waktu-content strong,
    .waktu-card.disabled .waktu-content span {
        color: #9ca3af;
    }

    .waktu-card.disabled::after {
        content: "Sudah digunakan";
        position: absolute;
        right: 10px;
        top: 10px;
        background: #d1d5db;
        color: #6b7280;
        padding: 5px 8px;
        border-radius: 5px;
        font-size: 12px;
        font-weight: 700;
    }

    /* =========================
       BUTTON SUBMIT
    ========================== */

    .button-area {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        margin-top: 28px;
        padding-top: 25px;
        border-top: 1px solid #e2e8f0;
    }

    .btn-submit {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 52px;
        padding: 13px 28px;
        border: none;
        border-radius: 9px;
        background: #12355b;
        color: #ffffff;
        font-size: 17px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 4px 10px rgba(18, 53, 91, 0.18);
    }

    .btn-submit:hover {
        background: #0d2947;
        transform: translateY(-1px);
        box-shadow: 0 6px 14px rgba(18, 53, 91, 0.23);
    }

    .btn-submit:active {
        transform: translateY(0);
    }

    /* =========================
       RESPONSIVE
    ========================== */

    @media (max-width: 900px) {

        .form-grid {
            grid-template-columns: 1fr;
        }

        .radio-group,
        .waktu-grid {
            grid-template-columns: 1fr;
        }

        .card {
            padding: 30px;
        }

        .header-inner {
            width: 94%;
        }
    }

    @media (max-width: 600px) {

        body {
            padding-bottom: 25px;
        }

        .header {
            padding: 22px 4% 17px;
        }

        .header-inner {
            width: 100%;
            align-items: flex-start;
        }

        .header h1 {
            font-size: 27px;
        }

        .header p {
            font-size: 15px;
        }

        .container {
            width: 94%;
            margin-top: 5px;
        }

        .card {
            padding: 22px 18px 28px;
            border-radius: 13px;
        }

        .aula-info {
            padding: 17px 18px;
        }

        .aula-info h2 {
            font-size: 21px;
        }

        .section-title {
            font-size: 20px;
        }

        label {
            font-size: 16px;
        }

        input,
        select,
        textarea {
            font-size: 16px;
        }

        .btn-back-top {
            min-height: 40px;
            padding: 8px 14px;
            font-size: 14px;
        }

        .button-area {
            justify-content: stretch;
        }

        .btn-submit {
            width: 100%;
        }

        .waktu-label {
            min-height: 110px;
        }
    }
</style>

<body>

    {{-- ==========================================================
        HEADER
    =========================================================== --}}

    <header class="header">

        <div class="header-inner">

            <h1>SAPA</h1>

            <p>
                Sistem Aplikasi untuk Layanan Akomodasi (Aula)
            </p>

        </div>

    </header>


    <main class="container">

        <div class="card">

            {{-- ======================================================
                TOMBOL KEMBALI
            ======================================================= --}}

            <div class="top-action">

                <a
                    href="{{ route('aulas') }}"
                    class="btn-back-top"
                >
                    ← Kembali ke Daftar Aula
                </a>

            </div>


            {{-- ======================================================
                INFO AULA
            ======================================================= --}}

            <div class="aula-info">

                <span class="label">
                    Aula yang Dipilih
                </span>

                <h2>
                    {{ $aula->nama_aula }}
                </h2>

            </div>


            {{-- ======================================================
                ERROR
            ======================================================= --}}

            @if ($errors->any())

                <div class="alert alert-danger">

                    <strong>
                        Terjadi kesalahan:
                    </strong>

                    <ul>

                        @foreach ($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <form
                action="{{ route('pendaftaran.store') }}"
                method="POST"
                id="formPendaftaran"
            >

                @csrf


                <input
                    type="hidden"
                    name="aula_id"
                    value="{{ $aula->id }}"
                >


                {{-- ======================================================
                    1. DATA PEMOHON
                ======================================================= --}}

                <section class="section">

                    <h2 class="section-title">
                        1. Data Pemohon
                    </h2>


                    <div class="form-grid">

                        {{-- NAMA LENGKAP --}}

                        <div class="form-group">

                            <label>

                                Nama Lengkap Pemohon

                                <span class="required">
                                    *
                                </span>

                            </label>


                            <input
                                type="text"
                                name="nama_pemohon"
                                value="{{ old('nama_pemohon', $user->name ?? '') }}"
                                placeholder="Masukkan nama lengkap pemohon"
                                required
                            >

                        </div>


                        {{-- JABATAN --}}

                        <div class="form-group">

                            <label>

                                Jabatan

                                <span class="required">
                                    *
                                </span>

                            </label>


                            <input
                                type="text"
                                name="jabatan"
                                value="{{ old('jabatan') }}"
                                placeholder="Masukkan jabatan"
                                required
                            >

                        </div>


                        {{-- BIDANG / UNIT --}}

                        <div
                            class="form-group"
                            id="unitGroup"
                        >

                            <label>

                                Bidang / Unit

                                <span class="required">
                                    *
                                </span>

                            </label>


                            <select
                                name="unit_organisasi"
                                id="unit_organisasi"
                            >

                                <option value="">
                                    -- Pilih Bidang / Unit --
                                </option>


                                @foreach ($struktur as $unit => $bagianList)

                                    <option
                                        value="{{ $unit }}"
                                        @selected(old('unit_organisasi') == $unit)
                                    >

                                        {{ $unit }}

                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- SUBBAGIAN / SEKSI --}}

                        <div class="form-group">

                            <label>

                                Subbagian / Seksi

                                <span class="required">
                                    *
                                </span>

                            </label>


                            <select
                                name="bagian_seksi"
                                id="bagian_seksi"
                            >

                                <option value="">
                                    -- Pilih Subbagian / Seksi --
                                </option>


                                @foreach ($struktur as $unit => $bagianList)

                                    <optgroup label="{{ $unit }}">

                                        @foreach ($bagianList as $bagian)

                                            <option
                                                value="{{ $bagian }}"
                                                @selected(old('bagian_seksi') == $bagian)
                                            >
                                                {{ $bagian }}
                                            </option>

                                        @endforeach

                                    </optgroup>

                                @endforeach

                            </select>

                        </div>

                    </div>

                </section>


                {{-- ======================================================
                    2. KEPERLUAN PEMAKAIAN
                ======================================================= --}}

                <section class="section">

                    <h2 class="section-title">
                        2. Keperluan Pemakaian
                    </h2>


                    <div class="form-group">

                        <textarea
                            name="keperluan"
                            placeholder="Masukkan keperluan pemakaian aula"
                            required
                        >{{ old('keperluan') }}</textarea>

                    </div>

                </section>


                {{-- ======================================================
                    3. DATA PESERTA
                ======================================================= --}}

                <section class="section">

                    <h2 class="section-title">
                        3. Data Peserta
                    </h2>


                    {{-- PESERTA RAPAT --}}

                    <div class="form-group">

                        <label>

                            Peserta Rapat

                            <span class="required">
                                *
                            </span>

                        </label>


                        <div class="radio-group">


                            {{-- INTERNAL --}}

                            <div class="radio-card">

                                <input
                                    type="radio"
                                    name="peserta_asal"
                                    id="internal"
                                    value="internal"
                                    @checked(old('peserta_asal') === 'internal')
                                    required
                                >


                                <label
                                    for="internal"
                                    class="radio-label"
                                >

                                    Internal

                                </label>

                            </div>


                            {{-- INTERNAL & EKSTERNAL --}}

                            <div class="radio-card">

                                <input
                                    type="radio"
                                    name="peserta_asal"
                                    id="internal_eksternal"
                                    value="internal_eksternal"
                                    @checked(old('peserta_asal') === 'internal_eksternal')
                                >


                                <label
                                    for="internal_eksternal"
                                    class="radio-label"
                                >

                                    Internal & Eksternal

                                </label>

                            </div>


                        </div>

                    </div>


                    <div
                        class="form-grid"
                        style="margin-top: 22px;"
                    >


                        {{-- INSTANSI --}}

                        <div
                            class="form-group hidden"
                            id="instansiGroup"
                        >

                            <label>

                                Nama Instansi / Organisasi

                                <span class="required">
                                    *
                                </span>

                            </label>


                            <input
                                type="text"
                                name="instansi"
                                id="instansi"
                                value="{{ old('instansi') }}"
                                placeholder="Masukkan nama instansi / organisasi"
                            >

                        </div>


                        {{-- JUMLAH PESERTA --}}

                        <div class="form-group">

                            <label>

                                Jumlah Peserta

                                <span class="required">
                                    *
                                </span>

                            </label>


                            <input
                                type="number"
                                name="jumlah_peserta"
                                value="{{ old('jumlah_peserta') }}"
                                min="1"
                                placeholder="Masukkan jumlah peserta"
                                required
                            >

                        </div>


                    </div>

                </section>


                {{-- ======================================================
                    4. WAKTU
                ======================================================= --}}

                <section class="section">

                    <h2 class="section-title">
                        4. Waktu
                    </h2>


                    <div class="form-grid">


                        {{-- TANGGAL MULAI --}}

                        <div class="form-group">

                            <label>

                                Tanggal Mulai

                                <span class="required">
                                    *
                                </span>

                            </label>


                            <input
                                type="date"
                                name="tanggal_mulai"
                                id="tanggal_mulai"
                                value="{{ old('tanggal_mulai') }}"
                                min="{{ date('Y-m-d') }}"
                                required
                            >


                            <div
                                class="hari-display empty"
                                id="hari_mulai"
                            >

                                Hari akan muncul otomatis

                            </div>

                        </div>


                        {{-- TANGGAL SELESAI --}}

                        <div class="form-group">

                            <label>

                                Tanggal Selesai

                                <span class="required">
                                    *
                                </span>

                            </label>


                            <input
                                type="date"
                                name="tanggal_selesai"
                                id="tanggal_selesai"
                                value="{{ old('tanggal_selesai') }}"
                                min="{{ date('Y-m-d') }}"
                                required
                            >


                            <div
                                class="hari-display empty"
                                id="hari_selesai"
                            >

                                Hari akan muncul otomatis

                            </div>

                        </div>


                    </div>


                    {{-- JAM PEMAKAIAN --}}

                    <div class="waktu-container">

                        <label>

                            Jam Pemakaian

                            <span class="required">
                                *
                            </span>

                        </label>


                        <div class="waktu-grid">


                            {{-- PAGI - SIANG --}}

                            <div
                                class="waktu-card"
                                data-waktu="pagi_siang"
                                data-slot="pagi"
                            >

                                <input
                                    type="radio"
                                    name="kriteria_waktu"
                                    id="pagi_siang"
                                    value="pagi_siang"
                                    @checked(old('kriteria_waktu') === 'pagi_siang')
                                    required
                                >


                                <label
                                    for="pagi_siang"
                                    class="waktu-label"
                                >

                                    <span class="waktu-icon">
                                        🌅
                                    </span>


                                    <span class="waktu-content">

                                        <strong>
                                            Pagi
                                        </strong>

                                        <span>
                                            08.00 – 13.00
                                        </span>

                                    </span>

                                </label>

                            </div>


                            {{-- SIANG - SORE --}}

                            <div
                                class="waktu-card"
                                data-waktu="siang_sore"
                                data-slot="siang"
                            >

                                <input
                                    type="radio"
                                    name="kriteria_waktu"
                                    id="siang_sore"
                                    value="siang_sore"
                                    @checked(old('kriteria_waktu') === 'siang_sore')
                                >


                                <label
                                    for="siang_sore"
                                    class="waktu-label"
                                >

                                    <span class="waktu-icon">
                                        ☀️
                                    </span>


                                    <span class="waktu-content">

                                        <strong>
                                            Siang
                                        </strong>

                                        <span>
                                            14.00 – 16.00
                                        </span>

                                    </span>

                                </label>

                            </div>


                            {{-- MALAM --}}

                            <div
                                class="waktu-card"
                                data-waktu="malam"
                                data-slot="malam"
                            >

                                <input
                                    type="radio"
                                    name="kriteria_waktu"
                                    id="malam"
                                    value="malam"
                                    @checked(old('kriteria_waktu') === 'malam')
                                >


                                <label
                                    for="malam"
                                    class="waktu-label"
                                >

                                    <span class="waktu-icon">
                                        🌙
                                    </span>


                                    <span class="waktu-content">

                                        <strong>
                                            Malam
                                        </strong>

                                        <span>
                                            18.00 – 21.00
                                        </span>

                                    </span>

                                </label>

                            </div>


                            {{-- GABUNGAN PAGI - SIANG --}}

                            <div
                                class="waktu-card"
                                data-waktu="gabungan_pagi_siang"
                                data-slot="pagi,siang"
                            >

                                <input
                                    type="radio"
                                    name="kriteria_waktu"
                                    id="gabungan_pagi_siang"
                                    value="gabungan_pagi_siang"
                                    @checked(old('kriteria_waktu') === 'gabungan_pagi_siang')
                                >


                                <label
                                    for="gabungan_pagi_siang"
                                    class="waktu-label"
                                >

                                    <span class="waktu-icon">
                                        🌤️
                                    </span>


                                    <span class="waktu-content">

                                        <strong>
                                            Pagi – Siang
                                        </strong>

                                        <span>
                                            08.00 – 16.00
                                        </span>

                                    </span>

                                </label>

                            </div>


                            {{-- GABUNGAN SIANG - MALAM --}}

                            <div
                                class="waktu-card"
                                data-waktu="gabungan_siang_malam"
                                data-slot="siang,malam"
                            >

                                <input
                                    type="radio"
                                    name="kriteria_waktu"
                                    id="gabungan_siang_malam"
                                    value="gabungan_siang_malam"
                                    @checked(old('kriteria_waktu') === 'gabungan_siang_malam')
                                >


                                <label
                                    for="gabungan_siang_malam"
                                    class="waktu-label"
                                >

                                    <span class="waktu-icon">
                                        🌆
                                    </span>


                                    <span class="waktu-content">

                                        <strong>
                                            Siang – Malam
                                        </strong>

                                        <span>
                                            14.00 – 21.00
                                        </span>

                                    </span>

                                </label>

                            </div>


                            {{-- GABUNGAN PAGI - MALAM --}}

                            <div
                                class="waktu-card"
                                data-waktu="gabungan_pagi_malam"
                                data-slot="pagi,malam"
                            >

                                <input
                                    type="radio"
                                    name="kriteria_waktu"
                                    id="gabungan_pagi_malam"
                                    value="gabungan_pagi_malam"
                                    @checked(old('kriteria_waktu') === 'gabungan_pagi_malam')
                                >


                                <label
                                    for="gabungan_pagi_malam"
                                    class="waktu-label"
                                >

                                    <span class="waktu-icon">
                                        🌗
                                    </span>


                                    <span class="waktu-content">

                                        <strong>
                                            Pagi – Malam
                                        </strong>

                                        <span>
                                            08.00 – 21.00
                                        </span>

                                    </span>

                                </label>

                            </div>


                        </div>

                    </div>

                </section>


                {{-- ======================================================
                    TOMBOL AJUKAN
                ======================================================= --}}

                <div class="button-area">

                    <button
                        type="submit"
                        class="btn-submit"
                    >

                        Ajukan Pendaftaran

                    </button>

                </div>

            </form>

        </div>

    </main>


    <script>

        document.addEventListener('DOMContentLoaded', function () {


            /* ==========================================================
               DATA STRUKTUR ORGANISASI
            ========================================================== */

            const strukturOrganisasi = @json($struktur);


            /* ==========================================================
               ELEMEN FORM
            ========================================================== */

            const form =
                document.getElementById('formPendaftaran');

            const unitSelect =
                document.getElementById('unit_organisasi');

            const bagianSelect =
                document.getElementById('bagian_seksi');

            const unitGroup =
                document.getElementById('unitGroup');

            const instansiGroup =
                document.getElementById('instansiGroup');

            const instansiInput =
                document.getElementById('instansi');

            const tanggalMulai =
                document.getElementById('tanggal_mulai');

            const tanggalSelesai =
                document.getElementById('tanggal_selesai');


            /* ==========================================================
               HARI INDONESIA
            ========================================================== */

            function getNamaHari(tanggal) {

                if (!tanggal) {
                    return '';
                }


                const hari = [
                    'Minggu',
                    'Senin',
                    'Selasa',
                    'Rabu',
                    'Kamis',
                    'Jumat',
                    'Sabtu'
                ];


                const date =
                    new Date(tanggal + 'T00:00:00');


                return hari[date.getDay()];

            }


            function updateHariMulai() {

                const hariElement =
                    document.getElementById('hari_mulai');


                if (!tanggalMulai.value) {

                    hariElement.textContent =
                        'Hari akan muncul otomatis';

                    hariElement.classList.add('empty');

                    return;

                }


                hariElement.textContent =
                    getNamaHari(tanggalMulai.value);

                hariElement.classList.remove('empty');

            }


            function updateHariSelesai() {

                const hariElement =
                    document.getElementById('hari_selesai');


                if (!tanggalSelesai.value) {

                    hariElement.textContent =
                        'Hari akan muncul otomatis';

                    hariElement.classList.add('empty');

                    return;

                }


                hariElement.textContent =
                    getNamaHari(tanggalSelesai.value);

                hariElement.classList.remove('empty');

            }


            /* ==========================================================
               SINKRON UNIT DARI SUBBAGIAN / SEKSI
            ========================================================== */

            function labelUnitBagian() {

                const option =
                    bagianSelect.selectedOptions[0];

                const group =
                    option
                        ? option.closest('optgroup')
                        : null;

                return group
                    ? group.label
                    : '';

            }


            /* ==========================================================
               PESERTA RAPAT
            ========================================================== */

            function ubahPeserta() {

                const peserta =
                    document.querySelector(
                        'input[name="peserta_asal"]:checked'
                    );


                if (!peserta) {

                    return;

                }


                if (peserta.value === 'internal') {

                    unitGroup.classList.remove('hidden');

                    unitSelect.required = true;

                    bagianSelect.required = true;

                    instansiGroup.classList.add('hidden');

                    instansiInput.required = false;

                    instansiInput.value = '';

                }


                else if (
                    peserta.value === 'internal_eksternal'
                ) {

                    unitGroup.classList.remove('hidden');

                    unitSelect.required = true;

                    bagianSelect.required = true;

                    instansiGroup.classList.remove('hidden');

                    instansiInput.required = true;

                }

            }


            /* ==========================================================
               FILTER SUBBAGIAN / SEKSI SESUAI BIDANG / UNIT
            ========================================================== */

            function tampilkanBagian(unit) {

                const terpilih =
                    bagianSelect.value;


                bagianSelect.innerHTML = '';


                const placeholder =
                    document.createElement('option');

                placeholder.value = '';

                placeholder.textContent =
                    '-- Pilih Subbagian / Seksi --';

                bagianSelect.appendChild(placeholder);


                Object.keys(strukturOrganisasi).forEach(
                    function (namaUnit) {

                        if (unit && namaUnit !== unit) {

                            return;

                        }


                        const group =
                            document.createElement('optgroup');

                        group.label = namaUnit;


                        strukturOrganisasi[namaUnit].forEach(
                            function (bagian) {

                                const option =
                                    document.createElement('option');

                                option.value = bagian;

                                option.textContent = bagian;

                                group.appendChild(option);

                            }
                        );


                        bagianSelect.appendChild(group);

                    }
                );


                const masihAda =
                    Array.from(bagianSelect.options).some(
                        function (option) {

                            return option.value === terpilih;

                        }
                    );


                bagianSelect.value =
                    masihAda ? terpilih : '';

            }


            /* ==========================================================
               EVENT BIDANG / UNIT DAN SUBBAGIAN / SEKSI
            ========================================================== */

            bagianSelect.addEventListener(
                'change',
                function () {

                    unitSelect.value =
                        labelUnitBagian();

                }
            );


            unitSelect.addEventListener(
                'change',
                function () {

                    tampilkanBagian(unitSelect.value);

                }
            );


            /* ==========================================================
               EVENT PESERTA RAPAT
            ========================================================== */

            document
                .querySelectorAll(
                    'input[name="peserta_asal"]'
                )
                .forEach(
                    function (radio) {

                        radio.addEventListener(
                            'change',
                            ubahPeserta
                        );

                    }
                );


            /* ==========================================================
               CEK KETERSEDIAAN WAKTU
            ========================================================== */

            async function cekKetersediaan() {

                const mulai =
                    tanggalMulai.value;

                const selesai =
                    tanggalSelesai.value;


                if (!mulai || !selesai) {

                    aktifkanSemuaWaktu();

                    return;

                }


                if (selesai < mulai) {

                    aktifkanSemuaWaktu();

                    return;

                }


                try {

                    const url =
                        "{{ route('pendaftaran.availability') }}"
                        + "?aula_id={{ $aula->id }}"
                        + "&tanggal_mulai="
                        + encodeURIComponent(mulai)
                        + "&tanggal_selesai="
                        + encodeURIComponent(selesai);


                    const response =
                        await fetch(
                            url,
                            {
                                headers: {
                                    'Accept': 'application/json'
                                }
                            }
                        );


                    if (!response.ok) {

                        throw new Error(
                            'Gagal mengecek ketersediaan.'
                        );

                    }


                    const data =
                        await response.json();


                    const slotTerpakai =
                        data.slotTerpakai || [];


                    document
                        .querySelectorAll('.waktu-card')
                        .forEach(
                            function (card) {

                                const slots =
                                    (card.dataset.slot || '')
                                        .split(',')
                                        .filter(
                                            function (s) {
                                                return s !== '';
                                            }
                                        );


                                const input =
                                    card.querySelector('input');


                                const bentrok =
                                    slots.some(
                                        function (s) {
                                            return slotTerpakai.includes(s);
                                        }
                                    );


                                if (bentrok) {

                                    card.classList.add(
                                        'disabled'
                                    );

                                    input.disabled = true;

                                    input.checked = false;

                                }

                                else {

                                    card.classList.remove(
                                        'disabled'
                                    );

                                    input.disabled = false;

                                }

                            }
                        );


                }

                catch (error) {

                    console.error(error);

                    aktifkanSemuaWaktu();

                }

            }


            function aktifkanSemuaWaktu() {

                document
                    .querySelectorAll('.waktu-card')
                    .forEach(
                        function (card) {

                            card.classList.remove(
                                'disabled'
                            );


                            const input =
                                card.querySelector('input');


                            input.disabled = false;

                        }
                    );

            }


            /* ==========================================================
               EVENT TANGGAL MULAI
            ========================================================== */

            tanggalMulai.addEventListener(
                'change',
                function () {

                    tanggalSelesai.min =
                        tanggalMulai.value;


                    if (
                        tanggalSelesai.value &&
                        tanggalSelesai.value <
                        tanggalMulai.value
                    ) {

                        tanggalSelesai.value = '';

                    }


                    updateHariMulai();

                    updateHariSelesai();

                    cekKetersediaan();

                }
            );


            /* ==========================================================
               EVENT TANGGAL SELESAI
            ========================================================== */

            tanggalSelesai.addEventListener(
                'change',
                function () {

                    updateHariSelesai();

                    cekKetersediaan();

                }
            );


            /* ==========================================================
               OLD VALUE
            ========================================================== */

            const oldUnit =
                @json(old('unit_organisasi', ''));


            const oldBagian =
                @json(old('bagian_seksi', ''));


            if (oldBagian) {

                bagianSelect.value =
                    oldBagian;


                unitSelect.value =
                    labelUnitBagian();

            }


            if (oldUnit) {

                unitSelect.value =
                    oldUnit;

            }


            /* ==========================================================
               INISIALISASI
            ========================================================== */

            tampilkanBagian(unitSelect.value);

            updateHariMulai();

            updateHariSelesai();

            ubahPeserta();


            if (tanggalMulai.value) {

                tanggalSelesai.min =
                    tanggalMulai.value;

            }


            if (
                tanggalMulai.value &&
                tanggalSelesai.value
            ) {

                cekKetersediaan();

            }


            /* ==========================================================
               VALIDASI SUBMIT
            ========================================================== */

            form.addEventListener(
                'submit',
                function (event) {

                    const waktuTerpilih =
                        document.querySelector(
                            'input[name="kriteria_waktu"]:checked'
                        );


                    if (!waktuTerpilih) {

                        event.preventDefault();

                        alert(
                            'Silakan pilih jam pemakaian yang tersedia.'
                        );

                        return;

                    }


                    const card =
                        waktuTerpilih.closest(
                            '.waktu-card'
                        );


                    if (
                        waktuTerpilih.disabled ||
                        card.classList.contains('disabled')
                    ) {

                        event.preventDefault();

                        alert(
                            'Waktu yang dipilih sudah digunakan. Silakan pilih waktu lain.'
                        );

                    }

                }
            );

        });

    </script>

</body>

</html>