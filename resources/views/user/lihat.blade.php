<x-layouts.app title="sejarah">
<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-2xl p-8 ">



    <h1 class="text-xl md:text-2xl font-bold mb-4">{{ $kegiatan->judul }}</h1>
    <div class="">
        <img src="{{ asset('uploads/kegiatan/'.$kegiatan->gambar) }}" alt="{{ $kegiatan->judul }}" class=" object-cover w-full h-50 md:h-100">
    </div>

    <p class="text-gray-500 mb-6">Dibuat pada: {{ $kegiatan->created_at->format('d M Y') }}</p>

    <!-- Jika konten memiliki paragraf, buat baris baru per paragraf -->
    @foreach(explode("\n", $kegiatan->deskripsi) as $paragraph)
        <p class="mb-4">{{ $paragraph }}</p>
    @endforeach

    <a href="/kegiatan" class="text-blue-500 hover:underline">Kembali ke daftar kegiatan</a>

</div>
</x-layouts.app>
