<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Tambahkan ini
        'alamat_sekretariat',  // Sesuaikan namanya
        'nomor_hp_ketua',      // Sesuaikan namanya
        'nomor_hp_sekretaris', // Sesuaikan namanya
        'nomor_hp_bendahara',  // Sesuaikan namanya
        'foto_profil',         // Sesuaikan namanya
        'upload_sk',           // Sesuaikan namanya
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function isSuperAdmin()
    {
        return $this->role === 'super_admin';
    }

    public function isAdminPAC()
    {
        return $this->role === 'admin';
    }
    public function isAdminUtama()
    {
        // Asumsi: Admin utama adalah admin pertama di database (ID = 1)
        // Anda juga bisa menggantinya dengan mengecek email khusus, misal:
        // return $this->email === 'admin@pelajarnuju.com';
        return $this->id === 1; 
    }
    public function biodataOrganisasi()
    {
        return $this->hasOne(BiodataOrganisasi::class, 'admin_id');
    }
}
