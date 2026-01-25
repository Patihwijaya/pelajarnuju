<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\User;


class AdminMaterialController extends Controller
{
    public function index()
    {
        $materials = Material::all();
        return view('admin.material.index', compact('materials'));

    }

    public function create()
    {
        return view('admin.material.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'isi_materi' => 'required',
            'file' => 'mimes:pdf,docx,pptx|max:10240'
        ]);

        $fileName = null;
        if($request->file) {
            $fileName = time() . '-' . $request->file->getClientOriginalName();
            $request->file->move(public_path('uploads/E-Book'), $fileName);
        }

        Material::create([
            'judul' => $request->judul,
            'isi_materi' => $request->isi_materi,
            'file' => $fileName,
        ]);

        return redirect()->route('admin.materials.index')->with('succes', 'materi berhasil ditambahkan');
    }

    public function edit($id)
    {
        $material = Material::findOrFail($id);
        return view('admin.material.edit', compact('material'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'isi_materi' =>'required',
            'file' => 'mimes:pdf,docx,pptx|max:10240'
        ]);

        $material = Material::findOrFail($id);

        if($request->file) {
            if($material->file && file_exists(public_path('materials/'. $material->file))){
                unlink(public_path('uploads/E-Book/'.$material->file));
            }

            $fileName = time() . '-' . $request->file->getClientOriginalName();
            $request->file->move(public_path('uploads/E-Book'), $fileName);

            $material->file = $fileName;
        }

        $material->judul = $request->judul;
        $material->isi_materi = $request->isi_materi;
        $material->save();

        return redirect()->route('admin.materials.index')->with('succes', 'materi berhasil diperbarui');
    }

    public function destroy($id)
    {
        $material = Material::findOrFail($id);

        if($material->file && file_exists(public_path('materials/'. $material->file))) {
            unlink(public_path('materials/'.$material->file));
        }

        $material->delete();

        return redirect()->route('admin.materials.index')->with('succes', 'materi berhasil di hapus');
    }

    public function viewers($id)
    {
        $material = Material::with('user')->findOrFail($id);
        return view('admin.materials.viewers', compact('materiak'));
    }

}
