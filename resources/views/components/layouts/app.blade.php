<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('asset/logoPelajarnuju.png') }}" type="image/png">
    <title>{{ $title ?? 'Website PC IPNU IPPNU' }}</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    {{-- DEFAULT SEO --}}
    <meta name="description" content="Website artikel dan informasi organisasi">
    <meta name="robots" content="index, follow">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />

    {{-- OPEN GRAPH & SEO --}}
    @stack('meta')
    @vite(["resources/css/app.css", "resources/js/app.js"])

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>

    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>
<body class="bg-gray-100 dark:bg-[#0C0C0C] text-[#091413] dark:text-gray-200 flex flex-col min-h-screen antialiased overflow-x-hidden">
    <x-navbar />
    <main class="flex-1 px-[15px] md:px-20 mx-auto w-full mt-10 mb-5">
        <!-- Global Loader -->
        <div id="global-loader" class="fixed inset-0 z-[9999] hidden flex-col items-center justify-center bg-white dark:bg-[#091413] opacity-0 transition-opacity duration-300">
            <div class="relative flex items-center justify-center">
                <!-- Spinner -->
                <div class="h-16 w-16 animate-spin rounded-full border-4 border-gray-200 border-t-blue-600"></div>
            </div>
            <p class="mt-4 text-sm font-medium text-gray-500 dark:text-gray-400 font-sans">
                Mohon tunggu...
            </p>
        </div>

        <style>
            /* Paksa sembunyikan jika JavaScript mati */
            .loader-hidden {
                display: none !important;
                opacity: 0 !important;
                visibility: hidden !important;
            }
            
            /* Tampilkan hanya jika class ini ada */
            .loader-visible {
                display: flex !important;
                opacity: 1 !important;
                visibility: visible !important;
            }
        </style>

        {{ $slot }}

    </main>
    <x-footer/>

    <script>
        (function() {
            const loader = document.getElementById("global-loader");
    
            function show() {
                if(loader) loader.classList.add("loader-visible");
            }
    
            function hide() {
                if(loader) loader.classList.remove("loader-visible");
            }
    
            // 1. Sembunyikan saat halaman selesai muat
            window.addEventListener("load", hide);
    
            // 2. Jalur darurat: Sembunyikan paksa setelah 4 detik (Failsafe)
            setTimeout(hide, 4000);
    
            // 3. Handle tombol Back browser
            window.addEventListener("pageshow", (e) => {
                if (e.persisted) hide();
            });
    
            // 4. Deteksi Klik Link secara cerdas
            document.addEventListener("click", (e) => {
                const link = e.target.closest("a");
                
                // LOGIKA PENGECUALIAN (Sangat Penting)
                if (!link || !link.href) return;
                
                const url = link.href;
                const isExternal = link.target === "_blank";
                const isAnchor = url.includes("#") || url.startsWith("javascript:");
                const isDownload = link.hasAttribute("download") || url.includes("download-semua");
                const isFancybox = link.hasAttribute("data-fancybox"); // Agar saat buka galeri tidak loading
    
                if (isExternal || isAnchor || isDownload || isFancybox) {
                    return; // Jangan munculkan loading
                }
    
                show();
            });
    
            // 5. Handle Form Submit
            document.addEventListener("submit", () => {
                show();
            });
        })();
    </script>

<script>
    const carousel = document.getElementById('carousel');
    const slides = carousel.children;
    let index = 0;
    let slideCount = slides.length;

    function nextSlide() {
        index++;
        carousel.style.transition = 'transform 1s ease-in-out';
        carousel.style.transform = `translateX(-${index * 100}%)`;

        // Reset tanpa animasi saat mencapai duplikasi slide pertama
        if(index === slideCount - 1) {
            setTimeout(() => {
                carousel.style.transition = 'none';
                index = 0;
                carousel.style.transform = `translateX(0)`;
            }, 1000); // harus sama dengan duration di CSS
        }
    }

    setInterval(nextSlide, 5000); // slide otomatis setiap 3 detik
</script>
</body>
</html>
