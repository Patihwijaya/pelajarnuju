<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<nav class="bg-white/40 dark:bg-[#222831]/70 backdrop-blur-xl shadow-xl fixed top-3 left-5 right-5 min-w-max rounded-full z-50">
    <div class="max-w-7xl mx-auto px-4  sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Kiri: Logo -->
            @auth
            {{-- jika sudah login --}}
            <a href="/dashboard">
                <div class="flex items-center justify-center">
                    <img src="{{ asset('asset/logoPelajarnuju.png') }}" alt="" class="h-10 w-10 object-contain">
                    <p class="font-bold text-sm md:text-2xl uppercase">Pelajarnuju</p>
                </div>
            </a>
            @else
            {{-- jika belom login --}}
            <a href="/">
                <div class="flex items-center justify-center">
                    <img src="{{ asset('asset/logo pelajarnuju hijau.png') }}" 
                        alt="Logo Pelajar NUJU Hijau" 
                        class="h-10 md:h-20 w-auto inline dark:hidden transition-opacity duration-300">

                    <img src="{{ asset('asset/logo pelajarnuju Putih.png') }}" 
                        alt="Logo Pelajar NUJU Putih" 
                        class="h-10 md:h-20 w-auto hidden dark:inline transition-opacity duration-300">
                </div>
            </a>

            @endauth

            <!-- Tengah: Menu Navigasi -->
            @auth
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="/dashboard" class="text-gray-700 hover:text-green-600">Dashboard</a>
                </div>
            @else
            <div class="hidden lg:flex items-center gap-8 text-sm font-semibold text-gray-700 dark:text-gray-200">
    
                <a href="/" class="hover:text-[#083C30] transition-colors">Beranda</a>
                
                <!-- Dropdown Profil menggunakan Alpine.js -->
                <div x-data="{ open: false }" class="relative" @mouseenter="open = true" @mouseleave="open = false">
                    <button type="button" class="flex items-center gap-1 hover:text-[#083C30] transition-colors outline-none focus:outline-none">
                        Profil
                        <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    
                    <!-- Isi Dropdown Desktop -->
                    <div 
                        x-show="open" 
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-2"
                        class="absolute top-full left-0 pt-4 w-48 z-50"
                        style="display: none;"
                    >
                        <div class="bg-white dark:bg-[#091413] shadow-xl rounded-xl py-2 border border-gray-100 dark:border-gray-800">
                            <!-- Sesuaikan link ini dengan route kamu -->
                            <a href="/sejarah" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-[#083C30]">Sejarah</a>
                            <a href="/strukturIpnu" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-[#083C30]">Struktur PC IPNU</a>
                            <a href="/strukturIppnu" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-[#083C30]">Struktur PC IPPNU</a>
                        </div>
                    </div>
                </div>
            
                <a href="/artikel" class="hover:text-[#083C30] transition-colors">Berita</a>
                <a href="/kegiatan" class="hover:text-[#083C30] transition-colors">Dokumentasi</a>
                <a href="/faq" class="hover:text-[#083C30] transition-colors">FAQ</a>
                <a href="/kontak" class="hover:text-[#083C30] transition-colors">Kontak</a>
            </div>
            @endauth


            <!-- Kanan: Tombol Login / Dropdown User -->
            <div class="flex items-center space-x-2 ">
                @auth
                    <!-- Jika User Sudah Login -->
                    {{-- notifikasi --}}
                    <div x-data="{ open:false }" class="relative">
                        <button @click="open = !open" class="inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-2 py-1 md:px-4 md:py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                🔔
                            @if(auth()->user()->unreadNotifications->count())
                                <span class="ml-1 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">
                                    {{ auth()->user()->unreadNotifications->count() }}
                                </span>
                            @endif
                        </button>
                        {{-- <div class="origin-top-right absolute right-0 mt-2 w-80 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50"> --}}
                        <div
                            x-show="open"
                            @click.away="open = false"
                            x-trasition
                            class="absolute top-10 right-0 w-48 bg-white border border-gray-200 rounded-lg shadow-lg">
                            <div class="py-1">
                                @forelse(auth()->user()->unreadNotifications as $notif)
                                    <a href="{{ route('notif.read', $notif->id) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <div class="font-semibold">{{ $notif->data['title'] }}</div>
                                        <div class="text-gray-500 text-xs">
                                            {{ $notif->data['message'] }}
                                            @isset($notif->data['catatan'])
                                                <br>{{ $notif->data['catatan'] }}
                                            @endisset
                                        </div>
                                    </a>
                                @empty
                                    <span class="block px-4 py-2 text-sm text-gray-500">Tidak ada notifikasi baru</span>
                                @endforelse
                                <div class="border-t mt-1">
                                    <a href="{{ route('notif.index') }}" class="block px-4 py-2 text-center text-sm text-blue-600 hover:bg-gray-100">Lihat semua notifikasi</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- user --}}
                    <div x-data="{ open:false }" class="relative">
                            @php
                                $user = Auth::user();
                                $foto = $user->profil->foto_profil ?? null;
                            @endphp
                        <button @click="open = !open" class="flex items-center text-gray-800 font-medium focus:outline-none">
                            @if ($foto && file_exists(public_path('uploads/foto_profil/' . $foto)))
                            <img src="{{ asset('uploads/foto_profil/'. $foto) }}" alt="Profil" class="w-10 h-10 object-cover rounded-full">
                            @else
                            <img src="{{ asset('asset/default.jpg') }}" alt="default" class="w-10 h-10 object-cover rounded-full">
                            @endif
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Dropdown -->
                        <div
                            x-show="open"
                            @click.away="open = false"
                            x-trasition
                            class="absolute right-0 w-48 bg-white border border-gray-200 rounded-lg shadow-lg">
                            <a href="/dashboard" class="block md:hidden px-4 py-2 text-gray-700 hover:bg-gray-100">Dashboard</a>
                            <a href="/profil" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profil</a>
                            <a href="/pengaturan" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Pengaturan</a>

                            <form method="POST" action="{{ route('user.logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Logout</button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Jika Belum Login -->
                    <div class="flex justify-between min-w-max gap-1 md:gap-3">
                        <div x-data="{
                            ucapan: '',
                            tanggal: '',
                            init() {
                                const jam = new Date().getHours();
                                
                                // Logika penentuan waktu
                                if (jam >= 4 && jam < 11) this.ucapan = 'Selamat Pagi 🌅';
                                else if (jam >= 11 && jam < 15) this.ucapan = 'Selamat Siang ☀️';
                                else if (jam >= 15 && jam < 18) this.ucapan = 'Selamat Sore 🌇';
                                else this.ucapan = 'Selamat Malam 🌙';
                    
                                // Format tanggal ke bahasa Indonesia
                                const opsiTanggal = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                                this.tanggal = new Date().toLocaleDateString('id-ID', opsiTanggal);
                            }
                        }" 
                        class="hidden md:block text-center rounded-2xl">
                            <p class="text-[12px] font-bold text-green-700" x-text="ucapan"></p>
                            <p class="mt-1 text-[12px] text-gray-500 dark:text-white" x-text="tanggal"></p>
                        </div>
                        <div x-data="liveSearchModal()" @keydown.escape.window="searchOpen = false">

                            <button @click="searchOpen = true; $nextTick(() => $refs.searchInput.focus())" class="bg-white dark:bg-[#222831] rounded-full p-2 transition duration-300 ease-in-out hover:bg-[#083C30] hover:dark:bg-white group">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white duration-300 ease-in-out group-hover:text-white group-hover:dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </button>
                        
                            <template x-teleport="body">
                                <div x-show="searchOpen" class="fixed inset-0 z-[100] flex items-start justify-center pt-16 sm:pt-24 px-4 pb-4" style="display: none;">
                                    
                                    <div x-show="searchOpen" class="fixed inset-0 transition-opacity bg-gray-900/50 backdrop-blur-sm" @click="searchOpen = false"></div>
                        
                                    <div x-show="searchOpen" class="relative w-full max-w-lg overflow-hidden bg-white shadow-2xl rounded-2xl" @click.stop>
                                        <form @submit.prevent class="relative flex items-center px-4 py-4 border-b border-gray-100">
                                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                            
                                            <input type="text" 
                                                   x-ref="searchInput"
                                                   x-model="keyword" 
                                                   @input.debounce.500ms="fetchResults()" 
                                                   placeholder="Cari berita atau artikel..." 
                                                   class="w-full px-3 text-base text-gray-900 bg-transparent border-0 outline-none focus:ring-0 placeholder:text-gray-400" autocomplete="off">
                                            
                                            <svg x-show="isLoading" class="w-5 h-5 text-green-500 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        
                                            <button type="button" x-show="keyword.length > 0 && !isLoading" @click="clearSearch()" class="absolute p-1 text-gray-400 right-4 hover:text-gray-600">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                            </button>
                                        </form>
                        
                                        <div class="px-5 py-6 overflow-y-auto max-h-[60vh]">
                                            
                                            <div x-show="keyword.length === 0">
                                                <h3 class="mb-3 text-xs font-medium tracking-wider text-gray-500">Mulai Mengetik...</h3>
                                            </div>
                        
                                            <div x-show="keyword.length > 0" x-cloak>
                                                <h3 class="mb-3 text-xs font-medium tracking-wider text-gray-500">Hasil Pencarian</h3>
                                                
                                                <ul x-show="results.length > 0" class="space-y-1">
                                                    <template x-for="item in results" :key="item.id">
                                                        <li>
                                                            <a :href="item.url" class="flex items-center gap-3 px-3 py-3 text-sm text-gray-700 transition rounded-lg hover:bg-gray-100 group">
                                                                <svg class="w-5 h-5 text-gray-400 group-hover:text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                                                <span x-text="item.judul"></span>
                                                            </a>
                                                        </li>
                                                    </template>
                                                </ul>
                        
                                                <div x-show="results.length === 0 && !isLoading" class="py-10 text-center">
                                                    <p class="text-sm text-gray-500">Tidak ada hasil yang cocok untuk "<span class="font-bold text-gray-800" x-text="keyword"></span>"</p>
                                                </div>
                                            </div>
                        
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <button 
                            x-data="{ isDark: document.documentElement.classList.contains('dark') }" 
                            @click="
                                isDark = !isDark; 
                                if (isDark) { 
                                    document.documentElement.classList.add('dark'); 
                                    localStorage.theme = 'dark'; 
                                } else { 
                                    document.documentElement.classList.remove('dark'); 
                                    localStorage.theme = 'light'; 
                                }
                            " 
                            class="bg-white dark:bg-[#222831] rounded-full p-2 transition duration-300 ease-in-out hover:bg-[#083C30] hover:dark:bg-white group">
                            
                            <svg x-show="!isDark" class="w-6 h-6 text-gray-800 dark:text-white duration-300 ease-in-out group-hover:text-white group-hover:dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                            </svg>
                            
                            <svg x-show="isDark" x-cloak class="w-6 h-6 text-gray-800 dark:text-white duration-300 ease-in-out group-hover:text-white group-hover:dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>

                        </button>

                        <div x-data="{ open: false }">

                            <button @click="open = true" class="bg-white dark:bg-[#222831] lg:hidden rounded-full p-2 transition duration-300 ease-in-out hover:bg-[#083C30] hover:dark:bg-white group">
                                <svg class="w-6 h-6 text-gray-800 lg:hidden dark:text-white duration-300 ease-in-out group-hover:text-white group-hover:dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>
                        
                            {{-- <div x-show="open"  x-transition.opacity.duration.300ms @click="open = false" class="fixed inset-0 z-40 bg-black/60 w-full h-full backdrop-blur-sm"></div> --}}
                            <template x-teleport="body">
        
                                <div class="relative z-[999]"> 
                                    
                                    <div x-show="open" x-transition.opacity.duration.300ms @click="open = false" class="fixed inset-0 bg-black/40 backdrop-blur-sm">
                                    </div>
                        
                                    <div :class="open ? 'translate-x-0' : 'translate-x-full'" class="fixed top-0 right-0 z-50 flex flex-col w-[85%] max-w-[360px] h-screen overflow-y-auto transition-transform duration-300 ease-in-out bg-white/70 dark:bg-black/50 backdrop-blur-xl rounded-l-[2.5rem] shadow-2xl">
                                        <div class="relative p-6">
                                            <div class="flex items-center justify-start mb-5">
                                                <img src="{{ asset('asset/logo pelajarnuju hijau.png') }}" 
                                                    alt="Logo Pelajar NUJU Hijau" 
                                                    class="h-10 w-auto inline dark:hidden transition-opacity duration-300">
                            
                                                <img src="{{ asset('asset/logo pelajarnuju Putih.png') }}" 
                                                    alt="Logo Pelajar NUJU Putih" 
                                                    class="h-10 w-auto hidden dark:inline transition-opacity duration-300">
                                            </div>
        
                                            <button @click="open = false" class="absolute flex items-center justify-center w-10 h-10 bg-white rounded-full shadow-md top-6 right-6 hover:bg-gray-50">
                                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                
                                            <div x-data="{
                                                ucapan: '',
                                                tanggal: '',
                                                init() {
                                                    const jam = new Date().getHours();
                                                    
                                                    // Logika penentuan waktu
                                                    if (jam >= 4 && jam < 11) this.ucapan = 'Selamat Pagi 🌅';
                                                    else if (jam >= 11 && jam < 15) this.ucapan = 'Selamat Siang ☀️';
                                                    else if (jam >= 15 && jam < 18) this.ucapan = 'Selamat Sore 🌇';
                                                    else this.ucapan = 'Selamat Malam 🌙';
                                        
                                                    // Format tanggal ke bahasa Indonesia
                                                    const opsiTanggal = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                                                    this.tanggal = new Date().toLocaleDateString('id-ID', opsiTanggal);
                                                }
                                            }" 
                                            class="p-4 text-center bg-gray-100/80 dark:bg-green-950/70 rounded-2xl">
                                                <p class="text-sm font-bold text-green-700" x-text="ucapan"></p>
                                                <p class="mt-1 text-xs text-gray-500 dark:text-white" x-text="tanggal"></p>
                                            </div>
                                        </div>
                                
                                        <nav class="flex-1 px-6 pb-8 space-y-1">
                                            <a href="/" class="flex items-center gap-4 px-4 py-3 text-gray-700 dark:text-white transition-colors rounded-xl hover:bg-gray-50 hover:text-green-600 group">
                                                <svg class="w-5 h-5 group-hover:text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                                                <span class="font-semibold group-hover:text-green-600">Beranda</span>
                                            </a>
                                
                                            <div x-data="{ dropdownOpen: false }" class="space-y-1">
    
                                                <button @click="dropdownOpen = !dropdownOpen" class="flex items-center justify-between w-full px-4 py-3 text-gray-700 dark:text-white transition-colors rounded-xl hover:bg-gray-50 hover:text-green-600 group">
                                                    <div class="flex items-center gap-4">
                                                        <svg class="w-5 h-5 group-hover:text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                                        <span class="font-semibold group-hover:text-green-600">Profil</span>
                                                    </div>
                                                    
                                                    <svg :class="dropdownOpen ? 'rotate-90' : ''" class="w-4 h-4 transition-transform duration-300 group-hover:text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                                </button>
                                            
                                                <div x-show="dropdownOpen" 
                                                     x-transition:enter="transition ease-out duration-200"
                                                     x-transition:enter-start="opacity-0 -translate-y-2"
                                                     x-transition:enter-end="opacity-100 translate-y-0"
                                                     x-transition:leave="transition ease-in duration-150"
                                                     x-transition:leave-start="opacity-100 translate-y-0"
                                                     x-transition:leave-end="opacity-0 -translate-y-2"
                                                     style="display: none;"
                                                     class="pl-14 pr-4 py-2 space-y-3">
                                                    
                                                    <a href="/sejarah" class="block text-sm font-medium text-gray-500 transition hover:text-green-600">Sejarah & Visi</a>
                                                    <a href="/strukturIpnu" class="block text-sm font-medium text-gray-500 transition hover:text-green-600">Struktu PC IPNU</a>
                                                    <a href="/strukturIppnu" class="block text-sm font-medium text-gray-500 transition hover:text-green-600">Struktur PC IPPNU</a>
                                                    
                                                </div>
                                            </div>

                                            <a href="/artikel" class="flex items-center gap-4 px-4 py-3 text-gray-700 dark:text-white transition-colors rounded-xl hover:bg-gray-50 hover:text-green-600 group">
                                                <svg class="w-6 h-6 group-hover:text-green-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7h1v12a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h11.5M7 14h6m-6 3h6m0-10h.5m-.5 3h.5M7 7h3v3H7V7Z"/>
                                                </svg>
                                                <span class="font-semibold group-hover:text-green-600">Berita</span>
                                            </a>
                                            
                                            <a href="/kegiatan" class="flex items-center gap-4 px-4 py-3 text-gray-700 dark:text-white transition-colors rounded-xl hover:bg-gray-50 hover:text-green-600 group">
                                                <svg class="w-6 h-6 group-hover:text-green-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m3 16 5-7 6 6.5m6.5 2.5L16 13l-4.286 6M14 10h.01M4 19h16a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z"/>
                                                </svg>                                                  
                                                <span class="font-semibold group-hover:text-green-600">Dokumentasi</span>
                                            </a>
                                            
                                            <a href="/faq" class="flex items-center gap-4 px-4 py-3 text-gray-700 dark:text-white transition-colors rounded-xl hover:bg-gray-50 hover:text-green-600 group">
                                                <svg class="w-6 h-6 group-hover:text-green-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.529 9.988a2.502 2.502 0 1 1 5 .191A2.441 2.441 0 0 1 12 12.582V14m-.01 3.008H12M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                </svg>                                        
                                                <span class="font-semibold group-hover:text-green-600">FAQ</span>
                                            </a>
                                            
                                            <a href="/kontak" class="flex items-center gap-4 px-4 py-3 text-gray-700 dark:text-white transition-colors rounded-xl hover:bg-gray-50 hover:text-green-600 group">
                                                <svg class="w-6 h-6 group-hover:text-green-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 9h3m-3 3h3m-3 3h3m-6 1c-.306-.613-.933-1-1.618-1H7.618c-.685 0-1.312.387-1.618 1M4 5h16a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Zm7 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z"/>
                                                </svg>                                       
                                                <span class="font-semibold group-hover:text-green-600">Kontak</span>
                                            </a>

                                        </nav>
                                    </div>
                                </div>
                            </template>

                        </div>
                    </div>

                    <a href="/login"
                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition hidden md:block">Login</a>
                @endauth
            </div>
        </div>
    </div>

    
