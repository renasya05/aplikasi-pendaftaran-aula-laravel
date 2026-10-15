<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'SAPA')</title>

    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo-sapa.svg') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;600;700&family=Source+Sans+3:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="{{ asset('css/sapa.css') }}">
</head>


<body>

    <div class="auth-page">

        {{-- =====================================================
             PANEL KIRI: IDENTITAS APLIKASI
        ====================================================== --}}

        <section class="auth-hero">

            <div class="auth-brand">

                <img
                    class="auth-logo"
                    src="{{ asset('images/logo-sapa.svg') }}"
                    alt=""
                    width="44"
                    height="44"
                >

                <strong>
                    SAPA — Sistem Aplikasi untuk Layanan Akomodasi (Aula)
                </strong>

            </div>


            <div>

                <h1>
                    @yield('hero_title')
                </h1>

                <p>
                    @yield('hero_text')
                </p>

                <ul class="auth-list">

                    @yield('hero_list')

                </ul>

            </div>


            <p class="auth-footer">
                &copy; {{ date('Y') }} SAPA — Diskominfo
            </p>

        </section>


        {{-- =====================================================
             PANEL KANAN: FORMULIR
        ====================================================== --}}

        <main class="auth-panel">

            <div class="auth-card">

                @yield('content')

            </div>

        </main>

    </div>

</body>

</html>
