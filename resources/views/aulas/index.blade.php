@extends('layouts.app')

@section('title', 'Daftar Aula | SAPA')

@section('content')

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

            if (str_contains($namaAula, 'kecil')) {

                $foto = asset('images/aula-kecil.jpg');

                $ukuran = '7,6 x 4 m';

                $fasilitas = 'TV 65 inch';

            } else {

                $foto = asset('images/aula-besar.jpg');

                $ukuran = '15 x 10 m';

                $fasilitas = 'Sistem Audio, Videotron, Laptop, Panggung';

            }

        @endphp


        <article class="aula-card">

            {{-- FOTO (nama aula sudah ada di dalam foto) --}}

            <div class="aula-photo">

                <img
                    src="{{ $foto }}"
                    alt="{{ $aula->nama_aula }}"
                >

            </div>


            {{-- INFO AULA DI BAWAH FOTO --}}

            <div class="aula-body">

                <div class="aula-desc">

                    <p>
                        Kap : {{ $aula->kapasitas }} orang
                        ({{ $ukuran }})
                    </p>

                    <p>
                        Fasilitas: {{ $fasilitas }}
                    </p>

                </div>


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

@endsection
