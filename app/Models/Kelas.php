<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    protected $fillable = [
        'nama_kelas',
        'gambar_kelas',
        'deskripsi'
    ];

    public function materis()
    {
        return $this->hasMany(materis::class);
        return $this->hasMany(materis::class, 'kelas_id', 'id');
    }
}
