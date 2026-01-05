<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artikel;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikels = Artikel::latest()->paginate(6);
        // $artikelsPopuler = Arikel::orderBy('lihats')->get();
        return view('user.artikel', compact('artikels'));
    }

    public function show($slug)
    {
        $artikels = Artikel::where('slug', $slug)->firstOrFail();
        // $artikels->increment('lihats');
        $sessionKey = $artikels->id;
        $shareUrl = url()->current();
        $shareText = $artikels->judul;
        $penulis = $artikels->penulis;

        $shareImage = $artikels->gambar ? asset('uploads/artikel/' . $artikels->gambar) : null;

        if(!session()->has($sessionKey)) {
            $artikels->increment('lihats');
            session([$sessionKey => true]);
        }

        if(!$artikels->slug){
            $artikels->slug = \Illuminate\Support\Str::slug($artikels->judul);
            $artikels->save();
        }
        return view('user.show', compact('artikels', 'shareUrl', 'shareText', 'shareImage', 'penulis'));
        // return redirect()->route('user.artikel.show', $artikels->slug);
    }
}
