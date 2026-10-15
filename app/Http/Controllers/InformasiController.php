<?php

namespace App\Http\Controllers;

use App\Models\Aula;

class InformasiController extends Controller
{
    /**
     * Halaman Informasi untuk pengguna:
     * informasi aula, panduan pendaftaran, ketentuan pemakaian,
     * pengumuman, serta bantuan.
     */
    public function index()
    {
        /*
        |----------------------------------------------------------------------
        | Informasi aula
        |----------------------------------------------------------------------
        |
        | Nama, keterangan, dan id aula diambil dari database.
        | Kapasitas, ukuran, fasilitas, dan foto mengikuti data yang sudah
        | dipakai di Dashboard dan Daftar Aula (dikenali dari nama aula).
        | Aula lain yang mungkin ditambahkan admin tetap tampil memakai
        | data dari database tanpa foto.
        |
        */

        $aulas = Aula::orderBy('nama_aula')->get()->map(function ($aula) {

            $nama = strtolower($aula->nama_aula ?? '');

            if (str_contains($nama, 'kecil')) {

                return [
                    'aula' => $aula,
                    'foto' => asset('images/aula-kecil.jpg'),
                    'kapasitas' => 'Maksimal 30 orang',
                    'ukuran' => 'Sekitar 7,6 × 4 meter',
                    'fasilitas' => 'TV 65 inch',
                ];
            }

            if (str_contains($nama, 'besar')) {

                return [
                    'aula' => $aula,
                    'foto' => asset('images/aula-besar.jpg'),
                    'kapasitas' => 'Lebih dari 100 orang',
                    'ukuran' => 'Sekitar 15 × 10 meter',
                    'fasilitas' => 'Sistem Audio, Videotron, Lighting, Panggung',
                ];
            }

            return [
                'aula' => $aula,
                'foto' => null,
                'kapasitas' => $aula->kapasitas
                    ? $aula->kapasitas . ' orang'
                    : null,
                'ukuran' => null,
                'fasilitas' => $aula->fasilitas,
            ];
        });


        /*
        |----------------------------------------------------------------------
        | Pengumuman
        |----------------------------------------------------------------------
        |
        | Belum ada sumber data pengumuman di proyek, sehingga daftar
        | dikosongkan dan halaman menampilkan pesan "belum ada pengumuman".
        | Jika nanti ada tabel pengumuman, isi variabel ini dengan data
        | berformat: judul, isi, tanggal.
        |
        */

        $pengumumans = collect();


        /*
        |----------------------------------------------------------------------
        | Kontak admin
        |----------------------------------------------------------------------
        |
        | Hanya tampil jika sudah diisi di .env (lihat config/sapa.php).
        |
        */

        $kontak = array_filter(
            config('sapa.kontak_admin', [])
        );

        return view(
            'informasi.index',
            compact('aulas', 'pengumumans', 'kontak')
        );
    }
}