</nav>

<script>
  const toggleBtn = document.getElementById('nav-toggle');
  const navMenu = document.getElementById('nav-menu');
  const openIcon = document.getElementById('toggle-open');
  const closeIcon = document.getElementById('toggle-close');


  toggleBtn.addEventListener('click', () => {
    navMenu.classList.toggle('hidden');
    openIcon.classList.toggle('hidden');
    closeIcon.classList.toggle('hidden');
  });
</script>

<script>
    function liveSearchModal() {
        return {
            searchOpen: false,
            keyword: '',
            results: [],
            isLoading: false,

            // Fungsi untuk membersihkan form
            clearSearch() {
                this.keyword = '';
                this.results = [];
                this.$refs.searchInput.focus();
            },

            // Fungsi untuk mengambil data ke server
            fetchResults() {
                // Jangan cari jika teks kurang dari 2 huruf
                if (this.keyword.length < 2) {
                    this.results = [];
                    return;
                }

                this.isLoading = true;

                // Memanggil endpoint Laravel menggunakan fetch API
                fetch(`/api/live-search?q=${encodeURIComponent(this.keyword)}`)
                    .then(response => response.json())
                    .then(data => {
                        this.results = data;
                        this.isLoading = false;
                    })
                    .catch(error => {
                        console.error('Error fetching search results:', error);
                        this.isLoading = false;
                    });
            }
        }
    }
</script>

<!-- Spacer agar konten tidak tertutup navbar -->
<div class="h-16"></div>
