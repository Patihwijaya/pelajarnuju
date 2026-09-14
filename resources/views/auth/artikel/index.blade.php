<x-layouts.app-user title="Artikel Saya">
    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        
        <!-- HEADER -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Daftar Artikel Saya</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400">Kelola tulisan Anda dan pantau status persetujuannya di sini.</p>
            </div>
            <a href="{{ route('user.artikel.create') }}" class="bg-[#083C30] hover:bg-[#062c23] text-white px-5 py-2.5 rounded-lg font-semibold transition-colors shadow-sm text-sm flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tulis Artikel Baru
            </a>
        </div>

        <!-- PANGGIL KOMPONEN ALERT KITA -->
        <x-alert-modal />

        <!-- TABEL ARTIKEL -->
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-xl overflow-hidden border border-gray-100 dark:border-gray-700">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-300 border-b dark:border-gray-600">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-center w-16">No</th>
                            <th scope="col" class="px-6 py-4">Judul Artikel</th>
                            <th scope="col" class="px-6 py-4">Kategori</th>
                            <th scope="col" class="px-6 py-4 text-center">Status</th>
                            <th scope="col" class="px-6 py-4 text-center">Tanggal Dibuat</th>
                            <th scope="col" class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($artikels as $key => $a)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                <td class="px-6 py-4 text-center font-medium text-gray-900 dark:text-white">
                                    {{ $artikels->firstItem() + $key }}
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                    <p class="line-clamp-2">{{ $a->title }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-1 rounded dark:bg-gray-700 dark:text-gray-300 whitespace-nowrap">
                                        {{ $a->kategori }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                @switch($a->status)
                                    @case('pending')
                                        <!-- Animasi: Ikon Loading Berputar (animate-spin) -->
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700 border border-yellow-200 shadow-sm">
                                            <svg class="w-3.5 h-3.5 animate-spin text-yellow-600" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                            Pending
                                        </span>
                                        @break

                                    @case('published')
                                        <!-- Animasi: Titik Radar Berkedip (animate-ping) untuk tanda "Live/Aktif" -->
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 border border-green-200 shadow-sm">
                                            <span class="relative flex h-2.5 w-2.5">
                                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-green-500"></span>
                                            </span>
                                            Published
                                        </span>
                                        @break

                                    @case('rejected')
                                        <!-- Animasi: Berdenyut Lembut (animate-pulse) dengan warna Merah -->
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700 border border-red-200 shadow-sm">
                                            <svg class="w-3.5 h-3.5 animate-pulse text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Rejected
                                        </span>
                                        @break

                                    @case('hidden')
                                        <!-- Animasi: Ikon Mata Dicoret Berdenyut (animate-pulse) dengan warna Abu-abu Gelap -->
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-700 border border-gray-200 shadow-sm">
                                            <svg class="w-3.5 h-3.5 animate-pulse text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                            </svg>
                                            Hidden
                                        </span>
                                        @break

                                    @default
                                        <!-- Fallback jika status tidak dikenali -->
                                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-600 border border-gray-200">
                                            {{ ucfirst($artikel->status) }}
                                        </span>
                                @endswitch
                                </td>
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    {{ $a->created_at->translatedFormat('d M Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('user.artikel.edit', $a->id) }}" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-2 text-center transition-colors">
                                            Edit
                                        </a>
                                        
                                        <!-- Form Hapus dengan Konfirmasi Bawaan -->
                                        <form action="{{ route('user.artikel.destroy', $a->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini? Data yang dihapus tidak bisa dikembalikan.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-xs px-3 py-2 text-center transition-colors">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <!-- TAMPILAN JIKA BELUM ADA ARTIKEL (EMPTY STATE) -->
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-16 h-16 mb-4 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l6 6v10a2 2 0 01-2 2z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14 4v6h6m-9 4h6m-6 4h6"></path>
                                        </svg>
                                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-300">Belum ada artikel</p>
                                        <p class="text-sm mt-1 mb-4">Anda belum menulis artikel apapun. Yuk, bagikan tulisan pertama Anda!</p>
                                        <a href="{{ route('user.artikel.create') }}" class="text-[#083C30] bg-green-50 hover:bg-green-100 font-medium rounded-lg text-sm px-5 py-2.5 transition-colors border border-green-200">
                                            Mulai Menulis
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- PAGINATION -->
            @if($artikels->hasPages())
                <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                    {{ $artikels->links() }}
                </div>
            @endif
        </div>
    </div>
</x-layouts.app-user>