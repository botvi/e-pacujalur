<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gelanggang extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_gelanggang',
        'deskripsi',
        'gambar',
        'lokasi_gelanggang',
        'maps',
    ];
}
