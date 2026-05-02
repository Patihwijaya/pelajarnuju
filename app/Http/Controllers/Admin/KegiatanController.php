<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Models\KegiatanGallery;
use Illuminate\Support\Facades\File;
use ZipArchive;


class KegiatanController extends Controller
{
    public function index()
    {
        // $kegiatan = Kegiatan::latest()->get();
        $kegiatan = Kegiatan::latest()->paginate(10);
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
            'lokasi' => 'required|string|max:255',
            'tanggal_acara' => 'required|date',
            'gambar' => 'required|image|max:2048', // Cover utama
            'galeri.*' => 'image|max:2048', // Validasi untuk setiap file di dalam array galeri
        ]);

        if ($request->hasFile('gambar')) {
            $namaFile = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('uploads/kegiatan'), $namaFile);
        }

        $kegiatan = Kegiatan::create([
            'admin_id' => Auth::guard('admin')->id(),
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'tanggal_acara' => $request->tanggal_acara,
            'gambar' => $namaFile,
        ]);

        if ($request->hasFile('galeri')) {
            foreach ($request->file('galeri') as $file) {
                // Gunakan uniqid() agar nama file tidak bentrok jika diupload di detik yang sama
                $namaGaleri = time() . '_' . uniqid() . '.' . $file->extension();
                $file->move(public_path('uploads/kegiatan/galeri'), $namaGaleri);

                // Simpan ke database kegiatan_galleries
                KegiatanGallery::create([
                    'kegiatan_id' => $kegiatan->id,
                    'foto' => $namaGaleri
                ]);
            }
        }

        return redirect()->route('admin.kegiatan.index')->with('success', 'kegiatan berhasil ditambahkan');
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
            'lokasi' => 'required|string|max:255',
            'tanggal_acara' => 'required|date',
            'gambar' => 'nullable|image|max:2048',
            'galeri.*' => 'image|max:2048',
        ]);

        $namaFile = $kegiatan->gambar;
        if ($request->hasFile('gambar')) {
            // Hapus cover lama dari server
            $pathLama = public_path('uploads/kegiatan/' . $kegiatan->gambar);
            if (File::exists($pathLama)) {
                File::delete($pathLama);
            }

            // Upload cover baru
            $namaFile = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('uploads/kegiatan'), $namaFile);
        }

        $kegiatan->update([
            'admin_id' => Auth::guard('admin')->id(),
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'tanggal_acara' => $request->tanggal_acara,
            'gambar' => $namaFile,
        ]);

        if ($request->hasFile('galeri')) {
            foreach ($request->file('galeri') as $file) {
                $namaGaleri = time() . '_' . uniqid() . '.' . $file->extension();
                $file->move(public_path('uploads/kegiatan/galeri'), $namaGaleri);

                KegiatanGallery::create([
                    'kegiatan_id' => $kegiatan->id,
                    'foto' => $namaGaleri
                ]);
            }
        }

        return redirect()->route('admin.kegiatan.index')->with('success', 'kegiatan berhasil diubah');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        $pathCover = public_path('uploads/kegiatan/' . $kegiatan->gambar);
        if (File::exists($pathCover)) {
            File::delete($pathCover);
        }

        foreach ($kegiatan->galleries as $galeri) {
            $pathGaleri = public_path('uploads/kegiatan/galeri/' . $galeri->foto);
            if (File::exists($pathGaleri)) {
                File::delete($pathGaleri);
            }
        }

        $kegiatan->delete();
        return redirect()->route('admin.kegiatan.index')->with('success', 'kegiatan berhasil dihapus');
    }
}
