<?php

namespace App\Services;

use App\Models\Pendaftaran;
use Carbon\Carbon;

class RekapKetersediaan
{
    /*
    |--------------------------------------------------------------------------
    | TAHUN AKTIF DARI INPUT
    |--------------------------------------------------------------------------
    */

    public static function tahunAktif($input): int
    {
        $tahun = (int) $input;

        if ($tahun < 2000 || $tahun > 2100) {
            return (int) now()->format('Y');
        }

        return $tahun;
    }


    /*
    |--------------------------------------------------------------------------
    | REKAP HARIAN PER BULAN UNTUK SATU TAHUN
    |--------------------------------------------------------------------------
    |
    | Menghasilkan 12 blok bulan, masing-masing berisi baris
    | harian dengan isi sel singkatan unit pemakai waktu.
    |
    */

    public static function build(?int $aulaId, int $tahun, ?array $bulanList = null): array
    {
        $bulanList = $bulanList ?? range(1, 12);

        $awalTahun = Carbon::create(
            $tahun,
            1,
            1,
            0,
            0,
            0
        )->startOfDay();

        $akhirTahun = $awalTahun->copy()->endOfYear();


        /*
        |----------------------------------------------------------------------
        | Pendaftaran yang memakai jadwal
        |----------------------------------------------------------------------
        */

        $pendaftarans = Pendaftaran::whereIn('status', [
            'menunggu',
            'disetujui',
        ])
            ->where('aula_id', $aulaId)
            ->whereNotNull('tanggal_mulai')
            ->whereNotNull('tanggal_selesai')
            ->whereDate(
                'tanggal_mulai',
                '<=',
                $akhirTahun
            )
            ->whereDate(
                'tanggal_selesai',
                '>=',
                $awalTahun
            )
            ->whereIn('kriteria_waktu', [
                'pagi_siang',
                'siang_sore',
                'malam',
            ])
            ->get();


        /*
        |----------------------------------------------------------------------
        | Pemetaan unit dan waktu
        |----------------------------------------------------------------------
        */

        $unitSingkat = [
            'Sekretariat' => 'Sekretariat',

            'Bidang Informasi Publik dan Statistik' =>
                'Inpub',

            'Bidang Komunikasi Publik' =>
                'Konpub',

            'Bidang Aplikasi Informatika' =>
                'Aptika',

            'Bidang Persandian dan Keamanan Informasi' =>
                'Sandikami',
        ];

        $slotWaktu = [
            'pagi_siang' => 'pagi',
            'siang_sore' => 'siang',
            'malam' => 'malam',
        ];


        /*
        |----------------------------------------------------------------------
        | Booking per tanggal dan waktu
        |----------------------------------------------------------------------
        */

        $booking = [];
        $slotTerpakai = [];

        foreach ($pendaftarans as $pendaftaran) {
            $slot = $slotWaktu[
                $pendaftaran->kriteria_waktu
            ] ?? null;

            if ($slot === null) {
                continue;
            }

            $unit = $pendaftaran->unit_organisasi
                ?: ($pendaftaran->instansi
                    ?: 'Instansi Lain');

            $label = $unitSingkat[$unit] ?? $unit;

            $mulai = Carbon::parse(
                $pendaftaran->tanggal_mulai
            )->startOfDay();

            $selesai = Carbon::parse(
                $pendaftaran->tanggal_selesai
            )->startOfDay();

            $mulaiEfektif = $mulai->lessThan($awalTahun)
                ? $awalTahun->copy()
                : $mulai;

            $selesaiEfektif = $selesai->greaterThan($akhirTahun)
                ? $akhirTahun->copy()
                : $selesai;

            for (
                $tanggal = $mulaiEfektif->copy();
                $tanggal->lte($selesaiEfektif);
                $tanggal->addDay()
            ) {
                $tanggalKey = $tanggal->format('Y-m-d');

                $booking[$tanggalKey][$slot][] = $label;

                $slotTerpakai[$tanggalKey][$slot] = true;
            }
        }


        /*
        |----------------------------------------------------------------------
        | Susun baris harian untuk setiap bulan
        |----------------------------------------------------------------------
        */

        $namaBulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        $namaHari = [
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
            7 => 'Minggu',
        ];

        $rekapBulanan = [];

        foreach ($bulanList as $bulanIdx) {
            $awalBulan = Carbon::create(
                $tahun,
                $bulanIdx,
                1,
                0,
                0,
                0
            )->startOfDay();

            $akhirBulan = $awalBulan->copy()->endOfMonth();

            $rows = [];

            for (
                $tanggal = $awalBulan->copy();
                $tanggal->lte($akhirBulan);
                $tanggal->addDay()
            ) {
                $tanggalKey = $tanggal->format('Y-m-d');

                $sel = $booking[$tanggalKey] ?? [];

                $jumlahSlot = count(
                    $slotTerpakai[$tanggalKey] ?? []
                );

                if ($jumlahSlot === 0) {
                    $status = 'empty';
                } elseif ($jumlahSlot >= 3) {
                    $status = 'full';
                } else {
                    $status = 'used';
                }

                $rows[] = [
                    'key' => $tanggalKey,

                    'tanggal' => $tanggal->format('d/m/Y'),

                    'hari' => $namaHari[
                        $tanggal->dayOfWeekIso
                    ],

                    'status' => $status,

                    'pagi' => implode(
                        ', ',
                        array_unique($sel['pagi'] ?? [])
                    ),

                    'siang' => implode(
                        ', ',
                        array_unique($sel['siang'] ?? [])
                    ),

                    'malam' => implode(
                        ', ',
                        array_unique($sel['malam'] ?? [])
                    ),
                ];
            }

            $rekapBulanan[] = [
                'judul' => $namaBulan[$bulanIdx]
                    . ' '
                    . $tahun,

                'rows' => $rows,
            ];
        }


        return [
            'rekapBulanan' => $rekapBulanan,
            'tahun' => $tahun,
            'tahunSebelumnya' => $tahun - 1,
            'tahunBerikutnya' => $tahun + 1,
        ];
    }
}
