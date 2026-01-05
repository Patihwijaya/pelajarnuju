<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<nav class="bg-white shadow-sm fixed top-0 left-0 w-full z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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
                <img src="{{ asset('asset/logoPelajarnuju.png') }}" alt="" class="h-10 w-10 object-contain">
                <p class="font-bold text-2xl uppercase">Pelajarnuju</p>
            </div>
            </a>

            @endauth

            <!-- Tengah: Menu Navigasi -->
            @auth
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="/dashboard" class="text-gray-700 hover:text-green-600">Dashboard</a>
                </div>
            @else
                <div class="hidden md:flex space-x-8 items-center ">
                    <a href="/profile" class="text-gray-700 hover:text-green-600">Profil</a>
                    <a href="/artikel" class="text-gray-700 hover:text-green-600">Artikel</a>
                    <a href="/kegiatan" class="text-gray-700 hover:text-green-600">Kegiatan</a>
                    <a href="/kontak" class="text-gray-700 hover:text-green-600">Kontak</a>
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
                          <button id="nav-toggle" class="md:hidden flex items-center focus:outline-none">
                                <svg id="toggle-open" class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                                <svg id="toggle-close" class="w-7 h-7 hidden" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>

                    <a href="/login"
                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition hidden md:block">Login</a>
                @endauth
            </div>
        </div>
    </div>
        <div id="nav-menu" class="hidden md:hidden bg-white shadow px-4 pb-4 space-y-2">
            <a href="/profile" class="block py-2 text-gray-700 hover:text-green-600">Profil</a>
            <a href="/artikel" class="block py-2 text-gray-700 hover:text-green-600">Artikel</a>
            <a href="/kegiatan" class="block py-2 text-gray-700 hover:text-green-600">Kegiatan</a>
            <a href="/kontak" class="block py-2 text-gray-700 hover:text-green-600">Kontak</a>
            <a href="/login" class="block text-center px-4 py-2 mt-5 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">Login</a>
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

<!-- Spacer agar konten tidak tertutup navbar -->
<div class="h-16"></div>
