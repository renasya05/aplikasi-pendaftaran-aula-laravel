<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'SAPA')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <style>
        /* =========================================================
           RESET
        ========================================================= */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        /* =========================================================
           VARIABLES
        ========================================================= */

        :root {
            --navy: #12355b;
            --navy-dark: #0d2947;
            --navy-light: #1f4e79;

            --background: #f4f6f9;
            --white: #ffffff;

            --text: #1f2937;
            --text-light: #667085;
            --muted: #6b7280;

            --border: #d9dee5;

            --success: #15803d;
            --success-bg: #dcfce7;

            --warning: #a16207;
            --warning-bg: #fef3c7;

            --danger: #b91c1c;
            --danger-bg: #fee2e2;

            --shadow: 0 4px 16px rgba(15, 23, 42, 0.08);

            --sidebar-width: 260px;
        }


        /* =========================================================
           BODY
        ========================================================= */

        body {
            font-family: 'Inter', sans-serif;
            background: var(--background);
            color: var(--text);
            min-height: 100vh;
            line-height: 1.6;
            font-size: 16px;
        }


        /* =========================================================
           SIDEBAR
        ========================================================= */

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;

            width: var(--sidebar-width);
            height: 100vh;

            background: var(--navy);
            color: white;

            display: flex;
            flex-direction: column;

            z-index: 1000;

            box-shadow: 4px 0 18px rgba(15, 23, 42, 0.12);
        }


        /* =========================================================
           SIDEBAR BRAND
        ========================================================= */

        .sidebar-brand {
            padding: 28px 24px 24px;

            text-decoration: none;
            color: white;

            border-bottom: 1px solid rgba(255, 255, 255, 0.12);
        }


        .sidebar-brand-top {
            display: flex;
            align-items: center;
            gap: 12px;
        }


        .sidebar-logo {
            width: 46px;
            height: 46px;

            border-radius: 11px;

            background: white;
            color: var(--navy);

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 19px;
            font-weight: 800;

            flex-shrink: 0;
        }


        .sidebar-brand-text {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }


        .sidebar-brand-text strong {
            font-size: 21px;
            font-weight: 800;
            color: white;
        }


        .sidebar-brand-text span {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.78);
            margin-top: 5px;
            line-height: 1.4;
        }


        .sidebar-brand-text strong.sidebar-brand-title {
            font-size: 13px;
            font-weight: 800;
            line-height: 1.35;
            letter-spacing: 0.3px;
        }


        /* =========================================================
           SIDEBAR NAVIGATION
        ========================================================= */

        .sidebar-nav {
            flex: 1;

            padding: 8px 14px;

            overflow-y: auto;
        }


        .sidebar-section-title {
            color: rgba(255, 255, 255, 0.45);

            font-size: 11px;
            font-weight: 700;

            text-transform: uppercase;
            letter-spacing: 0.8px;

            padding: 12px 12px 8px;
        }


        .sidebar-nav a {
            display: flex;
            align-items: center;

            gap: 12px;

            width: 100%;

            padding: 12px 13px;
            margin-bottom: 5px;

            border-radius: 9px;

            color: rgba(255, 255, 255, 0.82);

            text-decoration: none;

            font-size: 15px;
            font-weight: 600;

            transition: all 0.2s ease;
        }


        .sidebar-nav a:hover {
            background: rgba(255, 255, 255, 0.10);
            color: white;
        }


        .sidebar-nav a.active {
            background: white;
            color: var(--navy);

            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.10);
        }


        .sidebar-icon {
            width: 22px;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 17px;

            flex-shrink: 0;
        }


        /* =========================================================
           SIDEBAR BOTTOM
        ========================================================= */

        .sidebar-bottom {
            padding: 14px;

            border-top: 1px solid rgba(255, 255, 255, 0.12);
        }


        .sidebar-logout {
            width: 100%;

            display: flex;
            align-items: center;

            gap: 12px;

            padding: 12px 13px;

            border: none;
            border-radius: 9px;

            background: transparent;

            color: rgba(255, 255, 255, 0.82);

            font-family: inherit;

            font-size: 15px;
            font-weight: 600;

            cursor: pointer;

            text-align: left;

            transition: all 0.2s ease;
        }


        .sidebar-logout:hover {
            background: rgba(255, 255, 255, 0.10);
            color: white;
        }


        /* =========================================================
           MAIN AREA
        ========================================================= */

        .app-wrapper {
            min-height: 100vh;

            margin-left: var(--sidebar-width);

            display: flex;
            flex-direction: column;
        }


        .main-content {
            width: min(1400px, 94%);

            margin: 0 auto;

            padding: 38px 0 55px;

            min-height: calc(100vh - 75px);

            flex: 1;
        }


        /* =========================================================
           PAGE HEADER
        ========================================================= */

        .page-header {
            margin-bottom: 28px;
        }


        .page-header h1 {
            font-size: 34px;
            line-height: 1.25;

            font-weight: 800;

            color: var(--navy);

            margin-bottom: 7px;
        }


        .page-header p {
            font-size: 17px;
            line-height: 1.6;

            color: var(--text-light);
        }


        /* =========================================================
           CARD
        ========================================================= */

        .card {
            background: var(--white);

            border-radius: 16px;

            border: 1px solid #e4e7eb;

            box-shadow: var(--shadow);

            padding: 25px;
        }


        .card-title {
            font-size: 21px;

            font-weight: 700;

            color: var(--navy);

            margin-bottom: 18px;
        }


        /* =========================================================
           BUTTON
        ========================================================= */

        .btn {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            gap: 7px;

            min-height: 44px;

            padding: 10px 18px;

            border-radius: 9px;

            border: none;

            font-family: inherit;

            font-size: 16px;
            font-weight: 700;

            text-decoration: none;

            cursor: pointer;

            transition: all 0.2s ease;
        }


        .btn-primary {
            background: var(--navy);
            color: white;
        }


        .btn-primary:hover {
            background: var(--navy-dark);
            color: white;

            transform: translateY(-1px);
        }


        .btn-secondary {
            background: #eef2f6;
            color: #374151;
        }


        .btn-secondary:hover {
            background: #e2e8f0;
        }


        .btn-success {
            background: #15803d;
            color: white;
        }


        .btn-success:hover {
            background: #166534;
        }


        .btn-danger {
            background: #b91c1c;
            color: white;
        }


        .btn-danger:hover {
            background: #991b1b;
        }


        /* =========================================================
           FORM
        ========================================================= */

        label {
            display: block;

            font-size: 16px;
            font-weight: 700;

            color: #263238;

            margin-bottom: 8px;
        }


        input,
        select,
        textarea {
            width: 100%;

            min-height: 48px;

            border: 1px solid var(--border);

            border-radius: 9px;

            background: white;

            color: var(--text);

            font-family: inherit;

            font-size: 16px;

            line-height: 1.5;

            padding: 10px 13px;

            outline: none;

            transition: all 0.2s ease;
        }


        textarea {
            min-height: 110px;
            resize: vertical;
        }


        input:focus,
        select:focus,
        textarea:focus {
            border-color: var(--navy);

            box-shadow:
                0 0 0 3px rgba(18, 53, 91, 0.10);
        }


        input::placeholder,
        textarea::placeholder {
            color: #9ca3af;
        }


        .form-group {
            margin-bottom: 20px;
        }


        .form-text {
            font-size: 14px;
            color: var(--muted);
            margin-top: 6px;
        }


        .error-text {
            color: var(--danger);
            font-size: 14px;
            margin-top: 6px;
        }


        /* =========================================================
           ALERT
        ========================================================= */

        .alert {
            width: 100%;

            padding: 15px 18px;

            border-radius: 10px;

            margin-bottom: 22px;

            font-size: 16px;

            line-height: 1.6;

            border: 1px solid transparent;
        }


        .alert-success {
            color: #166534;

            background: var(--success-bg);

            border-color: #bbf7d0;
        }


        .alert-danger {
            color: #991b1b;

            background: var(--danger-bg);

            border-color: #fecaca;
        }


        .alert-warning {
            color: #92400e;

            background: var(--warning-bg);

            border-color: #fde68a;
        }


        /* =========================================================
           TABLE
        ========================================================= */

        .table-wrapper {
            width: 100%;

            overflow-x: auto;

            border-radius: 12px;

            border: 1px solid #e5e7eb;
        }


        table {
            width: 100%;

            border-collapse: collapse;

            background: white;
        }


        table th {
            background: #f4f6f9;

            color: var(--navy);

            font-size: 16px;

            font-weight: 700;

            text-align: left;

            padding: 15px 14px;

            border-bottom: 1px solid #dfe4ea;

            white-space: nowrap;
        }


        table td {
            color: #374151;

            font-size: 16px;

            padding: 15px 14px;

            border-bottom: 1px solid #edf0f3;

            vertical-align: middle;
        }


        table tbody tr:hover {
            background: #fafbfc;
        }


        table tbody tr:last-child td {
            border-bottom: none;
        }


        /* =========================================================
           BADGE
        ========================================================= */

        .badge {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            padding: 6px 11px;

            border-radius: 999px;

            font-size: 14px;
            font-weight: 700;

            white-space: nowrap;
        }


        .badge-success {
            background: #dcfce7;
            color: #166534;
        }


        .badge-warning {
            background: #fef3c7;
            color: #92400e;
        }


        .badge-danger {
            background: #fee2e2;
            color: #991b1b;
        }


        .badge-info {
            background: #dbeafe;
            color: #1e40af;
        }


        .badge-secondary {
            background: #e5e7eb;
            color: #374151;
        }


        /* =========================================================
           GRID
        ========================================================= */

        .grid {
            display: grid;
            gap: 22px;
        }


        .grid-2 {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }


        .grid-3 {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }


        .grid-4 {
            grid-template-columns: repeat(4, minmax(0, 1fr));
        }


        /* =========================================================
           STAT CARD
        ========================================================= */

        .stat-card {
            background: white;

            border: 1px solid #e4e7eb;

            border-radius: 16px;

            padding: 24px;

            box-shadow: var(--shadow);
        }


        .stat-label {
            font-size: 16px;

            font-weight: 600;

            color: var(--muted);

            margin-bottom: 8px;
        }


        .stat-value {
            font-size: 32px;

            line-height: 1.2;

            font-weight: 800;

            color: var(--navy);
        }


        /* =========================================================
           SECTION
        ========================================================= */

        .section {
            margin-top: 32px;
        }


        .section-title {
            font-size: 24px;

            font-weight: 800;

            color: var(--navy);

            margin-bottom: 18px;
        }


        /* =========================================================
           EMPTY STATE
        ========================================================= */

        .empty-state {
            background: white;

            border: 1px solid #e5e7eb;

            border-radius: 15px;

            padding: 45px 25px;

            text-align: center;

            color: var(--muted);
        }


        .empty-state h3 {
            font-size: 21px;

            color: var(--navy);

            margin-bottom: 8px;
        }


        .empty-state p {
            font-size: 16px;
        }


        /* =========================================================
           FOOTER
        ========================================================= */

        .footer {
            width: 100%;

            border-top: 1px solid #e5e7eb;

            background: white;

            padding: 20px;

            text-align: center;

            color: var(--muted);

            font-size: 14px;

            line-height: 1.5;
        }


        /* =========================================================
           FONT BESAR SAPA
        ========================================================= */

        p,
        span,
        li {
            font-size: 16px;
        }


        small {
            font-size: 14px;
        }


        .main-content {
            font-size: 18px !important;
        }


        .main-content p,
        .main-content span,
        .main-content label,
        .main-content li,
        .main-content td,
        .main-content th,
        .main-content a {
            font-size: 18px !important;
        }


        .main-content h1 {
            font-size: 34px !important;
        }


        .main-content h2 {
            font-size: 28px !important;
        }


        .main-content h3 {
            font-size: 22px !important;
        }


        .main-content h4 {
            font-size: 20px !important;
        }


        .main-content .card-title,
        .main-content .section-title {
            font-size: 22px !important;
        }


        .main-content small {
            font-size: 16px !important;
        }


        .main-content strong {
            font-size: 18px !important;
        }


        .main-content .stat-value {
            font-size: 34px !important;
        }


        .main-content .stat-label {
            font-size: 17px !important;
        }


        .main-content button,
        .main-content .btn {
            font-size: 17px !important;
        }


        .main-content input,
        .main-content select,
        .main-content textarea {
            font-size: 17px !important;
        }


        .main-content table th,
        .main-content table td {
            font-size: 17px !important;
        }


        .main-content .badge {
            font-size: 16px !important;
        }


        .main-content .alert {
            font-size: 17px !important;
        }


        /* =========================================================
           RESPONSIVE TABLET
        ========================================================= */

        @media (max-width: 1050px) {

            :root {
                --sidebar-width: 230px;
            }


            .sidebar-brand {
                padding-left: 18px;
                padding-right: 18px;
            }


            .sidebar-nav {
                padding-left: 10px;
                padding-right: 10px;
            }


            .grid-4 {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }


            .grid-3 {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }


        /* =========================================================
           RESPONSIVE MOBILE
        ========================================================= */

        @media (max-width: 700px) {

            :root {
                --sidebar-width: 0px;
            }


            .sidebar {
                position: relative;

                width: 100%;
                height: auto;

                min-height: auto;
            }


            .sidebar-brand {
                padding: 18px 20px;
            }


            .sidebar-nav {
                padding: 5px 14px 10px;

                display: flex;
                flex-wrap: wrap;

                gap: 5px;
            }


            .sidebar-section-title {
                display: none;
            }


            .sidebar-nav a {
                width: auto;

                margin-bottom: 0;

                padding: 10px 12px;

                font-size: 14px;
            }


            .sidebar-bottom {
                padding: 10px 14px;
            }


            .sidebar-logout {
                padding: 10px 12px;
                font-size: 14px;
            }


            .app-wrapper {
                margin-left: 0;
            }


            .main-content {
                width: 92%;

                padding: 28px 0 40px;

                font-size: 17px !important;
            }


            .main-content p,
            .main-content span,
            .main-content label,
            .main-content li,
            .main-content td,
            .main-content th,
            .main-content a {
                font-size: 17px !important;
            }


            .main-content h1 {
                font-size: 30px !important;
            }


            .main-content h2 {
                font-size: 25px !important;
            }


            .main-content h3 {
                font-size: 21px !important;
            }


            .main-content .card-title,
            .main-content .section-title {
                font-size: 21px !important;
            }


            .grid-4,
            .grid-3,
            .grid-2 {
                grid-template-columns: 1fr;
            }


            .stat-value {
                font-size: 29px;
            }


            .card {
                padding: 20px;
                border-radius: 13px;
            }


            .btn {
                font-size: 15px;
            }


            table th,
            table td {
                font-size: 15px !important;
            }
        }


        /* =========================================================
           EXTRA SMALL
        ========================================================= */

        @media (max-width: 450px) {

            .sidebar-brand-text span {
                font-size: 11px;
            }


            .sidebar-logo {
                width: 40px;
                height: 40px;
                font-size: 16px;
            }


            .sidebar-brand-text strong {
                font-size: 19px;
            }


            .page-header h1 {
                font-size: 26px;
            }


            .main-content .btn {
                width: 100%;
            }


            .sidebar-nav a {
                font-size: 13px;
            }
        }


        /* =========================================================
           PAGE-SPECIFIC STYLE SLOT
        ========================================================= */

        @stack('styles')

    </style>

</head>


<body>

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

                    <div class="sidebar-logo">
                        S
                    </div>

                    <div class="sidebar-brand-text">

                        <strong class="sidebar-brand-title">
                            SISTEM APLIKASI UNTUK LAYANAN AKOMODASI (AULA)
                        </strong>

                    </div>

                </div>

            </a>


            {{-- NAVIGATION --}}

            <nav class="sidebar-nav">

                <div class="sidebar-section-title">
                    Menu Utama
                </div>


                {{-- ADMIN MENU --}}

                @if(Auth::user()->isAdmin())

                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                    >
                        <span class="sidebar-icon">▣</span>
                        <span>Dashboard Admin</span>
                    </a>


                    <a
                        href="{{ route('admin.history') }}"
                        class="{{ request()->routeIs('admin.history*') ? 'active' : '' }}"
                    >
                        <span class="sidebar-icon">▤</span>
                        <span>Riwayat Pendaftaran</span>
                    </a>


                    <a
                        href="{{ route('admin.aulas') }}"
                        class="{{ request()->routeIs('admin.aulas*') ? 'active' : '' }}"
                    >
                        <span class="sidebar-icon">▦</span>
                        <span>Data Aula</span>
                    </a>


                    <a
                        href="{{ route('admin.laporan') }}"
                        class="{{ request()->routeIs('admin.laporan') ? 'active' : '' }}"
                    >
                        <span class="sidebar-icon">▥</span>
                        <span>Laporan</span>
                    </a>

                @else

                    {{-- USER MENU --}}

                    <a
                        href="{{ route('dashboard') }}"
                        class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"
                    >
                        <span class="sidebar-icon">▣</span>
                        <span>Dashboard</span>
                    </a>


                    <a
                        href="{{ route('aulas') }}"
                        class="{{ request()->routeIs('aulas') ? 'active' : '' }}"
                    >
                        <span class="sidebar-icon">▦</span>
                        <span>Daftar Aula</span>
                    </a>


                    <a
                        href="{{ route('pendaftaran.history') }}"
                        class="{{ request()->routeIs('pendaftaran.history*') || request()->routeIs('pendaftaran.show') ? 'active' : '' }}"
                    >
                        <span class="sidebar-icon">▤</span>
                        <span>Riwayat Pendaftaran</span>
                    </a>


                    <a
                        href="{{ route('informasi') }}"
                        class="{{ request()->routeIs('informasi') ? 'active' : '' }}"
                    >
                        <span class="sidebar-icon">ℹ</span>
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
                        <span class="sidebar-icon">↪</span>
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

        <main class="main-content">

            {{-- SUCCESS --}}

            @if(session('success'))

                <div class="alert alert-success">
                    {{ session('success') }}
                </div>

            @endif


            {{-- ERROR --}}

            @if(session('error'))

                <div class="alert alert-danger">
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