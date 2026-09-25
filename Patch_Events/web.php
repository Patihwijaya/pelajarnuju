<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProfilController;
use App\Models\Admin;
use App\Http\Controllers\User\ProfilController as UserProfilController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserProfilsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\IbadahConroller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\IbadahController;
use App\Http\Controllers\Admin\ArtikelController as AdminArtikelController;
use App\Http\Controllers\Admin\KegiatanController;
use App\Http\Controllers\User\ArtikelController as UserArtikelPublicController; // Alias diubah agar tidak bentrok
use App\Http\Controllers\User\KegiatanController as UserKegiatanConroller;
use App\Http\Controllers\Admin\StrukturIpnuController;
use App\Http\Controllers\Admin\StrukturIppnuController;
use App\Http\Controllers\User\StrukturIpnuController as UserStrukturIpnuController;
use App\Http\Controllers\User\StrukturIppnuController as UserStrukturIppnuController;
use App\Http\Controllers\User\KontakController;
use App\Http\Controllers\Admin\KontakController as AdminKontakController;
use App\Http\Controllers\PengajuanSkIpnuController;
use App\Http\Controllers\Admin\AdminPengajuanSkIpnuController;
use App\Http\Controllers\Admin\AdminPengajuanSkIppnuController;
use App\Http\Controllers\PilihLoginController;
use App\Http\Controllers\Admin\AdsController;
use App\Models\Ads;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\Admin\AdminMaterialController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\MaterisController;
use Illuminate\Support\Str;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\PengajuanSkIppnuController;
use App\Http\Controllers\Admin\AdminsController;
use App\Http\Controllers\UserArtikelController;
use App\Http\Controllers\Pac\ArtikelController as PacArtikelController;
use App\Http\Controllers\Admin\AdminEventController;
use App\Http\Controllers\EventController;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/pilihlogin', function () {
    return view('pilihlogin');
});
Route::get('/profile', function () {
    return view('user.profile');
});
Route::get('/sejarah', [UserProfilController::class, 'sejarah'])->name('user.sejarah');

// Tampilan Artikel Publik (Bisa diakses tanpa login)
Route::get('/artikel', [UserArtikelPublicController::class, 'index'])->name('artikel.index'); // Hapus kata 'user.'
Route::get('/artikel/{slug}', [UserArtikelPublicController::class, 'show'])->name('artikel.show'); // Hapus kata 'user.'

Route::get('/kegiatan', [UserKegiatanConroller::class, 'index'])->name('kegiatan.index');
Route::get('/kegiatan/{id}', [UserKegiatanConroller::class, 'show'])->name('kegiatan.lihat');
Route::get('/kegiatan/{id}/download-semua', [\App\Http\Controllers\User\KegiatanController::class, 'downloadSemua'])->name('kegiatan.download-semua');

Route::get('/strukturIpnu', [UserStrukturIpnuController::class, 'index'])->name('user.strukturIpnu.index');
Route::get('/strukturIppnu', [UserStrukturIppnuController::class, 'index'])->name('user.strukturIppnu.index');

Route::get('/kontak', [KontakController::class, 'form'])->name('kontak.form');
Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.store');

Route::get('/faq', function(){
    return view('user.faq', ['name' => 'Faq']);
});

// Halaman Publik Event
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{slug}', [EventController::class, 'show'])->name('events.show');
Route::get('/events/{slug}/register', [EventController::class, 'createRegistration'])->name('events.register');
Route::post('/events/{slug}/register', [EventController::class, 'storeRegistration'])->name('events.store');

// --- TAMBAHKAN RUTE CHECK-IN PUBLIK INI ---
Route::get('/event/{id}/check-in', [EventController::class, 'checkInForm'])->name('checkin.form');
Route::post('/event/{id}/check-in', [EventController::class, 'processCheckIn'])->name('checkin.process');
Route::get('/events/{slug}/success/{registrationId}', [EventController::class, 'success'])->name('events.success');

