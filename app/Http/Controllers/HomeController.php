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
        $artikel = Artikel::latest()->take(2)->get();

        $kegiatan = Kegiatan::latest()->take(2)->get();

        $data = $artikel->merge($kegiatan);

        return view('home', compact('totalArtikel', 'banner', 'artikel', 'kegiatan', 'data'));
    }

    public function show($id)
    {
        $artikels = Artikel::findOrfail($id);
        return view('user.show', compact('artikels'));
    }
}
