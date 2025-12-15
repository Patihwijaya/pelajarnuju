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

    public function show($id)
    {
        $artikels = Artikel::findOrfail($id);
        // $artikels->increment('lihats');
        $sessionKey = $artikels->id;

        if(!session()->has($sessionKey)) {
            $artikels->increment('lihats');
            session([$sessionKey => true]);
        }
        return view('user.show', compact('artikels'));
    }
}
