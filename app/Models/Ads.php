<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    protected $fillable = [
        'judul',
        'gambar',
        'link',
        'deskripsi',
        'status',
        'hit',
        'expired_at'
    ];

    protected $dates = ['expired_at'];
}
