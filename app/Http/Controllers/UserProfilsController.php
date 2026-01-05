<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserProfil;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserProfilsController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $profil = UserProfil::firstOrCreate(
            ['user_id' => $user->id],
            ['username' => $user->name]
        );

        return view('auth.profil', compact('user', 'profil'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('auth.pengaturan', compact('user'));
    }

    public function ubah(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'nomor_ponsel' => ['required', 'regex:/^08\d{8,11}$/'],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ]);
        $user->email = $request->email;
        $user->nomor_ponsel = $request->nomor_ponsel;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        try {
            $user->save();
            return back()->with('success', 'Profil berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi error: ' . $e->getMessage());
        }
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'username' => 'nullable|string|max:225',
            'nik' => 'nullable|string|max:225',
            'asal' => 'nullable|string|max:225',
            'tempat_lahir' => 'nullable|string|max:225',
            'tanggal_lahir' => 'nullable|date',
            'kecamatan' => 'nullable|string|max:225',
            'kelurahan' => 'nullable|string|max:225',
            'hobi' => 'nullable|string|max:225',
            'sertifikat_kaderisasi' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:100000',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:10000',
        ]);
        

        // ambil profil user
        $profil = UserProfil::firstOrCreate(
            ['user_id' => $user->id],
            ['username' => $user->name]
        );

        // update data teks
        $profil->fill([
            'username' => $request->username,
            'nik' => $request->nik,
            'asal' => $request->asal,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'kecamatan' => $request->kecamatan,
            'kelurahan' => $request->kelurahan,
            'hobi' => $request->hobi,
        ]);

        // upload foto profil
        if ($request->hasFile('foto_profil')) {
            $file = $request->file('foto_profil');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/foto_profil'), $filename);
            $profil->foto_profil = $filename;
        }

        // upload sertifikat
        if ($request->hasFile('sertifikat_kaderisasi')) {
            $files = $request->file('sertifikat_kaderisasi');
            $namaFile = time() . '_' . preg_replace('/[^A-Za-z0-9\-\_\.]/', '_', $files->getClientOriginalName());
            $files->move(public_path('uploads/sertifikat_kaderisasi'), $namaFile);
            $profil->sertifikat_kaderisasi = $namaFile;
        }

        // simpan ke database
        $profil->save();

        return redirect()->route('profil.index')->with('success', 'Profil berhasil diperbarui!');
    }
}
