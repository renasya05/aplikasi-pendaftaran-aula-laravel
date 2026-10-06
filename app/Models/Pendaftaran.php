<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pendaftaran extends Model
{
    protected $fillable = [
        'user_id',
        'aula_id',
        'nama_pemohon',
        'nip',
        'jabatan',
        'instansi',
        'unit_organisasi',
        'bagian_seksi',
        'peserta_asal',
        'tanggal_mulai',
        'tanggal_selesai',
        'kriteria_waktu',
        'jumlah_peserta',
        'keperluan',
        'status',
        'catatan_admin',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function aula(): BelongsTo
    {
        return $this->belongsTo(Aula::class);
    }
}