<x-layouts.app title="Events">
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 pb-24 transition-colors duration-300">
        
        <!-- Header Banner Melengkung -->
        <div class="bg-blue-600 dark:bg-[#0f172a] rounded-b-[3rem] shadow-lg pt-16 pb-32 px-4 sm:px-6 lg:px-8 relative overflow-hidden transition-colors duration-300 border-b border-blue-700 dark:border-gray-800">
            <div class="absolute inset-0 opacity-20 pointer-events-none" style="background-image: radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.5) 0%, transparent 50%), radial-gradient(circle at 80% 90%, rgba(255, 255, 255, 0.5) 0%, transparent 50%);"></div>
            
            <div class="max-w-7xl mx-auto relative z-10 text-center">
                <span class="inline-flex items-center px-4 py-1.5 rounded-full bg-white/20 dark:bg-blue-900/50 backdrop-blur-md text-white text-xs font-black tracking-widest mb-6 border border-white/30 uppercase shadow-sm">
                    Portal Event
                </span>
                <h1 class="text-2xl sm:text-4xl md:text-5xl font-extrabold text-white tracking-tight mb-5 leading-tight drop-shadow-md">
                    Daftar Kegiatan PC IPNU IPPNU Jakarta Utara
                </h1>
                <p class="max-w-2xl text-lg text-blue-100 dark:text-gray-300 mx-auto px-4 font-medium">
                    Temukan dan ikuti berbagai program pelatihan kepemimpinan eksklusif untuk tingkatkan kapasitas dirimu.
                </p>
            </div>
        </div>

        <!-- Grid Cards Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 relative z-20">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-10">
                @forelse($events as $event)
                    @php
                        // PERBAIKAN LOGIKA: Cek Kuota & Cek Waktu Kedaluwarsa
                        $totalRegistered = $event->registrations()->count();
                        $isFull = $totalRegistered >= $event->max_participants;
                        $isExpired = now()->greaterThan($event->end_date);
                        
                        // Hitung persentase untuk progress bar
                        $percentage = $event->max_participants > 0 ? min(100, ($totalRegistered / $event->max_participants) * 100) : 0;
                    @endphp
                    <!-- Kartu Event dibungkus tag article yang aman secara HTML -->
                    <article class="relative group flex flex-col bg-white dark:bg-gray-800 rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden border border-gray-100 dark:border-gray-700">

                    <!-- Link Utama yang mencakup seluruh kartu (Invisible Overlay Link) -->
                    <a href="{{ route('events.show', $event->slug) }}" class="absolute inset-0 z-10 focus:outline-none" aria-label="Lihat detail {{ $event->title }}"></a>

                    <!-- Area Gambar (16:9) dengan Gradient Overlay -->
                    <div class="relative w-full aspect-[4/3] sm:aspect-video bg-gray-200 dark:bg-gray-700 overflow-hidden">

                        @if(isset($event->thumbnail) && $event->thumbnail)
                            <img src="{{ asset('storage/' . $event->thumbnail) }}" alt="{{ $event->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        @else
                            <!-- Placeholder Elegan jika tidak ada gambar -->
                            <div class="w-full h-full bg-gradient-to-br from-blue-500 to-indigo-800 dark:from-gray-700 dark:to-gray-900 flex items-center justify-center transition-transform duration-700 group-hover:scale-110">
                                <svg class="w-16 h-16 text-white/20" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14zm-5-7l-3 3.72L9 13l-3 4h12l-4-5.28z"/></svg>
                            </div>
                        @endif

                        <!-- Gradient Hitam di Bawah Gambar untuk Keterbacaan Teks -->
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40 to-transparent pointer-events-none"></div>

                        <!-- Badge Status Kiri Atas -->
                        <div class="absolute top-4 left-4 z-20">
                            @if($isFull)
                                <span class="inline-flex items-center px-3 py-1.5 rounded-xl text-xs font-bold shadow-lg backdrop-blur-md bg-red-500/90 text-white border border-red-400/50">
                                    <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Kuota Penuh
                                </span>
                            @elseif($isExpired)
                                <span class="inline-flex items-center px-3 py-1.5 rounded-xl text-xs font-bold shadow-lg backdrop-blur-md bg-gray-600/90 text-white border border-gray-500/50">
                                    <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Pendaftaran Ditutup
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1.5 rounded-xl text-xs font-bold shadow-lg backdrop-blur-md bg-green-500/90 text-white border border-green-400/50">
                                    <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
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

                        <!-- Info Judul & Waktu di Atas Gambar (Bawah) -->
                        <div class="absolute bottom-0 left-0 w-full p-5 z-25 pointer-events-none">
                            <div class="flex flex-wrap items-center text-gray-300 text-xs font-medium mb-2.5 gap-x-4 gap-y-1">
                                <span class="flex items-center bg-black/30 px-2 py-1 rounded-md backdrop-blur-sm border border-white/10">
                                    <svg class="w-3.5 h-3.5 mr-1.5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    {{ $event->start_date->format('d F Y, H:i') }} WIB
                                </span>
                                <span class="flex items-center bg-black/30 px-2 py-1 rounded-md backdrop-blur-sm border border-white/10 truncate max-w-[150px]">
                                    <svg class="w-3.5 h-3.5 mr-1.5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    {{ Str::limit($event->location, 15) }}
                                </span>
                            </div>
                            <h3 class="text-xl sm:text-xl font-bold text-white leading-snug line-clamp-2 drop-shadow-lg group-hover:text-blue-300 transition-colors">
                                {{ $event->title }}
                            </h3>
                        </div>
                    </div>

                    <!-- Body Konten (Deskripsi Singkat) -->
                    <div class="p-6 pb-4 bg-white dark:bg-gray-800 flex-1 flex flex-col transition-colors">
                        <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-3 leading-relaxed">
                            {{ strip_tags($event->description) }}
                        </p>
                        <div class="flex-1"></div>
                    </div>

                    <!-- Footer Card (Progress Bar & Tampilan Tombol Action) -->
                    <div class="px-6 py-5 bg-white dark:bg-gray-800 border-t border-gray-100 dark:border-gray-700 flex flex-col sm:flex-row justify-between items-center gap-4 transition-colors relative z-20">

                        <!-- Progress Bar Kuota -->
                        <div class="w-full sm:w-1/2">
                            <div class="flex justify-between items-end text-xs mb-1.5">
                                <span class="font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider text-[10px]">Pendaftar</span>
                                <span class="font-black text-gray-900 dark:text-white">{{ $totalRegistered }} <span class="text-gray-400 font-medium">/ {{ $event->max_participants }}</span></span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 overflow-hidden">
                                <div class="bg-blue-600 h-2 rounded-full transition-all duration-1000 ease-out" style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>

                        <!-- Tampilan Tombol Action (Berubah menjadi Span agar valid secara HTML) -->
                        <span class="w-full sm:w-auto text-center inline-flex justify-center items-center px-5 py-2.5 text-sm font-bold rounded-xl text-white bg-blue-600 group-hover:bg-blue-700 dark:bg-blue-600 dark:group-hover:bg-blue-500 shadow-md transition-all">
                            Lihat Detail &rarr;
                        </span>
                    </div>
                    </article>                    
                @empty
                    <!-- Tampilan Kosong (Empty State) -->
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 flex flex-col items-center justify-center py-28 px-4 text-center bg-white dark:bg-gray-800 rounded-3xl border border-gray-200 dark:border-gray-700 shadow-sm transition-colors">
                        <div class="bg-gray-100 dark:bg-gray-700 p-6 rounded-full mb-6 border border-gray-200 dark:border-gray-600 shadow-inner">
                            <svg class="w-12 h-12 text-gray-400 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <h3 class="text-2xl font-extrabold text-gray-900 dark:text-white mb-2 tracking-tight">Belum Ada Event Aktif</h3>
                        <p class="text-gray-500 dark:text-gray-400 text-base max-w-md mx-auto">
                            Saat ini belum ada pendaftaran kegiatan yang dibuka. Pantau terus halaman ini untuk pembaruan dari Pelajar Nuju.
                        </p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($events->hasPages())
                <div class="mt-14 flex justify-center">
                    <div class="bg-white dark:bg-gray-800 py-3 px-6 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700">
                        {{ $events->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>