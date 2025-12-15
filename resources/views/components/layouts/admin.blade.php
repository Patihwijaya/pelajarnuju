<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="{{ asset('asset/logoPelajarnuju.png') }}" type="image/png">
        <title>{{ $title ?? 'Admin Dashboard' }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-100 flex min-h-screen">
        <x-navbar-admin />
        <main class="ml-60 p-8 w-full overflow-y-auto">
            {{ $slot }}
        </main>
    </body>
</html>
