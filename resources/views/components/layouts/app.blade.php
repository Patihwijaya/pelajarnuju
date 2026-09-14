<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Website PC IPNU IPPNU' }}</title>
    
    <link rel="icon" href="{{ asset('asset/logo pelajarnuju putih.png') }}" type="image/png">
    <meta name="description" content="Website artikel dan informasi organisasi">
    <meta name="robots" content="index, follow">
    @stack('meta')

    <!-- External CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    
    <!-- Alpine.js (Satu kali panggil saja) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Vite Assets (Tailwind & JS Internal) -->
    @vite(["resources/css/app.css", "resources/js/app.js"])

    <!-- Script Dark Mode -->
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>

<body class="bg-gray-100 dark:bg-[#0C0C0C] text-[#091413] dark:text-gray-200 flex flex-col min-h-screen antialiased overflow-x-hidden">
    
    <!-- Memanggil Komponen Loader -->
    <x-global-loader />

    <x-navbar />
    
    <main class="flex-1 px-[15px] md:px-20 mx-auto w-full mt-10 mb-5">
        
        <!-- Memanggil Komponen Korsel Iklan -->
        <x-ads-carousel />

        <!-- Konten Halaman -->
        {{ $slot }}

    </main>

    <x-alert-modal />
    
    <x-footer/>

    <!-- Area untuk script tambahan dari halaman spesifik -->
    @stack('scripts')
    
</body>
</html>