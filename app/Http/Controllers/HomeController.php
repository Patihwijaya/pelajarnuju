<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Artikel;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use App\Models\Kegiatan;
use App\Models\Event;

class HomeController extends Controller
{
    public function index()
    {
        Carbon::setLocale('id');
        CarbonInterval::setLocale('id');

        $totalUsers = User::count();
        
        // Ditambahkan filter status 'published' agar artikel pending tidak muncul ke publik
        $artikelPopuler = Artikel::where('status', 'published')
                                 ->orderBy('lihats', 'desc')
                                 ->orderBy('created_at', 'desc')
                                 ->take(6)
                                 ->get();

        $banner = Artikel::where('status', 'published')->latest()->first();
        $artikel = Artikel::where('status', 'published')->latest()->skip(1)->take(8)->get();

        $totalArtikel = Artikel::where('status', 'published')->latest()->take(6)->get();
        $kegiatan = Kegiatan::latest()->take(3)->get();

        $events = Event::latest()->take(3)->get();

        $data = $artikel->merge($kegiatan);

        return view('home', compact('totalArtikel', 'artikelPopuler' , 'banner', 'artikel', 'kegiatan', 'data', 'events'));
    }

    public function show($id)
    {
        // Pastikan hanya artikel published yang bisa dibuka oleh publik
        $artikels = Artikel::where('status', 'published')->findOrFail($id);
        $artikels->increment('lihats');
        return view('user.show', compact('artikels'));
    }

    public function liveSearch(Request $request)
    {
        $keyword = $request->input('q');

        if (empty($keyword)) {
            return response()->json([]);
        }

        // Disesuaikan dengan kolom 'title' di database dan filter 'published'
        $hasil = Artikel::where('status', 'published')
                        ->where('title', 'like', "%{$keyword}%")
                        ->select('id', 'title', 'slug')
                        ->limit(5)
                        ->get()
                        ->map(function($item) {
                            return [
                                'id' => $item->id,
                                'judul' => $item->title,
                                'url' => url('/artikel/' . $item->slug) 
                            ];
                        });

        return response()->json($hasil);
    }
}