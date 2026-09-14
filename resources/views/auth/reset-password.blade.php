<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('asset/logoPelajarnuju.png') }}" type="image/png">
    <title>Reset Password</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#098b67] min-h-screen w-full flex flex-col p-4 md:p-8 lg:p-12 font-sans antialiased box-border">

    <!-- Header Logo Khusus Mobile (Sembunyi di Desktop) -->
    <div class="md:hidden w-full flex flex-col items-center justify-center mb-6 mt-2">
        <img src="{{ asset('asset/logo pelajarnuju putih.png') }}" alt="">
    </div>

    <!-- Container Utama -->
    <div class="relative bg-white w-full flex flex-col md:flex-row overflow-hidden shadow-2xl">

        <!-- Card Putih Inner -->
        <div class="relative bg-white w-full flex flex-col md:flex-row overflow-hidden min-h-[500px]">

            <!-- Aksen Segitiga Kiri Bawah -->
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-[#b0ded5] opacity-50 z-0" style="clip-path: polygon(0 0, 0 100%, 100% 100%);"></div>
            <!-- Aksen Segitiga Kanan Atas -->
            <div class="absolute top-0 right-0 w-48 h-48 bg-[#b0ded5] opacity-50 z-0" style="clip-path: polygon(100% 0, 0 0, 100% 100%);"></div>

            <!-- Kolom Kiri: Branding (Sembunyi di Mobile) -->
            <div class="hidden md:flex md:w-1/2 flex-col items-center justify-center p-12 text-center relative z-10">
                <div class="absolute right-0 top-1/2 -translate-y-1/2 h-[70%] border-r border-gray-400"></div>

                <img src="{{ asset('asset/logo pelajarnuju hijau.png') }}" alt="">

                <p class="text-[10px] text-gray-700 leading-tight max-w-[80%] font-medium">
                    Sistem Kaderisasi dan Database Pimpinan Cabang Ikatan Pelajar Nahdlatul Ulama & Ikatan Pelajar Putri Nahdlatul Ulama Kota Administrasi Jakarta Utara
                </p>
            </div>

            <!-- Kolom Kanan: Form Reset Password -->
            <div class="w-full md:w-1/2 flex flex-col items-center justify-center p-8 md:p-12 relative z-10">
                <h3 class="text-4xl mb-2 text-black" style="font-family: 'Georgia', serif; font-style: italic;">
                    Buat Password Baru
                </h3>
                <p class="text-xs text-gray-600 mb-6 text-center max-w-[280px]">
                    Masukkan password baru untuk akun <strong class="text-[#098b67]">{{ $email }}</strong>.
                </p>

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 w-full max-w-[320px] text-xs">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.update') }}" class="w-full max-w-[320px]">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email }}">

                    <!-- Password Baru dengan Toggle Eye Icon -->
                    <div class="mb-3 relative flex items-center">
                        <input type="password" name="password" id="password" placeholder="Password Baru"
                            class="w-full pl-4 pr-12 py-3 border border-gray-400 focus:outline-none focus:border-[#098b67] text-sm text-gray-700 placeholder-gray-500 bg-transparent" required autofocus>

                        <button type="button" id="togglePassword" class="absolute right-3 text-gray-500 hover:text-[#098b67] transition-colors focus:outline-none">
                            <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 hidden">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        </button>
                    </div>

                    <!-- Konfirmasi Password dengan Toggle Eye Icon -->
                    <div class="mb-8 relative flex items-center">
                        <input type="password" name="password_confirmation" id="passwordConfirmation" placeholder="Konfirmasi Password Baru"
                            class="w-full pl-4 pr-12 py-3 border border-gray-400 focus:outline-none focus:border-[#098b67] text-sm text-gray-700 placeholder-gray-500 bg-transparent" required>

                        <button type="button" id="tandaPassword" class="absolute right-3 text-gray-500 hover:text-[#098b67] transition-colors focus:outline-none">
                            <svg id="mataTerbuka" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 hidden">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <svg id="mataTertutup" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        </button>
                    </div>

                    <!-- Button Submit -->
                    <button type="submit"
                        class="w-full py-2 mb-4 bg-gradient-to-r from-[#098b67] to-[#215a77] text-white text-sm font-semibold tracking-wide hover:opacity-90 transition-opacity">
                        RESET PASSWORD
                    </button>

                    <!-- Link Kembali -->
                    <div class="flex justify-center items-center text-[10px] md:text-xs w-full mt-2">
                        <span class="text-gray-600">Ingat password Anda?</span>
                        <a href="{{ route('login') }}" class="text-gray-800 font-semibold hover:text-[#098b67] ml-1">Kembali ke login</a>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const toggleBtn = document.getElementById('togglePassword');
        const eyeOpen = document.getElementById('eyeOpen');
        const eyeClosed = document.getElementById('eyeClosed');

        const passwordConfirmation = document.getElementById('passwordConfirmation');
        const tandaPassword = document.getElementById('tandaPassword');
        const mataTerbuka = document.getElementById('mataTerbuka');
        const mataTertutup = document.getElementById('mataTertutup');

        toggleBtn.addEventListener('click', () => {
            const isHidden = passwordInput.type === 'password';
            passwordInput.type = isHidden ? 'text' : 'password';
            eyeOpen.classList.toggle('hidden', !isHidden);
            eyeClosed.classList.toggle('hidden', isHidden);
        });

        tandaPassword.addEventListener('click', () => {
            const isHidden = passwordConfirmation.type === 'password';
            passwordConfirmation.type = isHidden ? 'text' : 'password';
            mataTerbuka.classList.toggle('hidden', !isHidden);
            mataTertutup.classList.toggle('hidden', isHidden);
        });
    </script>

</body>
</html>
