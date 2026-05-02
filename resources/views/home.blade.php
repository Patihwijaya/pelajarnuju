<x-layouts.app title="Pelajarnuju">

@php
    $ads = \App\Models\Ads::where('status', 1)
    ->whereDate('expired_at', '>=', now())
    ->latest()
    ->get();
@endphp

@if($ads->count())
    <div class="relative w-full aspect-[5/1] overflow-hidden mb-5 md:1">
        <div id="carousel" class="flex transition-transform duration-1000">
                @foreach ($ads as $ad)
                    <div class="min-w-full">
                        <a href="{{ route('ads.click', $ad->id) }}" target="_blank">
                            @if ($ad->gambar)
                                <img src="{{ asset('uploads/ads/'.$ad->gambar) }}" class="w-full h-48 object-cover object-center">
                            @else
                                <div class="bg-yellow-200 p-4 rounded shadow">
                                    <h2 class="text-lg font-bold">{{ $ad->judul }}</h2>
                                    <p>{{ $ad->deskripsi }}</p>
                                </div>
                            @endif
                        </a>
                    </div>
                @endforeach
            @if ($ads->count() > 0)
                <div class="min-w-full">
                    <a href="{{ route('ads.click', $ad->id) }}" target="_blank">
                        @if ($ad->gambar)
                            <img src="{{ asset('uploads/ads/'.$ads[0]->gambar) }}" class="w-full h-48 object-cover object-center">
                        @else
                            <div class="bg-yellow-200 p-4 rounded shadow">
                                <h2 class="text-lg font-bold">{{ $ad->judul }}</h2>
                                <p>{{ $ad->deskripsi }}</p>
                            </div>
                        @endif
                    </a>
                </div>
            @endif
        </div>
    </div>
@else
    <div class="w-full h-30 rounded shadow bg-gray-400 flex flex-col items-center justify-center">
        <p class="text-xl text-black font-bold">ini adalah iklan</p>
    </div>
@endif

{{-- <div class="w-full inline md:grid md:grid-cols-2 mb-10">
        @if ($banner)
        <section class="w-full bg-white dark:bg-[#091413] overflow-hidden relative border-b-2 border-gray-400 border-dashed">
            <a href="{{ route('user.artikel.show', $banner->slug) }}">
                <div class="w-full h-40 md:h-90 overflow-hidden">
                    <img src="{{ asset('uploads/artikel/' . $banner->gambar) }}" class="w-full h-48 object-cover object-center">
                </div>
                <div class="py-5">
                    <h1 class="text-sm md:text-2xl font-bold text-justify group-hover:text-green-600">{{ $banner->judul }}</h1>
                    <div class="mt-2 text-sm md:text-md text-gray-700 dark:text-gray-400 text-justify line-clamp-3">{!! \Illuminate\Support\Str::limit($banner->isi, 150) !!}</div>
                    <div class="flex gap-3 items-center">
                        <p class="text-sm bg-[#083C30] text-white font-bold px-6 py-1 w-fit absolute top-5 left-5">{{ $banner->kategori }}</p>
                        <p class="text-sm text-gray-500">{{ $banner->created_at->translatedFormat('l, d M Y') }} |</p>
                        <p class="text-sm text-gray-500">{{ $banner->created_at->diffForHumans()}}</p>
                    </div>
                    <a href="{{ route('user.artikel.show', $banner->id) }}" class="text-blue-600 mt-3 inline-block">Baca Selengkapnya</a>
                </div>
            </a>
        </section>
        @endif

        <div class="flex flex-col">
        @foreach($artikel as $a)
            <a href="{{ route('user.artikel.show', $a->slug) }}">
                <div class="flex w-full dark:bg-[#091413] hover:bg-gray-200 group bg-white border-b-2 border-gray-400 border-dashed my-2">
                    <div class="w-full flex flex-col py-2">
                        <div class="flex flex-col gap-2 pe-2">
                            <p class="text-sm bg-[#083C30] text-white max-w-min px-6 py-1">{{ $a->kategori }}</p>
                            <h1 class="text-sm font-bold text-justify group-hover:text-green-600">{{ $a->judul }}</h1>
                            <div class="flex w-full gap-3">
                                <p class="text-sm text-gray-500">{{ $a->created_at->translatedFormat('l, d M Y') }}</p>
                                <p class="text-sm text-gray-500">{{ $a->created_at->diffForHumans()}}</p>
                            </div>
                        </div>
                    </div>

                    @if($a->gambar)
                        <div class="w-30 overflow-hidden">
                                <img src="{{ asset('uploads/artikel/'.$a->gambar) }}" alt="{{ $a->judul }}" class="w-full aspect-square object-cover object-center">
                        </div>
                        
                        @else
                        <p>gambar tidak ada</p>
                    @endif
                </div>
            </a>
        @endforeach
    </div>
    <div class="col-start-1 col-end-3 w-full mt-10 order-2 text-center group ">
        <p><a href="/artikel" class="text-blue-600 dark:text-white hover:bg-gray-200 bg-white dark:bg-gray-800 hover:dark:bg-gray-500 p-3 rounded-2xl hover:underline">Lihat Selengkapnya</a></p>
    </div>
</div> --}}

