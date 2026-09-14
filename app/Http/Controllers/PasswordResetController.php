<?php

namespace App\Http\Controllers;

use App\Mail\SendResetLinkMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $token = Password::broker()->createToken($user);
            Mail::to($user->email)->send(new SendResetLinkMail($token, $user->email));
        }

        return back()->with('status', 'Jika email tersebut terdaftar, tautan reset password telah dikirim ke email Anda.');
    }

    public function showResetForm(string $token, Request $request)
    {
        $email = rawurldecode((string) $request->query('email', ''));

        $user = $email ? User::where('email', $email)->first() : null;

        if (!$user || !Password::broker()->tokenExists($user, $token)) {
            return redirect()->route('password.request')->withErrors([
                'email' => 'Tautan reset password tidak valid atau sudah kedaluwarsa.',
            ]);
        }

        return view('auth.reset-password', [
            'token' => $token,
            'email' => $email,
        ]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $status = Password::broker()->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();

                $user->setRememberToken(Str::random(60));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', 'Password berhasil diubah. Silahkan login dengan password baru Anda.')
            : back()->withErrors(['email' => [__($status)]]);
    }
}
