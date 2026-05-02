<x-layouts.app title="Kegiatan">
<div class="max-w-5xl mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-6">Daftar Kegiatan</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($kegiatan as $kegiatan)
        <a href="{{ route('user.kegiatan.lihat', $kegiatan->id) }}">
            <div class="w-full my-2 dark:bg-[#0C0C0C] hover:bg-gray-200 group rounded-2xl bg-white shadow-xl">
                @if($kegiatan->gambar)
                <div class="h-40 overflow-hidden rounded-t-xl">
                    <img src="{{ asset('uploads/kegiatan/'.$kegiatan->gambar) }}" alt="{{ $kegiatan->judul }}" class="w-full h-48 object-cover object-center">
                </div>

                @else
                <p>gambar tidak ada</p>
                @endif

                <div class="px-5 py-3 w-full flex flex-col ">
                    <h1 class="text-base line-clamp-1 font-semibold group-hover:text-green-600">{{ $kegiatan->judul }}</h1>
                    <div class="flex gap-1 items-center my-3">
                        <svg class="w-6 h-6 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z"/>
                        </svg>                              
                        <p class="text-sm text-gray-500">{{ $kegiatan->created_at->translatedFormat('l, d M Y') }}</p>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>

</div>
</x-layouts.app>
