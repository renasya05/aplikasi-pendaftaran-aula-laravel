@extends('layouts.app')

@section('title', 'Informasi | SAPA')

@section('content')

<div class="info-page">

    {{-- Navbar kanan atas: hari, notifikasi, profil --}}
    @include('partials.topbar')


    {{-- =========================================================
         HEADER
    ========================================================== --}}

    <div class="info-header">

        <div class="info-label">
            INFORMASI
        </div>

        <h1>
            Informasi SAPA
        </h1>

        <p>
            Informasi aula, panduan pendaftaran, ketentuan pemakaian,
            pengumuman, dan bantuan untuk pengguna SAPA.
        </p>

    </div>


    {{-- NAVIGASI BAGIAN --}}

    <nav class="info-nav">

        <a href="#informasi-aula">Informasi Aula</a>
        <a href="#panduan-pendaftaran">Panduan Pendaftaran</a>
        <a href="#ketentuan-pemakaian">Ketentuan Pemakaian</a>
        <a href="#pengumuman">Pengumuman</a>
        <a href="#bantuan">Bantuan</a>

    </nav>


    {{-- =========================================================
         A. INFORMASI AULA
    ========================================================== --}}

    <section class="info-section" id="informasi-aula">

        <div class="info-section-head">
            <span class="info-section-icon">🏢</span>
            <div>
                <h2>Informasi Aula</h2>
                <p>Data aula yang dapat digunakan melalui SAPA.</p>
            </div>
        </div>

        @if($aulas->count() > 0)

            <div class="aula-grid">

                @foreach($aulas as $item)

                    <article class="aula-info-card">

                        @if($item['foto'])
                            <img
                                src="{{ $item['foto'] }}"
                                alt="{{ $item['aula']->nama_aula }}"
                                class="aula-info-photo"
                            >
                        @else
                            <div class="aula-info-photo aula-info-photo-empty">
                                🏢
                            </div>
                        @endif

                        <div class="aula-info-body">

                            <h3>{{ $item['aula']->nama_aula }}</h3>

                            <dl class="aula-info-list">

                                @if($item['kapasitas'])
                                    <div>
                                        <dt>Kapasitas</dt>
                                        <dd>{{ $item['kapasitas'] }}</dd>
                                    </div>
                                @endif

                                @if($item['ukuran'])
                                    <div>
                                        <dt>Ukuran</dt>
                                        <dd>{{ $item['ukuran'] }}</dd>
                                    </div>
                                @endif

                                @if($item['fasilitas'])
                                    <div>
                                        <dt>Fasilitas</dt>
                                        <dd>{{ $item['fasilitas'] }}</dd>
                                    </div>
                                @endif

                                @if($item['aula']->keterangan)
                                    <div>
                                        <dt>Keterangan</dt>
                                        <dd>{{ $item['aula']->keterangan }}</dd>
                                    </div>
                                @endif

                            </dl>

                            <a
                                href="{{ route('pendaftaran.create', $item['aula']) }}"
                                class="info-btn"
                            >
                                Daftar {{ $item['aula']->nama_aula }}
                            </a>

                        </div>

                    </article>

                @endforeach

            </div>

        @else

            <div class="info-empty">
                Belum ada data aula.
            </div>

        @endif

    </section>


    {{-- =========================================================
         B. PANDUAN PENDAFTARAN
    ========================================================== --}}

    <section class="info-section" id="panduan-pendaftaran">

        <div class="info-section-head">
            <span class="info-section-icon">📝</span>
            <div>
                <h2>Panduan Pendaftaran</h2>
                <p>Langkah-langkah mengajukan pemakaian aula.</p>
            </div>
        </div>

        <ol class="step-list">

            <li>
                <span class="step-number">1</span>
                <div class="step-text">
                    <strong>Login</strong>
                    Login menggunakan akun yang terdaftar.
                </div>
            </li>

            <li>
                <span class="step-number">2</span>
                <div class="step-text">
                    <strong>Buka menu Daftar Aula</strong>
                    Buka menu
                    <a href="{{ route('aulas') }}">Daftar Aula</a>.
                </div>
            </li>

            <li>
                <span class="step-number">3</span>
                <div class="step-text">
                    <strong>Pilih aula</strong>
                    Pilih aula sesuai kebutuhan.
                </div>
            </li>

            <li>
                <span class="step-number">4</span>
                <div class="step-text">
                    <strong>Isi formulir</strong>
                    Isi formulir pendaftaran dengan benar.
                </div>
            </li>

            <li>
                <span class="step-number">5</span>
                <div class="step-text">
                    <strong>Kirim pengajuan</strong>
                    Kirim pengajuan.
                </div>
            </li>

            <li>
                <span class="step-number">6</span>
                <div class="step-text">
                    <strong>Pantau status</strong>
                    Pantau status pengajuan melalui menu
                    <a href="{{ route('pendaftaran.history') }}">Riwayat Pendaftaran</a>.
                </div>
            </li>

        </ol>

    </section>


    {{-- =========================================================
         C. KETENTUAN PEMAKAIAN AULA
    ========================================================== --}}

    <section class="info-section" id="ketentuan-pemakaian">

        <div class="info-section-head">
            <span class="info-section-icon">📋</span>
            <div>
                <h2>Ketentuan Pemakaian Aula</h2>
                <p>Ketentuan umum yang perlu diperhatikan pemohon.</p>
            </div>
        </div>

        <ul class="rule-list">

            <li>
                <span class="rule-check">✓</span>
                Isi data pemohon dan kegiatan dengan benar.
            </li>

            <li>
                <span class="rule-check">✓</span>
                Pilih tanggal dan waktu sesuai kebutuhan.
            </li>

            <li>
                <span class="rule-check">✓</span>
                Periksa ketersediaan aula sebelum mengirim pengajuan.
            </li>

            <li>
                <span class="rule-check">✓</span>
                Pengajuan belum dianggap disetujui sebelum admin
                memberikan persetujuan.
            </li>

            <li>
                <span class="rule-check">✓</span>
                Pantau status pengajuan melalui Riwayat Pendaftaran.
            </li>

        </ul>

    </section>


    {{-- =========================================================
         D. PENGUMUMAN
    ========================================================== --}}

    <section class="info-section" id="pengumuman">

        <div class="info-section-head">
            <span class="info-section-icon">📢</span>
            <div>
                <h2>Pengumuman</h2>
                <p>
                    Informasi terkait ketersediaan aula, pemeliharaan
                    fasilitas, atau perubahan layanan.
                </p>
            </div>
        </div>

        @forelse($pengumumans as $pengumuman)

            <article class="announce-card">

                <div class="announce-title">
                    {{ $pengumuman['judul'] }}
                </div>

                @if(!empty($pengumuman['tanggal']))
                    <div class="announce-date">
                        {{ $pengumuman['tanggal'] }}
                    </div>
                @endif

                <p>{{ $pengumuman['isi'] }}</p>

            </article>

        @empty

            <div class="info-empty">
                Belum ada pengumuman.
            </div>

        @endforelse

    </section>


    {{-- =========================================================
         E. BANTUAN DAN KONTAK ADMIN
    ========================================================== --}}

    <section class="info-section" id="bantuan">

        <div class="info-section-head">
            <span class="info-section-icon">💬</span>
            <div>
                <h2>Bantuan dan Kontak Admin</h2>
                <p>Petunjuk untuk mengatasi kendala yang sering terjadi.</p>
            </div>
        </div>

        <div class="help-grid">

            <div class="help-card">
                <h3>Kendala Login</h3>
                <ul>
                    <li>Pastikan Anda memakai akun yang sudah terdaftar.</li>
                    <li>Periksa kembali email dan kata sandi yang dimasukkan.</li>
                    <li>Muat ulang halaman, lalu coba login kembali.</li>
                    <li>Jika masih gagal, hubungi admin.</li>
                </ul>
            </div>

            <div class="help-card">
                <h3>Kendala Pendaftaran</h3>
                <ul>
                    <li>Lengkapi semua kolom wajib pada formulir.</li>
                    <li>Periksa ketersediaan tanggal dan waktu pada Rekap Ketersediaan Aula di Dashboard.</li>
                    <li>Pastikan tanggal selesai tidak lebih awal dari tanggal mulai.</li>
                    <li>Pantau hasil pengajuan di Riwayat Pendaftaran.</li>
                </ul>
            </div>

            <div class="help-card">
                <h3>Verifikasi Lokasi</h3>
                <ul>
                    <li>Jika diminta, izinkan akses lokasi pada browser.</li>
                    <li>Pastikan lokasi (GPS) pada perangkat dalam keadaan aktif.</li>
                    <li>Muat ulang halaman, lalu ulangi verifikasi.</li>
                    <li>Jika masih gagal, hubungi admin.</li>
                </ul>
            </div>

        </div>


        <div class="contact-card">

            <h3>Kontak Admin</h3>

            @if(count($kontak) > 0)

                <ul class="contact-list">

                    @if(!empty($kontak['telepon']))
                        <li><strong>Telepon</strong> {{ $kontak['telepon'] }}</li>
                    @endif

                    @if(!empty($kontak['email']))
                        <li><strong>Email</strong> {{ $kontak['email'] }}</li>
                    @endif

                    @if(!empty($kontak['alamat']))
                        <li><strong>Alamat</strong> {{ $kontak['alamat'] }}</li>
                    @endif

                </ul>

            @else

                <p>
                    Kontak resmi admin belum tersedia di sistem.
                </p>

            @endif

        </div>

    </section>

