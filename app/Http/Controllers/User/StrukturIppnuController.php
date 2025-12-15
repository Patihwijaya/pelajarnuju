<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StrukturIppnu;

class StrukturIppnuController extends Controller
{
    public function index()
    {
        $strukturIppnu = StrukturIppnu::first()->all();
        return view('user.strukturIppnu', compact('strukturIppnu'));
    }
}
