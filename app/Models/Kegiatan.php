<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatan';

    protected $fillable = [
        'admin_id',
        'judul',
        'deskripsi',
        'lokasi',
        'tanggal_acara',
        'gambar',
    ];

    protected $casts = [
        'tanggal_acara' => 'date',
    ];

    public function galleries()
    {
        return $this->hasMany(KegiatanGallery::class, 'kegiatan_id');
    }
}
