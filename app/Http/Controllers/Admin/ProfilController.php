<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function index()
    {
        $profil = Profil::where('admin_id', Auth::guard('admin')->id())->first();
        return view('admin.profil.index', compact('profil'));
        return view('user.sejarah', compact('profil'));
    }

    public function create()
    {
        return view('admin.profil.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'nullable',
            'text' => 'nullable',
        ]);

        Profil::create([
            'admin_id' => Auth::guard('admin')->id(),
            'judul' => $request->judul,
            'text' => $request->text,
        ]);

        return redirect()->route('admin.profil.index')->with('succes', 'Profil Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $profil = Profil::findOrFail($id);
        return view('admin.profil.edit', compact('profil'));
    }

    public function update(Request $request, $id)
    {
        $profil = Profil::findOrFail($id);
        $profil->update($request->only('judul', 'text'));

        return redirect()->route('admin.profil.index')->with('success', 'Profil berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $profil = Profil::findOrFail($id);
        $profil->delete();

        return redirect()->route('admin.profil.index')->with('success', 'Profil berhasil dihapus.');
    }
}
