<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\BiodataOrganisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class AdminsController extends Controller
{
    public function index()
    {
        $admins = Admin::orderBy('created_at', 'desc')->get();

        return view('admin.admins.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.admins.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:admins,email',
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()],
            'role' => ['required', Rule::in(['super_admin', 'admin'])],
            'asal' => 'nullable|string|max:255', // Tambahan: Validasi asal PAC
        ]);

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'asal' => $request->asal, // Tambahan: Simpan asal kecamatan PAC
        ]);

        return redirect()->route('admin.admins.index')->with('success', 'Admin berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);

        return view('admin.admins.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()],
            'role' => ['nullable', Rule::in(['super_admin', 'admin'])],
            'asal' => 'nullable|string|max:255', // Tambahan: Validasi asal PAC
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'asal' => $request->asal, // Tambahan: Update asal kecamatan PAC
        ];

        // Role hanya dapat diubah untuk akun selain 'Admin Utama'.
        if (!$admin->isAdminUtama() && $request->has('role')) {
            $data['role'] = $request->role;
        }

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $admin->update($data);

        return redirect()->route('admin.admins.index')->with('success', 'Admin berhasil diperbarui!');
    }

    public function destroy(Admin $admin)
    {
        if ($admin->isAdminUtama()) {
            return back()->with('error', 'Akun Admin Utama tidak dapat dihapus.');
        }

        if ($admin->id === Auth::guard('admin')->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        $admin->delete();

        return redirect()->route('admin.admins.index')->with('success', 'Admin berhasil dihapus!');
    }

    public function biodata(Admin $admin)
    {
        $adminTarget = $admin;
        $biodata = BiodataOrganisasi::where('admin_id', $adminTarget->id)->first();

        return view('admin.admins.biodata', compact('adminTarget', 'biodata'));
    }

    public function updateBiodata(Request $request, Admin $admin)
    {
        $validated = $request->validate([
            'nama_organisasi' => 'required|string|max:255',
            'alamat_sekretariat' => 'required|string',
            'nomor_hp_ketua' => 'nullable|string|max:20',
            'nomor_hp_sekretaris' => 'nullable|string|max:20',
            'nomor_hp_bendahara' => 'nullable|string|max:20',
            'foto_profil' => 'nullable|image|max:2048',
            'upload_sk' => 'nullable|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $biodata = BiodataOrganisasi::where('admin_id', $admin->id)->first();

        if ($biodata) {
            if ($request->hasFile('foto_profil')) {
                $oldPath = public_path('uploads/biodata/' . $biodata->foto_profil);
                if ($biodata->foto_profil && file_exists($oldPath)) {
                    unlink($oldPath);
                }
                $validated['foto_profil'] = time() . '_foto.' . $request->foto_profil->extension();
                $request->foto_profil->move(public_path('uploads/biodata'), $validated['foto_profil']);
            } else {
                unset($validated['foto_profil']);
            }

            if ($request->hasFile('upload_sk')) {
                $oldPath = public_path('uploads/biodata/' . $biodata->upload_sk);
                if ($biodata->upload_sk && file_exists($oldPath)) {
                    unlink($oldPath);
                }
                $validated['upload_sk'] = time() . '_sk.' . $request->upload_sk->extension();
                $request->upload_sk->move(public_path('uploads/biodata'), $validated['upload_sk']);
            } else {
                unset($validated['upload_sk']);
            }

            $biodata->update($validated);
        } else {
            if ($request->hasFile('foto_profil')) {
                $validated['foto_profil'] = time() . '_foto.' . $request->foto_profil->extension();
                $request->foto_profil->move(public_path('uploads/biodata'), $validated['foto_profil']);
            }

            if ($request->hasFile('upload_sk')) {
                $validated['upload_sk'] = time() . '_sk.' . $request->upload_sk->extension();
                $request->upload_sk->move(public_path('uploads/biodata'), $validated['upload_sk']);
            }

            $validated['admin_id'] = $admin->id;
            BiodataOrganisasi::create($validated);
        }

        return redirect()->route('admin.admins.biodata', $admin->id)->with('success', 'Biodata organisasi berhasil disimpan!');
    }
    
    public function myBiodata()
    {
        $admin = Auth::guard('admin')->user();
        $biodata = BiodataOrganisasi::where('admin_id', $admin->id)->first();

        return view('pac.biodata.index', compact('admin', 'biodata'));
    }

    /**
     * Menyimpan/Update Biodata PAC ke tabel biodata_organisasi
     */
    public function updateMyBiodata(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $request->validate([
            'nama_organisasi'     => 'required|string|max:255',
            'alamat_sekretariat'  => 'required|string',
            'nomor_hp_ketua'      => 'nullable|string|max:25',
            'nomor_hp_sekretaris' => 'nullable|string|max:25',
            'nomor_hp_bendahara'  => 'nullable|string|max:25',
            'foto_profil'         => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'upload_sk'           => 'nullable|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $dataUpdate = [
            'nama_organisasi'     => $request->nama_organisasi,
            'alamat_sekretariat'  => $request->alamat_sekretariat,
            'nomor_hp_ketua'      => $request->nomor_hp_ketua,
            'nomor_hp_sekretaris' => $request->nomor_hp_sekretaris,
            'nomor_hp_bendahara'  => $request->nomor_hp_bendahara,
        ];

        // Cari biodata lama jika ada untuk referensi file
        $biodataLama = BiodataOrganisasi::where('admin_id', $admin->id)->first();

        if ($request->hasFile('foto_profil')) {
            $logoName = time() . '_logo.' . $request->foto_profil->extension();
            $request->foto_profil->move(public_path('uploads/profil'), $logoName);
            $dataUpdate['foto_profil'] = $logoName;
        }

        if ($request->hasFile('upload_sk')) {
            $skName = time() . '_sk.' . $request->upload_sk->extension();
            $request->upload_sk->move(public_path('uploads/sk'), $skName);
            $dataUpdate['upload_sk'] = $skName;
        }

        // Update jika sudah ada, atau buat baru jika belum ada record-nya
        BiodataOrganisasi::updateOrCreate(
            ['admin_id' => $admin->id],
            $dataUpdate
        );

        return redirect()->back()->with('success', 'Biodata Organisasi berhasil disimpan!');
    }
}