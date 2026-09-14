<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Pengecekan untuk sesi Admin (PC IPNU IPPNU atau PAC)
        if (Auth::guard('admin')->check()) {
            $admin = Auth::guard('admin')->user();
            
            // Cek apakah role admin saat ini ada di dalam daftar role yang diizinkan di route
            if (in_array($admin->role, $roles)) {
                return $next($request);
            }
        }

        // Pengecekan untuk sesi User biasa (Anggota/Kader)
        if (Auth::guard('web')->check()) {
            // Karena user biasa belum punya kolom role spesifik, kita anggap rolenya 'user'
            if (in_array('user', $roles)) {
                return $next($request);
            }
        }

        // Jika tidak memenuhi syarat, lemparkan error 403 Forbidden
        abort(403, 'Akses ditolak. Anda tidak memiliki izin untuk melihat halaman ini.');
    }
}