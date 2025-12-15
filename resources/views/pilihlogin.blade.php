<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('asset/logoPelajarnuju.png') }}" type="image/png">
    <title>Document</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-800 px-5">
    <div class="w-full h-100 mx-auto mt-30 bg-gray-200 rounded-lg relative md:w-250">
        <img src="{{ asset('asset/background.jpg') }}" alt="" class="h-50 w-full rounded-t-lg bg-cover">
            <div class="w-full gap-2 items-center absolute top-10 ">
                <div class="flex">
                    <img src="{{ asset('asset/logoPelajarnuju.png') }}" alt="" class="w-20 h-20">
                    <div class="flex flex-col">
                        <h1 class="font-bold text-xl uppercase text-white">pelajarnuju</h1>
                        <p class="text-xs text-white md:text-sm">Sistem Kaderisasi PC IPNU IPPNU Jakarta Utara</p>
                    </div>
                </div>
                <a href="/">
                    <p class="m-3 w-40 h-10 flex items-center justify-center rounded-lg bg-white hover:bg-slate-200 top-5 right-5 md:absolute md:px-5 md:py-3">Kembali</p>
                </a>
            </div>

        <div class="p-5">
            <h1 class="font-bold text-2xl uppercase mb-5">Daftar Login</h1>
            <div class="flex gap-5">
                <div class="w-20 rounded-lg bg-white hover:border-2 border-gray-800">
                    <a href="{{ route('login') }}">
                        <div class="flex flex-col items-center justify-center">
                            <svg class="w-15 h-15 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z" clip-rule="evenodd"/>
                            </svg>
                            <p class="text-lg font-bold text-gray-500">user</p>
                        </div>
                    </a>
                </div>
                <div class="w-20 rounded-lg bg-white hidden xl:block hover:border-2 border-gray-800">
                    <a href="{{ route('admin.login') }}">
                        <div class="flex flex-col items-center justify-center">
                            <svg class="w-15 h-15 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z" clip-rule="evenodd"/>
                            </svg>
                            <p class="text-lg font-bold text-gray-500">Admin</p>
                        </div>
                    </a>
                </div>
            </div>

        </div>

    </div>

</body>
</html>

