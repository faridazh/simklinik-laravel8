<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dokter extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'dokterid',
        'photo',
        'nosertif',
        'validtill',
        'nostr',
        'norekom',
        'nama',
        'namagelar',
        'tempatlahir',
        'datelahir',
        'alamat',
        'keterangan',
        'sertifikat',
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
