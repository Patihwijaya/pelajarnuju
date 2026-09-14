<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('asset/logoPelajarnuju.png') }}" type="image/png">
    <title>Verifikasi OTP</title>
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

            <!-- Kolom Kanan: Form Verifikasi OTP -->
            <div class="w-full md:w-1/2 flex flex-col items-center justify-center p-8 md:p-12 relative z-10">
                <h3 class="text-4xl mb-2 text-black" style="font-family: 'Georgia', serif; font-style: italic;">
                    Verifikasi OTP
                </h3>
                <p class="text-xs text-gray-600 mb-6 text-center max-w-[280px]">
                    Kode 6 digit telah dikirim ke <strong class="text-[#098b67]">{{ $email }}</strong>. Berlaku selama 15 menit.
                </p>

                @if (session('succes'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 w-full max-w-[320px] text-xs">
                        {{ session('succes') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 w-full max-w-[320px] text-xs">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 w-full max-w-[320px] text-xs">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('verify.otp.post') }}" class="w-full max-w-[320px]">
                    @csrf

                    <!-- Input Kode OTP -->
                    <div class="mb-8">
                        <label for="otp" class="block text-xs font-medium text-gray-700 mb-1">Kode OTP</label>
                        <input type="text" name="otp" id="otp" inputmode="numeric" maxlength="6" placeholder="000000"
                            value="{{ old('otp') }}"
                            class="w-full px-3 py-3 border border-gray-400 focus:outline-none focus:border-[#098b67] text-center text-2xl tracking-[0.5em] text-gray-700 placeholder-gray-400 bg-transparent" required autofocus>
                    </div>

                    <!-- Button Verifikasi -->
                    <button type="submit"
                        class="w-full py-2 mb-4 bg-gradient-to-r from-[#098b67] to-[#215a77] text-white text-sm font-semibold tracking-wide hover:opacity-90 transition-opacity">
                        VERIFIKASI
                    </button>

                    <!-- Link Login -->
                    <div class="flex justify-center items-center text-[10px] md:text-xs w-full mt-2">
                        <span class="text-red-400 font-medium">Sudah punya akun?</span>
                        <a href="{{ route('login') }}" class="text-gray-800 font-semibold hover:text-[#098b67] ml-1">Login sekarang</a>
                    </div>
                </form>

            </div>
        </div>
    </div>

</body>
</html>
