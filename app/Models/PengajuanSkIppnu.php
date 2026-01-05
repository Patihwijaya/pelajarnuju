<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanSkIppnu extends Model
{
    protected $fillable = [
        'user_id',
        'nama',
        'no_hp',
        'asal',
        'surat_permohonan_pengesahan',
        'berita_acara_surat_keputusan_konferensi',
        'berita_acara_penyusunan_pengurus_oleh_tim_formatur',
        'berita_acara_penyusunan_pengurus_oleh_pengurus_harian',
        'susunan_pengurus_lengkap',
        'foto_kartu_identitas_pengurus_harian_dan_ketua_lembaga',
        'surat_rekomendasi_mwcnu_atau_prnu',
        'surat_rekomendasi_pimpinan_lembaga_pendidikan',
        'surat_rekomendasi_pac_ippnu',
        'status',
        'catatan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
