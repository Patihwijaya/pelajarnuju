<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanSkIpnu extends Model
{
    protected $fillable = [
        'user_id',
        'nama',
        'no_hp',
        'asal',
        'surat_permhonan_pengesahan',
        'berita_acara_hasil_konferensi',
        'berita_acara_penyusunan_pengurus',
        'lampiran_susunan_pengurus',
        'surat_rekomendasi_mwcnu_prnu',
        'surat_rekomendasi_pac',
        'cv',
        'biodata',
        'surat_pernyataan',
        'hasil_konferensi',
        'lpj',
        'profil',
        'status',
        'catatan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
