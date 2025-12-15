<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;
use Illuminate\Support\Facades\File;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::latest()->get();
        return view('admin.kelas.index', compact('kelas'));
    }

    public function create()
    {
        return view('admin.kelas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required',
            'deskripsi' => 'required',
            'gambar_kelas' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $data = $data = $request->only(['nama_kelas', 'deskripsi']); // ambil field text saja

        if ($request->hasFile('gambar_kelas')) {
            $file = $request->file('gambar_kelas');
            $namaFile = time() . '.' . $file->extension();
            $file->move(public_path('uploads/kelas'), $namaFile);
            $data['gambar_kelas'] = $namaFile;
        }

        Kelas::create($data);


        return redirect()->route('kelas.index')->with('success', 'kelas Berhasil dibuat');
    }

    public function show(Kelas $kela)
    {
        $materis = $kela->materis()->latest()->get();
        return view('admin.kelas.show', compact('kela', 'materis'));
    }

    public function edit(Kelas $kela)
    {
        return view('admin.kelas.edit', compact('kela'));
    }

    public function update(Request $request, Kelas $kela)
    {
        $request->validate([
            'nama_kelas' => 'required',
            'deskripsi' => 'required',
            'gambar_kelas' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $data = $request->only(['nama_kelas', 'deskripsi']); // ambil field text saja

        if ($request->hasFile('gambar_kelas')) {
            // Hapus gambar lama jika ada
            if ($kela->gambar_kelas && File::exists(public_path('uploads/kelas/' .$kela->gambar_kelas))) {
            File::delete(public_path('uploads/kelas/' . $kela->gambar_kelas));
            }

            $file = $request->file('gambar_kelas');
            $namaFile = time() . '.' . $file->extension();
            $file->move(public_path('uploads/kelas'), $namaFile);
            $data['gambar_kelas'] = $namaFile;
        }


        $kela->update($data);

        return redirect()->route('kelas.index')->with('success', 'kelas berhasil diperbarui');
    }

    public function destroy(Kelas $kela)
    {

        if ($kela->gambar_kelas && File::exists(public_path('uploads/kelas/' . $kela->gambar_kelas))) {
            File::delete(public_path('uploads/kelas/' . $kela->gambar_kelas));
        }

        $kela->delete();

        return back()->with('succes', 'Kelas Berhasil dihapus');
    }
}
