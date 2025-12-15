<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StrukturIpnu;

class StrukturIpnuController extends Controller
{
    public function index()
    {
        $strukturIpnu = StrukturIpnu::latest()->get();
        return view('admin.strukturIpnu.index', compact('strukturIpnu'));
    }

    public function create()
    {
        return view('admin.strukturIpnu.create');
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
            $request->gambar->move(public_path('uploads/strukturIpnu'), $namaFile);
        }

        StrukturIpnu::create([
            'admin_id' => Auth::guard('admin')->id(),
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'instagram' => $request->instagram,
            'gambar' => $namaFile,
        ]);

        return redirect()->route('admin.strukturIpnu.index')->with('succes', 'data berhasil ditambahlan');
    }

    public function edit(StrukturIpnu $strukturIpnu)
    {
        return view('admin.strukturIpnu.edit', compact('strukturIpnu'));
    }

    public function update(Request $request, StrukturIpnu $strukturIpnu)
    {
        $request->validate([
            'nama' => 'required|string|max:225',
            'jabatan' => 'required|string|max:225',
            'instagram' => 'required|string|max:225',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $namaFile = $strukturIpnu->gambar;
        if ($request->hasFile('gambar')) {
            $namaFile = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('uploads/strukturIpnu'), $namaFile);
        }

        $strukturIpnu->update([
            'admin_id' => Auth::guard('admin')->id(),
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'instagram' => $request->instagram,
            'gambar' => $namaFile,
        ]);

        return redirect()->route('admin.strukturIpnu.index')->with('succes', 'data berhasil diubah');
    }

    public function destroy(StrukturIpnu $strukturIpnu)
    {
        $strukturIpnu->delete();
        return redirect()->route('admin.strukturIpnu.index')->with('succes', 'data berhasil di hapus');
    }
}
