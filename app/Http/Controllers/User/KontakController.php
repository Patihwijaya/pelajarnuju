<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use Illuminate\Http\Request;


class KontakController extends Controller
{
    public function form()
    {
        return view('user.kontak');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'pesan' => 'required',
        ]);

        Kontak::create($request->only('nama', 'email', 'pesan'));

        return back()->with('succes', 'pesan berhasil dikirim');
    }
}