@php
    // Membagi daftar artikel menjadi dua bagian untuk kolom kiri dan kanan
    $artikelKiri = $artikel->slice(0, 3); // Ambil 3 artikel pertama untuk Kiri
    $artikelTengahBawah = $artikel->slice(3, 2); // Ambil 2 artikel selanjutnya untuk Tengah
    $artikelKanan = $artikel->slice(5, 3); // Ambil 3 artikel terakhir untuk Kanan
@endphp

<div class=" mb-10">
    <!-- Grid System: 1 kolom di HP, 4 kolom di Desktop (1 Kiri, 2 Tengah, 1 Kanan) -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

        <!-- KOLOM KIRI -->
        <div class="lg:col-span-1 flex flex-col gap-6">
            @foreach($artikelKiri as $a)
                <a href="{{ route('user.artikel.show', $a->slug) }}" class="group block border-b border-dashed border-gray-400 pb-4">
                    @if($a->gambar)
                        <div class="w-full aspect-[4/3] overflow-hidden rounded mb-3">
                            <img src="{{ asset('uploads/artikel/'.$a->gambar) }}" alt="{{ $a->judul }}" class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-300">
                        </div>
                    @endif
                    <span class="bg-[#083C30] text-white text-xs font-semibold px-2 py-1 rounded inline-block mb-2">{{ $a->kategori }}</span>
                    <h1 class="text-base font-bold leading-tight mb-2 group-hover:text-green-600 transition-colors text-justify">{{ $a->judul }}</h1>
                    <div class="flex gap-2 text-xs text-gray-500">
                        <p>{{ $a->created_at->translatedFormat('d M Y') }}</p>
                        <p>|</p>
                        <p>{{ $a->created_at->diffForHumans() }}</p>
                    </div>
                </a>
            @endforeach
        </div>

        <!-- KOLOM TENGAH (BANNER UTAMA) -->
        <div class="lg:col-span-2 flex flex-col">
            @if ($banner)
                <section class="w-full relative group pb-6 lg:border-b-0 border-b border-dashed border-gray-400">
                    <a href="{{ route('user.artikel.show', $banner->slug) }}" class="block">
                        <!-- Gambar Banner: aspect-video memastikan gambar tidak melar -->
                        <div class="w-full aspect-video overflow-hidden rounded mb-4 relative">
                            <img src="{{ asset('uploads/artikel/' . $banner->gambar) }}" class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500">
                            <!-- Kategori melayang di atas gambar -->
                            <span class="absolute top-4 left-4 bg-[#083C30] text-white text-xs font-bold px-4 py-1 rounded shadow">{{ $banner->kategori }}</span>
                        </div>
                        
                        <h1 class="text-base md:text-xl font-bold text-justify group-hover:text-green-600 transition-colors mb-3">{{ $banner->judul }}</h1>
                        
                        <div class="text-gray-700 dark:text-gray-400 text-justify line-clamp-3 mb-4 leading-relaxed text-sm md:text-base">
                            {!! \Illuminate\Support\Str::limit($banner->isi, 150) !!}
                        </div>
                        
                        <div class="flex gap-2 items-center text-sm text-gray-500 mb-4">
                            <p>{{ $banner->created_at->translatedFormat('l, d M Y') }}</p>
                            <p>|</p>
                            <p>{{ $banner->created_at->diffForHumans() }}</p>
                        </div>
                        
                        <span class="text-blue-600 font-medium hover:underline inline-block">Baca Selengkapnya &rarr;</span>
                    </a>
                </section>
            @endif
            <div class="hidden md:flex flex-col gap-4 border-t-2 border-dashed border-gray-300 pt-6 mt-2">
                @foreach($artikelTengahBawah as $a)
                    <a href="{{ route('user.artikel.show', $a->slug) }}" class="group flex gap-4 pb-4 border-b border-dashed border-gray-300 last:border-0 last:pb-0">
                        
                        <!-- Gambar (Di Kiri) -->
                        @if($a->gambar)
                            <div class="w-1/3 aspect-[4/3] overflow-hidden rounded shrink-0">
                                <img src="{{ asset('uploads/artikel/'.$a->gambar) }}" alt="{{ $a->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            </div>
                        @endif

                        <!-- Teks (Di Kanan) -->
                        <div class="w-2/3 flex flex-col justify-center">
                            <span class="bg-[#083C30] text-white text-[10px] font-bold px-2 py-1 rounded inline-block mb-2 w-fit uppercase">{{ $a->kategori }}</span>
                            <h3 class="text-sm md:text-base font-bold leading-snug mb-1 group-hover:text-[#083C30] transition-colors">{{ $a->judul }}</h3>
                            <div class="flex gap-2 text-xs text-gray-500 mt-1">
                                <p>{{ $a->created_at->translatedFormat('d M Y') }}</p>
                            </div>
                        </div>

                    </a>
                @endforeach
            </div>
        </div>
        <!-- KOLOM KANAN -->
        <div class="lg:col-span-1 flex flex-col gap-6">
            @foreach($artikelKanan as $a)
                <a href="{{ route('user.artikel.show', $a->slug) }}" class="group block border-b border-dashed border-gray-400 pb-4">
                    @if($a->gambar)
                        <div class="w-full aspect-[4/3] overflow-hidden rounded mb-3">
                            <img src="{{ asset('uploads/artikel/'.$a->gambar) }}" alt="{{ $a->judul }}" class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-300">
                        </div>
                    @endif
                    <span class="bg-[#083C30] text-white text-xs font-semibold px-2 py-1 rounded inline-block mb-2">{{ $a->kategori }}</span>
                    <h1 class="text-base font-bold leading-tight mb-2 group-hover:text-green-600 transition-colors text-justify">{{ $a->judul }}</h1>
                    <div class="flex gap-2 text-xs text-gray-500">
                        <p>{{ $a->created_at->translatedFormat('d M Y') }}</p>
                        <p>|</p>
                        <p>{{ $a->created_at->diffForHumans() }}</p>
                    </div>
                </a>
            @endforeach
        </div>

    </div>

    <!-- Tombol Lihat Selengkapnya (Di luar grid agar posisinya full di tengah bawah) -->
    <div class="w-full mt-12 text-center">
        <a href="/artikel" class="text-blue-600 text-base dark:text-white hover:bg-gray-200 bg-white dark:bg-gray-800 hover:dark:bg-gray-500 px-3 py-1 md:px-6 md:py-3 rounded-full font-medium hover:underline transition-colors shadow-sm">
            Lihat Selengkapnya Semua Artikel
        </a>
    </div>
