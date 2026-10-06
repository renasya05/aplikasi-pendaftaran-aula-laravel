<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Daftar Aula | SAPA</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f1f5f9;
            color: white;
            line-height: 1.6;
        }

        /* =====================================================
           HEADER
        ====================================================== */

        .header {
            background: #12355b;
            color: white;
            padding: 24px 5%;
        }

        .header-inner {
            max-width: 1180px;
            margin: auto;

            display: flex;
            justify-content: space-between;
            align-items: center;

            gap: 20px;
        }

        .brand h1 {
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 3px;
        }

        .brand p {
            font-size: 16px;
            opacity: 0.92;
        }

        .back-dashboard {
            color: white;
            text-decoration: none;

            border: 1px solid rgba(255, 255, 255, 0.45);

            padding: 10px 17px;
            border-radius: 8px;

            font-size: 15px;
            font-weight: 700;

            transition: 0.2s ease;
        }

        .back-dashboard:hover {
            background: rgba(255, 255, 255, 0.12);
        }

        /* =====================================================
           CONTAINER
        ====================================================== */

        .container {
            width: 92%;
            max-width: 1180px;

            margin: 32px auto 50px;
        }

        /* =====================================================
           TITLE
        ====================================================== */

        .page-heading {
            margin-bottom: 28px;
        }

        .page-heading h2 {
            color: #12355b;
            font-size: 30px;
            font-weight: 800;
            text-transform: uppercase;

            margin-bottom: 4px;
        }

        .page-heading p {
            color: #64748b;
            font-size: 16px;
        }

        /* =====================================================
           GRID AULA
        ====================================================== */

        .aula-list {
            display: grid;

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap: 24px;

            align-items: stretch;
        }

        /* =====================================================
           FULL FOTO CARD
        ====================================================== */

        .aula-card {
            position: relative;

            display: flex;
            flex-direction: column;

            border-radius: 18px;

            overflow: hidden;

            background: #ffffff;

            box-shadow:
                0 8px 30px
                rgba(15, 23, 42, 0.16);

            transition:
                transform 0.25s ease,
                box-shadow 0.25s ease;
        }

        .aula-card:hover {
            transform: translateY(-4px);

            box-shadow:
                0 14px 35px
                rgba(15, 23, 42, 0.22);
        }

        /* =====================================================
           FOTO
        ====================================================== */

        .aula-photo {
            position: relative;

            width: 100%;
            height: 300px;

            overflow: hidden;
        }

        .aula-photo img {
            position: absolute;

            inset: 0;

            width: 100%;
            height: 100%;

            object-fit: cover;
            object-position: center;

            display: block;

            transition:
                transform 0.4s ease;
        }

        .aula-card:hover .aula-photo img {
            transform: scale(1.04);
        }

        /* =====================================================
           OVERLAY FOTO
        ====================================================== */

        .aula-photo::after {
            content: "";

            position: absolute;

            inset: 0;

            background:
                rgba(0, 0, 0, 0.12);

            z-index: 1;
        }

        /* =====================================================
           JUDUL DI DALAM LAYAR TV / VIDEOTRON
        ====================================================== */

        .aula-title {
            position: absolute;

            left: 0;
            right: 0;

            z-index: 2;

            display: flex;

            align-items: center;
            justify-content: center;

            text-align: center;

            pointer-events: none;
        }

        /* posisi layar videotron pada foto aula besar */
        .title-besar {
            top: 35%;
            height: 18%;
        }

        /* posisi layar TV pada foto aula kecil */
        .title-kecil {
            top: 25%;
            height: 16%;
        }

        .aula-title h3 {
            display: flex;
            flex-direction: column;

            font-size: 14px;

            font-weight: 800;

            color: white;

            letter-spacing: 2px;

            line-height: 1.2;

            text-transform: uppercase;

            text-shadow:
                0 1px 4px rgba(0, 0, 0, 0.65);
        }

        /* =====================================================
           ISI KARTU DI BAWAH FOTO
        ====================================================== */

        .aula-body {
            padding: 20px 22px 22px;

            display: flex;
            flex-direction: column;
            gap: 16px;

            flex: 1;
        }

        .aula-desc {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .aula-desc p {
            color: #475569;

            font-size: 14px;

            line-height: 1.5;
        }

        /* =====================================================
           BUTTON
        ====================================================== */

        .aula-action {
            display: flex;

            margin-top: auto;
        }

        .btn-pilih {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            width: 100%;

            min-height: 46px;

            padding: 11px 24px;

            background: #12355b;

            color: #ffffff;

            text-decoration: none;

            border-radius: 8px;

            font-size: 15px;

            font-weight: 800;

            transition:
                background 0.2s ease,
                transform 0.2s ease;
        }

        .btn-pilih:hover {
            background: #0d2846;

            transform: translateY(-1px);
        }

        /* =====================================================
           RESPONSIVE TABLET
        ====================================================== */

        @media (max-width: 900px) {

            .aula-list {
                grid-template-columns: 1fr;
            }

            .aula-photo {
                height: 320px;
            }
        }

        /* =====================================================
           RESPONSIVE MOBILE
        ====================================================== */

        @media (max-width: 600px) {

            .header-inner {
                flex-direction: column;

                align-items: flex-start;
            }

            .back-dashboard {
                width: 100%;

                text-align: center;
            }

            .page-heading h2 {
                font-size: 25px;
            }

            .aula-card {
                border-radius: 14px;
            }

            .aula-photo {
                height: 260px;
            }

            .aula-body {
                padding: 18px;
            }

            .aula-title h3 {
                font-size: 12px;

                letter-spacing: 1.5px;
            }
        }
    </style>
</head>

<body>

    {{-- ==========================================================
         HEADER
    =========================================================== --}}

    <header class="header">

        <div class="header-inner">

            <div class="brand">

                <h1>SAPA</h1>

                <p>
                    Sistem Aplikasi Pemakaian Aula
                </p>

            </div>

            <a
                href="{{ route('dashboard') }}"
                class="back-dashboard"
            >
                ← Kembali ke Dashboard
            </a>

        </div>

    </header>


    {{-- ==========================================================
         CONTENT
    =========================================================== --}}

    <main class="container">

        <div class="page-heading">

            <h2>
                Daftar Aula
            </h2>

            <p>
                Pilih aula yang sesuai dengan kebutuhan kegiatan Anda.
            </p>

        </div>


        {{-- ======================================================
             DAFTAR AULA
        ======================================================= --}}

        <div class="aula-list">

            @foreach ($aulas as $aula)

                @php

                    $namaAula = strtolower(
                        $aula->nama_aula ?? ''
                    );

                    if (
                        str_contains(
                            $namaAula,
                            'kecil'
                        )
                    ) {

                        $foto = asset(
                            'images/aula-kecil.jpg'
                        );

                        $optimal = '11 orang';

                        $ukuran = '7,6 x 4 m';

                        $fasilitas =
                            'TV 65 inch, Sound System';

                    } else {

                        $foto = asset(
                            'images/aula-besar.jpg'
                        );

                        $optimal =
                            'Sesuai kebutuhan';

                        $ukuran =
                            '15 x 10 m';

                        $fasilitas =
                            'Sistem Audio, Videotron';
                    }

                    $kata = preg_split(
                        '/\s+/',
                        trim($aula->nama_aula ?? '')
                    );

                    $barisSatu = $kata[0] ?? '';

                    $barisDua = implode(
                        ' ',
                        array_slice($kata, 1)
                    );

                @endphp


                <article class="aula-card">


                    {{-- ==================================================
                         FOTO + JUDUL DI DALAM LAYAR TV
                    =================================================== --}}

                    <div class="aula-photo">

                        <img
                            src="{{ $foto }}"
                            alt="{{ $aula->nama_aula }}"
                        >

                        <div
                            class="aula-title {{ str_contains($namaAula, 'kecil') ? 'title-kecil' : 'title-besar' }}"
                        >

                            <h3>
                                <span>{{ $barisSatu }}</span>

                                @if ($barisDua !== '')
                                    <span>{{ $barisDua }}</span>
                                @endif
                            </h3>

                        </div>

                    </div>


                    {{-- ==================================================
                         INFO AULA DI BAWAH FOTO
                    =================================================== --}}

                    <div class="aula-body">

                        <div class="aula-desc">

                            <p>
                                Kap {{ $aula->kapasitas > 30 ? '>' : '≤' }} 30 orang
                                ({{ $ukuran }})
                            </p>

                            <p>
                                Fasilitas: {{ $fasilitas }}
                            </p>

                        </div>


                        {{-- ==================================================
                             BUTTON
                        =================================================== --}}

                        <div class="aula-action">

                            <a
                                href="{{ route('pendaftaran.create', $aula) }}"
                                class="btn-pilih"
                            >
                                Daftar {{ $aula->nama_aula }}
                            </a>

                        </div>

                    </div>

                </article>

            @endforeach

        </div>

    </main>

</body>

</html>