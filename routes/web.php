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
use App\Http\Controllers\User\ArtikelController as UserArtikelController;
use App\Http\Controllers\User\KegiatanController as UserKegiatanConroller;
use App\Http\Controllers\Admin\StrukturIpnuController;
use App\Http\Controllers\Admin\StrukturIppnuController;
use App\Http\Controllers\User\StrukturIpnuController as UserStrukturIpnuController;
use App\Http\Controllers\User\StrukturIppnuController as UserStrukturIppnuController;
use App\Http\Controllers\User\KontakController;
use App\Http\Controllers\Admin\KontakController as AdminKontakController;
use App\Http\Controllers\PengajuanSkIpnuController;
use App\Http\Controllers\Admin\AdminPengajuanSkIpnuController;
use App\Http\Controllers\PilihLoginController;
use App\Http\Controllers\Admin\AdsController;
use App\Models\Ads;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\Admin\AdminMaterialController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\MaterisController;



Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/pilihlogin', function () {
    return view('pilihlogin');
});
Route::get('/profile', function () {
    return view('user.profile');
});
Route::get('/sejarah', [UserProfilController::class, 'sejarah'])->name('user.sejarah');

Route::get('/artikel', [UserArtikelController::class, 'index'])->name('user.artikel.index');
Route::get('/artikel/{id}', [UserArtikelController::class, 'show'])->name('user.artikel.show');

Route::get('/kegiatan', [UserKegiatanConroller::class, 'index'])->name('user.kegiatan.index');
Route::get('/kegiatan/{id}', [UserKegiatanConroller::class, 'show'])->name('user.kegiatan.lihat');

Route::get('/strukturIpnu', [UserStrukturIpnuController::class, 'index'])->name('user.strukturIpnu.index');

Route::get('/strukturIppnu', [UserStrukturIppnuController::class, 'index'])->name('user.strukturIppnu.index');

Route::get('/kontak', [KontakController::class, 'form'])->name('kontak.form');
Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.store');

Route::get('/ads/click/{id}', function ($id) {
    $ad = Ads::findOrFail($id);

    $ad->increment('hit');

    return redirect()->to($ad->link);
})->name('ads.click');



