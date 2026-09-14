<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('asset/logoPelajarnuju.png') }}" type="image/png">
    <title>{{ $title ?? 'Website PC IPNU IPPNU' }}</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@ckeditor/ckeditor5-build-decoupled-document@41.4.2/build/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js" referrerpolicy="origin"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .ck-editor__editable {
            min-height: 450px !important;
        }
    </style>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">
    <x-navbar />
    @auth
        @if (request()->routeIs('user.dashboard'))
            <x-header />
        @endif
    @endauth
    <main class="flex-1 px-5 md:px-20 w-full mt-5">
        {{ $slot }}
    </main>


    <script>
        function updateClock() {
            const now = new Date();
            const options = { timeZone: 'Asia/Jakarta', hour: '2-digit', minute: '2-digit', second: '2-digit' };
            const timeString = now.toLocaleTimeString('id-ID', options);
            document.getElementById('jamRealtime').textContent = timeString + ' WIB';
        }

        setInterval(updateClock, 1000);
        updateClock();
    </script>
    @stack('scripts')
</body>
</html>
