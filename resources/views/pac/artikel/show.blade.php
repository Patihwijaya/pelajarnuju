<x-layouts.admin title="Review Artikel - Admin">
    <div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        
        <!-- Tombol Kembali -->
        <div class="mb-6">
            <a href="{{ route('pac.artikel.index') }}" class="text-[#083C30] dark:text-[#3BD59C] hover:underline flex items-center gap-1 text-sm font-medium transition-colors w-fit">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Daftar Artikel
            </a>
        </div>

        <!-- CARD PREVIEW ARTIKEL -->
        <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl p-6 md:p-8 border border-gray-100 dark:border-gray-700">
            
            <!-- Header Informasi Status & Kategori -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-6 pb-4 border-b border-gray-200 dark:border-gray-700">
                <span class="bg-[#083C30] text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                    {{ $artikel->kategori }}
                </span>
                
                <div>
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
                </div>
            </div>

            <!-- Judul Artikel -->
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-4 leading-snug">
                {{ $artikel->title }}
            </h1>

            <!-- Meta Info (Penulis & Tanggal) -->
            <div class="flex flex-wrap items-center gap-3 text-sm text-gray-500 dark:text-gray-400 mb-6 pb-4 border-b border-gray-200 dark:border-gray-700">
                <p>Penulis: <span class="font-semibold text-gray-700 dark:text-gray-300">{{ $artikel->penulis }}</span></p>
                <p>|</p>
                <p>Dibuat pada: {{ $artikel->created_at->translatedFormat('l, d M Y H:i') }}</p>
            </div>

            <!-- Gambar Sampul -->
            @if($artikel->gambar)
                <div class="w-full aspect-video overflow-hidden rounded-xl mb-8 shadow-md">
                    <img src="{{ asset('uploads/artikel/'.$artikel->gambar) }}" alt="{{ $artikel->title }}" class="w-full h-full object-cover object-center">
                </div>
            @endif

            <!-- Isi Konten Artikel (Render HTML dari CKEditor) -->
            <div class="prose dark:prose-invert max-w-none text-gray-800 dark:text-gray-200 leading-relaxed mb-10 text-justify">
                {!! $artikel->content !!}
            </div>

            <!-- Bagian Tombol Aksi di Bawah -->
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('pac.artikel.index') }}" class="w-full sm:w-auto text-center px-5 py-2.5 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 rounded-lg text-sm font-medium transition-colors">
                    Kembali ke Tabel
                </a>

                <div class="flex items-center gap-4">
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
                </div>
            </div>

        </div>
    </div>
</x-layouts.admin>