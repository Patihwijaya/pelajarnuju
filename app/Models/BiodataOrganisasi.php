<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiodataOrganisasi extends Model
{
    use HasFactory;

    protected $table = 'biodata_organisasi';

    protected $fillable = [
        'admin_id',
        'nama_organisasi',
        'alamat_sekretariat',
        'nomor_hp_ketua',
        'nomor_hp_sekretaris',
        'nomor_hp_bendahara',
        'foto_profil',
        'upload_sk',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}