</div>

<div class="my-5">
    <div class="flex gap-2 items-center mb-3">
        <div class="flex flex-col gap-2">
            <h1 class="font-bold text-lg">Terpopuler</h1>
            <div class="flex gap-1">
                <div class="w-[46px] h-1 rounded-full bg-[#083C30]"></div>
                <div class="w-[23px] h-1 rounded-full bg-[#3BD59C]"></div>
                <div class="w-[6px] h-1 rounded-full bg-[#99FFD9]"></div>
            </div>
        </div>
        <div class="border border-[#696767] border-dashed w-full h-0.5"></div>
    </div>
    <div class="col-span-2 md:grid md:grid-cols-3 gap-3">
        @php
            $no = 1;
        @endphp
        @foreach($totalArtikel as $artikel)
            <a href="{{ route('user.artikel.show', $artikel->id) }}">
                <div class="flex md:flex md:flex-row">
                    <div class="flex gap-3 py-1 w-full hover:bg-gray-200 group items-start">
                        <h1 class="font-bold text-lg text-[#3BD59C] italic">{{ $no++ }}</h1>
                        <div class="w-full">
                            <h1 class="text-sm md:text-lg line-clamp-2 font-semibold group-hover:text-green-600">{{ $artikel->judul }}</h1>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
    <p><a href="/artikel" class="text-blue-600 hover:underline">Lihat Selengkapnya</a></p>
