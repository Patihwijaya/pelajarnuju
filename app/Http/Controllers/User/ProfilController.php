<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Profil;

class ProfilController extends Controller
{
    public function sejarah()
    {
        $profil = \App\Models\Profil::first(); // atau bisa kamu ubah sesuai kebutuhan
        return view('user.sejarah', compact('profil'));
    }
}
