<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Kegiatan;


class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatan = Kegiatan::latest()->get();
        return view('admin.kegiatan.index', compact('kegiatan'));
    }

    public function create()
    {
        return view('admin.kegiatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:225',
            'deskripsi' => 'required',
            'gambar' => 'required|image|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $namaFile = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('uploads/kegiatan'), $namaFile);
        }

        Kegiatan::create([
            'admin_id' => Auth::guard('admin')->id(),
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'gambar' => $namaFile,
        ]);

        return redirect()->route('admin.kegiatan.index')->with('succes', 'kegiatan berhasil ditambahlan');
    }

    public function edit(Kegiatan $kegiatan)
    {
        return view('admin.kegiatan.edit', compact('kegiatan'));
    }

    public function update(Request $request, Kegiatan $kegiatan)
    {
        $request->validate([
            'judul' => 'required|string|max:225',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $namaFile = $kegiatan->gambar;
        if ($request->hasFile('gambar')) {
            $namaFile = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('uploads/kegiatan'), $namaFile);
        }

        $kegiatan->update([
            'admin_id' => Auth::guard('admin')->id(),
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'gambar' => $namaFile,
        ]);

        return redirect()->route('admin.kegiatan.index')->with('succes', 'kegiatan berhasil diubah');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        $kegiatan->delete();
        return redirect()->route('admin.kegiatan.index')->with('succes', 'kegiatan berhasil dihapus');
    }
}
