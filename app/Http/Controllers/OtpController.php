<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class OtpController extends Controller
{
    // 1. Fungsi Mengirim OTP ke Email (AJAX)
    public function sendOtpAjax(Request $request)
    {
        // Pastikan email valid dan belum terdaftar
        $request->validate([
            'email' => 'required|email|unique:users,email'
        ]);

        $email = $request->email;
        $otpCode = rand(100000, 999999);

        // Simpan OTP di memori sementara (Cache) selama 10 menit
        Cache::put('otp_' . $email, $otpCode, now()->addMinutes(10));

        // Kirim email
        Mail::send('emails.otp', ['otpCode' => $otpCode], function ($message) use ($email) {
            $message->to($email)->subject('Kode Verifikasi Pendaftaran - Pelajarnuju');
        });

        return response()->json(['success' => true, 'message' => 'OTP berhasil dikirim ke email!']);
    }

    // 2. Fungsi Validasi Kecocokan OTP (AJAX)
    public function verifyOtpAjax(Request $request)
    {
        $email = $request->email;
        $otp = $request->otp;

        $cachedOtp = Cache::get('otp_' . $email);

        if ($cachedOtp && $cachedOtp == $otp) {
            // Jika valid, beri "stempel" di session bahwa email ini sudah diverifikasi
            Session::put('verified_email_' . $email, true);
            Cache::forget('otp_' . $email); // Bersihkan cache OTP

            return response()->json(['success' => true, 'message' => 'Email berhasil diverifikasi!']);
        }

        return response()->json(['success' => false, 'message' => 'Kode OTP salah atau sudah kadaluarsa!'], 400);
    }

    public function sendResetOtpAjax(Request $request)
    {
        // Pastikan email valid dan TERDAFTAR di database
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], [
            'email.exists' => 'Email ini tidak terdaftar di sistem kami.'
        ]);

        $email = $request->email;
        $otpCode = rand(100000, 999999);

        // Simpan OTP di memori sementara (Cache) selama 10 menit
        Cache::put('otp_' . $email, $otpCode, now()->addMinutes(10));

        // Kirim email menggunakan template yang sama!
        Mail::send('emails.otp', ['otpCode' => $otpCode], function ($message) use ($email) {
            $message->to($email)->subject('Kode OTP Reset Password - Pelajarnuju');
        });

        return response()->json(['success' => true, 'message' => 'OTP berhasil dikirim ke email!']);
    }
}