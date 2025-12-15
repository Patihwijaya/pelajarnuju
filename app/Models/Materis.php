<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Materis extends Model
{
    use HasFactory;

    protected $table = 'materis';
    protected $fillable = [
        'kelas_id',
        'judul_materi',
        'konten',
        'gambar',
        'video_url'
    ];

    public function kelas()
    {
        return $this->belongsTo(kelas::class);
    }
}
