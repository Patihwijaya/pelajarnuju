<!-- Global Loader Component -->
<style>
    .loader-hidden {
        display: none !important;
        opacity: 0 !important;
        visibility: hidden !important;
    }
    .loader-visible {
        display: flex !important;
        opacity: 1 !important;
        visibility: visible !important;
    }
</style>

<div id="global-loader" class="fixed inset-0 z-[9999] hidden flex-col items-center justify-center bg-white dark:bg-[#091413] opacity-0 transition-opacity duration-300">
    <div class="relative flex items-center justify-center">
        <!-- Spinner -->
        <div class="h-16 w-16 animate-spin rounded-full border-4 border-gray-200 border-t-blue-600"></div>
    </div>
    <p class="mt-4 text-sm font-medium text-gray-500 dark:text-gray-400 font-sans">
        Mohon tunggu...
    </p>
</div>

<script>
    (function() {
        const loader = document.getElementById("global-loader");
        function show() { if(loader) loader.classList.add("loader-visible"); }
        function hide() { if(loader) loader.classList.remove("loader-visible"); }

        window.addEventListener("load", hide);
        setTimeout(hide, 4000); // Failsafe
        window.addEventListener("pageshow", (e) => { if (e.persisted) hide(); });

        document.addEventListener("click", (e) => {
            const link = e.target.closest("a");
            if (!link || !link.href) return;
            
            const url = link.href;
            const isExternal = link.target === "_blank";
            const isAnchor = url.includes("#") || url.startsWith("javascript:");
            const isDownload = link.hasAttribute("download") || url.includes("download-semua");
            const isFancybox = link.hasAttribute("data-fancybox");
            
            if (isExternal || isAnchor || isDownload || isFancybox) return;
            show();
        });

        document.addEventListener("submit", show);
    })();
</script>