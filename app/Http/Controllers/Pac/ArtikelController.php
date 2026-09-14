<?php

namespace App\Http\Controllers\Pac;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $search = $request->input('search');
        $kategori = $request->input('kategori');
        $user = Auth::guard('admin')->user();

        // PAC HANYA bisa melihat artikel miliknya sendiri
        $query = Artikel::where('authorable_id', $user->id)
                        ->where('authorable_type', 'App\Models\Admin');

        if ($kategori) {
            $query->where('kategori', $kategori);
        }
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('kategori', 'like', "%{$search}%");
            });
        }

        $artikels = $query->orderBy('created_at', 'desc')->paginate($perPage)->appends($request->query());

        if ($request->ajax()) {
            return view('pac.artikel.partials.table', compact('artikels'))->render();
        }

        return view('pac.artikel.index', compact('artikels'));
    }

    public function create()
    {
        return view('pac.artikel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:225|unique:artikels,title',
            'isi' => 'required',
            'kategori' => 'required|string',
            'penulis' => 'required|string|max:225',
            'gambar' => 'nullable|image|max:1000000'
        ], [
            'judul.unique' => 'Judul artikel ini sudah pernah digunakan. Silakan gunakan judul yang sedikit berbeda.'
        ]);

        $namaFile = null;
        if ($request->hasFile('gambar')) {
            $namaFile = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('uploads/artikel'), $namaFile);
        }
        
        $user = Auth::guard('admin')->user();

        Artikel::create([
            'authorable_id' => $user->id,
            'authorable_type' => 'App\Models\Admin', 
            'title' => $request->judul,
            'slug' => Str::slug($request->judul),
            'content' => trim($request->isi, '"'),
            'kategori' => $request->kategori,
            'gambar' => $namaFile,
            'penulis' => $request->penulis,
            'status' => 'pending', // PAC selalu pending
        ]);

        return redirect()->route('pac.artikel.index')->with('success', 'Artikel berhasil ditambahkan dan menunggu persetujuan Super Admin.');
    }

    public function show(Artikel $artikel)
    {
        // Proteksi ekstra: PAC tidak bisa melihat detail artikel orang lain
        if ($artikel->authorable_id !== Auth::guard('admin')->user()->id) {
            abort(403, 'Akses ditolak.');
        }
        return view('pac.artikel.show', compact('artikel'));
    }

    public function edit(Artikel $artikel)
    {
        // Proteksi ekstra: PAC tidak bisa edit artikel orang lain
        if ($artikel->authorable_id !== Auth::guard('admin')->user()->id) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit artikel ini.');
        }

        return view('pac.artikel.edit', compact('artikel'));
    }

    public function update(Request $request, Artikel $artikel)
    {
        if ($artikel->authorable_id !== Auth::guard('admin')->user()->id) {
            abort(403, 'Akses ditolak.');
        }

        $request->validate([
            'judul' => 'required|string|max:225|unique:artikels,title,' . $artikel->id,
            'isi' => 'required',
            'kategori' => 'required|string',
            'penulis' => 'required|string|max:225',
            'gambar' => 'nullable|image|max:1000000',
        ], [
            'judul.unique' => 'Judul artikel ini sudah pernah digunakan.'
        ]);

        $namaFile = $artikel->gambar;
        if ($request->hasFile('gambar')) {
            $namaFile = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('uploads/artikel'), $namaFile);
        }

        $artikel->update([
            'title' => $request->judul,
            'slug' => Str::slug($request->judul),
            'content' => trim($request->isi, '"'),
            'kategori' => $request->kategori,
            'gambar' => $namaFile,
            'penulis' => $request->penulis,
            'status' => 'pending', // Kembali pending setelah diedit
            'verifier_id' => null,
            'verifier_type' => null
        ]);

        return redirect()->route('pac.artikel.index')->with('success', 'Artikel berhasil diubah dan dikembalikan ke status pending.');
    }

    public function destroy(Artikel $artikel)
    {
        if ($artikel->authorable_id !== Auth::guard('admin')->user()->id) {
            abort(403, 'Akses ditolak.');
        }
        $artikel->delete();
        return redirect()->route('pac.artikel.index')->with('success', 'Artikel berhasil dihapus.');
    }

    public function upload(Request $request) 
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $path = $file->storeAs('articles', $filename, 'public');
            
            return response()->json([
                'url' => asset('storage/' . $path)
            ]);
        }
    }
}