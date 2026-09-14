<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $search = $request->input('search');
        $kategori = $request->input('kategori');

        // Super Admin melihat SEMUA artikel dari seluruh user
        $query = Artikel::query();

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
            return view('admin.artikel.partials.table', compact('artikels'))->render();
        }

        return view('admin.artikel.index', compact('artikels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.artikel.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:225|unique:artikels,title',
            'isi' => 'required',
            'kategori' => 'required|string',
            'penulis' => 'required|string|max:225',
            'gambar' => 'nullable|image|max:2048'
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
            'status' => 'published', // Khusus Super Admin: Langsung published
        ]);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil diterbitkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Artikel $artikel)
    {
        return view('admin.artikel.show', compact('artikel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artikel $artikel)
    {
        // Super Admin bebas mengedit artikel siapa saja
        return view('admin.artikel.edit', compact('artikel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artikel $artikel)
    {
        $request->validate([
            'judul' => 'required|string|max:225|unique:artikels,title,' . $artikel->id,
            'isi' => 'required',
            'kategori' => 'required|string',
            'penulis' => 'required|string|max:225',
            'gambar' => 'nullable|image|max:2048',
        ], [
            'judul.unique' => 'Judul artikel ini sudah pernah digunakan. Silakan gunakan judul yang sedikit berbeda.'
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
            // Status tidak diubah menjadi 'pending' karena yang mengedit adalah Super Admin
        ]);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artikel $artikel)
    {
        // Super Admin bebas menghapus artikel siapa saja
        $artikel->delete();
        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil dihapus');
    }

    /**
     * Khusus untuk Super Admin menyetujui artikel
     */
    public function approve(Artikel $artikel)
    {
        $user = Auth::guard('admin')->user();
        
        $artikel->update([
            'status' => 'published',
            'verifier_id' => $user->id,
            'verifier_type' => 'App\Models\Admin'
        ]);

        return back()->with('success', 'Artikel berhasil disetujui dan dipublish!');
    }

    /**
     * Khusus untuk Super Admin menolak artikel
     */
    public function reject(Artikel $artikel)
    {
        $user = Auth::guard('admin')->user();
        
        $artikel->update([
            'status' => 'rejected',
            'verifier_id' => $user->id,
            'verifier_type' => 'App\Models\Admin'
        ]);

        return back()->with('success', 'Artikel berhasil ditolak.');
    }
    
    /**
     * Fungsi upload gambar dari TinyMCE
     */
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

    public function hide(Artikel $artikel)
    {
        $user = Auth::guard('admin')->user();
        
        if ($user->role !== 'super_admin') {
            abort(403, 'Hanya Super Admin yang dapat menyembunyikan artikel.');
        }

        $artikel->update([
            'status' => 'hidden', // Mengubah status menjadi hidden
            'verifier_id' => $user->id,
            'verifier_type' => 'App\Models\Admin'
        ]);

        return back()->with('success', 'Artikel berhasil disembunyikan dari halaman publik.');
    }
}