<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\File;
use ZipArchive;

class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatan = Kegiatan::latest()->paginate(6);
        return view('user.kegiatan', compact('kegiatan'));
    }

    public function show($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return view('user.lihat', compact('kegiatan'));
    }

    public function downloadSemua($id)
    {
        $kegiatan = Kegiatan::with('galleries')->findOrFail($id);

        $zip = new ZipArchive;
        
        $safeTitle = preg_replace('/[^A-Za-z0-9\-]/', '_', $kegiatan->judul);
        $fileName = 'Dokumentasi_' . $safeTitle . '.zip';
        
        $zipPath = public_path('uploads/kegiatan/' . $fileName);

        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            
            // 1. Cover
            $coverPath = public_path('uploads/kegiatan/' . $kegiatan->gambar);
            if (File::exists($coverPath)) {
                $zip->addFile($coverPath, 'Cover_' . $kegiatan->gambar);
            }

            // 2. Galeri
            foreach ($kegiatan->galleries as $galeri) {
                $galeriPath = public_path('uploads/kegiatan/galeri/' . $galeri->foto);
                if (File::exists($galeriPath)) {
                    $zip->addFile($galeriPath, 'Galeri_' . $galeri->foto);
                }
            }

            $zip->close();
        }

        return response()->download($zipPath)->deleteFileAfterSend(true);
    }
}
