@extends('layouts.app')

@section('title', 'Tambah Aula | SAPA')

@section('content')

<style>
    .page-container {
        max-width: 1150px;
        margin: 0 auto;
        padding: 38px 0 50px;
    }

    .page-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 22px;
    }

    .page-header-text .eyebrow {
        margin: 0 0 7px;
        color: #2563eb;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1.4px;
        text-transform: uppercase;
    }

    .page-header-text h1 {
        margin: 0;
        color: #12355b;
        font-size: 27px;
        line-height: 1.2;
        font-weight: 800;
    }

    .page-header-text p {
        margin: 7px 0 0;
        color: #64748b;
        font-size: 13px;
        line-height: 1.6;
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
    }

    .back-link:hover {
        color: #2563eb;
    }

    .form-card {
        background: #ffffff;
        border: 1px solid #dfe6ee;
        border-radius: 16px;
        overflow: hidden;
    }

    .form-card-header {
        padding: 22px 28px;
        border-bottom: 1px solid #e5eaf0;
        background: #ffffff;
    }

    .form-card-header h2 {
        margin: 0;
        color: #12355b;
        font-size: 17px;
        font-weight: 800;
    }

    .form-card-header p {
        margin: 5px 0 0;
        color: #64748b;
        font-size: 12px;
    }

    .form-body {
        padding: 28px;
    }

    .alert-error {
        margin-bottom: 24px;
        padding: 14px 16px;
        background: #fef2f2;
        border: 1px solid #fecaca;
        border-radius: 10px;
        color: #991b1b;
        font-size: 13px;
        line-height: 1.6;
    }

    .alert-error strong {
        font-weight: 800;
    }

    .alert-error ul {
        margin: 7px 0 0;
        padding-left: 20px;
    }

    .form-group {
        margin-bottom: 22px;
    }

    .form-group:last-of-type {
        margin-bottom: 0;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #334155;
        font-size: 13px;
        font-weight: 700;
    }

    .required {
        color: #dc2626;
    }

    .form-control {
        width: 100%;
        padding: 12px 14px;
        border: 1px solid #cbd5e1;
        border-radius: 9px;
        background: #ffffff;
        color: #1f2937;
        font-family: inherit;
        font-size: 13px;
        outline: none;
        transition: border-color .2s ease, box-shadow .2s ease;
    }

    .form-control::placeholder {
        color: #94a3b8;
    }

    .form-control:focus {
        border-color: #12355b;
        box-shadow: 0 0 0 3px rgba(18, 53, 91, .08);
    }

    textarea.form-control {
        min-height: 125px;
        resize: vertical;
        line-height: 1.6;
    }

    .help-text {
        margin-top: 7px;
        color: #64748b;
        font-size: 11px;
        line-height: 1.5;
    }

    .error-text {
        display: block;
        margin-top: 6px;
        color: #dc2626;
        font-size: 12px;
    }

    .button-area {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 28px;
        padding-top: 22px;
        border-top: 1px solid #e5e7eb;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 105px;
        padding: 11px 18px;
        border: 0;
        border-radius: 9px;
        font-family: inherit;
        font-size: 13px;
        font-weight: 800;
        text-decoration: none;
        cursor: pointer;
        transition: all .2s ease;
    }

    .btn-primary {
        background: #12355b;
        color: #ffffff;
    }

    .btn-primary:hover {
        background: #0d2946;
        transform: translateY(-1px);
    }

    .btn-secondary {
        background: #eef2f7;
        color: #475569;
        border: 1px solid #dbe2ea;
    }

    .btn-secondary:hover {
        background: #e2e8f0;
        color: #334155;
    }

    @media (max-width: 768px) {
        .page-container {
            padding: 25px 16px 40px;
        }

        .page-header {
            align-items: flex-start;
        }

        .page-header-text h1 {
            font-size: 23px;
        }

        .form-card-header,
        .form-body {
            padding: 20px;
        }

        .button-area {
            justify-content: stretch;
        }

        .button-area .btn {
            flex: 1;
        }
    }

    @media (max-width: 480px) {
        .page-header-text h1 {
            font-size: 21px;
        }

        .button-area {
            flex-direction: column-reverse;
        }

        .button-area .btn {
            width: 100%;
        }
    }
</style>

<div class="page-container">

    <a href="{{ route('admin.aulas') }}" class="back-link">
        ← Kembali ke Data Aula
    </a>

    <div class="page-header">
        <div class="page-header-text">
            <div class="eyebrow">Administrator</div>

            <h1>Tambah Aula Baru</h1>

            <p>
                Silakan isi formulir di bawah ini untuk menambahkan data aula baru.
            </p>
        </div>
    </div>

    <div class="form-card">

        <div class="form-card-header">
            <h2>Informasi Aula</h2>
            <p>Lengkapi data aula yang akan ditambahkan ke sistem.</p>
        </div>

        <div class="form-body">

            @if($errors->any())
                <div class="alert-error">
                    <strong>Terjadi kesalahan input:</strong>

                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.aulas.store') }}" method="POST">
                @csrf

                {{-- NAMA AULA --}}
                <div class="form-group">

                    <label for="nama_aula">
                        Nama Aula <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        id="nama_aula"
                        name="nama_aula"
                        value="{{ old('nama_aula') }}"
                        class="form-control"
                        placeholder="Contoh: Aula Serbaguna, Aula Pertemuan Lantai 2"
                        required
                        autofocus
                    >

                    @error('nama_aula')
                        <span class="error-text">{{ $message }}</span>
                    @enderror

                </div>

                {{-- KAPASITAS --}}
                <div class="form-group">

                    <label for="kapasitas">
                        Kapasitas (orang) <span class="required">*</span>
                    </label>

                    <input
                        type="number"
                        id="kapasitas"
                        name="kapasitas"
                        value="{{ old('kapasitas') }}"
                        class="form-control"
                        min="1"
                        placeholder="Contoh: 100"
                        required
                    >

                    <div class="help-text">
                        Jumlah kapasitas maksimal peserta yang dapat ditampung.
                    </div>

                    @error('kapasitas')
                        <span class="error-text">{{ $message }}</span>
                    @enderror

                </div>

                {{-- KETERANGAN --}}
                <div class="form-group">

                    <label for="keterangan">
                        Keterangan <span class="required">*</span>
                    </label>

                    <textarea
                        id="keterangan"
                        name="keterangan"
                        class="form-control"
                        placeholder="Deskripsi aula, peruntukan kegiatan, dan lokasi..."
                        required
                    >{{ old('keterangan') }}</textarea>

                    @error('keterangan')
                        <span class="error-text">{{ $message }}</span>
                    @enderror

                </div>

                {{-- FASILITAS --}}
                <div class="form-group">

                    <label for="fasilitas">
                        Fasilitas
                    </label>
                    
                    <textarea
                        id="fasilitas"
                        name="fasilitas"
                        class="form-control"
                        placeholder="Contoh: AC, Sound System, Proyektor, Meja, Kursi, Podium..."
                    >{{ old('fasilitas') }}</textarea>

                    <div class="help-text">
                        Daftar fasilitas yang disediakan (opsional).
                    </div>

                    @error('fasilitas')
                        <span class="error-text">{{ $message }}</span>
                    @enderror

                </div>

                {{-- BUTTON --}}
                <div class="button-area">

                    <a
                        href="{{ route('admin.aulas') }}"
                        class="btn btn-secondary">
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary">
                        Simpan Aula
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection