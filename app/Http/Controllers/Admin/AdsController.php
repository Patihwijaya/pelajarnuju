<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ads;

class AdsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ads = Ads::all();
        return view('admin.ads.index', compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ads.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'gambar' => 'image|mimes:png,jpg,jpeg|max:2048',
            'expired_at' => 'required|date'
        ]);

        $gambar = null;
        if ($request->hasFile('gambar')) {
            $gambar = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('uploads/ads'), $gambar);
        }

        Ads::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'link' => $request->link,
            'gambar' => $gambar,
            'expired_at' => $request->expired_at
        ]);

        return redirect()->route('admin.ads.index')->with('succes', 'iklan berhasil ditambahkan');
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
    public function edit($id)
    {
        $ad = Ads::findOrFail($id);
        return view('admin.ads.edit', compact('ad'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'judul' => 'required',
            'gambar' => 'image|mimes:png,jpg,jpeg|max:2048',
            'expired_at' => 'required|date',
            'link' => 'required|url'
        ]);

        $ad = Ads::findOrFail($id);
        $ad->update($request->only('judul', 'gambar', 'expired_at', 'link'));

        return redirect()->route('admin.ads.index')->with('success', 'iklan berhasil di ubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ad = Ads::findOrFail($id);
        $ad->delete();

        return redirect()->route('admin.ads.index')->with('success', 'Ads berhasil di hapus');
    }
}