</div>


<style>

/* =========================================================
   PAGE
========================================================= */

.info-page {
    max-width: 1100px;
    margin: 0 auto;
    padding: 35px 0 55px;
}

.info-header {
    margin-bottom: 18px;
}

.info-label {
    display: inline-flex;
    align-items: center;
    color: #12355b;
    background: #eef4f9;
    border: 1px solid #d9e5ef;
    border-radius: 6px;
    padding: 5px 9px;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 1px;
    margin-bottom: 9px;
}

.info-header h1 {
    margin: 0;
    color: #12355b;
    font-size: 27px;
    font-weight: 800;
    line-height: 1.25;
}

.info-header p {
    margin: 7px 0 0;
    color: #64748b;
    font-size: 14px;
    line-height: 1.6;
}


/* =========================================================
   NAVIGASI BAGIAN
========================================================= */

.info-nav {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 22px;
}

.info-nav a {
    padding: 8px 14px;
    background: #ffffff;
    border: 1px solid #dfe5ec;
    border-radius: 8px;
    color: #12355b;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    transition: .2s ease;
}

.info-nav a:hover {
    background: #12355b;
    border-color: #12355b;
    color: #ffffff;
}


/* =========================================================
   SECTION
========================================================= */

.info-section {
    margin-bottom: 22px;
    padding: 24px;
    background: #ffffff;
    border: 1px solid #dfe5ec;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(15, 23, 42, .045);
    scroll-margin-top: 20px;
}

