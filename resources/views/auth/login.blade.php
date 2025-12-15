<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('asset/logoPelajarnuju.png') }}" type="image/png">
    <title>Login</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<div class="bg-gray-500 h-screen flex">
    <div class="w-1/2 lg:w-2/3 relative hidden md:block">
        <img src="{{ asset('asset/bg.jpg') }}" alt="" class="w-full h-screen object-cover">
        <div class="absolute top-20 left-5 w-80 lg:w-150 lg:left-30">
            <img src="{{ asset('asset/logoPelajarnuju.png') }}" alt="" class="w-50 h-50">
            <h1 class="text-lg lg:text-5xl text-white">Hallo</h1>
            <h1 class="text-lg lg:text-5xl  text-white mb-5">Rekan dan Rekanita! 👋</h1>
            <p class="text-md lg:text-md text-white">Selamat datang disitus resmi PC IPNU IPPNU Jakarta Utara, semoga hari mu menyenangkan!</p>
            <p class="text-sm text-white">Kembali ke <a href="/" class="underline font-semibold">Beranda</a></p>
        </div>
        <span class="text-gray-500 absolute bottom-10 left-5 lg:left-30">@2025 Pelajarnuju. All rights reserved</span>
    </div>

    <form action="{{ route('login') }}" method="POST" class="bg-white p-6 w-full md:w-1/2 xl:w-1/3 flex flex-col relative justify-center gap-3">
        @csrf
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif
        <span class="underline text-sm absolute top-5 md:hidden text-blue-500">
            <a href="/" class="flex items-center">
            <svg class="w-6 h-6 text-blue-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/>
            </svg>
            Kembali
            </a>
        </span>
        <h2 class="text-lg md:text-2xl font-bold text-center mb-4">Selamat Datang Kembali!</h2>

        <input type="email" name="email" placeholder="Email" class="w-full border rounded p-2" required>

        <div class="relative">
            <input type="password" id="password" name="password" placeholder="Password" class="w-full border rounded p-2" required>
            <!-- Tombol show/hide -->
                    <button
                        type="button"
                        id="togglePassword"
                        class="absolute right-3 top-2 text-gray-500 hover:text-green-600 focus:outline-none"
                    >
                        <!-- Mata tertutup -->

                        <svg id="eyeClosed" class="w-6 h-6 text-gray-800 hidden" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.933 13.909A4.357 4.357 0 0 1 3 12c0-1 4-6 9-6m7.6 3.8A5.068 5.068 0 0 1 21 12c0 1-3 6-9 6-.314 0-.62-.014-.918-.04M5 19 19 5m-4 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                        </svg>


                        <!-- Mata terbuka -->

                        <svg id="eyeOpen" class="w-6 h-6 text-gray-800 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>
                            <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                        </svg>

                    </button>
        </div>

        <p class="text-sm text-start">Belum punya akun? <a href="{{ route('register') }}" class="text-black font-semibold underline">Buat Akun Sekarang!</a></p>

        <button type="submit" class="w-full bg-black text-white py-2 rounded hover:bg-gray-800">Login</button>

    </form>

</div>

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
