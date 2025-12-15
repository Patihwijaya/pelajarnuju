<x-layouts.app title="sejarah">
<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-2xl p-8 ">
    @php
        $artikel = $artikels
    @endphp


    <h1 class="text-xl md:text-2xl font-bold mb-4">{{ $artikel->judul }}</h1>
    <img src="{{ asset('uploads/artikel/'.$artikel->gambar) }}" alt="{{ $artikel->judul }}" class="w-full h-50 md:h-100 object-cover">

    <p class="text-gray-500 mb-6">Dibuat pada: {{ $artikel->created_at->format('d M Y') }}</p>

    <!-- Jika konten memiliki paragraf, buat baris baru per paragraf -->
    @foreach(explode("\n", $artikel->isi) as $paragraph)
        <p class="mb-4">{{ $paragraph }}</p>
    @endforeach

    <p class="mb-4 text-gray-500">Penulis: {{ $artikel->penulis }}</p>
    <a href="/artikel" class="text-blue-500 hover:underline">Kembali ke daftar artikel</a>

</div>
</x-layouts.app>
