<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JuaraPacuJalur extends Model
{
    use HasFactory;
    protected $fillable = [
        'gelanggang_id',
        'event_id',
        'tahun',
        'daftar_juara',
    ];

    protected $casts = [
        'daftar_juara' => 'array',
    ];

    public function gelanggang()
    {
        return $this->belongsTo(Gelanggang::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function jalurs()
    {
        return $this->belongsToMany(Jalur::class, 'juara_pacu_jalur_jalur', 'juara_pacu_jalur_id', 'jalur_id');
    }

    // Helper method untuk mendapatkan jalur dari daftar_juara JSON
    public function getJalurFromDaftarJuara()
    {
        if (!is_array($this->daftar_juara)) {
            return collect();
        }

        $jalurIds = collect($this->daftar_juara)->pluck('jalur_id')->filter()->unique();
        return Jalur::whereIn('id', $jalurIds)->get();
    }
}
