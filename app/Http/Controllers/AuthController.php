<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; // Tambahan untuk memproses Slug
use Illuminate\Validation\Rules\Password; // Tambahan untuk validasi password
use Illuminate\Support\Facades\Mail; // Tambahan untuk mengirim email OTP

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'nomor_ponsel' => 'required',
            'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::min(8)->mixedCase()->numbers()]
        ], [
            'password.min' => 'Password minimal harus 8 karakter.',
            'password.mixed' => 'Password harus mengandung huruf besar dan huruf kecil.',
            'password.numbers' => 'Password harus mengandung setidaknya satu angka.',
        ]);

        // Cek Keamanan: Apakah email ini benar-benar sudah lolos verifikasi OTP?
        if (!session()->has('verified_email_' . $request->email)) {
            return back()->withInput()->with('error', 'Pendaftaran gagal: Anda harus memverifikasi email terlebih dahulu!');
        }

        $slug = \Illuminate\Support\Str::slug($request->name) . '-' . \Illuminate\Support\Str::random(4);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nomor_ponsel' => $request->nomor_ponsel,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'slug' => $slug,
            'email_verified_at' => now(), // Karena sudah diverifikasi lewat AJAX, langsung set aktif!
        ]);

        // Hapus stempel session agar rapi
        session()->forget('verified_email_' . $request->email);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        // 1. Cek apakah akun terdaftar sebagai Admin (Super Admin atau Admin PAC)
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            $admin = Auth::guard('admin')->user();
    
            // Arahkan dinamis berdasarkan role admin di database
            if ($admin->role === 'super_admin') {
                return redirect()->route('admin.dashboard'); // URL: /admin/dashboard
            } elseif ($admin->role === 'admin') {
                return redirect()->route('pac.dashboard');   // URL: /pac/dashboard
            }
        }
    
        // 2. Cek apakah akun terdaftar sebagai User Biasa (Anggota/Pelajar)
        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
    
            // Opsional: Validasi OTP jika diaktifkan
            // if (Auth::guard('web')->user()->email_verified_at == null) {
            //     Auth::guard('web')->logout();
            //     return redirect()->route('otp.verify')->with(['email' => $request->email, 'error' => 'Akun belum diverifikasi.']);
            // }
    
            return redirect()->route('user.dashboard'); // URL: /dashboard
        }
    
        // Jika keduanya gagal
        return back()->with('error', 'Email atau password salah!')->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function updatePassword(Request $request)
    {
        // 1. Validasi Input (Aturan ketat seperti saat Registrasi)
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::min(8)->mixedCase()->numbers()]
        ], [
            'email.exists' => 'Email tidak ditemukan.',
            'password.min' => 'Password minimal harus 8 karakter.',
            'password.mixed' => 'Password harus mengandung huruf besar dan huruf kecil.',
            'password.numbers' => 'Password harus mengandung setidaknya satu angka.',
        ]);

        // 2. Cek Keamanan: Pastikan email ini benar-benar sudah lolos verifikasi OTP
        // (Mencegah user "nakal" yang mencoba menembak URL langsung tanpa verifikasi)
        if (!session()->has('verified_email_' . $request->email)) {
            return back()->with('error', 'Akses ditolak: Anda harus memverifikasi OTP terlebih dahulu!');
        }

        // 3. Update Password di Database
        $user = \App\Models\User::where('email', $request->email)->first();
        $user->update([
            'password' => \Illuminate\Support\Facades\Hash::make($request->password)
        ]);

        // 4. Hapus stempel verifikasi dari session agar tidak bisa disalahgunakan lagi
        session()->forget('verified_email_' . $request->email);

        // 5. Arahkan kembali ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Password berhasil dipulihkan! Silakan login dengan password baru Anda.');
    }
}