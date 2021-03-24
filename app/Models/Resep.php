<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Resep extends Model
{
    // use HasFactory;
    // use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'norm',
        'nama',
        'resep',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
