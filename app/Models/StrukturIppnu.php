<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class StrukturIppnu extends Model
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
