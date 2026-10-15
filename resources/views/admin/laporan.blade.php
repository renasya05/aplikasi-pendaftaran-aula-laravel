@extends('layouts.app')

@section('title', 'Laporan Per Bulan | SAPA')

@section('content')


<div class="laporan-page">

    {{-- =========================
         HEADER
    ========================= --}}
    <div class="laporan-header no-print">
        <div class="header-content">

            <h1>
                Laporan Pemakaian Aula per Bulan
            </h1>

            <p>
                Rekap ketersediaan harian untuk bulan berjalan,
                sesuai aula yang dipilih.
            </p>

        </div>
    </div>


    {{-- =========================
         PILIH AULA
    ========================= --}}
    <div class="selector-card no-print">

        <div class="selector-title">
            Pilih Aula
        </div>

        <div class="aula-buttons">

            @foreach ($aulas as $aula)

                <a
                    href="{{ route('admin.laporan', [
                        'aula' => $aula->id,
                    ]) }}"
                    class="aula-btn {{ $aulaTerpilih && $aulaTerpilih->id === $aula->id ? 'active' : '' }}"
                >
                    {{ $aula->nama_aula }}
                </a>

            @endforeach

        </div>

    </div>


    {{-- =========================
         BULAN BERJALAN
    ========================= --}}
    <div class="month-navigation month-current no-print">

        <div class="month-title">
            {{ $judulBulan }}
        </div>

    </div>


    {{-- =========================
         REPORT
    ========================= --}}
    <div class="report-card">

        {{-- HEADER CETAK --}}
        <div class="print-header">

            <img
                class="print-logo"
                src="{{ asset('images/logo-sapa.svg') }}"
                alt=""
                width="44"
                height="44"
            >

            <h1>
                LAPORAN PEMAKAIAN AULA PER BULAN
            </h1>

            <h2>
                SAPA — Sistem Aplikasi untuk Layanan Akomodasi (Aula)
            </h2>

            <p>
                {{ $judulBulan }}
                —
                {{ $aulaTerpilih->nama_aula ?? 'Semua Aula' }}
            </p>

        </div>


        {{-- REPORT HEADER --}}
        <div class="report-top">

            <div class="report-title">

                <div class="report-icon">
                    <x-icon name="chart" />
                </div>

                <div>

                    <h2>
                        Rekap Pemakaian per Bulan
                    </h2>

                    <p>
                        Menampilkan bulan
                        {{ $judulBulan }}
                        untuk
                        {{ $aulaTerpilih->nama_aula ?? 'semua aula' }}.
                    </p>

                </div>

            </div>


            <button
                type="button"
                class="btn btn-print no-print"
                onclick="window.print()"
            >
                <x-icon name="printer" size="17" />
                Cetak Laporan
            </button>

        </div>


        {{-- LEGEND --}}
        <div class="rekap-legend">
            Keterangan Unit:
            Sekretariat, Inpub, Konpub, Aptika, Sandikami
        </div>

        <div class="rekap-legend legend-status">
            <span class="legend-title">Keterangan Status:</span>

            <span class="legend-item">
                <span class="legend-box box-disetujui"></span>
                Disetujui
            </span>

            <span class="legend-item">
                <span class="legend-box box-menunggu"></span>
                Menunggu
            </span>

            <span class="legend-item">
                <span class="legend-box box-ditolak"></span>
                Ditolak
            </span>
        </div>


        {{-- DATA PER BULAN --}}
        @foreach ($rekapBulanan as $bulanItem)

            <div class="rekap-month">

                <div class="rekap-month-title">
                    {{ $bulanItem['judul'] }}
                </div>

                <div class="rekap-table-scroll">

                    <table class="rekap-table">

                        <thead>

                            <tr>
                                <th class="col-tanggal">
                                    Tanggal
                                </th>

                                <th class="col-hari">
                                    Hari
                                </th>

                                <th>
                                    Pagi
                                    <span>08.00 - 13.00</span>
                                </th>

                                <th>
                                    Siang
                                    <span>14.00 - 16.00</span>
                                </th>

                                <th>
                                    Malam
                                    <span>18.00 - 21.00</span>
                                </th>
                            </tr>

                        </thead>


                        <tbody>

                            @forelse ($bulanItem['rows'] as $row)

                                <tr class="{{ in_array($row['hari'], ['Sabtu', 'Minggu']) ? 'weekend' : '' }}">
                                    <td class="col-tanggal">
                                        {{ $row['tanggal'] }}
                                    </td>

                                    <td class="col-hari">
                                        {{ $row['hari'] }}
                                    </td>

                                    <td class="{{ $row['pagiStatus'] ? 'cell-' . $row['pagiStatus'] : '' }}">
                                        {{ $row['pagi'] }}
                                    </td>

                                    <td class="{{ $row['siangStatus'] ? 'cell-' . $row['siangStatus'] : '' }}">
                                        {{ $row['siang'] }}
                                    </td>

                                    <td class="{{ $row['malamStatus'] ? 'cell-' . $row['malamStatus'] : '' }}">
                                        {{ $row['malam'] }}
                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td colspan="5">
                                        Belum ada data untuk ditampilkan.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        @endforeach

    </div>

</div>

@endsection