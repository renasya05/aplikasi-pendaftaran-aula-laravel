<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendaftaranController extends Controller
{
    /**
     * Struktur organisasi dan bagian/seksi.
     */
    private function strukturOrganisasi(): array
    {
        return [
            'Sekretariat' => [
                'Subbagian Perencanaan dan Pelaporan',
                'Subbagian Keuangan dan Aset',
                'Subbagian Umum dan Kepegawaian',
            ],

            'Bidang Informasi Publik dan Statistik' => [
                'Seksi Layanan Informasi Publik',
                'Seksi Pengelolaan Informasi Publik dan Media',
                'Seksi Pengelolaan Data Statistik',
            ],

            'Bidang Komunikasi Publik' => [
                'Seksi Pengelolaan Opini Publik',
                'Seksi Sumber Daya Komunikasi Publik dan Kehumasan',
                'Seksi Kemitraan Komunikasi Publik dan Hubungan Media',
            ],

            'Bidang Aplikasi Informatika' => [
                'Seksi Pengembangan Aplikasi',
                'Seksi Infrastruktur E-Government',
                'Seksi Tata Kelola dan Ekosistem E-Government',
            ],

            'Bidang Persandian dan Keamanan Informasi' => [
                'Seksi Pengembangan Kapasitas Tata Kelola Persandian dan Keamanan Informasi',
                'Seksi Layanan Persandian dan Keamanan Informasi',
                'Seksi Monitoring, Evaluasi dan Audit Persandian dan Keamanan Informasi',
            ],
        ];
    }

    /**
     * Menampilkan form pendaftaran.
     */
    public function create(Aula $aula)
    {
        $struktur = $this->strukturOrganisasi();
        $user = Auth::user();

        return view(
            'pendaftaran.create',
            compact(
                'aula',
                'struktur',
                'user'
            )
        );
    }

    /**
     * Menyimpan pendaftaran baru.
     */
    public function store(Request $request)
    {
        /**
         * Validasi data form.
         */
        $validated = $request->validate([
            'aula_id' => [
                'required',
                'exists:aulas,id',
            ],

            'nama_pemohon' => [
                'required',
                'string',
                'max:255',
            ],

            'jabatan' => [
                'required',
                'string',
                'max:255',
            ],

            'peserta_asal' => [
                'required',
                'in:internal,internal_eksternal',
            ],

            'unit_organisasi' => [
                'nullable',
                'string',
                'max:255',
            ],

            'bagian_seksi' => [
                'nullable',
                'string',
                'max:255',
            ],

            'instansi' => [
                'nullable',
                'string',
                'max:255',
            ],

            'tanggal_mulai' => [
                'required',
                'date',
                'after_or_equal:today',
            ],

            'tanggal_selesai' => [
                'required',
                'date',
                'after_or_equal:tanggal_mulai',
            ],

            'kriteria_waktu' => [
                'required',
                'in:pagi_siang,siang_sore,malam',
            ],

            'jumlah_peserta' => [
                'required',
                'integer',
                'min:1',
            ],

            'keperluan' => [
                'required',
                'string',
            ],
        ]);

        /**
         * Struktur organisasi.
         */
        $struktur = $this->strukturOrganisasi();

        $pesertaAsal = $validated['peserta_asal'];

        $unitOrganisasi = null;
        $bagianSeksi = null;
        $instansi = null;

        /**
         * Peserta Internal.
         */
        if ($pesertaAsal === 'internal') {

            if (empty($validated['unit_organisasi'])) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'unit_organisasi' =>
                            'Bidang / Unit wajib dipilih untuk peserta internal.',
                    ]);
            }

            if (empty($validated['bagian_seksi'])) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'bagian_seksi' =>
                            'Bagian / Seksi wajib dipilih untuk peserta internal.',
                    ]);
            }

            $unitOrganisasi = $validated['unit_organisasi'];

            $bagianSeksi = $validated['bagian_seksi'];

            $instansi = 'DISKOMINFO';
        }

        /**
         * Peserta Eksternal.
         */
        elseif ($pesertaAsal === 'eksternal') {

            if (empty($validated['instansi'])) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'instansi' =>
                            'Nama Instansi / Organisasi wajib diisi untuk peserta eksternal.',
                    ]);
            }

            $instansi = $validated['instansi'];
        }

        /**
         * Peserta Internal & Eksternal.
         */
        elseif ($pesertaAsal === 'internal_eksternal') {

            if (empty($validated['unit_organisasi'])) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'unit_organisasi' =>
                            'Bidang / Unit wajib dipilih untuk peserta internal & eksternal.',
                    ]);
            }

            if (empty($validated['bagian_seksi'])) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'bagian_seksi' =>
                            'Bagian / Seksi wajib dipilih untuk peserta internal & eksternal.',
                    ]);
            }

            if (empty($validated['instansi'])) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'instansi' =>
                            'Nama Instansi / Organisasi wajib diisi untuk peserta internal & eksternal.',
                    ]);
            }

            $unitOrganisasi = $validated['unit_organisasi'];

            $bagianSeksi = $validated['bagian_seksi'];

            $instansi = $validated['instansi'];
        }

        /**
         * Validasi Unit Organisasi dan Bagian/Seksi.
         */
        if ($unitOrganisasi !== null) {

            if (!array_key_exists($unitOrganisasi, $struktur)) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'unit_organisasi' =>
                            'Bidang / Unit yang dipilih tidak valid.',
                    ]);
            }

            if (
                $bagianSeksi !== null &&
                !in_array(
                    $bagianSeksi,
                    $struktur[$unitOrganisasi],
                    true
                )
            ) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'bagian_seksi' =>
                            'Bagian / Seksi tidak sesuai dengan Bidang / Unit yang dipilih.',
                    ]);
            }
        }

        /**
         * Ambil data aula.
         */
        $aula = Aula::findOrFail(
            $validated['aula_id']
        );

        /**
         * Validasi kapasitas aula.
         */
        if (
            $validated['jumlah_peserta']
            >
            $aula->kapasitas
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'jumlah_peserta' =>
                        'Jumlah peserta melebihi kapasitas maksimum aula (' .
                        $aula->kapasitas .
                        ' orang).',
                ]);
        }

        /**
         * Cek bentrok jadwal.
         *
         * Pendaftaran dengan status menunggu
         * atau disetujui dianggap menggunakan jadwal.
         */
        $bentrok = Pendaftaran::query()
            ->where(
                'aula_id',
                $aula->id
            )
            ->whereIn(
                'status',
                [
                    'menunggu',
                    'disetujui',
                ]
            )
            ->whereNotNull(
                'tanggal_mulai'
            )
            ->whereNotNull(
                'tanggal_selesai'
            )
            ->where(
                'tanggal_mulai',
                '<=',
                $validated['tanggal_selesai']
            )
            ->where(
                'tanggal_selesai',
                '>=',
                $validated['tanggal_mulai']
            )
            ->where(
                'kriteria_waktu',
                $validated['kriteria_waktu']
            )
            ->exists();

        /**
         * Jika jadwal bentrok.
         */
        if ($bentrok) {

            $namaWaktu = [
                'pagi_siang' =>
                    'Pagi – Siang (08.00–13.00)',

                'siang_sore' =>
                    'Siang – Sore (14.00–16.00)',

                'malam' =>
                    'Malam (18.00–21.00)',
            ];

            return back()
                ->withInput()
                ->withErrors([
                    'kriteria_waktu' =>
                        'Waktu ' .
                        $namaWaktu[
                            $validated['kriteria_waktu']
                        ] .
                        ' sudah digunakan pada rentang tanggal tersebut. Silakan pilih waktu lain.',
                ]);
        }

        /**
         * Simpan pendaftaran.
         */
        Pendaftaran::create([
            'user_id' =>
                Auth::id(),

            'aula_id' =>
                $aula->id,

            'nama_pemohon' =>
                $validated['nama_pemohon'],

            'nip' =>
                '-',

            'jabatan' =>
                $validated['jabatan'],

            'instansi' =>
                $instansi,

            'unit_organisasi' =>
                $unitOrganisasi,

            'bagian_seksi' =>
                $bagianSeksi,

            'peserta_asal' =>
                $pesertaAsal,

            'tanggal_mulai' =>
                $validated['tanggal_mulai'],

            'tanggal_selesai' =>
                $validated['tanggal_selesai'],

            'kriteria_waktu' =>
                $validated['kriteria_waktu'],

            'jumlah_peserta' =>
                $validated['jumlah_peserta'],

            'keperluan' =>
                $validated['keperluan'],

            'status' =>
                'menunggu',

            'catatan_admin' =>
                null,
        ]);

        /**
         * Redirect ke riwayat.
         */
        return redirect()
            ->route(
                'pendaftaran.history'
            )
            ->with(
                'success',
                'Pendaftaran aula berhasil dikirim dan sedang menunggu persetujuan admin.'
            );
    }

    /**
     * Mengecek ketersediaan waktu.
     */
    public function availability(
        Request $request
    ) {
        $validated = $request->validate([
            'aula_id' => [
                'required',
                'exists:aulas,id',
            ],

            'tanggal_mulai' => [
                'required',
                'date',
            ],

            'tanggal_selesai' => [
                'required',
                'date',
                'after_or_equal:tanggal_mulai',
            ],
        ]);

        /**
         * Ambil waktu yang sudah digunakan.
         */
        $terpakai = Pendaftaran::query()
            ->where(
                'aula_id',
                $validated['aula_id']
            )
            ->whereIn(
                'status',
                [
                    'menunggu',
                    'disetujui',
                ]
            )
            ->whereNotNull(
                'tanggal_mulai'
            )
            ->whereNotNull(
                'tanggal_selesai'
            )
            ->where(
                'tanggal_mulai',
                '<=',
                $validated['tanggal_selesai']
            )
            ->where(
                'tanggal_selesai',
                '>=',
                $validated['tanggal_mulai']
            )
            ->whereIn(
                'kriteria_waktu',
                [
                    'pagi_siang',
                    'siang_sore',
                    'malam',
                ]
            )
            ->pluck(
                'kriteria_waktu'
            )
            ->unique()
            ->values()
            ->toArray();

        return response()->json([
            'terpakai' => $terpakai,
        ]);
    }

    /**
     * Riwayat pendaftaran milik user.
     */
    public function history()
    {
        $pendaftarans = Pendaftaran::with(
            'aula'
        )
            ->where(
                'user_id',
                Auth::id()
            )
            ->latest()
            ->get();

        return view(
            'pendaftaran.history',
            compact(
                'pendaftarans'
            )
        );
    }

    /**
     * Detail pendaftaran milik user.
     */
    public function show(
        Pendaftaran $pendaftaran
    ) {
        /**
         * Pastikan user hanya dapat melihat
         * pendaftarannya sendiri.
         */
        if (
            $pendaftaran->user_id
            !==
            Auth::id()
        ) {
            abort(403);
        }

        $pendaftaran->load(
            'aula'
        );

        return view(
            'pendaftaran.show',
            compact(
                'pendaftaran'
            )
        );
    }
}