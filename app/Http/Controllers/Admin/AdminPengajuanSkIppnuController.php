<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengajuanSkIppnu;
use App\Notifications\StatusPengajuanSkNotification;
use App\Models\User;

class AdminPengajuanSkIppnuController extends Controller
{
    public function index()
    {
        $pengajuan = PengajuanSkIppnu::latest()->get();
        return view('admin.pengajuanSkippnu.index', compact('pengajuan'));
    }

    public function show($id)
    {
        $pengajuan = PengajuanSkippnu::findOrFail($id);
        return view('admin.pengajuanSkIppnu.show', compact('pengajuan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diproses,dikembalikan,diterima',
            'catatan' => 'nullable|string'
        ]);

        $pengajuan = PengajuanSkIppnu::findOrFail($id);

        $pengajuan->status = $request->status;
        $pengajuan->catatan = $request->catatan;
        $pengajuan->save();

        $user = $pengajuan->user;
        if($user) {
            $user->notify(new \App\Notifications\StatusPengajuanSkNotification(
                $pengajuan->status,
                $pengajuan->catatan
            ));
        }

        return back()->with('success', 'jawaban berhasil dikirm');
    }

    public function destroy($id)
    {
        $pengajuan = PengajuanSkIppnu::findOrFail($id);
        $pengajuan->delete();

        return redirect()->back()->with('success', 'Pengajuan Sk Berhasil dihapus');
    }
}
