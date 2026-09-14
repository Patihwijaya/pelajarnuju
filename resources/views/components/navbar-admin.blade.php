<aside class="w-64 bg-[#0f172a] text-white fixed top-0 left-0 h-screen flex flex-col justify-between" x-data="{ openKelola: false, openProfil: false, openKategori: false }">
    <div>
        <div class="flex items-center space-x-3 mt-5 ms-3">
            <img src="{{ asset('asset/logoPelajarnuju.png') }}" alt="Logo" class="h-8 w-8 rounded-full">
            <span class="font-semibold text-lg uppercase">pelajarnuju</span>
        </div>
        
        <ul class="mt-10 space-y-4 px-4">
            <!-- DASHBOARD: Bisa diakses Keduanya -->
            <li>
                <a href="{{ Auth::guard('admin')->user()->isSuperAdmin() ? route('admin.dashboard') : route('pac.dashboard') }}" class="block hover:bg-gray-700 p-3 rounded">
                    Dashboard
                </a>
            </li>
            
            <!-- MENU PROFIL -->
            <li>
                <div>
                    <button
                        @click="openProfil = !openProfil"
                        class="w-full flex justify-between items-center px-3 py-2 rounded hover:bg-gray-700 transition"
                    >
                        <span><i class="bi bi-folder"></i> Profil</span>
                        <svg :class="{ 'rotate-180': openProfil }" class="w-4 h-4 transform transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <ul x-show="openProfil" x-transition class="pl-6 mt-1 space-y-1">
                        <!-- SEJARAH: Bisa diakses Keduanya -->
                        <li>
                            <a href="{{ Auth::guard('admin')->user()->isSuperAdmin() ? route('admin.profil.index') : route('pac.profil.index') }}" class="block px-3 py-1.5 rounded hover:bg-gray-700">Sejarah</a>
                        </li>
                        
                        <!-- STRUKTUR: Hanya Super Admin -->
                        @if(Auth::guard('admin')->user()->isSuperAdmin())
                            <li><a href="{{ route('admin.strukturIpnu.index') }}" class="block px-3 py-1.5 rounded hover:bg-gray-700">Struktur IPNU</a></li>
                            <li><a href="{{ route('admin.strukturIppnu.index') }}" class="block px-3 py-1.5 rounded hover:bg-gray-700">Struktur IPPNU</a></li>
                        @else
                            <li><a href="{{ route('pac.biodata') }}" class="block px-3 py-1.5 rounded hover:bg-gray-700">Biodata</a></li>
                        @endif
                    </ul>
                </div>
            </li>
            
            <!-- MENU KELOLA -->
            <li>
                <div>
                    <button
                        @click="openKelola = !openKelola"
                        class="w-full flex justify-between items-center px-3 py-2 rounded hover:bg-gray-700 transition"
                    >
                        <span><i class="bi bi-folder"></i> Kelola</span>
                        <svg :class="{ 'rotate-180': openKelola }" class="w-4 h-4 transform transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <ul x-show="openKelola" x-transition class="pl-6 mt-1 space-y-1">
                        <!-- MENU BERSAMA (Super Admin & Admin PAC) -->
                        <li><a href="{{ Auth::guard('admin')->user()->isSuperAdmin() ? route('admin.artikel.index') : route('pac.artikel.index') }}" class="block px-3 py-1.5 rounded hover:bg-gray-700">Artikel</a></li>
                        <li><a href="{{ Auth::guard('admin')->user()->isSuperAdmin() ? route('admin.kegiatan.index') : route('pac.kegiatan.index') }}" class="block px-3 py-1.5 rounded hover:bg-gray-700">Kegiatan</a></li>
                        <li><a href="{{ Auth::guard('admin')->user()->isSuperAdmin() ? route('admin.users.index') : route('pac.users.index') }}" class="block px-3 py-1.5 rounded hover:bg-gray-700">User</a></li>
                        <li><a href="{{ Auth::guard('admin')->user()->isSuperAdmin() ? route('admin.pengajuanSkIpnu.index') : route('pac.pengajuanSkIpnu.index') }}" class="block px-3 py-1.5 rounded hover:bg-gray-700">Pengajuan SK IPNU</a></li>
                        <li><a href="{{ Auth::guard('admin')->user()->isSuperAdmin() ? route('admin.pengajuanSkIppnu.index') : route('pac.pengajuanSkIppnu.index') }}" class="block px-3 py-1.5 rounded hover:bg-gray-700">Pengajuan SK IPPNU</a></li>
                        
                        <!-- MENU EKSKLUSIF (Hanya Super Admin PC) -->
                        @if(Auth::guard('admin')->user()->isSuperAdmin())
                            <li><a href="{{ route('admin.admins.index') }}" class="block px-3 py-1.5 rounded hover:bg-gray-700">Admin PC & PAC</a></li>
                            <li><a href="{{ route('admin.ads.index') }}" class="block px-3 py-1.5 rounded hover:bg-gray-700">Ads (Iklan)</a></li>
                            <li><a href="{{ route('admin.materials.index') }}" class="block px-3 py-1.5 rounded hover:bg-gray-700">Materi</a></li>
                        @endif
                    </ul>
                </div>
            </li>
            
            <!-- KONTAK: Hanya Super Admin PC -->
            @if(Auth::guard('admin')->user()->isSuperAdmin())
                <li><a href="{{ route('admin.kontak.index') }}" class="block hover:bg-gray-700 p-3 rounded">Kontak</a></li>
            @endif
        </ul>
    </div>

    <!-- TOMBOL LOGOUT -->
    <div class="p-4">
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="bg-red-600 hover:bg-red-700 w-full p-3 text-start rounded transition">
                <i class="bi bi-box-arrow-left"></i> Logout
            </button>
        </form>
    </div>
</aside>

<!-- Alpine.js -->
<script src="//unpkg.com/alpinejs" defer></script>