</div>
<div>
    <div class="flex gap-2 items-center mb-3">
        <div class="flex flex-col gap-2">
            <h1 class="font-bold text-lg">Dokuementasi</h1>
            <div class="flex gap-1">
                <div class="w-[46px] h-1 rounded-full bg-[#083C30]"></div>
                <div class="w-[23px] h-1 rounded-full bg-[#3BD59C]"></div>
                <div class="w-[6px] h-1 rounded-full bg-[#99FFD9]"></div>
            </div>
        </div>
        <div class="border border-[#696767] border-dashed w-full h-0.5"></div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
        @foreach($kegiatan as $k)
            <a href="{{ route('user.kegiatan.lihat', $k->id) }}">
                <div class="w-full my-2 dark:bg-[#091413] hover:bg-gray-200 group rounded-2xl bg-white shadow-xl">
                    @if($k->gambar)
                    <div class="h-40 overflow-hidden rounded-t-xl">
                        <img src="{{ asset('uploads/kegiatan/'.$k->gambar) }}" alt="{{ $k->judul }}" class="w-full h-48 object-cover object-center">
                    </div>

                    @else
                    <p>gambar tidak ada</p>
                    @endif

                    <div class="px-5 py-3 w-full flex flex-col ">
                        <h1 class="text-base font-semibold line-clamp-1 group-hover:text-green-600">{{ $k->judul }}</h1>
                        <div class="flex gap-1 items-center my-3">
                            <svg class="w-6 h-6 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z"/>
                            </svg>                              
                            <p class="text-sm text-gray-500">{{ $k->created_at->translatedFormat('l, d M Y') }}</p>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>

<section class="bg-gray-900 py-16 px-6 sm:py-24 sm:px-12 lg:px-8 -mx-5 md:-mx-20">
    <div class="mx-auto max-w-2xl text-center">
        <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">
            Siap Bergabung dengan kami?
        </h2>
        
        <p class="mx-auto mt-6 max-w-xl text-lg leading-8 text-gray-300">
            Jadilah bagian dari gerakan pelajar NU Jakarta Utara. Mari bersama-sama berkontribusi untuk kemajuan agama, bangsa, dan negara.
        </p>
        
        <div class="mt-10 flex items-center justify-center gap-x-2">
            <a href="#" class="rounded-md bg-white px-3.5 py-2 text-sm font-semibold text-gray-900 shadow-sm transition hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">
                Gabung Sekarang
            </a>
            
            <a href="#" class="text-sm font-semibold leading-6 text-white transition hover:text-gray-300 flex items-center gap-1">
                Pelajari Selengkapnya <span aria-hidden="true">&rarr;</span>
            </a>
        </div>
    </div>
</section>

<script>
    const carousel = document.getElementById('carousel');
    const slides = carousel.children;
    let index = 0;
    let slideCount = slides.length;

    function nextSlide() {
        index++;
        carousel.style.transition = 'transform 1s ease-in-out';
        carousel.style.transform = `translateX(-${index * 100}%)`;

        // Reset tanpa animasi saat mencapai duplikasi slide pertama
        if(index === slideCount - 1) {
            setTimeout(() => {
                carousel.style.transition = 'none';
                index = 0;
                carousel.style.transform = `translateX(0)`;
            }, 1000); // harus sama dengan duration di CSS
        }
    }

    setInterval(nextSlide, 5000); // slide otomatis setiap 3 detik
</script>

</x-layouts.app>
