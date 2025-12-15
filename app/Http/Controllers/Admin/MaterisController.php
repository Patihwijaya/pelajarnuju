<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Kelas;
use App\Models\Materis;

class MaterisController extends Controller
{
    public function create(Kelas $kela)
    {
        return view('admin.materis.create', compact('kela'));
    }

    public function store(Request $request, Kelas $kela)
    {
        $request->validate([
            'judul_materi' => 'required',
            'konten' => 'required',
            'gambar' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'youtube_url' => 'nullable|string'
        ]);

        $gambarName = null;
        if ($request->hasFile('gambar')) {
            $gambarName = time() . '.' . $request->gambar->extension();
            $request->gambar->storeAs('public/materi', $gambarName);
        }

        $kela->materis()->create([
            'judul_materi' =>$request->judul_materi,
            'konten' => $request->konten,
            'gambar' => $gambarName,
            'youtube_url' => $request->youtube_url
        ]);

        return redirect()->route('kelas.show', $kela->id)->with('succes', 'materi berhasil ditambahkan');
    }

    public function edit(Kelas $kela, Materis $materis)
    {
        return view('admin.materis.edit', compact('kela', 'materis'));
    }

    public function update(Request $request, Kelas $kela, Materis $materis)
    {
        $request->validate([
            'judul_materi' => 'required',
            'konten' => 'required',
        ]);

        if ($request->hasFile('gambar')) {

            // hapus gambar lama
            if ($materis->gambar && Storage::exists('public/materi/' . $materis->gambar)) {
                Storage::delete('public/materi/' . $materis->gambar);
            }

            // upload gambar baru
            $gambarName = time() . '.' . $request->gambar->extension();
            $request->gambar->storeAs('public/materi', $gambarName);

            $materis->gambar = $gambarName;
        }

        $materis->update([
            'judul_materi' => $request->judul_materi,
            'konten' => $request->konten,
            'youtube_url' => $request->youtube_url,
            'gambar' => $materis->gambar
        ]);

        return redirect()->route('kelas.show', $kela->id)->with('succes', 'materi berhasil diperbarui');
    }

    public function show(Kelas $kela, Materis $materi)
    {
        return view('admin.materis.show', compact('kela', 'materi'));
    }

    public function index(Kelas $kela)
    {
        $materis = $kela->materis()->latest()->get();
        return view('admin.materi.index', compact('kela', 'materis'));
    }

    public function destroy(Kelas $kela, Materis $materiS)
    {
        if ($materiS->gambar && Storage::exists('public/materi/' . $materiS->gambar)) {
                Storage::delete('public/materi/' . $materiS->gambar);
        }

        $materiS->delete();

        return back()->with('succes', 'materi berhasil dihapus');
    }
}