.info-section-head {
    display: flex;
    align-items: center;
    gap: 14px;
    margin-bottom: 20px;
    padding-bottom: 16px;
    border-bottom: 1px solid #edf1f5;
}

.info-section-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    flex: 0 0 42px;
    background: #eff6ff;
    border-radius: 10px;
    font-size: 20px;
}

.info-section-head h2 {
    margin: 0;
    color: #12355b;
    font-size: 18px;
    font-weight: 800;
}

.info-section-head p {
    margin: 3px 0 0;
    color: #64748b;
    font-size: 13px;
}

.info-empty {
    padding: 28px;
    background: #f8fafc;
    border: 1px dashed #cbd5e1;
    border-radius: 10px;
    color: #64748b;
    font-size: 14px;
    font-weight: 700;
    text-align: center;
}


/* =========================================================
   INFORMASI AULA
========================================================= */

.aula-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 18px;
}

.aula-info-card {
    display: flex;
    flex-direction: column;
    overflow: hidden;
    background: #ffffff;
    border: 1px solid #dfe5ec;
    border-radius: 12px;
}

.aula-info-photo {
    display: block;
    width: 100%;
    height: 210px;
    object-fit: cover;
    background: #e2e8f0;
}

.aula-info-photo-empty {
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 40px;
}

.aula-info-body {
    display: flex;
    flex-direction: column;
    flex: 1;
    padding: 18px 20px 20px;
}

.aula-info-body h3 {
    margin: 0 0 12px;
    color: #12355b;
    font-size: 18px;
    font-weight: 800;
}

.aula-info-list {
    margin: 0 0 18px;
    flex: 1;
}

.aula-info-list > div {
    display: flex;
    gap: 12px;
    padding: 8px 0;
    border-bottom: 1px solid #f1f5f9;
    font-size: 13px;
    line-height: 1.55;
}

