<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Artikel;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use App\Models\kegiatan;

class HomeController extends Controller
{
    public function index()
    {
        Carbon::setLocale('id');
        CarbonInterval::setLocale('id');

        $totalUsers = User::count();
        $totalArtikel = Artikel::orderBy('lihats', 'desc')->orderBy('created_at', 'desc')->get();


        $banner = Artikel::latest()->first();
        $artikel = Artikel::latest()->skip(1)->take(8)->get();

        $totalArtikel = Artikel::latest()->take(6)->get();
        $kegiatan = Kegiatan::latest()->take(3)->get();

        $data = $artikel->merge($kegiatan);

        return view('home', compact('totalArtikel', 'banner', 'artikel', 'kegiatan', 'data'));
    }

    public function show($id)
    {
        $artikels = Artikel::findOrfail($id);
        return view('user.show', compact('artikels'));
    }

    
    public function liveSearch(Request $request)
    {
    $keyword = $request->input('q');

    // Jika input kosong, kembalikan array kosong
    if (empty($keyword)) {
        return response()->json([]);
    }

    // Cari artikel berdasarkan judul (dibatasi 5 hasil saja agar modal tidak kepanjangan)
    $hasil = Artikel::where('judul', 'like', "%{$keyword}%")
                    ->select('id', 'judul', 'slug') // Ambil kolom yang dibutuhkan saja
                    ->limit(5)
                    ->get()
                    ->map(function($item) {
                        return [
                            'id' => $item->id,
                            'judul' => $item->judul,
                            // Sesuaikan URL ini dengan format URL artikelmu
                            'url' => url('/artikel/' . $item->slug) 
                        ];
                    });

    return response()->json($hasil);
}
}
