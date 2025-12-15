<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StrukturIpnu extends Model
{
    use HasFactory;

    protected $fillable = ([
        'admin_id',
        'nama',
        'jabatan',
        'instagram',
        'gambar',
    ]);
}
