<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StrukturIpnu;

class StrukturIpnuController extends Controller
{
    public function index()
    {
        $strukturIpnu = StrukturIpnu::first()->all();
        return view('user.strukturIpnu', compact('strukturIpnu'));
    }
}
