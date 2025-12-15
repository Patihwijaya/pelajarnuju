<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kegiatan;

class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatan = Kegiatan::latest()->paginate(6);
        return view('user.kegiatan', compact('kegiatan'));
    }

    public function show($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return view('user.lihat', compact('kegiatan'));
    }
}