.aula-info-list > div:last-child {
    border-bottom: none;
}

.aula-info-list dt {
    flex: 0 0 92px;
    color: #64748b;
    font-weight: 700;
}

.aula-info-list dd {
    margin: 0;
    color: #1e293b;
    font-weight: 600;
}

.info-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    align-self: flex-start;
    min-height: 40px;
    padding: 0 17px;
    background: #12355b;
    color: #ffffff;
    border: 1px solid #12355b;
    border-radius: 7px;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    transition: .2s ease;
}

.info-btn:hover {
    background: #0f2c4c;
    border-color: #0f2c4c;
}


/* =========================================================
   PANDUAN PENDAFTARAN
========================================================= */

.step-list {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 14px;
    margin: 0;
    padding: 0;
    list-style: none;
}

.step-list li {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    padding: 14px 16px;
    background: #f8fafc;
    border: 1px solid #e5eaf0;
    border-radius: 10px;
}

.step-number {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 30px;
    height: 30px;
    flex: 0 0 30px;
    background: #12355b;
    border-radius: 50%;
    color: #ffffff;
    font-size: 13px;
    font-weight: 800;
}

.step-text {
    color: #475569;
    font-size: 13px;
    line-height: 1.55;
}

.step-text strong {
    display: block;
    color: #12355b;
    font-size: 14px;
    font-weight: 800;
}

.step-text a {
    color: #12355b;
    font-weight: 700;
}


/* =========================================================
   KETENTUAN
========================================================= */

.rule-list {
    margin: 0;
    padding: 0;
    list-style: none;
}

.rule-list li {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 12px 0;
    border-bottom: 1px solid #f1f5f9;
    color: #334155;
    font-size: 14px;
    line-height: 1.55;
}

.rule-list li:last-child {
    border-bottom: none;
}

.rule-check {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 22px;
    height: 22px;
    flex: 0 0 22px;
    background: #dcfce7;
    border-radius: 50%;
    color: #15803d;
    font-size: 12px;
    font-weight: 800;
}


/* =========================================================
   PENGUMUMAN
========================================================= */

.announce-card {
    margin-bottom: 12px;
    padding: 16px 18px;
    background: #f8fafc;
    border: 1px solid #e5eaf0;
    border-left: 4px solid #12355b;
    border-radius: 10px;
}

.announce-title {
    color: #12355b;
    font-size: 15px;
    font-weight: 800;
}

.announce-date {
    margin-top: 3px;
    color: #64748b;
    font-size: 12px;
}

.announce-card p {
    margin: 8px 0 0;
    color: #475569;
    font-size: 13px;
    line-height: 1.6;
}


/* =========================================================
   BANTUAN
========================================================= */

.help-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
    margin-bottom: 18px;
}

.help-card {
    padding: 18px;
    background: #f8fafc;
    border: 1px solid #e5eaf0;
    border-radius: 10px;
}

.help-card h3,
.contact-card h3 {
    margin: 0 0 10px;
    color: #12355b;
    font-size: 15px;
    font-weight: 800;
}

.help-card ul {
    margin: 0;
    padding-left: 18px;
    color: #475569;
    font-size: 13px;
    line-height: 1.6;
}

.help-card li {
    margin-bottom: 6px;
}

.contact-card {
    padding: 18px;
    background: #eff6ff;
    border: 1px solid #dbeafe;
    border-radius: 10px;
}

.contact-card p {
    margin: 0;
    color: #475569;
    font-size: 13px;
}

.contact-list {
    margin: 0;
    padding: 0;
    list-style: none;
    color: #334155;
    font-size: 13px;
    line-height: 1.8;
}

.contact-list strong {
    display: inline-block;
    min-width: 70px;
    color: #12355b;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 900px) {

    .aula-grid,
    .step-list {
        grid-template-columns: 1fr;
    }

    .help-grid {
        grid-template-columns: 1fr;
    }

}

@media (max-width: 600px) {

    .info-page {
        padding-top: 20px;
    }

    .info-header h1 {
        font-size: 22px;
    }

    .info-section {
        padding: 16px;
    }

    .aula-info-photo {
        height: 170px;
    }

    .aula-info-list > div {
        flex-direction: column;
        gap: 2px;
    }

    .aula-info-list dt {
        flex-basis: auto;
    }

    .info-btn {
        width: 100%;
    }

}

</style>

@endsection
