<x-layouts.app title="Dokuementasi">
<div class="w-full bg-white dark:bg-[#091413] shadow-lg rounded-2xl p-3 md:px-20">


    <!-- Judul -->
    <h1 class="text-3xl md:text-5xl font-bold mt-4 mb-6 text-gray-900 dark:text-white leading-tight">
        {{ $kegiatan->judul }}
    </h1>

    <!-- Deskripsi -->
    <div class="text-gray-600 dark:text-gray-300 text-lg mb-8 leading-relaxed">
        @foreach(explode("\n", $kegiatan->deskripsi) as $paragraph)
            @if(trim($paragraph) !== '')
                <p class="break-words mb-4">{{ $paragraph }}</p>
            @endif
        @endforeach
    </div>

    <!-- Metadata Row -->
    <div class="flex flex-wrap items-center gap-6 text-sm text-gray-500 dark:text-gray-400 mb-8 border-b border-gray-200 dark:border-gray-800 pb-6">
        
        <!-- Tanggal Acara -->
        <div class="flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            <span>{{ $kegiatan->tanggal_acara ? $kegiatan->tanggal_acara->format('d F Y') : $kegiatan->created_at->format('d F Y') }}</span>
        </div>
        
        <!-- Lokasi -->
        <div class="flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            <span>{{ $kegiatan->lokasi ?? 'Lokasi tidak diketahui' }}</span>
        </div>

        <!-- Tim (Placeholder statis) -->
        <div class="flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            <span>Tim Dokumentasi</span>
        </div>

        <!-- Jumlah Foto (1 Cover + Total Galeri) -->
        <div class="flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2l2 2h8a2 2 0 012 2v8a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 15.5a2.5 2.5 0 10-5 0 2.5 2.5 0 005 0z"></path></svg>
            <span>{{ $kegiatan->galleries->count() + 1 }} Foto</span>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex flex-wrap gap-4 mb-8 mt-6">
        <!-- Tombol Unduh Semua (Baru) -->
        <a href="{{ route('kegiatan.download-semua', $kegiatan->id) }}" class="flex items-center gap-2 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-800 transition shadow-sm font-medium">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
            Unduh Semua
        </a>
    </div>

    <!-- GALLERY GRID -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        
        <!-- 1. Tampilkan Gambar Cover Utama -->
        <!-- Perhatikan penambahan data-fancybox="gallery" -->
        <a href="{{ asset('uploads/kegiatan/' . $kegiatan->gambar) }}" data-fancybox="gallery" class="block overflow-hidden rounded-2xl bg-gray-100 group">
            <img src="{{ asset('uploads/kegiatan/' . $kegiatan->gambar) }}" alt="Cover Utama" class="object-cover w-full h-64 md:h-80 group-hover:scale-105 transition-transform duration-300">
        </a>
        
        <!-- 2. Looping Gambar-Gambar Galeri -->
        @foreach($kegiatan->galleries as $galeri)
            <!-- Perhatikan penambahan data-fancybox="gallery" di sini juga -->
            <a href="{{ asset('uploads/kegiatan/galeri/' . $galeri->foto) }}" data-fancybox="gallery" class="block overflow-hidden rounded-2xl bg-gray-100 group">
                <img src="{{ asset('uploads/kegiatan/galeri/' . $galeri->foto) }}" alt="Dokumentasi" class="object-cover w-full h-64 md:h-80 group-hover:scale-105 transition-transform duration-300">
            </a>
        @endforeach

    </div>

    <!-- Tombol Kembali -->
    <div class="mt-12">
        <a href="/kegiatan" class="text-blue-600 hover:text-blue-800 hover:underline inline-flex items-center gap-1 font-medium">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke daftar kegiatan
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script>
    // Inisialisasi Fancybox
    Fancybox.bind('[data-fancybox="gallery"]', {
        // Opsi untuk menampilkan thumbnail di bawah
        Thumbs: {
            type: "classic",
        },
    });
</script>
</div>
</x-layouts.app>