Route::get('/api/live-search', [HomeController::class, 'liveSearch'])->name('live.search');

Route::get('/ads/click/{id}', function ($id) {
    $ad = Ads::findOrFail($id);
    $ad->increment('hit');
    return redirect()->to($ad->link);
})->name('ads.click');


// -----------------------------
// ROUTE ADMIN AUTH (Satu pintu login untuk PC & PAC)
// -----------------------------
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');


// =========================================================================================
// 1. AREA SUPER ADMIN (PC IPNU IPPNU JAKARTA UTARA) - Prefix: /admin
// =========================================================================================
Route::middleware(['auth:admin', 'role:super_admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('profil', ProfilController::class)->names('admin.profil');
    Route::resource('artikel', AdminArtikelController::class)->names('admin.artikel');
    Route::resource('kegiatan', KegiatanController::class)->names('admin.kegiatan');
    Route::resource('strukturIpnu', StrukturIpnuController::class)->names('admin.strukturIpnu');
    Route::resource('strukturIppnu', StrukturIppnuController::class)->names('admin.strukturIppnu');
    Route::resource('ads', AdsController::class)->names('admin.ads');

    // Pengajuan SK
    Route::get('/pengajuanSkIpnu', [AdminPengajuanSkIpnuController::class, 'index'])->name('admin.pengajuanSkIpnu.index');
    Route::get('/pengajuanSkIpnu/{id}', [AdminPengajuanSkIpnuController::class, 'show'])->name('admin.pengajuanSkIpnu.show');
    Route::post('/pengajuanSkIpnu/{id}/status', [AdminPengajuanSkIpnuController::class, 'updateStatus'])->name('admin.pengajuanSkIpnu.updateStatus');
    Route::delete('/pengajuanSkIpnu/{id}', [AdminPengajuanSkIpnuController::class, 'destroy'])->name('admin.pengajuanSkIpnu.destroy');

    Route::get('/pengajuanSkIppnu', [AdminPengajuanSkIppnuController::class, 'index'])->name('admin.pengajuanSkIppnu.index');
    Route::get('/pengajuanSkIppnu/{id}', [AdminPengajuanSkIppnuController::class, 'show'])->name('admin.pengajuanSkIppnu.show');
    Route::post('/pengajuanSkIppnu/{id}/status', [AdminPengajuanSkIppnuController::class, 'updateStatus'])->name('admin.pengajuanSkIppnu.updateStatus');
    Route::delete('/pengajuanSkIppnu/{id}', [AdminPengajuanSkIppnuController::class, 'destroy'])->name('admin.pengajuanSkIppnu.destroy');

    // Kontak Pusat
    Route::get('/kontak', [AdminKontakController::class, 'index'])->name('admin.kontak.index');
    Route::get('/kontak/{id}', [AdminKontakController::class, 'show'])->name('admin.kontak.show');
    Route::post('/kontak/balas/{id}/', [AdminKontakController::class, 'reply'])->name('admin.kontak.reply');

    // Kelola Semua Users se-Jakut
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('/{id}', [UserController::class, 'show'])->name('admin.users.show');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    });

    // ROUTE KELOLA ADMIN PAC
    Route::resource('admins', AdminsController::class)->names('admin.admins');
    Route::get('/admins/{admin}/biodata', [AdminsController::class, 'biodata'])->name('admin.admins.biodata');
    Route::post('/admins/{admin}/biodata', [AdminsController::class, 'updateBiodata'])->name('admin.admins.biodata.update');

    // Materi & Kelas Master
    Route::resource('materials', AdminMaterialController::class)->names('admin.materials');
    Route::resource('kelas', KelasController::class);
    Route::get('kelas/{kela}/materi', [MaterisController::class, 'index'])->name('materis.index');
    Route::get('kelas/{kela}/materi/create', [MaterisController::class, 'create'])->name('materi.create');
    Route::post('kelas/{kela}/materi', [MaterisController::class, 'store'])->name('materi.store');
    Route::get('kelas/{kela}/materi/{materis}/edit', [MaterisController::class, 'edit'])->name('materi.edit');
    Route::put('kelas/{kela}/materi/{materis}', [MaterisController::class, 'update'])->name('materi.update');
    Route::delete('kelas/{kela}/materi/{materis}', [MaterisController::class, 'destroy'])->name('materi.destroy');
    Route::get('kelas/{kela}/materi/{materis}', [MaterisController::class, 'show'])->name('materi.show');

    // Route Approve dan Reject Artikel untuk Super Admin
    Route::post('/artikel/{artikel}/approve', [\App\Http\Controllers\Admin\ArtikelController::class, 'approve'])->name('admin.artikel.approve');
    Route::post('/artikel/{artikel}/reject', [\App\Http\Controllers\Admin\ArtikelController::class, 'reject'])->name('admin.artikel.reject');
    Route::post('/artikel/upload', [AdminArtikelController::class, 'upload'])->name('admin.artikel.upload');
    Route::post('/artikel/{artikel}/hide', [\App\Http\Controllers\Admin\ArtikelController::class, 'hide'])->name('admin.artikel.hide');

    // CRUD Event Utama (menggunakan AdminEventController)
    Route::resource('events', AdminEventController::class)->names('admin.events');

    // Route tambahan untuk mengelola peserta per event
    Route::get('events/{event}/participants', [AdminEventController::class, 'participants'])->name('admin.events.participants');
    Route::delete('participants/{registration}', [AdminEventController::class, 'destroyParticipant'])->name('admin.participants.destroy');
    Route::get('/check-in/{qr_token}', [EventController::class, 'verifyCheckIn'])->name('checkin.verify');
    Route::get('/admin/events/{id}/export-excel', [AdminEventController::class, 'exportExcel'])->name('admin.events.export');
    Route::get('/admin/events/{id}/export-files', [AdminEventController::class, 'exportFilesZip'])->name('admin.events.export-files');
    Route::post('/admin/events/{id}/update-checkin-status', [AdminEventController::class, 'updateCheckinStatus'])->name('admin.events.update-checkin');
});


