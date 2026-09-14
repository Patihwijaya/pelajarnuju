<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('asset/logoPelajarnuju.png') }}" type="image/png">
    <title>Login - Pelajarnuju</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<div class="min-h-screen flex flex-col md:flex-row bg-gray-50 dark:bg-gray-900">
    
    <!-- Sisi Kiri: Branding & Visual -->
    <div class="md:w-5/12 bg-gradient-to-br from-[#083C30] via-[#0b4d40] to-[#04241d] p-8 md:p-12 flex flex-col justify-between text-white relative overflow-hidden hidden md:flex">
        <!-- Elemen Dekoratif Lingkaran Cahaya -->
        <div class="absolute -top-24 -left-24 w-72 h-72 bg-[#3BD59C]/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-24 w-80 h-80 bg-emerald-400/10 rounded-full blur-3xl pointer-events-none"></div>

        <!-- Logo Atas -->
        <div class="relative z-10">
            <a href="{{ route('home') }}" class="inline-block">
                <img src="{{ asset('asset/logo pelajarnuju putih.png') }}" alt="Logo Pelajar Nuju" class="h-10 w-auto object-contain">
            </a>
        </div>

        <!-- Konten Tengah -->
        <div class="relative z-10 my-auto py-10">
            <span class="inline-block bg-[#3BD59C]/20 text-[#3BD59C] text-xs font-semibold px-3 py-1 rounded-full mb-4 border border-[#3BD59C]/30">
                Portal Resmi PC IPNU IPPNU Jakarta Utara
            </span>
            <h1 class="text-3xl md:text-4xl font-bold tracking-tight mb-4 leading-snug">
                Hallo Rekan dan Rekanita! 👋
            </h1>
            <p class="text-gray-300 text-sm md:text-base leading-relaxed">
                Selamat datang di situs resmi PC IPNU IPPNU Jakarta Utara, semoga harimu menyenangkan!
            </p>
        </div>

        <!-- Footer Kiri -->
        <div class="relative z-10 text-xs text-gray-400 flex items-center justify-between border-t border-white/10 pt-6">
            <span>&copy; 2026 Pelajarnuju. All rights reserved.</span>
            <a href="{{ route('home') }}" class="hover:text-[#3BD59C] transition-colors flex items-center gap-1">
                &larr; Kembali ke Beranda
            </a>
        </div>
    </div>

    <!-- Sisi Kanan: Form Login -->
    <div class="md:w-7/12 flex items-center justify-center p-6 md:p-16 relative w-full min-h-screen md:min-h-0">
        
        <!-- Tombol Kembali Mobile -->
        <a href="/" class="absolute top-6 left-6 text-sm font-medium text-[#083C30] hover:underline flex items-center gap-1 md:hidden">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/>
            </svg>
            Kembali
        </a>

        <div class="w-full max-w-md bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 mt-8 md:mt-0">
            
            <!-- Logo Alternatif untuk Mobile / Header Form -->
            <div class="mb-6 text-center md:text-left">
                <img src="{{ asset('asset/logo pelajarnuju hijau.png') }}" alt="Logo" class="h-8 w-auto mx-auto md:mx-0 mb-3 object-contain">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Selamat Datang Kembali!</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Silakan masukkan email dan password Anda.</p>
            </div>

            <!-- Notifikasi Error -->
            @if (session('error'))
                <div class="mb-4 p-3 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-400 text-sm rounded-xl">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-[#083C30] focus:border-transparent outline-none transition-all text-sm"
                        placeholder="nama@email.com">
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs text-[#083C30] dark:text-[#3BD59C] hover:underline font-medium">Lupa Password?</a>
                        @endif
                    </div>
                    <div class="relative">
                        <input type="password" id="password" name="password" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-[#083C30] focus:border-transparent outline-none transition-all text-sm pr-12"
                            placeholder="••••••••">
                        
                        <!-- Tombol Show/Hide Password -->
                        <button type="button" id="togglePassword" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-[#083C30] focus:outline-none p-1">
                            <!-- Mata Tertutup -->
                            <svg id="eyeClosed" class="w-5 h-5 hidden" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.933 13.909A4.357 4.357 0 0 1 3 12c0-1 4-6 9-6m7.6 3.8A5.068 5.068 0 0 1 21 12c0 1-3 6-9 6-.314 0-.62-.014-.918-.04M5 19 19 5m-4 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                            </svg>
                            <!-- Mata Terbuka -->
                            <svg id="eyeOpen" class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>
                                <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <button type="submit" 
                    class="w-full py-3 px-4 bg-[#083C30] hover:bg-[#062d24] text-white font-semibold rounded-xl shadow-lg shadow-[#083C30]/20 transition-all duration-200 text-sm flex items-center justify-center gap-2">
                    Login
                </button>
            </form>

            <p class="text-center text-sm text-gray-600 dark:text-gray-400 mt-6">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="text-[#083C30] dark:text-[#3BD59C] font-semibold hover:underline">Buat Akun Sekarang!</a>
            </p>

        </div>
    </div>

</div>

<x-alert-modal />

<script>
    const passwordInput = document.getElementById('password');
    const toggleBtn = document.getElementById('togglePassword');
    const eyeOpen = document.getElementById('eyeOpen');
    const eyeClosed = document.getElementById('eyeClosed');

    toggleBtn.addEventListener('click', () => {
        const isHidden = passwordInput.type === 'password';
        passwordInput.type = isHidden ? 'text' : 'password';
        eyeOpen.classList.toggle('hidden', !isHidden);
        eyeClosed.classList.toggle('hidden', isHidden);
    });
</script>

</body>
</html>