<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StrukturIppnu;

class StrukturIppnuController extends Controller
{
    public function index()
    {
        $strukturIppnu = StrukturIppnu::latest()->get();
        return view('admin.strukturIppnu.index', compact('strukturIppnu'));
    }

    public function create()
    {
        return view('admin.strukturIppnu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:225',
            'jabatan' => 'required|string|max:225',
            'instagram' => 'required|string|max:225',
            'gambar' => 'required|image|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $namaFile = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('uploads/strukturIppnu'), $namaFile);
        }

        StrukturIppnu::create([
            'admin_id' => Auth::guard('admin')->id(),
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'instagram' => $request->instagram,
            'gambar' => $namaFile,
        ]);

        return redirect()->route('admin.strukturIppnu.index')->with('succes', 'data berhasil ditambahlan');
    }

    public function edit(StrukturIppnu $strukturIppnu)
    {
        return view('admin.strukturIppnu.edit', compact('strukturIppnu'));
    }

    public function update(Request $request, StrukturIppnu $strukturIppnu)
    {
        $request->validate([
            'nama' => 'required|string|max:225',
            'jabatan' => 'required|string|max:225',
            'instagram' => 'required|string|max:225',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $namaFile = $strukturIppnu->gambar;
        if ($request->hasFile('gambar')) {
            $namaFile = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('uploads/strukturIppnu'), $namaFile);
        }

        $strukturIppnu->update([
            'admin_id' => Auth::guard('admin')->id(),
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'instagram' => $request->instagram,
            'gambar' => $namaFile,
        ]);

        return redirect()->route('admin.strukturIppnu.index')->with('succes', 'data berhasil diubah');
    }

    public function destroy(StrukturIppnu $strukturIppnu)
    {
        $strukturIppnu->delete();
        return redirect()->route('admin.strukturIppnu.index')->with('succes', 'data berhasil di hapus');
    }
}