// =========================================================================================
// 2. AREA ADMIN (PAC IPNU IPPNU TINGKAT KECAMATAN) - Prefix: /pac
// =========================================================================================
Route::middleware(['auth:admin', 'role:admin'])->prefix('pac')->group(function () {
    // Kita arahkan ke controller yang sama, tapi nama route-nya beda (prefix 'pac.')
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('pac.dashboard');
    Route::resource('profil', ProfilController::class)->names('pac.profil');
    Route::resource('artikel', PacArtikelController::class)->names('pac.artikel');
    Route::post('/artikel/upload', [PacArtikelController::class, 'upload'])->name('pac.artikel.upload');
    Route::resource('kegiatan', KegiatanController::class)->names('pac.kegiatan');
    
    // Pengajuan SK khusus PAC
    Route::get('/pengajuanSkIpnu', [AdminPengajuanSkIpnuController::class, 'index'])->name('pac.pengajuanSkIpnu.index');
    Route::get('/pengajuanSkIpnu/{id}', [AdminPengajuanSkIpnuController::class, 'show'])->name('pac.pengajuanSkIpnu.show');
    Route::post('/pengajuanSkIpnu/{id}/status', [AdminPengajuanSkIpnuController::class, 'updateStatus'])->name('pac.pengajuanSkIpnu.updateStatus');

    Route::get('/pengajuanSkIppnu', [AdminPengajuanSkIppnuController::class, 'index'])->name('pac.pengajuanSkIppnu.index');
    Route::get('/pengajuanSkIppnu/{id}', [AdminPengajuanSkIppnuController::class, 'show'])->name('pac.pengajuanSkIppnu.show');
    Route::post('/pengajuanSkIppnu/{id}/status', [AdminPengajuanSkIppnuController::class, 'updateStatus'])->name('pac.pengajuanSkIppnu.updateStatus');

    // ROUTE BIODATA KHUSUS PAC (Menggunakan data admin yang sedang login)
    Route::get('/biodata', [\App\Http\Controllers\Admin\AdminsController::class, 'myBiodata'])->name('pac.biodata');
    Route::post('/biodata', [\App\Http\Controllers\Admin\AdminsController::class, 'updateMyBiodata'])->name('pac.biodata.update');

    // Kelola Anggota khusus wilayah PAC-nya
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('pac.users.index');
        Route::get('/{id}', [UserController::class, 'show'])->name('pac.users.show');
    });
});


