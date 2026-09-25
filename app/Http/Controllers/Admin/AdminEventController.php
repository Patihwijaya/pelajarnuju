<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use ZipArchive;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class AdminEventController extends Controller
{
    /**
     * Menampilkan daftar semua event.
     */
    public function index()
    {
        $events = Event::with('registrations')->latest()->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    /**
     * Menampilkan form untuk membuat event baru.
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Menyimpan event baru ke dalam database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'max_participants' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'event_start_date' => 'nullable|date',
            'event_end_date' => 'nullable|date',
            'category' => 'required|string',
            'location' => 'required|string',
            'description' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'form_schema' => 'nullable|array',
            'payment_info' => 'nullable|array',
            'whatsapp_link' => 'nullable|url',
            'post_registration_note' => 'nullable|string',
            'booklet_link' => 'nullable|url',
            'twibbon_link' => 'nullable|url',
            'pre_task_info' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($request->title);

        // Jika opsi berbayar dicentang, simpan payment_info. Jika tidak, set null.
        if (!$request->has('is_paid')) {
            $validated['payment_info'] = null;
        }

        // Handle Upload Thumbnail
        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        Event::create($validated);

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil dibuat!');
    }

    /**
     * Menampilkan form edit event.
     */
    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    /**
     * Mengupdate data event.
     */
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'max_participants' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'event_start_date' => 'nullable|date',
            'event_end_date' => 'nullable|date',
            'category' => 'required|string',
            'location' => 'required|string',
            'description' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'form_schema' => 'nullable|array',
            'payment_info' => 'nullable|array',
            'whatsapp_link' => 'nullable|url',
            'post_registration_note' => 'nullable|string',
            'booklet_link' => 'nullable|url',
            'twibbon_link' => 'nullable|url',
            'pre_task_info' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($request->title);

        // Jika opsi berbayar dicentang, simpan payment_info. Jika tidak, set null.
        if (!$request->has('is_paid')) {
            $validated['payment_info'] = null;
        }

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $event->update($validated);

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil diperbarui!');
    }

    /**
     * Menghapus event dari database.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event berhasil dihapus!');
    }

    /**
     * Menampilkan halaman kelola peserta dan QR Code untuk event tertentu.
     */
    public function participants(Event $event)
    {
        $event->load('registrations');
        $isCheckinActive = Cache::get('event_checkin_active_' . $event->id, true);
        return view('admin.events.participants', compact('event', 'isCheckinActive'));
    }

    // Memperbarui status aktif/nonaktif via Cache
    public function updateCheckinStatus(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        $status = $request->is_checkin_active; // Nilai 1 atau 0

        // Simpan status ke Cache secara permanen untuk event ini
        Cache::forever('event_checkin_active_' . $event->id, $status);

        $statusText = $status ? 'diaktifkan' : 'dinonaktifkan';
        return back()->with('success', 'QR Code Check-in berhasil ' . $statusText . '.');
    }

    /**
     * Menghapus data peserta yang terdaftar pada event.
     */
    public function destroyParticipant(Registration $registration)
    {
        $registration->delete();
        return back()->with('success', 'Data peserta berhasil dihapus.');
    }

    public function verifyCheckIn($qr_token)
    {
        // Cari data registrasi berdasarkan qr_token
        $registration = Registration::where('qr_token', $qr_token)->with('event')->firstOrFail();

        // Jika belum pernah absen, catat waktu kehadirannya
        if (!$registration->attended_at) {
            $registration->update(['attended_at' => now()]);
        }

        return view('admin.events.checkin-success', compact('registration'));
    }

    public function exportExcel($id)
    {
        $event = Event::findOrFail($id);
        $registrations = $event->registrations()->latest()->get();

        // Nama file excel/csv
        $fileName = 'Data-Pendaftar-' . Str::slug($event->title) . '-' . date('Y-m-d') . '.csv';

        // Header untuk unduhan file spreadsheet
        $headers = [
            "Content-type"        => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function() use ($event, $registrations) {
            $file = fopen('php://output', 'w');
            
            // BOM UTF-8 agar karakter khusus / Excel tidak berantakan
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            // 1. BUAT HEADER KOLOM SECARA DINAMIS
            $csvHeaders = ['ID Pendaftar'];

            // Ambil struktur form dari event
            $formSchema = is_array($event->form_schema) ? $event->form_schema : [];
            foreach ($formSchema as $field) {
                $csvHeaders[] = $field['label']; // Label dinamis (Contoh: Nama Lengkap, Asal Sekolah, dll)
            }

            $csvHeaders[] = 'Status Kehadiran';
            $csvHeaders[] = 'Waktu Pendaftaran';

            fputcsv($file, $csvHeaders);

            // 2. MASUKKAN BARIS DATA PENDAFTAR SECARA DINAMIS
            foreach ($registrations as $reg) {
                $uniqueId = '09.06.5455.' . str_pad($reg->id, 4, '0', STR_PAD_LEFT);
                
                // Kolom pertama: ID Pendaftar
                $row = [$uniqueId];

                // Loop data jawaban pendaftar berdasarkan form_schema yang dibuat admin
                foreach ($formSchema as $field) {
                    $fieldName = $field['name'];
                    $val = $reg->answers[$fieldName] ?? '-';

                    // Jika kolom berupa file upload, tampilkan link akses filenya
                    if ($field['type'] === 'file' && $val !== '-') {
                        $val = asset('storage/' . $val);
                    }

                    $row[] = $val;
                }

                // Kolom tambahan di ujung baris
                $statusHadir = $reg->attended_at ? 'Hadir (' . $reg->attended_at->format('d/m/Y H:i') . ')' : 'Belum Hadir';
                $waktuDaftar = $reg->created_at->format('d/m/Y H:i');

                $row[] = $statusHadir;
                $row[] = $waktuDaftar;

                // Cetak baris ke file CSV
                fputcsv($file, $row);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportFilesZip($id)
    {
        $event = Event::findOrFail($id);
        $registrations = $event->registrations()->get();

        // 1. Siapkan folder temporary (sementara) di sistem
        $tempFolderName = 'temp_export_' . uniqid();
        $tempDirPath = storage_path('app/' . $tempFolderName);
        $berkasDirPath = $tempDirPath . '/Berkas_Peserta';
        
        \Illuminate\Support\Facades\File::makeDirectory($berkasDirPath, 0755, true, true);

        // 2. Buat file CSV (Excel) di dalam folder temporary
        $csvFileName = 'Data_Pendaftar_' . \Illuminate\Support\Str::slug($event->title) . '.csv';
        $csvPath = $tempDirPath . '/' . $csvFileName;
        $fileCsv = fopen($csvPath, 'w');
        
        // BOM UTF-8 (Agar karakter khusus rapi di Excel)
        fprintf($fileCsv, chr(0xEF).chr(0xBB).chr(0xBF));

        $csvHeaders = ['ID Pendaftar'];
        $formSchema = is_array($event->form_schema) ? $event->form_schema : [];
        foreach ($formSchema as $field) {
            $csvHeaders[] = $field['label'];
        }
        $csvHeaders[] = 'Status Kehadiran';
        $csvHeaders[] = 'Waktu Pendaftaran';
        fputcsv($fileCsv, $csvHeaders);

        // 3. Masukkan data ke CSV & Copy File ke folder Berkas_Peserta
        foreach ($registrations as $reg) {
            $uniqueId = '09.06.5455.' . str_pad($reg->id, 4, '0', STR_PAD_LEFT);
            $row = [$uniqueId];
            
            // Ambil nama pendaftar untuk penamaan file
            $namaPeserta = $reg->answers['nama_lengkap'] ?? 'Peserta_' . $reg->id;

            foreach ($formSchema as $field) {
                $fieldName = $field['name'];
                $val = $reg->answers[$fieldName] ?? '-';

                if ($field['type'] === 'file' && $val !== '-') {
                    // Cek apakah file fisik ada di storage
                    if (\Illuminate\Support\Facades\Storage::disk('public')->exists($val)) {
                        $ext = pathinfo(storage_path('app/public/' . $val), PATHINFO_EXTENSION);
                        
                        // Format nama file: nama-peserta_label-kolom_id.ekstensi
                        $newFileName = \Illuminate\Support\Str::slug($namaPeserta) . '_' . \Illuminate\Support\Str::slug($field['label']) . '_' . $reg->id . '.' . $ext;
                        
                        // Salin file asli ke dalam folder temporary
                        \Illuminate\Support\Facades\File::copy(
                            storage_path('app/public/' . $val), 
                            $berkasDirPath . '/' . $newFileName
                        );
                        
                        // Tulis "Path Offline" di file Excel
                        $row[] = 'Berkas_Peserta/' . $newFileName;
                    } else {
                        $row[] = 'File Tidak Ditemukan';
                    }
                } else {
                    // Kolom biasa (teks)
                    $row[] = $val;
                }
            }

            $row[] = $reg->attended_at ? 'Hadir (' . $reg->attended_at->format('d/m/Y H:i') . ')' : 'Belum Hadir';
            $row[] = $reg->created_at->format('d/m/Y H:i');
            fputcsv($fileCsv, $row);
        }
        fclose($fileCsv);

        // 4. Proses kompresi semuanya menjadi 1 File ZIP
        $zipFileName = 'Rekap_Data_Lengkap_' . \Illuminate\Support\Str::slug($event->title) . '.zip';
        $zipPath = storage_path('app/' . $zipFileName);

        $zip = new \ZipArchive();
        if ($zip->open($zipPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === TRUE) {
            // Tambahkan CSV ke ZIP
            $zip->addFile($csvPath, $csvFileName);
            
            // Tambahkan semua berkas ke folder Berkas_Peserta di dalam ZIP
            $files = \Illuminate\Support\Facades\File::allFiles($berkasDirPath);
            foreach ($files as $file) {
                $zip->addFile($file->getRealPath(), 'Berkas_Peserta/' . $file->getFilename());
            }
            $zip->close();
        }

        // 5. Hapus folder temporary (Bersih-bersih server)
        \Illuminate\Support\Facades\File::deleteDirectory($tempDirPath);

        // 6. Download ZIP dan HAPUS ZIP dari server setelah selesai diunduh
        return response()->download($zipPath)->deleteFileAfterSend(true);
    }
}