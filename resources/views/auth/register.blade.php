<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('asset/logoPelajarnuju.png') }}" type="image/png">
    <title>Registrasi</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="bg-gray-500 h-screen flex">
    <div class="w-1/2 lg:w-2/3 relative hidden md:block">
        <img src="{{ asset('asset/bg.jpg') }}" alt="" class="w-full h-screen object-cover">
        <div class="absolute top-0 left-5 w-80 lg:w-150 lg:left-10">
            <img src="{{ asset('asset/logoPelajarnuju.png') }}" alt="" class="w-50 h-50">
            <h1 class="text-lg lg:text-5xl text-white">Hallo</h1>
            <h1 class="text-lg lg:text-5xl text-white mb-5">Rekan dan Rekanita! 👋</h1>
            <p class="text-md lg:text-md text-white">Selamat datang disitus resmi PC IPNU IPPNU Jakarta Utara, semoga hari mu menyenangkan!</p>
            <p class="text-sm text-white">Kembali ke <a href="/" class="underline font-semibold">Beranda</a></p>
        </div>
        <span class="text-gray-500 absolute bottom-10 left-5 lg:left-10">@2025 Pelajarnuju. All rights reserved</span>
    </div>

    <form action="{{ route('register') }}" method="POST" class="bg-white p-6 w-full md:w-1/2 xl:w-1/3 flex flex-col relative justify-center gap-3">
        @csrf
        <span class="underline text-sm absolute top-5 md:hidden text-blue-500">
            <a href="/" class="flex items-center">
                <svg class="w-6 h-6 text-blue-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/>
                </svg>
                Kembali
            </a>
        </span>
        <h2 class="text-lg md:text-2xl font-semibold text-center mb-4">Daftar</h2>

        <input type="text" name="name" placeholder="Nama Lengkap" class="w-full border rounded p-2" required>
        <input type="email" name="email" placeholder="Email" class="w-full border rounded p-2" required>
        <select name="jenis_kelamin" id="jenis_kelamin" class="w-full border rounded p-2">
            <option value="">-- Jenis Kelamin --</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select>
        <input type="text" name="nomor_ponsel" placeholder="nomor Ponsel" class="w-full border rounded p-2" required>
        <input type="password" name="password" placeholder="Password" class="w-full border rounded p-2" required>
        <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" class="w-full border rounded p-2" required>

        <p class="text-sm text-center">Sudah punya akun? <a href="{{ route('login') }}" class="text-black font-semibold underline">Login Sekarang!</a></p>

        <button type="submit" class="w-full bg-black text-white py-2 rounded hover:bg-gray-800">Daftar</button>

    </form>
</div>

</body>
</html>