// -----------------------------
// ROUTE USER AUTH & AREA USER BIASA
// -----------------------------
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('user.logout');

Route::post('/ajax/send-otp', [\App\Http\Controllers\OtpController::class, 'sendOtpAjax'])->name('ajax.send.otp');
Route::post('/ajax/verify-otp', [\App\Http\Controllers\OtpController::class, 'verifyOtpAjax'])->name('ajax.verify.otp');

// Tampilan Halaman Lupa Password & Proses
Route::get('/forgot-password', [\App\Http\Controllers\AuthController::class, 'forgotPassword'])->name('password.request');
Route::post('/forgot-password', [\App\Http\Controllers\AuthController::class, 'updatePassword'])->name('password.update');
Route::post('/ajax/send-reset-otp', [\App\Http\Controllers\OtpController::class, 'sendResetOtpAjax'])->name('ajax.send.reset.otp');

// =========================================================================================
// 3. AREA DASHBOARD USER (Anggota / Pelajar)
// =========================================================================================
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('auth.dashboard');
    })->name('user.dashboard');

    Route::get('/ibadah', [IbadahConroller::class, 'index'])->name('ibadah.index');

    Route::get('/pengajuanSkIpnu', [PengajuanSkIpnuController::class, 'create']);
    Route::post('/pengajuanSkIpnu', [PengajuanSkIpnuController::class, 'store']);
    Route::get('/pengajuanSkIppnu', [PengajuanSkIppnuController::class, 'create']);
    Route::post('/pengajuanSkIppnu', [PengajuanSkIppnuController::class, 'store']);

    Route::get('/material', [MaterialController::class, 'index'])->name('material.index');
    Route::get('/materials/{id}', [MaterialController::class, 'show'])->name('material.show');

    Route::post('/user/artikel/upload', [UserArtikelController::class, 'upload'])->name('user.artikel.upload');

    // Route Manajemen Artikel User
    Route::prefix('user')->name('user.')->group(function () {
        Route::resource('artikel', \App\Http\Controllers\UserArtikelController::class)->except(['show']);
    });
    Route::post('/user/artikel/upload', [UserArtikelController::class, 'upload'])->name('user.artikel.upload');

    Route::get('/notifikasi', function () {
        $user = auth()->user();
        $notifications = $user->notifications()->latest()->get(); 
        return view('auth.notifikasi', compact('notifications'));
    })->name('notif.index');

    Route::get('/notifikasi/baca/{id}', function ($id) {
        $notif = auth()->user()->notifications()->findOrFail($id);
        $notif->markAsRead();
        return redirect()->back();
    })->name('notif.read');

    Route::get('/notifikasi/baca-semua', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    })->name('notif.readAll');

    Route::get('/profil', [UserProfilsController::class, 'index'])->name('profil.index');
    Route::post('/profil', [UserProfilsController::class, 'update'])->name('profil.update');
    Route::get('/pengaturan', [UserProfilsController::class, 'edit'])->name('profil.edit');
    Route::post('/pengaturan', [UserProfilsController::class, 'ubah'])->name('profil.ubah');
});