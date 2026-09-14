<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    protected $fillable = [
        'authorable_id', 'authorable_type', 'title', 'slug', 'content', 'kategori', 'gambar', 'status', 'penulis', 'verifier_id', 'verifier_type'
    ];

    public function user()
    {
        return $this->belongsTo(user::class);
    }
}
