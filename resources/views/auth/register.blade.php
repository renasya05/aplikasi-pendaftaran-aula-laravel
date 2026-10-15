@extends('layouts.auth')

@section('title', 'Daftar | SAPA')

@section('hero_title', 'Buat akun untuk mulai mengajukan pemakaian aula')

@section('hero_text')
    Akun SAPA dipakai untuk mengajukan pemakaian aula dan memantau
    status pengajuan Anda.
@endsection

@section('hero_list')

    <li>
        <x-icon name="check" />
        Satu akun untuk seluruh pengajuan Anda
    </li>

    <li>
        <x-icon name="check" />
        Data pemohon terisi otomatis saat mengajukan
    </li>

@endsection

@section('content')

    <h2>Daftar akun</h2>

    <p>
        Lengkapi data berikut untuk membuat akun SAPA.
    </p>


    @if($errors->any())

        <div class="alert alert-danger" role="alert">
            {{ $errors->first() }}
        </div>

    @endif


    <form
        action="{{ route('register.process') }}"
        method="POST"
    >

        @csrf


        <div class="form-group">

            <label for="name">
                Nama Lengkap
            </label>

            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                placeholder="Masukkan nama lengkap"
                required
                autofocus
            >

            @error('name')

                <span class="error-text">
                    {{ $message }}
                </span>

            @enderror

        </div>


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
                placeholder="Minimal 8 karakter"
                required
            >

            @error('password')

                <span class="error-text">
                    {{ $message }}
                </span>

            @enderror

        </div>


        <div class="form-group">

            <label for="password_confirmation">
                Konfirmasi Password
            </label>

            <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                placeholder="Ulangi password"
                required
            >

        </div>


        <button
            type="submit"
            class="btn btn-primary auth-submit"
        >
            Buat Akun
        </button>

    </form>


    <p class="auth-alt">

        Sudah memiliki akun?

        <a href="{{ route('login') }}">
            Masuk di sini
        </a>

    </p>

@endsection
