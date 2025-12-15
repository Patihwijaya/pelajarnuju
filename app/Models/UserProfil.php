<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class UserProfil extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'profils';

    protected $fillable = [
        'user_id',
        'username',
        'nik',
        'asal',
        'tempat_lahir',
        'tanggal_lahir',
        'kecamatan',
        'kelurahan',
        'hobi',
        'foto_profil',
        'sertifikat_kaderisasi',
        'nomor_ponsel'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
