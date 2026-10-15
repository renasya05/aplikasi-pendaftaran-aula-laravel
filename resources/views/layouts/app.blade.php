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

    <a class="skip-link" href="#main">
        Lewati ke konten utama
    </a>

    @auth

        {{-- =====================================================
             SIDEBAR
        ====================================================== --}}

        <aside class="sidebar">

            {{-- BRAND --}}

            <a
                href="{{ Auth::user()->isAdmin()
                    ? route('admin.dashboard')
                    : route('dashboard') }}"
                class="sidebar-brand"
            >

                <div class="sidebar-brand-top">

                    <img
                        class="sidebar-logo"
                        src="{{ asset('images/logo-sapa.svg') }}"
                        alt=""
                        width="40"
                        height="40"
                    >

                    <div class="sidebar-brand-text">

                        <strong class="sidebar-brand-title">
                            Sistem Aplikasi untuk Layanan Akomodasi (Aula)
                        </strong>

                    </div>

                </div>

            </a>


            {{-- NAVIGATION --}}

            <nav class="sidebar-nav" aria-label="Menu utama">

                <div class="sidebar-section-title">
                    Menu Utama
                </div>


                {{-- ADMIN MENU --}}

                @if(Auth::user()->isAdmin())

                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                        @if(request()->routeIs('admin.dashboard')) aria-current="page" @endif
                    >
                        <span class="sidebar-icon"><x-icon name="dashboard" /></span>
                        <span>Dashboard Admin</span>
                    </a>


                    <a
                        href="{{ route('admin.pendaftaran.index') }}"
                        class="{{ request()->routeIs('admin.pendaftaran.*') ? 'active' : '' }}"
                        @if(request()->routeIs('admin.pendaftaran.*')) aria-current="page" @endif
                    >
                        <span class="sidebar-icon"><x-icon name="history" /></span>
                        <span>Riwayat Pendaftaran</span>
                    </a>


                    <a
                        href="{{ route('admin.aulas.index') }}"
                        class="{{ request()->routeIs('admin.aulas*') ? 'active' : '' }}"
                        @if(request()->routeIs('admin.aulas*')) aria-current="page" @endif
                    >
                        <span class="sidebar-icon"><x-icon name="building" /></span>
                        <span>Data Aula</span>
                    </a>


                    <a
                        href="{{ route('admin.laporan') }}"
                        class="{{ request()->routeIs('admin.laporan') ? 'active' : '' }}"
                        @if(request()->routeIs('admin.laporan')) aria-current="page" @endif
                    >
                        <span class="sidebar-icon"><x-icon name="chart" /></span>
                        <span>Laporan</span>
                    </a>

                @else

                    {{-- USER MENU --}}

                    <a
                        href="{{ route('dashboard') }}"
                        class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"
                        @if(request()->routeIs('dashboard')) aria-current="page" @endif
                    >
                        <span class="sidebar-icon"><x-icon name="dashboard" /></span>
                        <span>Dashboard</span>
                    </a>


                    <a
                        href="{{ route('aulas') }}"
                        class="{{ request()->routeIs('aulas') ? 'active' : '' }}"
                        @if(request()->routeIs('aulas')) aria-current="page" @endif
                    >
                        <span class="sidebar-icon"><x-icon name="building" /></span>
                        <span>Daftar Aula</span>
                    </a>


                    <a
                        href="{{ route('pendaftaran.history') }}"
                        class="{{ request()->routeIs('pendaftaran.history*') || request()->routeIs('pendaftaran.show') ? 'active' : '' }}"
                        @if(request()->routeIs('pendaftaran.history*') || request()->routeIs('pendaftaran.show')) aria-current="page" @endif
                    >
                        <span class="sidebar-icon"><x-icon name="history" /></span>
                        <span>Riwayat Pendaftaran</span>
                    </a>


                    <a
                        href="{{ route('informasi') }}"
                        class="{{ request()->routeIs('informasi') ? 'active' : '' }}"
                        @if(request()->routeIs('informasi')) aria-current="page" @endif
                    >
                        <span class="sidebar-icon"><x-icon name="info" /></span>
                        <span>Informasi</span>
                    </a>

                @endif

            </nav>


            {{-- LOGOUT --}}

            <div class="sidebar-bottom">

                <form
                    method="POST"
                    action="{{ route('logout') }}"
                >

                    @csrf

                    <button
                        type="submit"
                        class="sidebar-logout"
                    >
                        <span class="sidebar-icon"><x-icon name="logout" /></span>
                        <span>Keluar</span>
                    </button>

                </form>

            </div>

        </aside>

    @endauth


    {{-- =========================================================
         APP WRAPPER
    ========================================================== --}}

    <div class="app-wrapper">


        {{-- =====================================================
             MAIN CONTENT
        ====================================================== --}}

        <main class="main-content" id="main">

            {{-- SUCCESS --}}

            @if(session('success'))

                <div class="alert alert-success" role="status">
                    {{ session('success') }}
                </div>

            @endif


            {{-- ERROR --}}

            @if(session('error'))

                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>

            @endif


            @yield('content')

        </main>


        {{-- =====================================================
             FOOTER
        ====================================================== --}}

        @auth

            <footer class="footer">
                © {{ date('Y') }} SAPA — Sistem Aplikasi untuk Layanan Akomodasi (Aula)
            </footer>

        @endauth


    </div>


    @stack('scripts')

</body>

</html>
