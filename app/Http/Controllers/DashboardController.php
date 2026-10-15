<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use App\Models\Pendaftaran;
use App\Services\RekapKetersediaan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | STATISTIK PENDAFTARAN USER
        |--------------------------------------------------------------------------
        */

        $totalPendaftaran = Pendaftaran::where(
            'user_id',
            $user->id
        )->count();

        $menunggu = Pendaftaran::where(
            'user_id',
            $user->id
        )
            ->where('status', 'menunggu')
            ->count();

        $disetujui = Pendaftaran::where(
            'user_id',
            $user->id
        )
            ->where('status', 'disetujui')
            ->count();

        $ditolak = Pendaftaran::where(
            'user_id',
            $user->id
        )
            ->where('status', 'ditolak')
            ->count();


        /*
        |--------------------------------------------------------------------------
        | BULAN BERJALAN (REALTIME)
        |--------------------------------------------------------------------------
        |
        | Rekap harian hanya menampilkan bulan yang sedang
        | berjalan saat ini, mengikuti tanggal sistem.
        |
        */

        $tahun = (int) now()->format('Y');

        $bulanIni = (int) now()->format('n');


        /*
        |--------------------------------------------------------------------------
        | DATA AULA
        |--------------------------------------------------------------------------
        */

        $aulas = Aula::orderBy('nama_aula')->get();

        $aulaTerpilih = $aulas->firstWhere(
            'id',
            (int) $request->input('aula')
        ) ?? $aulas->first();


        /*
        |--------------------------------------------------------------------------
        | STATISTIK PER AULA (MILIK USER)
        |--------------------------------------------------------------------------
        */

        $statistikAula = [];

        foreach ($aulas as $aulaItem) {
            $statistikAula[$aulaItem->id] = [
                'total' => Pendaftaran::where('user_id', $user->id)
                    ->where('aula_id', $aulaItem->id)
                    ->count(),

                'menunggu' => Pendaftaran::where('user_id', $user->id)
                    ->where('aula_id', $aulaItem->id)
                    ->where('status', 'menunggu')
                    ->count(),

                'disetujui' => Pendaftaran::where('user_id', $user->id)
                    ->where('aula_id', $aulaItem->id)
                    ->where('status', 'disetujui')
                    ->count(),

                'ditolak' => Pendaftaran::where('user_id', $user->id)
                    ->where('aula_id', $aulaItem->id)
                    ->where('status', 'ditolak')
                    ->count(),
            ];
        }


        /*
        |--------------------------------------------------------------------------
        | REKAP HARIAN BULAN INI
        |--------------------------------------------------------------------------
        */

        $rekap = RekapKetersediaan::build(
            $aulaTerpilih?->id,
            $tahun,
            [$bulanIni],
            ['menunggu', 'disetujui', 'ditolak']
        );

        $rekapBulanIni = $rekap['rekapBulanan'][0] ?? null;


        /*
        |--------------------------------------------------------------------------
        | VIEW DASHBOARD PENGGUNA
        |--------------------------------------------------------------------------
        */

        return view(
            'dashboard',
            compact(
                'totalPendaftaran',
                'menunggu',
                'disetujui',
                'ditolak',
                'aulas',
                'aulaTerpilih',
                'tahun',
                'rekapBulanIni',
                'statistikAula'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | DAFTAR AULA
    |--------------------------------------------------------------------------
    */

    public function aulas()
    {
        $aulas = Aula::latest()->get();

        return view(
            'aulas.index',
            [
                'aulas' => $aulas,
            ]
        );
    }
}
