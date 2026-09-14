<table class="min-w-full divide-y divide-gray-200">
    <thead>
        <tr class="bg-gray-200">
            <th class="p-3 border">#</th>
            <th class="p-3 border">Penulis</th>
            <th class="p-3 border">Judul</th>
            <th class="p-3 border">Kategori</th>
            <th class="p-3 border text-center">Status</th>
            <th class="p-3 border">Klik</th>
            <th class="p-3 border">Tanggal</th>
            <th class="p-3 border text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($artikels as $key => $artikel)
            <tr class="hover:bg-gray-50">
                <td class="p-3 border text-center">{{ $artikels->firstItem() + $key }}</td>
                <td class="p-3 border">{{ $artikel->penulis }}</td>
                <td class="p-3 border">{{ $artikel->title }}</td>
                <td class="p-3 border capitalize">{{ $artikel->kategori }}</td>
                
                <!-- Kolom Status Artikel -->
                <td class="p-3 border text-center">
                @switch($artikel->status)
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

                <td class="p-3 border capitalize">{{ $artikel->lihats }} kali</td>
                <td class="p-3 border">{{ $artikel->created_at->format('d M Y') }}</td>
                <td class="p-3 border text-center">
                    <div class="flex items-center justify-center gap-1.5 flex-wrap">
                        <!-- Tombol Lihat / Preview -->
                        <a href="{{ route('pac.artikel.show', $artikel->id) }}" class="bg-gray-600 text-white px-2.5 py-1 rounded text-xs hover:bg-gray-700">Lihat</a>

                        <!-- Tombol Edit -->
                        <a href="{{ route('pac.artikel.edit', $artikel->id) }}" class="bg-blue-600 text-white px-2.5 py-1 rounded text-xs hover:bg-blue-700">Edit</a>
                        
                        <!-- Tombol Hapus -->
                        <form action="{{ route('pac.artikel.destroy', $artikel->id) }}" method="POST" class="inline-block"
                            onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-2.5 py-1 rounded text-xs hover:bg-red-700">Hapus</button>
                        </form>

                        <!-- Tombol Approval (Setujui & Tolak) Khusus Super Admin & Status Pending -->
                        @if(Auth::guard('admin')->user()->role === 'super_admin' && $artikel->status === 'pending')
                            <form action="{{ route('admin.artikel.approve', $artikel->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-green-600 text-white px-2.5 py-1 rounded text-xs hover:bg-green-700">
                                    Setujui
                                </button>
                            </form>

                            <form action="{{ route('admin.artikel.reject', $artikel->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menolak artikel ini?')">
                                @csrf
                                <button type="submit" class="bg-red-500 text-white px-2.5 py-1 rounded text-xs hover:bg-red-600">
                                    Tolak
                                </button>
                            </form>
                        @endif
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center p-4 text-gray-500">Belum ada artikel.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<!-- Menampilkan Link Paginasi -->
<div class="mt-4">
    {{ $artikels->links() }}
</div>