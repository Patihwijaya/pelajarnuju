<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KegiatanGallery extends Model
{
    protected $fillable = ['kegiatan_id', 'foto'];

    // Relasi balik ke tabel kegiatan
    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'kegiatan_id');
    }
}
