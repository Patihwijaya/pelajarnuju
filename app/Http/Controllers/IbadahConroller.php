<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Alkoumi\LaravelHijriDate\Hijri;
use GuzzleHttp\Client;

class IbadahConroller extends Controller
{
    public function index()
    {
        // Lokasi Jakarta Utara
        $city = 'Jakarta Utara';
        $latitude = -6.1189;
        $longitude = 106.9069;

        // Pastikan format lokal Indonesia aktif
        setlocale(LC_TIME, 'id_ID.UTF-8', 'Indonesian', 'id_ID', 'id');
        Carbon::setLocale('id');

        // Ambil tanggal sekarang (zona Jakarta)
        $today = Carbon::now('Asia/Jakarta');
        // Gunakan format strftime supaya bisa pakai setlocale
        $tanggalMasehi = strftime('%A, %d %B %Y', $today->getTimestamp());
        $tanggalMasehi = ucfirst($tanggalMasehi); // huruf besar di awal

        // Ambil tanggal Hijriah (dari API)
        $tanggalHijriah = $this->getHijriDate($today);

        // Ambil jadwal shalat dari API Aladhan
        $client = new Client();
        $response = $client->get("https://api.aladhan.com/v1/timings/{$today->format('d-m-Y')}?latitude={$latitude}&longitude={$longitude}&method=20");
        $data = json_decode($response->getBody(), true);

        $jadwal = $data['data']['timings'];
        // Mapping waktu salat ke Bahasa Indonesia
        $labelMap = [
            'Fajr' => 'Subuh',
            'Sunrise' => 'Terbit',
            'Dhuhr' => 'Zuhur',
            'Asr' => 'Asar',
            'Sunset' => 'Terbenam',
            'Maghrib' => 'Magrib',
            'Isha' => 'Isya',
            'Imsak' => 'Imsak',
        ];

        // Ambil hanya jadwal penting dan ubah label
        $jadwalFiltered = collect($jadwal)
            ->only(['Imsak', 'Fajr', 'Sunrise', 'Dhuhr', 'Asr', 'Maghrib', 'Isha'])
            ->mapWithKeys(fn($time, $key) => [$labelMap[$key] ?? $key => $time]);

        return view('auth.ibadah', compact('city', 'tanggalMasehi', 'tanggalHijriah', 'jadwalFiltered'));
    }

    private function getHijriDate($carbonDate)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->get("https://api.aladhan.com/v1/gToH?date=" . $carbonDate->format('d-m-Y'));
        $data = json_decode($response->getBody(), true);

        $hijri = $data['data']['hijri'];
        $dayName = $this->translateDay($hijri['weekday']['ar']);
        $monthName = $this->translateMonth($hijri['month']['ar']);

        // Tampilkan hasil dalam format Indonesia
        return "{$dayName}, {$hijri['day']} {$monthName} {$hijri['year']} H";
    }

    private function translateDay($arabic)
    {
        return match ($arabic) {
            'السبت' => 'Sabtu',
            'الأحد' => 'Ahad',
            'الاثنين' => 'Senin',
            'الثلاثاء' => 'Selasa',
            'الاربعاء' => 'Rabu',
            'الخميس' => 'Kamis',
            'الجمعة' => 'Jumat',
            default => $arabic
        };
    }

    private function translateMonth($arabic)
    {
        return match ($arabic) {
            'محرم' => 'Muharram',
            'صفر' => 'Safar',
            'ربيع الأول' => 'Rabiul Awal',
            'ربيع الآخر' => 'Rabiul Akhir',
            'جُمادى الأولى' => 'Jumadil Awal',
            'جمادى الآخرة' => 'Jumadil Akhir',
            'رجب' => 'Rajab',
            'شعبان' => 'Syaban',
            'رمضان' => 'Ramadhan',
            'شوال' => 'Syawal',
            'ذو القعدة' => 'Zulkaidah',
            'ذو الحجة' => 'Zulhijah',
            default => $arabic
        };
    }
}
