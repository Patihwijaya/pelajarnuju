{{-- <nav class="bg-gray-900 text-white px-6 py-3 flex flex-col w-100">
    <div class="flex items-center space-x-3 mt-5">
        <img src="{{ asset('asset/logoPelajarnuju.png') }}" alt="Logo" class="h-8 w-8 rounded-full">
        <span class="font-semibold text-lg uppercase">pelajarnuju</span>
    </div>

    <ul class="flex flex-col gap-5 mt-10">
        <li class="hover:bg-gray-700 p-3"><a href="/admin/dashboard" >Dashboard</a></li>
        <li class="hover:bg-gray-700 p-3"><a href="/admin/profil" >Profil</a></li>
        <li class="hover:bg-gray-700 p-3"><a href="/admin/kegiatan" >Kegiatan</a></li>
        <li class="hover:bg-gray-700 p-3"><a href="/admin/kontak" >Kontak</a></li>
        <li class="bg-red-600 p-3 hover:bg-red-800 mt-50">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </li>
    </ul>
</nav> --}}


<aside class="w-64 bg-[#0f172a] text-white fixed top-0 left-0 h-screen flex flex-col justify-between" x-data="{ openKelola: false, openProfil: false, openKategori: false }">
        <div>
            <div class="flex items-center space-x-3 mt-5 ms-3">
                <img src="{{ asset('asset/logoPelajarnuju.png') }}" alt="Logo" class="h-8 w-8 rounded-full">
                <span class="font-semibold text-lg uppercase">pelajarnuju</span>
            </div>
            <ul class="mt-10 space-y-4 px-4">
                <li><a href="/admin/dashboard" class="block hover:bg-gray-700 p-3">Dashboard</a></li>
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
                            <li><a href="/admin/profil" class="block px-3 py-1.5 rounded hover:bg-gray-700">Sejarah</a></li>
                            <li><a href="/admin/strukturIpnu" class="block px-3 py-1.5 rounded hover:bg-gray-700">Struktuk IPNU</a></li>
                            <li><a href="/admin/strukturIppnu" class="block px-3 py-1.5 rounded hover:bg-gray-700">Struktuk IPPNU</a></li>
                        </ul>
                    </div>
                </li>
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
                            <li><a href="/admin/artikel" class="block px-3 py-1.5 rounded hover:bg-gray-700">Artikel</a></li>
                            <li><a href="/admin/kegiatan" class="block px-3 py-1.5 rounded hover:bg-gray-700">Kegiatan</a></li>
                            <li><a href="/admin/users" class="block px-3 py-1.5 rounded hover:bg-gray-700">User</a></li>
                            <li><a href="/admin/pengajuanSkIpnu" class="block px-3 py-1.5 rounded hover:bg-gray-700">Pengajuan SK</a></li>
                            <li><a href="/admin/ads" class="block px-3 py-1.5 rounded hover:bg-gray-700">Ads</a></li>
                            <li><a href="/admin/materials" class="block px-3 py-1.5 rounded hover:bg-gray-700">Materi</a></li>
                            <li><a href="/admin/kelas" class="block px-3 py-1.5 rounded hover:bg-gray-700">Kelas</a></li>
                        </ul>
                    </div>
                </li>
                <li><a href="/admin/kontak" class="block hover:bg-gray-700 p-3">Kontak</a></li>
            </ul>
        </div>


        <div class="p-4">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="hover:bg-red-500 w-full p-3 text-start">Logout</button>
            </form>
        </div>
</aside>

    <!-- Alpine.js -->
<script src="//unpkg.com/alpinejs" defer></script>

