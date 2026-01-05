<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\User;
use App\Models\Kontak;
use App\Models\PengajuanSkIpnu;
use App\Models\PengajuanSkIppnu;
use App\Models\Visitor;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $jumlahArtikel = Artikel::count();
        $jumlahUser = User::count();
        $jumlahKontak = Kontak::count();

        $skIpnuBelumDicek = PengajuanSkIpnu::where('status', 'diproses')->count();

        $skIppnuBelumDicek = PengajuanSkIppnu::where('status', 'diproses')->count();

        $totalPengunjung = Visitor::count();

        $pengunjungHariIni = Visitor::where('visit_date', now()->toDateString())->count();

        $dates = [];
        $visitors = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->toDateString();
            $dates[] = Carbon::parse($date)->format('d M'); // format label
            $count = Visitor::where('visit_date', $date)->count();
            $visitors[] = $count;
        }

        return view('admin.dashboard', compact(
            'jumlahArtikel',
            'jumlahUser',
            'jumlahKontak',
            'skIpnuBelumDicek',
            'skIppnuBelumDicek',
            'totalPengunjung',
            'pengunjungHariIni',
            'dates',
            'visitors'
        ));

    }
}
