<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('asset/logoPelajarnuju.png') }}" type="image/png">
    <title>{{ $title ?? 'Profil' }}</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex relative">
    <x-navbar />
    <div class="max-w-3xl mx-auto mt-10 flex-1" >
        {{ $slot }}
    </div>
</body>
</html>
