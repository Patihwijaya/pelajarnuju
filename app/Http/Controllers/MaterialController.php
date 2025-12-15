<?php

namespace App\Http\Controllers;


use App\Models\Material;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::all(); // pastikan variabel plural
        return view('auth.material.index', compact('materials'));
    }

    public function show($id)
    {
        $material = Material::findOrFail($id); // findOrFail → otomatis 404 jika id tidak ada
        return view('auth.material.show', compact('material'));
    }
}
