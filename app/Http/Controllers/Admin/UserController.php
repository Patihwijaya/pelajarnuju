<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth; // Wajib ditambahkan untuk mengecek siapa yang login

class UserController extends Controller
{
    public function index()
    {
        // 1. Cek admin yang sedang login
        $admin = Auth::guard('admin')->user();

        // 2. Filter data berdasarkan Role
        if ($admin->isSuperAdmin()) {
            // PC (Super Admin): Bebas melihat semua user se-Jakarta Utara
            // Saya tambahkan latest() agar user terbaru selalu muncul di atas
            $users = User::with('profil')->latest()->get(); 
        } else {
            // PAC (Admin): Hanya bisa melihat user yang kecamatannya sesuai dengan 'asal' PAC
            $users = User::whereHas('profil', function($query) use ($admin) {
                $query->where('kecamatan', $admin->asal);
            })->with('profil')->latest()->get();
        }

        // View-nya tetap menggunakan file blade yang sama, jadi tidak perlu ubah frontend
        return view('admin.users.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::with('profil')->findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        $user->delete();

        // 3. Pengecekan arah kembalinya (Redirect) karena route PC dan PAC dipisah
        $admin = Auth::guard('admin')->user();
        
        if ($admin->isSuperAdmin()) {
            return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus!');
        } else {
            return redirect()->route('pac.users.index')->with('success', 'User berhasil dihapus!');
        }
    }
}