// -----------------------------
// ROUTE ADMIN AUTH
// -----------------------------
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// -----------------------------
// ROUTE ADMIN (Proteksi dengan auth:admin)
// -----------------------------
Route::middleware('auth:admin')->prefix('admin')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Profil admin
    Route::resource('profil', ProfilController::class)->names('admin.profil');

    // Artikel Admin
    Route::resource('artikel', AdminArtikelController::class)->names('admin.artikel');

    // Kegiatan Admin
    Route::resource('kegiatan', KegiatanController::class)->names('admin.kegiatan');

    // Struktur IPNU Admin
    Route::resource('strukturIpnu', StrukturIpnuController::class)->names('admin.strukturIpnu');

    // Struktur IPPNU Admin
    Route::resource('strukturIppnu', StrukturIppnuController::class)->names('admin.strukturIppnu');

    // kelola Ads
    Route::resource('ads', AdsController::class)->names('admin.ads');

    // Pengajuan SK IPNU Admin
    Route::get('/pengajuanSkIpnu', [AdminPengajuanSkIpnuController::class, 'index'])->name('admin.pengajuanSkIpnu.index');
    Route::get('/pengajuanSkIpnu/{id}', [AdminPengajuanSkIpnuController::class, 'show'])->name('admin.pengajuanSkIpnu.show');
    Route::post('/pengajuanSkIpnu/{id}/status', [AdminPengajuanSkIpnuController::class, 'updateStatus'])->name('admin.pengajuanSkIpnu.updateStatus');

    // Kontak Admin
    Route::get('/kontak', [AdminKontakController::class, 'index'])->name('admin.kontak.index');
    Route::get('/kontak/{id}', [AdminKontakController::class, 'show'])->name('admin.kontak.show');
    Route::post('/kontak/balas/{id}/', [AdminKontakController::class, 'reply'])->name('admin.kontak.reply');

    // Kelola user
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('/{id}', [UserController::class, 'show'])->name('admin.users.show');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    });

    //kelola materi
    // Route::get('/materials', [AdminMaterialController::class,'index'])->name('admin.material.index');

    // Route::get('/materials/create', [AdminMaterialController::class, 'create'])->name('admin.material.create');
    // Route::post('/materials/store', [AdminMaterialController::class, 'store'])->name('admin.material.store');

    // Route::get('/materials/{id}/edit', [AdminMaterialController::class, 'edit'])->name('admin.material.edit');
    // Route::put('/materials/{id}/update', [AdminMaterialController::class, 'update'])->name('admin.material.update');

    // Route::delete('/materials/{id}', [AdminMaterialController::class, 'destroy'])->name('admin.material.destroy');

    // Route::get('/materials/{id}/viewers', [AdminMaterialController::class, 'viewers'])->name('admin.material.viewers');
    Route::resource('materials', AdminMaterialController::class)->names('admin.materials');

    // kelola kelas
    // Route::resource('kelas', KelasController::class)->names('admin.kelas');
    Route::resource('kelas', KelasController::class);

    // kelola kelas, CRUD (di dalam kelas)
    Route::get('kelas/{kela}/materi', [MaterisController::class, 'index'])->name('materis.index');
    Route::get('kelas/{kela}/materi/create', [MaterisController::class, 'create'])->name('materi.create');
    Route::post('kelas/{kela}/materi', [MaterisController::class, 'store'])->name('materi.store');
    Route::get('kelas/{kela}/materi/{materis}/edit', [MaterisController::class, 'edit'])->name('materi.edit');
    Route::put('kelas/{kela}/materi/{materis}', [MaterisController::class, 'update'])->name('materi.update');
    Route::delete('kelas/{kela}/materi/{materis}', [MaterisController::class, 'destroy'])->name('materi.destroy');
    Route::get('kelas/{kela}/materi/{materis}', [MaterisController::class, 'show'])->name('materi.show');


});

// -----------------------------
// ROUTE USER AUTH
// -----------------------------
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('user.logout');

// -----------------------------
// ROUTE USER (Proteksi auth user biasa)
// -----------------------------
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('auth.dashboard');
    })->name('user.dashboard');

    Route::get('/ibadah', [IbadahConroller::class, 'index'])->name('ibadah.index');
    Route::get('/pengajuanSkIpnu', [PengajuanSkIpnuController::class, 'create']);
    Route::post('/pengajuanSkIpnu', [PengajuanSkIpnuController::class, 'store']);

    // Route::get('/materials', [MaterialController::class, 'index'])->name('materi.index');
    // Route::get('/materials/{id}', [MaterialController::class, 'show'])->name('materi.show');

    Route::get('/material', [MaterialController::class, 'index'])->name('material.index');
    Route::get('/materials/{id}', [MaterialController::class, 'show'])->name('material.show');


    // Halaman daftar notifikasi
    Route::get('/notifikasi', function () {
        $user = auth()->user();
        $notifications = $user->notifications()->latest()->get(); // semua notifikasi
        return view('auth.notifikasi', compact('notifications'));
    })->name('notif.index');

    // Tandai notifikasi sudah dibaca
    Route::get('/notifikasi/baca/{id}', function ($id) {
        $notif = auth()->user()->notifications()->findOrFail($id);
        $notif->markAsRead();
        return redirect()->back();
    })->name('notif.read');

    // Bisa tambahkan "tandai semua sudah dibaca"
    Route::get('/notifikasi/baca-semua', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    })->name('notif.readAll');

    Route::get('/profil', [UserProfilsController::class, 'index'])->name('profil.index');
    Route::post('/profil', [UserProfilsController::class, 'update'])->name('profil.update');
    Route::get('/pengaturan', [UserProfilsController::class, 'edit'])->name('profil.edit');
    Route::post('/pengaturan', [UserProfilsController::class, 'ubah'])->name('profil.ubah');
});
