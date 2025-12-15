<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\PengajuanSkIpnu;
use Illuminate\Support\Facades\Auth;


class PengajuanSkIpnuController extends Controller
{
    public function create()
    {
        return view('auth.pengajuanSkIpnu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'no_hp' => 'required',
            'asal' => 'required',

            'surat_permhonan_pengesahan' => 'required|file|mimes:pdf',
            'berita_acara_hasil_konferensi' => 'required|file|mimes:pdf',
            'berita_acara_penyusunan_pengurus' => 'required|file|mimes:pdf',
            'lampiran_susunan_pengurus' => 'required|file|mimes:pdf',
            'surat_rekomendasi_mwcnu_prnu' => 'required|file|mimes:pdf',
            'surat_rekomendasi_pac' => 'nullable|file|mimes:pdf',
            'cv' => 'required|file|mimes:pdf',
            'biodata' => 'required|file|mimes:pdf',
            'surat_pernyataan' => 'required|file|mimes:pdf',
            'hasil_konferensi' => 'required|file|mimes:pdf',
            'lpj' => 'required|file|mimes:pdf',
            'profil' => 'required|file|mimes:pdf',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();

        foreach ($request->files as $key => $file) {
            if ($file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/pengajuan-sk'), $filename);
                $data[$key] = 'uploads/pengajuan-sk/' . $filename;
            }
        }

        PengajuanSkIpnu::create($data);

        return redirect()->back()->with('succes', 'data berhasil dikirim');
    }
}
