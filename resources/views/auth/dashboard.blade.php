<x-layouts.app-user title="Beranda - Pelajar Nuju">
    <!-- Pembungkus Utama (Container) -->
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 space-y-8">

        <!-- 2. QUICK STATS METRICS (Statistik Ringkas) -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
            <div class="bg-white dark:bg-gray-800 p-5 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-[#083C30]/10 dark:bg-[#3BD59C]/10 text-[#083C30] dark:text-[#3BD59C] flex items-center justify-center font-bold text-xl">
                    📝
                </div>
                <div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 font-medium uppercase tracking-wider">Artikel Saya</p>
                    <h4 class="text-xl font-bold text-gray-900 dark:text-white">Kelola & Tulis</h4>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 p-5 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-blue-500/10 text-blue-600 dark:text-blue-400 flex items-center justify-center font-bold text-xl">
                    📄
                </div>
                <div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 font-medium uppercase tracking-wider">Layanan SK</p>
                    <h4 class="text-xl font-bold text-gray-900 dark:text-white">IPNU & IPPNU</h4>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 p-5 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-amber-500/10 text-amber-600 dark:text-amber-400 flex items-center justify-center font-bold text-xl">
                    📚
                </div>
                <div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 font-medium uppercase tracking-wider">Perpustakaan</p>
                    <h4 class="text-xl font-bold text-gray-900 dark:text-white">E-Book & Materi</h4>
                </div>
            </div>
        </div>

        <!-- 3. SECTION: DAFTAR LAYANAN UTAMA -->
        <div>
            <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                <div>
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white">Layanan Pelajar NU</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Pilih menu layanan yang ingin Anda akses di bawah ini.</p>
                </div>
            </div>

            <!-- Grid System responsif -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6">
                
                <!-- 1. CARD WAKTU IBADAH -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-gray-700 flex flex-col group">
                    <a href="{{ route('ibadah.index') }}" class="relative block overflow-hidden aspect-video">
                        <img src="{{ asset('asset/jam.jpg') }}" alt="Waktu Sholat" class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-3 right-3 px-3 py-1 bg-[#3BD59C]/90 backdrop-blur-sm text-[#083C30] font-bold text-[10px] uppercase tracking-wider rounded-full shadow-sm">Umum</span>
                    </a>
                    <div class="p-5 flex flex-col flex-grow">
                        <h3 class="text-base font-bold text-gray-900 dark:text-white mb-1.5 group-hover:text-[#083C30] dark:group-hover:text-[#3BD59C] transition-colors">Waktu Sholat</h3>
                        <p class="text-xs text-gray-600 dark:text-gray-400 mb-4 line-clamp-2">Jadwal sholat harian lengkap untuk wilayah sekitar.</p>
                        <a href="{{ route('ibadah.index') }}" class="mt-auto block w-full py-2.5 bg-[#083C30] hover:bg-[#062d24] text-white rounded-xl text-center font-semibold transition-colors text-xs shadow-sm">
                            Buka Layanan
                        </a>
                    </div>
                </div>

                <!-- 2. CARD PENGAJUAN SK IPNU -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-gray-700 flex flex-col group">
                    <a href="{{ url('pengajuanSkIpnu') }}" class="relative block overflow-hidden aspect-video">
                        <img src="{{ asset('asset/foto ipnu.jpeg') }}" alt="SK IPNU" class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-3 right-3 px-3 py-1 bg-blue-500/90 backdrop-blur-sm text-white font-bold text-[10px] uppercase tracking-wider rounded-full shadow-sm">IPNU</span>
                    </a>
                    <div class="p-5 flex flex-col flex-grow">
                        <h3 class="text-base font-bold text-gray-900 dark:text-white mb-1.5 group-hover:text-[#083C30] dark:group-hover:text-[#3BD59C] transition-colors">SP IPNU</h3>
                        <p class="text-xs text-gray-600 dark:text-gray-400 mb-4 line-clamp-2">Pengajuan Surat Pengesahan PAC, PR, & PK IPNU.</p>
                        <a href="{{ url('pengajuanSkIpnu') }}" class="mt-auto block w-full py-2.5 bg-[#083C30] hover:bg-[#062d24] text-white rounded-xl text-center font-semibold transition-colors text-xs shadow-sm">
                            Buat Pengajuan
                        </a>
                    </div>
                </div>

                <!-- 3. CARD PENGAJUAN SK IPPNU -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-gray-700 flex flex-col group">
                    <a href="{{ url('pengajuanSkIppnu') }}" class="relative block overflow-hidden aspect-video">
                        <img src="{{ asset('asset/foto ippnu.jpeg') }}" alt="SK IPPNU" class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-3 right-3 px-3 py-1 bg-emerald-600/90 backdrop-blur-sm text-white font-bold text-[10px] uppercase tracking-wider rounded-full shadow-sm">IPPNU</span>
                    </a>
                    <div class="p-5 flex flex-col flex-grow">
                        <h3 class="text-base font-bold text-gray-900 dark:text-white mb-1.5 group-hover:text-[#083C30] dark:group-hover:text-[#3BD59C] transition-colors">SP IPPNU</h3>
                        <p class="text-xs text-gray-600 dark:text-gray-400 mb-4 line-clamp-2">Pengajuan Surat Pengesahan PAC, PR, & PK IPPNU.</p>
                        <a href="{{ url('pengajuanSkIppnu') }}" class="mt-auto block w-full py-2.5 bg-[#083C30] hover:bg-[#062d24] text-white rounded-xl text-center font-semibold transition-colors text-xs shadow-sm">
                            Buat Pengajuan
                        </a>
                    </div>
                </div>

                <!-- 4. CARD E-BOOK (MATERIAL) -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-gray-700 flex flex-col group">
                    <a href="{{ route('material.index') }}" class="relative block overflow-hidden aspect-video">
                        <img src="{{ asset('asset/buku.jpg') }}" alt="E-Book" class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-3 right-3 px-3 py-1 bg-[#3BD59C]/90 backdrop-blur-sm text-[#083C30] font-bold text-[10px] uppercase tracking-wider rounded-full shadow-sm">Umum</span>
                    </a>
                    <div class="p-5 flex flex-col flex-grow">
                        <h3 class="text-base font-bold text-gray-900 dark:text-white mb-1.5 group-hover:text-[#083C30] dark:group-hover:text-[#3BD59C] transition-colors">E-Book</h3>
                        <p class="text-xs text-gray-600 dark:text-gray-400 mb-4 line-clamp-2">Perpustakaan digital & materi bacaan kepelajaran.</p>
                        <a href="{{ route('material.index') }}" class="mt-auto block w-full py-2.5 bg-[#083C30] hover:bg-[#062d24] text-white rounded-xl text-center font-semibold transition-colors text-xs shadow-sm">
                            Mulai Membaca
                        </a>
                    </div>
                </div>

                <!-- 5. CARD KELOLA ARTIKEL -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-gray-700 flex flex-col group">
                    <a href="{{ route('user.artikel.index') }}" class="relative block overflow-hidden aspect-video">
                        <img src="{{ asset('asset/buku.jpg') }}" alt="Artikel" class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-3 right-3 px-3 py-1 bg-[#3BD59C]/90 backdrop-blur-sm text-[#083C30] font-bold text-[10px] uppercase tracking-wider rounded-full shadow-sm">Umum</span>
                    </a>
                    <div class="p-5 flex flex-col flex-grow">
                        <h3 class="text-base font-bold text-gray-900 dark:text-white mb-1.5 group-hover:text-[#083C30] dark:group-hover:text-[#3BD59C] transition-colors">Artikel Saya</h3>
                        <p class="text-xs text-gray-600 dark:text-gray-400 mb-4 line-clamp-2">Studio penulisan dan kirim berita/opini mandiri.</p>
                        <a href="{{ route('user.artikel.index') }}" class="mt-auto block w-full py-2.5 bg-[#083C30] hover:bg-[#062d24] text-white rounded-xl text-center font-semibold transition-colors text-xs shadow-sm">
                            Buka Studio
                        </a>
                    </div>
                </div>

            </div>
        </div>

    </div>
</x-layouts.app-user>