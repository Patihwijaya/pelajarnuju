<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class EventController extends Controller
{
    // Menampilkan daftar event aktif di halaman publik
    public function index()
    {
        $events = Event::latest()->paginate(9);
        return view('user.events.index', compact('events'));
    }

    // Menampilkan detail event tertentu
    public function show($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        $isFull = $event->registrations()->count() >= $event->max_participants;
        
        return view('user.events.show', compact('event', 'isFull'));
    }

    // Menampilkan form pendaftaran dinamis
    public function createRegistration($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        $isFull = $event->registrations()->count() >= $event->max_participants;

        if ($isFull) {
            return redirect()->route('events.show', $slug)->with('error', 'Maaf, kuota peserta sudah penuh.');
        }

        return view('user.events.register', compact('event'));
    }

    // Menyimpan data pendaftaran peserta baru
    public function storeRegistration(Request $request, $slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();

        // Validasi dinamis berdasarkan form_schema event
        $rules = [];
        if (is_array($event->form_schema)) {
            foreach ($event->form_schema as $field) {
                $fieldName = 'answers.' . $field['name'];
                $rules[$fieldName] = $field['required'] ? 'required' : 'nullable';
                
                if ($field['type'] === 'email') {
                    $rules[$fieldName] .= '|email';
                }
                if ($field['type'] === 'file') {
                    $rules[$fieldName] .= '|file|mimes:jpg,jpeg,png,pdf|max:2048';
                }
            }
        }

        $request->validate($rules);

        // Handle penyimpanan jawaban & file upload
        $answers = [];
        if (is_array($event->form_schema)) {
            foreach ($event->form_schema as $field) {
                $fieldName = $field['name'];
                
                // Mengecek file berdasarkan input array answers[$fieldName]
                if ($field['type'] === 'file' && $request->hasFile('answers.' . $fieldName)) {
                    $path = $request->file('answers.' . $fieldName)->store('uploads/registrations', 'public');
                    $answers[$fieldName] = $path;
                } else {
                    // Mengambil data dari array answers
                    $answers[$fieldName] = $request->input('answers.' . $fieldName);
                }
            }
        }

        $registration = Registration::create([
            'event_id' => $event->id,
            'qr_token' => Str::random(32),
            'answers' => $answers,
        ]);

        // Diperbarui: Mengarahkan langsung ke halaman sukses dengan membawa slug dan ID registrasi
        return redirect()->route('events.success', [$slug, $registration->id]);
    }

    // Menampilkan halaman Scan / Check-in Mandiri (Publik)
    public function checkInForm($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();

        // Cek status dari Cache
        $isCheckinActive = Cache::get('event_checkin_active_' . $event->id, true);

        if (!$isCheckinActive) {
            return redirect()->route('events.show', $slug)->with('error', 'Maaf, sesi check-in mandiri untuk kegiatan ini sedang ditutup oleh panitia.');
        }
        
        // Ambil label field pertama sebagai acuan pertanyaan (misal: "Nama Lengkap")
        $firstFieldLabel = 'Nama Lengkap';
        if (is_array($event->form_schema) && count($event->form_schema) > 0) {
            $firstFieldLabel = $event->form_schema[0]['label'];
        }

        return view('user.events.checkin', compact('event', 'firstFieldLabel'));
    }

    // Memproses kehadiran peserta
    public function processCheckIn(Request $request, $id)
    {
        $request->validate([
            'search_data' => 'required|string'
        ]);

        $event = Event::findOrFail($id);

        // Cek status dari Cache
        $isCheckinActive = Cache::get('event_checkin_active_' . $event->id, true);

        if (!$isCheckinActive) {
            return back()->with('error', 'Sesi check-in saat ini sedang dinonaktifkan oleh panitia.');
        }
        
        // Cari key nama sistem field pertama (misal: "nama_lengkap")
        $firstFieldName = 'nama_lengkap'; 
        if (is_array($event->form_schema) && count($event->form_schema) > 0) {
            $firstFieldName = $event->form_schema[0]['name'];
        }

        // Cari peserta di database berdasarkan event dan jawaban pada field pertama
        $registration = Registration::where('event_id', $event->id)
            ->where('answers->' . $firstFieldName, $request->search_data)
            ->first();

        // Jika data tidak ditemukan
        if (!$registration) {
            return back()->with('error', 'Data tidak ditemukan! Pastikan ejaan nama sesuai dengan saat Anda mendaftar.');
        }

        // Jika sudah pernah check-in sebelumnya
        if ($registration->attended_at) {
            return back()->with('info', 'Anda sudah berhasil check-in sebelumnya pada ' . $registration->attended_at->format('H:i') . ' WIB.');
        }

        // Catat waktu kehadiran
        $registration->update(['attended_at' => now()]);

        return back()->with('success', 'Check-in Berhasil! Selamat mengikuti kegiatan.');
    }

    // Menampilkan Halaman Sukses Pendaftaran
    public function success($slug, $registrationId)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        $registration = Registration::where('event_id', $event->id)->where('id', $registrationId)->firstOrFail();

        // Generate Google Calendar URL otomatis
        $gcalUrl = "#";
        if ($event->event_start_date) {
            $start = $event->event_start_date->format('Ymd\THis\Z');
            $end = $event->event_end_date ? $event->event_end_date->format('Ymd\THis\Z') : $event->event_start_date->copy()->addHours(2)->format('Ymd\THis\Z');
            $title = urlencode($event->title);
            $details = urlencode(strip_tags($event->description));
            $location = urlencode($event->location);
            $gcalUrl = "https://calendar.google.com/calendar/render?action=TEMPLATE&text={$title}&dates={$start}/{$end}&details={$details}&location={$location}";
        }

        return view('user.events.success', compact('event', 'registration', 'gcalUrl'));
    }
}