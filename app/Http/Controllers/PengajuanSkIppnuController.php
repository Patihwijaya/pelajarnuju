<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\PengajuanSkIppnu;
use Illuminate\Support\Facades\Auth;


class PengajuanSkIppnuController extends Controller
{
    public function create()
    {
        return view('auth.pengajuanSkIppnu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'no_hp' => 'required',
            'asal' => 'required',

            'surat_permohonan_pengesahan' => 'required|file|mimes:pdf',
            'berita_acara_surat_keputusan_konferensi' => 'required|file|mimes:pdf',
            'berita_acara_penyusunan_pengurus_oleh_tim_formatur' => 'required|file|mimes:pdf',
            'berita_acara_penyusunan_pengurus_oleh_pengurus_harian' => 'required|file|mimes:pdf',
            'susunan_pengurus_lengkap' => 'required|file|mimes:pdf',
            'foto_kartu_identitas_pengurus_harian_dan_ketua_lembaga' => 'required|file|mimes:pdf',
            'surat_rekomendasi_mwcnu_atau_prnu' => 'required|file|mimes:pdf',
            'surat_rekomendasi_pimpinan_lembaga_pendidikan' => 'nullable|file|mimes:pdf',
            'surat_rekomendasi_pac_ippnu' => 'nullable|file|mimes:pdf'
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();

        foreach($request->files as $key => $file) {
            if($file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/pengajuan-sk-ippnu'), $filename);
                $data[$key] = 'uploads/pengajuan-sk-ippnu/' . $filename;
            }
        }

        PengajuanSkIppnu::create($data);

        return redirect()->back()->with('success', 'data berhasil dikirim');
    }
}
