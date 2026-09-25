<x-layouts.app title="Pelajarnuju">

    @php
        // Membagi daftar artikel menjadi dua bagian untuk kolom kiri dan kanan
        $artikelKiri = $artikel->slice(0, 3); // Ambil 3 artikel pertama untuk Kiri
        $artikelTengahBawah = $artikel->slice(3, 2); // Ambil 2 artikel selanjutnya untuk Tengah
        $artikelKanan = $artikel->slice(5, 3); // Ambil 3 artikel terakhir untuk Kanan
    @endphp

    <!-- ================= KONTEN ARTIKEL UTAMA ================= -->
    <div class="mb-10">
        <!-- Grid System: 1 kolom di HP, 4 kolom di Desktop (1 Kiri, 2 Tengah, 1 Kanan) -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

            <!-- KOLOM KIRI -->
            <div class="lg:col-span-1 flex flex-col gap-6">
                @foreach($artikelKiri as $a)
                    <a href="{{ route('artikel.show', $a->slug) }}" class="group block border-b border-dashed border-gray-400 pb-4">
                        @if($a->gambar)
                            <div class="w-full aspect-[4/3] overflow-hidden rounded mb-3">
                                <img src="{{ asset('uploads/artikel/'.$a->gambar) }}" alt="{{ $a->title }}" class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-300">
                            </div>
                        @endif
                        <span class="bg-[#083C30] text-white text-xs font-semibold px-2 py-1 rounded inline-block mb-2">{{ $a->kategori }}</span>
                        <h1 class="text-base font-bold leading-tight mb-2 group-hover:text-green-600 transition-colors text-justify">{{ $a->title }}</h1>
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
                        <a href="{{ route('artikel.show', $banner->slug) }}" class="block">
                            <!-- Gambar Banner: aspect-video memastikan gambar tidak melar -->
                            <div class="w-full aspect-video overflow-hidden rounded mb-4 relative">
                                <img src="{{ asset('uploads/artikel/' . $banner->gambar) }}" alt="{{ $banner->title }}" class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500">
                                <!-- Kategori melayang di atas gambar -->
                                <span class="absolute top-4 left-4 bg-[#083C30] text-white text-xs font-bold px-4 py-1 rounded shadow">{{ $banner->kategori }}</span>
                            </div>
                            
                            <h1 class="text-base md:text-xl font-bold text-justify group-hover:text-green-600 transition-colors mb-3">{{ $banner->title }}</h1>
                            
                            <!-- Penyesuaian 'isi' menjadi 'content' -->
                            <div class="text-gray-700 dark:text-gray-400 text-justify line-clamp-3 mb-4 leading-relaxed text-sm md:text-base">
                                {!! \Illuminate\Support\Str::limit($banner->content, 150) !!}
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
                        <a href="{{ route('artikel.show', $a->slug) }}" class="group flex gap-4 pb-4 border-b border-dashed border-gray-300 last:border-0 last:pb-0">
                            <!-- Gambar (Di Kiri) -->
                            @if($a->gambar)
                                <div class="w-1/3 aspect-[4/3] overflow-hidden rounded shrink-0">
                                    <img src="{{ asset('uploads/artikel/'.$a->gambar) }}" alt="{{ $a->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                </div>
                            @endif

                            <!-- Teks (Di Kanan) -->
                            <div class="w-2/3 flex flex-col justify-center">
                                <span class="bg-[#083C30] text-white text-[10px] font-bold px-2 py-1 rounded inline-block mb-2 w-fit uppercase">{{ $a->kategori }}</span>
                                <h3 class="text-sm md:text-base font-bold leading-snug mb-1 group-hover:text-[#083C30] transition-colors">{{ $a->title }}</h3>
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
                    <a href="{{ route('artikel.show', $a->slug) }}" class="group block border-b border-dashed border-gray-400 pb-4">
                        @if($a->gambar)
                            <div class="w-full aspect-[4/3] overflow-hidden rounded mb-3">
                                <img src="{{ asset('uploads/artikel/'.$a->gambar) }}" alt="{{ $a->title }}" class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-300">
                            </div>
                        @endif
                        <span class="bg-[#083C30] text-white text-xs font-semibold px-2 py-1 rounded inline-block mb-2">{{ $a->kategori }}</span>
                        <h1 class="text-base font-bold leading-tight mb-2 group-hover:text-green-600 transition-colors text-justify">{{ $a->title }}</h1>
                        <div class="flex gap-2 text-xs text-gray-500">
                            <p>{{ $a->created_at->translatedFormat('d M Y') }}</p>
                            <p>|</p>
                            <p>{{ $a->created_at->diffForHumans() }}</p>
                        </div>
                    </a>
                @endforeach
            </div>

        </div>

        <!-- Tombol Lihat Selengkapnya -->
        <div class="w-full mt-12 text-center">
            <a href="/artikel" class="text-blue-600 text-base dark:text-white hover:bg-gray-200 bg-white dark:bg-gray-800 hover:dark:bg-gray-500 px-3 py-1 md:px-6 md:py-3 rounded-full font-medium hover:underline transition-colors shadow-sm">
                Lihat Selengkapnya Semua Artikel
            </a>
        </div>
    </div>


    <!-- ================= ARTIKEL TERPOPULER ================= -->
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
            @php $no = 1; @endphp
            @foreach($artikelPopuler as $artikel)
                <a href="{{ route('artikel.show', $artikel->slug) }}">
                    <div class="flex md:flex md:flex-row">
                        <div class="flex gap-3 py-1 w-full hover:bg-gray-200 group items-start">
                            <h1 class="font-bold text-lg text-[#3BD59C] italic">{{ $no++ }}</h1>
                            <div class="w-full">
                                <h1 class="text-sm md:text-lg line-clamp-2 font-semibold group-hover:text-green-600">{{ $artikel->title }}</h1>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        <p class="mt-2"><a href="/artikel" class="text-blue-600 hover:underline">Lihat Selengkapnya</a></p>
    </div>

    <!-- ================= SEGMEN ACARA (EVENTS) ================= -->
    <div class="mb-16">
        <!-- Header Bagian Acara (Menyesuaikan style Dokumentasi) -->
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-xl sm:text-2xl font-bold text-white relative pr-4 bg-[#0B1120] z-10">
                Acara Terdekat
            </h2>
            <div class="flex-1 border-b border-dashed border-gray-600 relative top-[-2px]"></div>
            <a href="{{ route('events.index') }}" class="text-sm font-semibold text-blue-400 hover:text-blue-300 ml-4 pl-4 bg-[#0B1120] z-10 transition-colors">
                Lihat Semua Acara &rarr;
            </a>
        </div>

        <!-- Grid Card Acara -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            @forelse($events as $event)
                @php
                    $totalRegistered = $event->registrations()->count();
                    $isFull = $totalRegistered >= $event->max_participants;
                    $isExpired = now() > $event->end_date;
                    $percentage = $event->max_participants > 0 ? min(100, ($totalRegistered / $event->max_participants) * 100) : 0;
                @endphp

                <!-- Card Event -->
                <article class="relative group flex flex-col bg-gray-800 rounded-2xl sm:rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden border border-gray-700">

                    <a href="{{ route('events.show', $event->slug) }}" class="absolute inset-0 z-10 focus:outline-none" aria-label="Lihat detail {{ $event->title }}"></a>

                    <!-- Area Gambar -->
                    <div class="relative w-full aspect-[4/3] bg-gray-700 overflow-hidden">
                        @if(isset($event->thumbnail) && $event->thumbnail)
                            <img src="{{ asset('storage/' . $event->thumbnail) }}" alt="{{ $event->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-blue-600 to-indigo-900 flex items-center justify-center transition-transform duration-700 group-hover:scale-110">
                                <svg class="w-12 h-12 text-white/20" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14zm-5-7l-3 3.72L9 13l-3 4h12l-4-5.28z"/></svg>
                            </div>
                        @endif

                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40 to-transparent pointer-events-none"></div>

                        <!-- Badge Status Kiri Atas -->
                        <div class="absolute top-4 left-4 z-20">
                            @if($isFull)
                                <span class="inline-flex items-center px-3 py-1.5 rounded-xl text-[10px] font-bold shadow-lg backdrop-blur-md bg-red-500/90 text-white border border-red-400/50">
                                    Kuota Penuh
                                </span>
                            @elseif($isExpired)
                                <span class="inline-flex items-center px-3 py-1.5 rounded-xl text-[10px] font-bold shadow-lg backdrop-blur-md bg-gray-600/90 text-white border border-gray-500/50">
                                    Ditutup
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1.5 rounded-xl text-[10px] font-bold shadow-lg backdrop-blur-md bg-green-500/90 text-white border border-green-400/50">
                                    Pendaftaran Dibuka
                                </span>
                            @endif
                        </div>

                        <!-- Badge Kategori Kanan Atas -->
                        @if(isset($event->category))
                            <div class="absolute top-4 right-4 z-20">
                                <span class="inline-flex items-center px-3 py-1 rounded-full bg-black/40 backdrop-blur-sm border border-white/20 text-white text-[10px] font-black uppercase tracking-widest shadow-sm">
                                    {{ $event->category }}
                                </span>
                            </div>
                        @endif

                        <!-- Info Waktu & Lokasi Overlay -->
                        <div class="absolute bottom-0 left-0 w-full p-4 z-20 pointer-events-none">
                            <div class="flex flex-wrap items-center text-gray-300 text-[10px] font-medium mb-1.5 gap-x-2 gap-y-1">
                                <span class="flex items-center bg-black/50 px-2 py-1 rounded backdrop-blur-sm border border-white/10">
                                    <svg class="w-3 h-3 mr-1 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    {{ $event->start_date->format('d F Y') }}
                                </span>
                                <span class="flex items-center bg-black/50 px-2 py-1 rounded backdrop-blur-sm border border-white/10 truncate max-w-[120px]">
                                    <svg class="w-3 h-3 mr-1 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    {{ Str::limit($event->location, 12) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Konten Body -->
                    <div class="p-5 bg-gray-800 flex-1 flex flex-col">
                        <h3 class="text-lg font-bold text-white leading-snug line-clamp-2 mb-2 group-hover:text-blue-400 transition-colors">
                            {{ $event->title }}
                        </h3>
                        <p class="text-xs text-gray-400 line-clamp-2 leading-relaxed">
                            {{ strip_tags($event->description) }}
                        </p>
                        <div class="flex-1"></div>
                    </div>

                    <!-- Footer Card -->
                    <div class="px-5 py-4 bg-gray-800 border-t border-gray-700 flex justify-between items-center z-20">
                        <div class="w-2/3 pr-4">
                            <div class="flex justify-between items-end text-[10px] mb-1">
                                <span class="font-bold text-gray-400 uppercase tracking-wider">Pendaftar</span>
                                <span class="font-bold text-white">{{ $totalRegistered }} <span class="text-gray-500">/ {{ $event->max_participants }}</span></span>
                            </div>
                            <div class="w-full bg-gray-700 rounded-full h-1.5 overflow-hidden">
                                <div class="bg-blue-500 h-1.5 rounded-full transition-all duration-1000 ease-out" style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>
                        
                        <a href="{{ route('events.show', $event->slug) }}" class="inline-flex justify-center items-center px-3 py-1.5 text-xs font-bold rounded-lg text-white bg-blue-600 group-hover:bg-blue-500 shadow-md transition-all">
                            Detail
                        </a>
                    </div>
                </article>
            @empty
                <!-- State jika belum ada Event -->
                <div class="col-span-full bg-gray-800/50 rounded-2xl p-8 text-center border border-gray-700">
                    <p class="text-gray-400 text-sm">Belum ada acara terdekat saat ini.</p>
                </div>
            @endforelse
        </div>
    </div>


    <!-- ================= DOKUMENTASI KEGIATAN ================= -->
    <div class="mt-8">
        <div class="flex gap-2 items-center mb-3">
            <div class="flex flex-col gap-2">
                <h1 class="font-bold text-lg">Dokumentasi</h1>
                <div class="flex gap-1">
                    <div class="w-[46px] h-1 rounded-full bg-[#083C30]"></div>
                    <div class="w-[23px] h-1 rounded-full bg-[#3BD59C]"></div>
                    <div class="w-[6px] h-1 rounded-full bg-[#99FFD9]"></div>
                </div>
            </div>
            <div class="border border-[#696767] border-dashed w-full h-0.5"></div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mt-4">
            @foreach($kegiatan as $k)
                <a href="{{ route('kegiatan.lihat', $k->id) }}" class="group">
                    <div class="w-full h-full flex flex-col my-2 dark:bg-[#091413] hover:bg-gray-100 rounded-2xl bg-white shadow-lg overflow-hidden transition-all duration-300">
                        
                        @if($k->gambar)
                            <div class="h-48 overflow-hidden relative">
                                <img src="{{ asset('uploads/kegiatan/'.$k->gambar) }}" alt="{{ $k->title }}" class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500">
                            </div>
                        @else
                            <div class="h-48 bg-gray-200 flex items-center justify-center text-gray-500">
                                Gambar tidak tersedia
                            </div>
                        @endif

                        <div class="px-5 py-4 w-full flex flex-col flex-grow">
                            <h1 class="text-base font-semibold line-clamp-2 group-hover:text-green-600 transition-colors">{{ $k->judul }}</h1>
                            <div class="flex gap-2 items-center mt-auto pt-4">
                                <svg class="w-5 h-5 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
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


    <!-- ================= CTA / CALL TO ACTION ================= -->
    <section class="bg-gray-900 py-16 px-6 sm:py-24 sm:px-12 lg:px-8 -mx-[15px] md:-mx-20 mt-16">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">
                Siap Bergabung dengan kami?
            </h2>
            
            <p class="mx-auto mt-6 max-w-xl text-lg leading-8 text-gray-300">
                Jadilah bagian dari gerakan pelajar NU Jakarta Utara. Mari bersama-sama berkontribusi untuk kemajuan agama, bangsa, dan negara.
            </p>
            
            <div class="mt-10 flex items-center justify-center gap-x-6">
                <a href="/login" class="rounded-md bg-white px-5 py-3 text-sm font-semibold text-gray-900 shadow-sm transition-transform hover:scale-105 hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">
                    Gabung Sekarang
                </a>
                
                <a href="/sejarah" class="text-sm font-semibold leading-6 text-white transition hover:text-gray-300 flex items-center gap-1">
                    Pelajari Selengkapnya <span aria-hidden="true">&rarr;</span>
                </a>
            </div>
        </div>
    </section>

</x-layouts.app>