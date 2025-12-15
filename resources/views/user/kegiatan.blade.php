<x-layouts.app title="sejarah">
<div class="max-w-5xl mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-6">Daftar Kegiatan</h1>
    <div class="grid md:flex lg:flex gap-6">
        @foreach($kegiatan as $kegiatan)
        <a href="{{ route('user.kegiatan.lihat', $kegiatan->id) }}">
        <div class="bg-white rounded-xl shadow-md overflow-hidden w-80 hover:shadow-xl relative">
            @if($kegiatan->gambar)
                <img src="{{ asset('uploads/kegiatan/'.$kegiatan->gambar) }}" alt="{{ $kegiatan->judul }}" class="w-full h-48 object-cover">
            @else
                <p>gambar tidak ada</p>
            @endif
            <div class="p-4">
                <h2 class="text-xl font-semibold">{{ $kegiatan->judul }}</h2>
                <p class="mt-2 text-gray-700 line-clamp-3">{{ Str::limit(strip_tags($kegiatan->deskripsi), 100) }}</p>
                <a href="{{ route('user.kegiatan.lihat', $kegiatan->id) }}" class="text-blue-600 mt-3 inline-block">Baca selengkapnya</a>
            </div>
        </div>
        </a>
        @endforeach
    </div>

</div>
</x-layouts.app>
