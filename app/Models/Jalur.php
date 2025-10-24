<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jalur extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_jalur',
        'deskripsi',
        'gambar',
        'asal_jalur',
        'tahun_buat',
    ];

    
}
