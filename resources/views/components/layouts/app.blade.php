<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('asset/logoPelajarnuju.png') }}" type="image/png">
    <title>{{ $title ?? 'Website PC IPNU IPPNU' }}</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">
    <x-navbar />
    @auth
    <x-header/>
    @endauth
    <main class="flex-1 px-5 mb-50 md:px-20 w-full mt-5">
        <div id="global-loader" class="fixed inset-0 bg-white flex items-center justify-center z-9999 transition-opacity duration-500">

            <div class="animate-spin rounded-full h-14 w-14 border-4 border-gray-300 border-t-blue-600"></div>

        </div>

        {{ $slot }}

    </main>
    <x-footer/>

    <script>
        // 1️⃣ Loading ketika pertama kali membuka / reload halaman
        window.addEventListener("load", () => {
            const loader = document.getElementById("global-loader");
            loader.classList.add("opacity-0");
            setTimeout(() => loader.style.display = "none", 500);
        });

        // 2️⃣ Fungsi untuk menampilkan loading saat request user
        function showLoader() {
            const loader = document.getElementById("global-loader");
            loader.style.display = "flex";
            setTimeout(() => loader.classList.remove("opacity-0"), 10);
        }

        // 3️⃣ Loading otomatis untuk semua <form>
        document.addEventListener("submit", function (e) {
            if (e.target.tagName === "FORM") {
                showLoader();
            }
        });

        // 4️⃣ Loading otomatis untuk semua link yang bukan anchor internal
        document.addEventListener("click", function (e) {
            const el = e.target.closest("a");
            if (el && el.href && !el.href.includes("#")) {
                showLoader();
            }
        });

        // 5️⃣ Loading otomatis untuk fetch() / AJAX
        const originalFetch = window.fetch;
        window.fetch = async (...args) => {
            showLoader();
            try {
                return await originalFetch(...args);
            } finally {
                setTimeout(() => {
                    const loader = document.getElementById("global-loader");
                    loader.classList.add("opacity-0");
                    setTimeout(() => loader.style.display = "none", 500);
                }, 300);
            }
        };
    </script>
</body>
</html>
