@extends('layouts.auth')

@section('title', 'Masuk | SAPA')

@section('hero_title', 'Pendaftaran pemakaian aula dalam satu sistem')

@section('hero_text')
    Ajukan pemakaian aula, pantau status persetujuan, dan lihat jadwal
    ketersediaan aula secara langsung.
@endsection

@section('hero_list')

    <li>
        <x-icon name="check" />
        Jadwal ketersediaan aula terlihat sebelum mengajukan
    </li>

    <li>
        <x-icon name="check" />
        Status pengajuan dapat dipantau kapan saja
    </li>

    <li>
        <x-icon name="check" />
        Riwayat pemakaian aula tersimpan rapi
    </li>

@endsection

@section('content')

    <h2>Selamat datang</h2>

    <p>
        Silakan masuk untuk melanjutkan ke sistem.
    </p>


    {{-- PESAN BERHASIL --}}

    @if(session('success'))

        <div class="alert alert-success" role="status">
            {{ session('success') }}
        </div>

    @endif


    {{-- PESAN ERROR --}}

    @if(session('error'))

        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>

    @endif


    {{-- VALIDASI --}}

    @if($errors->any())

        <div class="alert alert-danger" role="alert">
            {{ $errors->first() }}
        </div>

    @endif


    <form
        method="POST"
        action="{{ route('login.process') }}"
    >

        @csrf


        <div class="form-group">

            <label for="email">
                Email
            </label>

            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="Masukkan email"
                required
                autofocus
            >

            @error('email')

                <span class="error-text">
                    {{ $message }}
                </span>

            @enderror

        </div>


        <div class="form-group">

            <label for="password">
                Password
            </label>

            <input
                type="password"
                id="password"
                name="password"
                placeholder="Masukkan password"
                required
            >

            @error('password')

                <span class="error-text">
                    {{ $message }}
                </span>

            @enderror

        </div>


        <button
            type="submit"
            class="btn btn-primary auth-submit"
        >
            Masuk
        </button>

    </form>


    <p class="auth-alt">

        Belum memiliki akun?

        <a href="{{ route('register') }}">
            Daftar sekarang
        </a>

    </p>

@endsection
