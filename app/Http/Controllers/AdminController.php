<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use App\Models\Pendaftaran;
use App\Services\RekapKetersediaan;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Kriteria Waktu
    |--------------------------------------------------------------------------
    */
    private function kriteriaWaktu(): array
    {
        return [
            'pagi_siang' => [
                'nama' => 'Pagi – Siang',
                'jam' => '08.00 – 13.00',
            ],

            'siang_sore' => [
                'nama' => 'Siang – Sore',
                'jam' => '14.00 – 16.00',
            ],

            'malam' => [
                'nama' => 'Malam',
                'jam' => '18.00 – 21.00',
            ],
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Dashboard Admin
    |--------------------------------------------------------------------------
    */
    public function dashboard()
    {
        $stats = [
            'totalPendaftar' => Pendaftaran::count(),

            'menunggu' => Pendaftaran::where(
                'status',
                'menunggu'
            )->count(),

            'disetujui' => Pendaftaran::where(
                'status',
                'disetujui'
            )->count(),

            'ditolak' => Pendaftaran::where(
                'status',
                'ditolak'
            )->count(),

            'aulas' => Aula::count(),
        ];


        /*
        |--------------------------------------------------------------------------
        | NOTIFIKASI PENGAJUAN BARU
        |--------------------------------------------------------------------------
        |
        | Pengajuan berstatus menunggu (pendaftaran baru)
        | ditampilkan sebagai notifikasi di dashboard admin.
        |
        */

        $notifikasi = Pendaftaran::with('aula')
            ->where('status', 'menunggu')
            ->latest('created_at')
            ->limit(6)
            ->get();


        return view('admin.dashboard', [
            'stats' => $stats,
            'notifikasi' => $notifikasi,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Riwayat Pendaftaran Admin
    |--------------------------------------------------------------------------
    */
    public function history(Request $request)
    {
        $query = Pendaftaran::with([
            'user',
            'aula',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Filter Status
        |--------------------------------------------------------------------------
        */
        if (
            $request->filled('status') &&
            $request->status !== 'semua'
        ) {
            $query->where(
                'status',
                $request->status
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Ambil Data
        |--------------------------------------------------------------------------
        */
        $pendaftarans = $query
            ->orderByDesc('created_at')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Kirim ke Blade
        |--------------------------------------------------------------------------
        */
        return view('admin.history', [
            'pendaftarans' => $pendaftarans,

            'statusAktif' => $request->status ?? 'semua',
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Detail Pendaftaran
    |--------------------------------------------------------------------------
    */
    public function show(Pendaftaran $pendaftaran)
    {
        $pendaftaran->load([
            'user',
            'aula',
        ]);

        return view(
            'admin.pendaftaran.show',
            [
                'pendaftaran' => $pendaftaran,
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Approve Pendaftaran
    |--------------------------------------------------------------------------
    */
    public function approve(Pendaftaran $pendaftaran)
    {
        /*
        |--------------------------------------------------------------------------
        | Hanya pengajuan menunggu yang dapat diproses
        |--------------------------------------------------------------------------
        */
        if ($pendaftaran->status !== 'menunggu') {
            return back()->with(
                'error',
                'Pengajuan ini sudah diproses sebelumnya.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Cek Bentrok Jadwal
        |--------------------------------------------------------------------------
        */
        $bentrok = Pendaftaran::where(
                'id',
                '!=',
                $pendaftaran->id
            )
            ->where(
                'aula_id',
                $pendaftaran->aula_id
            )
            ->where(
                'status',
                'disetujui'
            )
            ->whereNotNull('tanggal_mulai')
            ->whereNotNull('tanggal_selesai')
            ->where(
                'tanggal_mulai',
                '<=',
                $pendaftaran->tanggal_selesai
            )
            ->where(
                'tanggal_selesai',
                '>=',
                $pendaftaran->tanggal_mulai
            )
            ->where(
                'kriteria_waktu',
                $pendaftaran->kriteria_waktu
            )
            ->exists();


        /*
        |--------------------------------------------------------------------------
        | Jika Bentrok
        |--------------------------------------------------------------------------
        */
        if ($bentrok) {

            $namaWaktu = [
                'pagi_siang' => 'Pagi – Siang',
                'siang_sore' => 'Siang – Sore',
                'malam' => 'Malam',
            ];

            $waktu = $namaWaktu[
                $pendaftaran->kriteria_waktu
            ] ?? 'waktu tersebut';

            return back()->with(
                'error',
                'Pengajuan tidak dapat disetujui karena jadwal '
                . $waktu
                . ' pada aula dan tanggal tersebut sudah digunakan.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Setujui
        |--------------------------------------------------------------------------
        */
        $pendaftaran->update([
            'status' => 'disetujui',
            'catatan_admin' => null,
        ]);


        return back()->with(
            'success',
            'Pengajuan berhasil disetujui.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Reject Pendaftaran
    |--------------------------------------------------------------------------
    */
    public function reject(
        Request $request,
        Pendaftaran $pendaftaran
    ) {
        $validated = $request->validate(
            [
                'catatan_admin' => [
                    'required',
                    'string',
                    'max:1000',
                ],
            ],
            [
                'catatan_admin.required' =>
                    'Catatan penolakan wajib diisi.',
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | Tolak Pengajuan
        |--------------------------------------------------------------------------
        */
        $pendaftaran->update([
            'status' => 'ditolak',
            'catatan_admin' =>
                $validated['catatan_admin'],
        ]);


        return back()->with(
            'success',
            'Pengajuan berhasil ditolak.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Laporan
    |--------------------------------------------------------------------------
    */
    public function laporan(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Data Aula
        |--------------------------------------------------------------------------
        */
        $aulas = Aula::orderBy(
            'nama_aula'
        )->get();

        $aulaTerpilih = $aulas->firstWhere(
            'id',
            (int) $request->input('aula')
        ) ?? $aulas->first();


        /*
        |--------------------------------------------------------------------------
        | Rekap Harian Per Bulan
        |--------------------------------------------------------------------------
        |
        | Format laporan disamakan dengan rekap pada
        | dashboard pengguna: tabel harian bertumpuk
        | untuk setiap bulan pada tahun yang dipilih.
        |
        */
        $tahun = RekapKetersediaan::tahunAktif(
            $request->input('tahun')
        );

        $rekap = RekapKetersediaan::build(
            $aulaTerpilih?->id,
            $tahun
        );

        return view('admin.laporan', [
            'aulas' => $aulas,

            'aulaTerpilih' => $aulaTerpilih,

            'rekapBulanan' => $rekap['rekapBulanan'],

            'tahun' => $rekap['tahun'],

            'tahunSebelumnya' => $rekap['tahunSebelumnya'],

            'tahunBerikutnya' => $rekap['tahunBerikutnya'],
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Data Aula
    |--------------------------------------------------------------------------
    */
    public function aulas()
    {
        $aulas = Aula::latest()->get();

        return view(
            'admin.aulas.index',
            [
                'aulas' => $aulas,
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Create Aula
    |--------------------------------------------------------------------------
    */
    public function createAula()
    {
        return view(
            'admin.aulas.create'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Store Aula
    |--------------------------------------------------------------------------
    */
    public function storeAula(Request $request)
    {
        $validated = $request->validate([
            'nama_aula' => [
                'required',
                'string',
                'max:255',
            ],

            'kapasitas' => [
                'required',
                'integer',
                'min:1',
            ],

            'keterangan' => [
                'required',
                'string',
            ],

            'fasilitas' => [
                'nullable',
                'string',
            ],
        ]);


        Aula::create($validated);


        return redirect()
            ->route('admin.aulas')
            ->with(
                'success',
                'Data aula berhasil ditambahkan.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Show Aula
    |--------------------------------------------------------------------------
    */
    public function showAula(Aula $aula)
    {
        return view(
            'admin.aulas.show',
            [
                'aula' => $aula,
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Edit Aula
    |--------------------------------------------------------------------------
    */
    public function editAula(Aula $aula)
    {
        return view(
            'admin.aulas.edit',
            [
                'aula' => $aula,
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Update Aula
    |--------------------------------------------------------------------------
    */
    public function updateAula(
        Request $request,
        Aula $aula
    ) {
        $validated = $request->validate([
            'nama_aula' => [
                'required',
                'string',
                'max:255',
            ],

            'kapasitas' => [
                'required',
                'integer',
                'min:1',
            ],

            'keterangan' => [
                'required',
                'string',
            ],

            'fasilitas' => [
                'nullable',
                'string',
            ],
        ]);


        $aula->update($validated);


        return redirect()
            ->route('admin.aulas')
            ->with(
                'success',
                'Data aula berhasil diperbarui.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Delete Aula
    |--------------------------------------------------------------------------
    */
    public function destroyAula(
        Aula $aula
    ) {
        $aula->delete();


        return redirect()
            ->route('admin.aulas')
            ->with(
                'success',
                'Data aula berhasil dihapus.'
            );
    }
}