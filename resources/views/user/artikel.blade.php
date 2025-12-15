<x-layouts.app title="Artikel">
<div class="max-w-5xl mx-auto mt-10">
    <h1 class="text-xl md:text-3xl font-bold mb-6">Daftar Artikel</h1>
    <div class="grid md:flex md:flex-col lg:flex gap-6">
        @foreach($artikels as $artikel)
        <a href="{{ route('user.artikel.show', $artikel->id) }}">
        <div class="bg-white rounded-xl shadow-md overflow-hidden w-full hover:shadow-xl relative md:flex">
            <div class="w-full h-48 md:w-50 md:h-full">
                @if($artikel->gambar)
                <img src="{{ asset('uploads/artikel/'.$artikel->gambar) }}" alt="{{ $artikel->judul }}" class="w-full h-full object-cover">
                @else
                <p>gambar tidak ada</p>
                @endif
            </div>
            <div class="p-4">
                <h2 class="text-xl md:text-2xl font-semibold mb-5">{{ $artikel->judul }}</h2>
                <p class="text-gray-700 mb-2"><strong>Penulis : </strong> {{ $artikel->penulis }}</p>
                <p class="text-gray-700 line-clamp-3 md:hidden">{{ Str::limit(strip_tags($artikel->isi), 100) }}</p>
                <p class="absolute md:text-sm top-0 right-0 md:static font-semibold text-center text-white bg-blue-500 rounded-xl p-3 min-w-max md:max-w-2 md:px-3 md:py-1 md:mt-2">{{ ucfirst($artikel->kategori) }}</p>
                <a href="{{ route('user.artikel.show', $artikel->id) }}" class="text-blue-600 mt-3 inline-block">Baca selengkapnya</a>
            </div>
        </div>
        </a>
        @endforeach
    </div>
    <div class="mt-6">{{ $artikels->links() }}</div>
</div>
</x-layouts.app>
