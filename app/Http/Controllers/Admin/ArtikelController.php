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
        // $artikels = Artikel::latest()->get();
        // return view('admin.artikel.index', compact('artikels'));

        $perPage = $request->input('per_page', 5);
        $search = $request->input('search');
        $kategori = $request->input('kategori');

        $query = Artikel::query();

        if ($kategori) {
            $query->where('kategori', $kategori);
        }
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                ->orWhere('penulis', 'like', "%{$search}%")
                ->orWhere('kategori', 'like', "%{$search}%");
            });
        }

        $artikels = $query->orderBy('created_at', 'desc')->paginate($perPage)->appends($request->query());

        // JIKA INI REQUEST AJAX, KEMBALIKAN HANYA TABELNYA SAJA (TIDAK TERMASUK NAVBAR/SIDEBAR)
        if ($request->ajax()) {
            return view('admin.artikel.partials.table', compact('artikels'))->render();
        }

        // JIKA LOADING NORMAL, KEMBALIKAN HALAMAN UTUH
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
            'judul' => 'required|string|max:225',
            'isi' => 'required',
            'kategori' => 'required|string',
            'penulis' => 'required|string|max:225',
            'gambar' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            $namaFile = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('uploads/artikel'), $namaFile);
        }
        
        Artikel::create([
            'admin_id' => Auth::guard('admin')->id(),
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'isi' => trim($request->isi, '"'),
            'kategori' => $request->kategori,
            'penulis' => $request->penulis,
            'gambar' => $namaFile,
        ]);

        return redirect()->route('admin.artikel.index')->with('succes', 'Artikel Berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artikel $artikel)
    {
        return view('admin.artikel.edit', compact('artikel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artikel $artikel)
    {
        $request->validate([
            'judul' => 'required|string|max:225',
            'isi' => 'required',
            'kategori' => 'required|string',
            'penulis' => 'required|string|max:225',
            'gambar' => 'nullable|image|max:2048',
        ]);


        $namaFile = $artikel->gambar;
        if ($request->hasFile('gambar')) {
            $namaFile = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('uploads/artikel'), $namaFile);
        }

        $artikel->update([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'isi' => trim($request->isi, '"'),
            'kategori' => $request->kategori,
            'penulis' => $request->penulis,
            'gambar' => $namaFile,
        ]);

        return redirect()->route('admin.artikel.index')->with('succes', 'Artikel Berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artikel $artikel)
    {
        $artikel->delete();
        return redirect()->route('admin.artikel.index')->with('succes', 'Artikel berhasil dihapus');
    }
}
