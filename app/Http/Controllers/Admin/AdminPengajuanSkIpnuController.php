<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengajuanSkIpnu;
use Illuminate\Http\Request;
use App\Notifications\StatusPengajuanSkNotification;
use App\Models\User;

class AdminPengajuanSkIpnuController extends Controller
{
    public function index()
    {
        $pengajuan = PengajuanSkIpnu::latest()->get();
        return view('admin.pengajuanSkIpnu.index', compact('pengajuan'));
    }

    public function show($id)
    {
        $pengajuan = PengajuanSkIpnu::findOrFail($id);
        return view('admin.pengajuanSkIpnu.show', compact('pengajuan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diproses,dikembalikan,diterima',
            'catatan' => 'nullable|string',
        ]);

        $pengajuan = PengajuanSkIpnu::findOrFail($id);

        $pengajuan->status = $request->status;
        $pengajuan->catatan = $request->catatan;
        $pengajuan->save();

        $user = $pengajuan->user; // pastikan relasi user ada
        if ($user) {
            $user->notify(new \App\Notifications\StatusPengajuanSkNotification(
                $pengajuan->status,
                $pengajuan->catatan
            ));
        }

        return back()->with('succes', 'jawaban berhasil dikirm');
    }

    public function destroy($id)
    {
        $pengajuan = PengajuanSkIpnu::findOrFail($id);
        $pengajuan->delete();

        return redirect()->back()->with('success', 'Pengajuan SK berhasil dihapus');
    }
}
