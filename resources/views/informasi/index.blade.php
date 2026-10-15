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
            <span class="info-section-icon"><x-icon name="building" /></span>
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
                                <x-icon name="building" size="42" />
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
            <span class="info-section-icon"><x-icon name="pencil" /></span>
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
            <span class="info-section-icon"><x-icon name="checklist" /></span>
            <div>
                <h2>Ketentuan Pemakaian Aula</h2>
                <p>Ketentuan umum yang perlu diperhatikan pemohon.</p>
            </div>
        </div>

        <ul class="rule-list">

            <li>
                <span class="rule-check"><x-icon name="check" size="14" /></span>
                Isi data pemohon dan kegiatan dengan benar.
            </li>

            <li>
                <span class="rule-check"><x-icon name="check" size="14" /></span>
                Pilih tanggal dan waktu sesuai kebutuhan.
            </li>

            <li>
                <span class="rule-check"><x-icon name="check" size="14" /></span>
                Periksa ketersediaan aula sebelum mengirim pengajuan.
            </li>

            <li>
                <span class="rule-check"><x-icon name="check" size="14" /></span>
                Pengajuan belum dianggap disetujui sebelum admin
                memberikan persetujuan.
            </li>

            <li>
                <span class="rule-check"><x-icon name="check" size="14" /></span>
                Pantau status pengajuan melalui Riwayat Pendaftaran.
            </li>

        </ul>

    </section>


    {{-- =========================================================
         D. PENGUMUMAN
    ========================================================== --}}

    <section class="info-section" id="pengumuman">

        <div class="info-section-head">
            <span class="info-section-icon"><x-icon name="megaphone" /></span>
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
            <span class="info-section-icon"><x-icon name="message" /></span>
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



@endsection
