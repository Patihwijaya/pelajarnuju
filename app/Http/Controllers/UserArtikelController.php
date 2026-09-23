<?php

namespace App\Http\Controllers; // <-- Namespace diubah ke root Controllers

use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserArtikelController extends Controller
{
    /**
     * Tampilkan HANYA artikel milik user yang sedang login
     */
    public function index()
    {
        $user = Auth::user();

        $artikels = Artikel::where('authorable_id', $user->id)
                           ->where('authorable_type', 'App\Models\User')
                           ->latest()
                           ->paginate(5);

        // Sesuaikan dengan letak file view untuk dashboard user Anda
        return view('auth.artikel.index', compact('artikels'));
    }

    public function create()
    {
        return view('auth.artikel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:225',
            'isi' => 'required',
            'kategori' => 'required|string',
            'penulis' => 'required|string|max:225',
            'gambar' => 'nullable|image|max:1000000'
        ]);

        $namaFile = null;
        if ($request->hasFile('gambar')) {
            $namaFile = time() . '.' . $request->gambar->extension();
            $destinationPath = base_path('../public_html/uploads/artikel');
            $request->gambar->move($destinationPath, $namaFile);
        }

        Artikel::create([
            'authorable_id' => Auth::id(),
            'authorable_type' => 'App\Models\User', 
            
            'title' => $request->judul,
            'slug' => Str::slug($request->judul),
            'content' => trim($request->isi, '"'),
            'kategori' => $request->kategori,
            'gambar' => $namaFile,
            'penulis' => $request->penulis,

            // PENTING: User biasa tidak bisa langsung publish
            'status' => 'pending',
        ]);

        return redirect()->route('user.artikel.index')->with('success', 'Artikel berhasil dikirim dan sedang menunggu persetujuan Admin.');
    }

    public function edit(Artikel $artikel)
    {
        // Keamanan: Pastikan user hanya bisa mengedit artikelnya sendiri
        if ($artikel->authorable_id !== Auth::id() || $artikel->authorable_type !== 'App\Models\User') {
            abort(403, 'Anda tidak memiliki izin untuk mengedit artikel ini.');
        }

        return view('auth.artikel.edit', compact('artikel'));
    }

    public function update(Request $request, Artikel $artikel)
    {
        if ($artikel->authorable_id !== Auth::id() || $artikel->authorable_type !== 'App\Models\User') {
            abort(403, 'Akses Ditolak.');
        }

        $request->validate([
            'judul' => 'required|string|max:225',
            'isi' => 'required',
            'kategori' => 'required|string',
            'penulis' => 'required|string|max:225',
            'gambar' => 'nullable|image|max:1000000',
        ]);

        $namaFile = $artikel->gambar;
        if ($request->hasFile('gambar')) {
            $namaFile = time() . '.' . $request->gambar->extension();
            $destinationPath = base_path('../public_html/uploads/artikel');
            $request->gambar->move($destinationPath, $namaFile);
        }

        $artikel->update([
            'title' => $request->judul,
            'slug' => Str::slug($request->judul),
            'content' => trim($request->isi, '"'),
            'kategori' => $request->kategori,
            'gambar' => $namaFile,
            'penulis' => $request->penulis,
            
            // PENTING: Jika diedit, kembali menjadi 'pending'
            'status' => 'pending',
            'verifier_id' => null,
            'verifier_type' => null,
        ]);

        return redirect()->route('user.artikel.index')->with('success', 'Artikel berhasil diperbarui dan dikirim ulang untuk direview.');
    }

    public function destroy(Artikel $artikel)
    {
        if ($artikel->authorable_id !== Auth::id() || $artikel->authorable_type !== 'App\Models\User') {
            abort(403, 'Akses Ditolak.');
        }

        $artikel->delete();
        return redirect()->route('user.artikel.index')->with('success', 'Artikel berhasil dihapus.');
    }

    public function upload(Request $request) 
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            // Membersihkan nama file dari spasi agar URL aman
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            
            // SIMPAN LANGSUNG KE PUBLIC_HTML
            // Berkat index.php yang sudah kita ikat sebelumnya, ini akan otomatis masuk ke public_html/uploads/artikel/konten
            $file->move(public_path('uploads/artikel/konten'), $filename);
            
            // KEMBALIKAN URL LANGSUNG (Tanpa embel-embel /storage/)
            return response()->json([
                'url' => asset('uploads/artikel/konten/' . $filename)
            ]);
        }
    }
}