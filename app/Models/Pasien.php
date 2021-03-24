<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pasien extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        // Identitas Pasien
        'norm',
        'nama',
        'kelamin',
        'headfamily',
        'hubfamily',
        'agama',
        'tempatlahir',
        'datelahir',
        'alamat',
        'telepon',
        'bpjs',
        'statusnikah',
        'pendidikan',
        'pekerjaan',

        // Rekam Medis
        'rmringan',

        // Riwayat Alergi
        'alergi',

        // Riwayat Penyakit Yang Diderita Saat Ini
        'penyakitskrg',

        // Riwayat Penyakit Pada Keluarga
        'penyakitfamily',

        // Riwayat Imunisasi
        'imunisasi',

        // Riwayat Keluarga Berencana (Kandungan)
        'kb_riwayat',
        'kb_operasi',

        // Riwayat Lain
        'riwayatrawat',
        'riwayatoperasi',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
}
