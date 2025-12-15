<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UndianPacu extends Model
{
    use HasFactory;
    protected $fillable = [
        'event_id',
        'gelanggang_id',
        'participants',
        'tanggal',
        'jam',
    ];
    protected $casts = [
        'participants' => 'array',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function gelanggang()
    {
        return $this->belongsTo(Gelanggang::class);
    }
    public function Jalur()
    {
        return $this->belongsTo(Jalur::class);
    }
  
}
