<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kontak;
use Illuminate\Support\Facades\Mail;

class KontakController extends Controller
{
    public function index()
    {
        $massages = Kontak::latest()->get();
        return view('admin.kontak.index', compact('massages'));
    }

    public function show($id)
    {
        $massages = Kontak::latest()->get();
        $selected = Kontak::findOrFail($id);

        return view('admin.kontak.index', compact('massages', 'selected'));
    }

    public function reply(Request $request, $id)
    {
        $request->validate([
            'balasan' => 'required'
        ]);

        $kontak = Kontak::findOrFail($id);

        Mail::raw($request->balasan, function ($massages) use ($kontak) {
            $massages->to($kontak->email)->subject('Balasan dari admin');
        });

        $kontak->update(['dibalas' => true]);

        return redirect()->route('admin.kontak.index')->with('success', 'Balasan berhasil dikirim');
    }
}
