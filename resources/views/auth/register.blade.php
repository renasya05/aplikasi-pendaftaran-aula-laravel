<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Registrasi - Sistem Aplikasi untuk Layanan Akomodasi (Aula)</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f3f5f8;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #263238;
        }

        .register-container {
            width: 100%;
            max-width: 480px;
            padding: 20px;
        }

        .register-card {
            background: white;
            border: 1px solid #e1e5e9;
            border-radius: 10px;
            padding: 35px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.06);
        }

        .logo {
            width: 65px;
            height: 65px;
            margin: 0 auto 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #1f4e79;
            color: white;
            border-radius: 8px;
            font-size: 21px;
            font-weight: bold;
        }

        .title {
            text-align: center;
            font-size: 20px;
            line-height: 1.3;
            color: #1f2933;
            margin-bottom: 7px;
        }

        .subtitle {
            text-align: center;
            color: #6b7280;
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 28px;
        }

        .form-group {
            margin-bottom: 17px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            color: #374151;
            font-size: 14px;
            font-weight: bold;
        }

        input {
            width: 100%;
            height: 45px;
            padding: 0 13px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 14px;
            outline: none;
        }

        input:focus {
            border-color: #1f4e79;
        }

        .btn-register {
            width: 100%;
            height: 45px;
            border: none;
            border-radius: 6px;
            background: #1f4e79;
            color: white;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-register:hover {
            background: #173a5c;
        }

        .login-text {
            text-align: center;
            margin-top: 23px;
            color: #6b7280;
            font-size: 14px;
        }

        .login-text a {
            color: #1f4e79;
            text-decoration: none;
            font-weight: bold;
        }

        .login-text a:hover {
            text-decoration: underline;
        }

        .error-text {
            display: block;
            margin-top: 6px;
            color: #dc2626;
            font-size: 12px;
        }

        .alert {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
            border-radius: 6px;
            padding: 12px 14px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color: #9ca3af;
            font-size: 12px;
        }
    </style>
</head>

<body>

<div class="register-container">

    <div class="register-card">

        <div class="logo">
            SA
        </div>

        <h1 class="title">
            Sistem Aplikasi untuk
            Layanan Akomodasi (Aula)
        </h1>

        <p class="subtitle">
            Buat akun untuk melakukan pendaftaran
            dan pemakaian aula.
        </p>

        @if($errors->any())
            <div class="alert">
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
                class="btn-register"
            >
                Buat Akun
            </button>

        </form>


        <div class="login-text">

            Sudah memiliki akun?

            <a href="{{ route('login') }}">
                Masuk di sini
            </a>

        </div>

    </div>


    <div class="footer">
        Sistem Aplikasi untuk Layanan Akomodasi (Aula) &copy; {{ date('Y') }}
    </div>

</div>

</body>
</html>