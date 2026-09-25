<x-layouts.app title="{{ $event->title }}">
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-6 sm:py-12 px-3 sm:px-6 lg:px-8 transition-colors duration-300">
        <div class="max-w-6xl mx-auto">
            
            <!-- Header Navigasi -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                <a href="{{ route('events.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm text-sm font-bold text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                    &larr; Kembali ke Daftar
                </a>
                
                @php
                    $totalRegistered = $event->registrations()->count();
                    $isFull = $totalRegistered >= $event->max_participants;
                @endphp
                
                <span class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-bold bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-700 shadow-sm">
                    <svg class="w-4 h-4 mr-2 text-blue-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    Kuota: {{ $totalRegistered }} / {{ $event->max_participants }} Terisi
                </span>
            </div>

            <!-- HERO BANNER & COUNTDOWN TIMER -->
            <div class="relative rounded-2xl sm:rounded-3xl overflow-hidden shadow-2xl mb-8 sm:mb-10 flex flex-col lg:flex-row justify-between items-center gap-8 p-5 sm:p-10 lg:p-12 border border-gray-200 dark:border-gray-800">
                
                <!-- Background Banner -->
                @if(isset($event->thumbnail) && $event->thumbnail)
                    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('storage/' . $event->thumbnail) }}');"></div>
                    <div class="absolute inset-0 bg-gradient-to-r from-gray-900 via-gray-900/95 to-gray-900/80"></div>
                @else
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-700 via-blue-800 to-indigo-900"></div>
                    <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.4) 0%, transparent 50%);"></div>
                @endif

                <!-- Info Event (Sebelah Kiri) -->
                <div class="relative z-10 w-full lg:w-3/5 text-left">
                    <span class="inline-block py-1 px-3 sm:px-4 rounded-full bg-white/20 backdrop-blur-md border border-white/30 text-white text-[11px] sm:text-xs font-bold uppercase tracking-widest mb-3 sm:mb-5 shadow-sm">
                        {{ $event->category ?? 'EVENT' }}
                    </span>
                    <h1 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight mb-3 sm:mb-5 leading-snug sm:leading-tight drop-shadow-md">
                        {{ $event->title }}
                    </h1>
                    <p class="text-blue-100 text-xs sm:text-base mb-6 sm:mb-8 max-w-xl leading-relaxed">
                        {{ Str::limit(strip_tags($event->description), 130) }}
                    </p>
                    
                    <div class="flex flex-wrap items-center gap-2 sm:gap-4 text-xs sm:text-sm font-semibold text-white">
                        <div class="flex items-center bg-black/30 backdrop-blur-md border border-white/25 rounded-xl px-3 sm:px-4 py-2 shadow-sm">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 mr-1.5 sm:mr-2 text-blue-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span class="truncate">{{ $event->end_date->format('d M Y, H:i') }} WIB</span>
                        </div>
                        <div class="flex items-center bg-black/30 backdrop-blur-md border border-white/25 rounded-xl px-3 sm:px-4 py-2 shadow-sm max-w-[200px] sm:max-w-xs">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 mr-1.5 sm:mr-2 text-red-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span class="truncate">{{ $event->location }}</span>
                        </div>
                    </div>
                </div>

                <!-- Countdown Timer Box (Responsive Sizing) -->
                <div class="relative z-10 w-full lg:w-auto flex-shrink-0" 
                    x-data="countdown('{{ $event->end_date->format('Y-m-d\TH:i:s') }}')" 
                    x-init="initCountdown()">
                    
                    <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl sm:rounded-3xl p-4 sm:p-8 text-center shadow-2xl">
                        <p class="text-blue-100 text-xs sm:text-sm font-bold uppercase tracking-wider mb-3 sm:mb-5">Penutupan Pendaftaran</p>
                        
                        <div class="flex justify-center items-center gap-1.5 sm:gap-4 text-center">
                            <!-- Hari -->
                            <div class="flex flex-col items-center">
                                <div class="bg-white text-blue-900 rounded-xl sm:rounded-2xl w-8 h-8 sm:w-20 sm:h-20 flex items-center justify-center text-lg sm:text-4xl font-black shadow-lg">
                                    <span x-text="days">00</span>
                                </div>
                                <span class="text-white text-[9px] sm:text-xs mt-2 sm:mt-3 font-bold uppercase tracking-widest">Hari</span>
                            </div>
                            <span class="text-white/60 text-xl sm:text-3xl font-bold pb-4 sm:pb-5">:</span>
                            
                            <!-- Jam -->
                            <div class="flex flex-col items-center">
                                <div class="bg-white text-blue-900 rounded-xl sm:rounded-2xl w-8 h-8 sm:w-20 sm:h-20 flex items-center justify-center text-lg sm:text-4xl font-black shadow-lg">
                                    <span x-text="hours">00</span>
                                </div>
                                <span class="text-white text-[9px] sm:text-xs mt-2 sm:mt-3 font-bold uppercase tracking-widest">Jam</span>
                            </div>
                            <span class="text-white/60 text-xl sm:text-3xl font-bold pb-4 sm:pb-5">:</span>
                            
                            <!-- Menit -->
                            <div class="flex flex-col items-center">
                                <div class="bg-white text-blue-900 rounded-xl sm:rounded-2xl w-8 h-8 sm:w-20 sm:h-20 flex items-center justify-center text-lg sm:text-4xl font-black shadow-lg">
                                    <span x-text="minutes">00</span>
                                </div>
                                <span class="text-white text-[9px] sm:text-xs mt-2 sm:mt-3 font-bold uppercase tracking-widest">Menit</span>
                            </div>
                            <span class="text-white/60 text-xl sm:text-3xl font-bold pb-4 sm:pb-5">:</span>
                            
                            <!-- Detik -->
                            <div class="flex flex-col items-center">
                                <div class="bg-blue-500 text-white rounded-xl sm:rounded-2xl w-8 h-8 sm:w-20 sm:h-20 flex items-center justify-center text-lg sm:text-4xl font-black shadow-lg">
                                    <span x-text="seconds">00</span>
                                </div>
                                <span class="text-white text-[9px] sm:text-xs mt-2 sm:mt-3 font-bold uppercase tracking-widest">Detik</span>
                            </div>
                        </div>

                        <!-- Pesan Waktu Habis -->
                        <div x-show="isExpired" class="mt-4 sm:mt-6 text-white font-bold text-xs sm:text-sm bg-red-500/90 py-2.5 sm:py-3 rounded-xl backdrop-blur-md border border-red-400" style="display: none;">
                            Waktu pendaftaran telah berakhir!
                        </div>
                    </div>
                </div>
            </div>

            <!-- DETAIL KONTEN BAWAH -->
            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl sm:rounded-3xl overflow-hidden border border-gray-200 dark:border-gray-700 transition-colors">
                <div class="p-5 sm:p-10 lg:p-12">
                    <h2 class="text-xl sm:text-2xl font-extrabold text-gray-900 dark:text-white mb-4 sm:mb-6 border-b border-gray-100 dark:border-gray-700 pb-3 sm:pb-4">
                        Deskripsi Kegiatan
                    </h2>
                    
                    <div class="prose prose-blue dark:prose-invert max-w-none text-gray-700 dark:text-gray-300 mb-8 sm:mb-10 text-sm sm:text-base leading-relaxed whitespace-pre-line">
                        {{ $event->description }}
                    </div>

                    <!-- INFORMASI REKENING PEMBAYARAN HTM -->
                    @if(!empty($event->payment_info) && is_array($event->payment_info) && count($event->payment_info) > 0)
                        <div class="bg-blue-50 dark:bg-gray-700/50 border border-blue-200 dark:border-gray-600 rounded-2xl p-4 sm:p-8 mb-8 transition-colors">
                            <div class="flex items-center mb-4 sm:mb-5">
                                <div class="p-2.5 sm:p-3 bg-blue-600 text-white rounded-xl mr-3 sm:mr-4 shadow-md shrink-0">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                                </div>
                                <div>
                                    <h3 class="text-base sm:text-lg font-bold text-blue-900 dark:text-blue-300">Informasi Pembayaran HTM</h3>
                                    <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400">Silakan lakukan transfer ke salah satu rekening resmi di bawah ini:</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5 mt-4">
                                @foreach($event->payment_info as $acc)
                                    <div class="bg-white dark:bg-gray-800 p-4 sm:p-6 rounded-xl border border-blue-100 dark:border-gray-600 shadow-sm hover:shadow-md transition">
                                        <div class="flex justify-between items-center mb-1">
                                            <span class="text-[11px] sm:text-xs font-black uppercase tracking-widest text-blue-600 dark:text-blue-400">{{ $acc['bank_name'] ?? '-' }}</span>
                                        </div>
                                        <p class="text-xl sm:text-2xl font-mono font-black text-gray-900 dark:text-white tracking-wider my-1 sm:my-2 select-all break-all">{{ $acc['account_number'] ?? '-' }}</p>
                                        <div class="border-t border-gray-100 dark:border-gray-700 pt-2.5 sm:pt-3 mt-2.5 sm:mt-3">
                                            <span class="text-xs text-gray-500 dark:text-gray-400">Atas Nama: <strong class="text-gray-800 dark:text-gray-200">{{ $acc['account_holder'] ?? '-' }}</strong></span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- BOX CALL TO ACTION (DAFTAR) -->
                    <div class="bg-gray-50 dark:bg-gray-900/50 border border-gray-200 dark:border-gray-700 rounded-2xl p-5 sm:p-8 flex flex-col sm:flex-row justify-between items-center gap-4 sm:gap-6 mt-8 sm:mt-10 transition-colors">
                        <div class="text-center sm:text-left">
                            <h3 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white">Tertarik untuk bergabung?</h3>
                            <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 mt-1">Segera amankan kursimu sebelum kuota penuh atau waktu habis.</p>
                        </div>
                        
                        @if($isFull || now() > $event->end_date)
                            <button disabled class="w-full sm:w-auto px-6 sm:px-8 py-3 sm:py-3.5 rounded-xl text-white font-bold bg-gray-400 dark:bg-gray-700 cursor-not-allowed shadow-inner text-center uppercase tracking-wide text-xs sm:text-sm">
                                Pendaftaran Ditutup
                            </button>
                        @else
                            <a href="{{ route('events.register', $event->slug) }}" class="w-full sm:w-auto px-8 sm:px-10 py-3 sm:py-3.5 rounded-xl text-white font-bold bg-blue-600 hover:bg-blue-700 shadow-lg hover:shadow-blue-500/30 transition-all transform hover:-translate-y-1 text-center uppercase tracking-wide text-xs sm:text-sm">
                                Daftar Sekarang &rarr;
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Alpine.js Countdown -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('countdown', (endDateStr) => ({
                endDate: new Date(endDateStr).getTime(),
                days: '00', hours: '00', minutes: '00', seconds: '00',
                isExpired: false,
                initCountdown() {
                    this.updateTime();
                    setInterval(() => { this.updateTime(); }, 1000);
                },
                updateTime() {
                    const now = new Date().getTime();
                    const distance = this.endDate - now;
                    if (distance < 0) {
                        this.isExpired = true;
                        this.days = '00'; this.hours = '00'; this.minutes = '00'; this.seconds = '00';
                        return;
                    }
                    const d = Math.floor(distance / (1000 * 60 * 60 * 24));
                    const h = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const m = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const s = Math.floor((distance % (1000 * 60)) / 1000);
                    
                    this.days = d < 10 ? '0' + d : d;
                    this.hours = h < 10 ? '0' + h : h;
                    this.minutes = m < 10 ? '0' + m : m;
                    this.seconds = s < 10 ? '0' + s : s;
                }
            }))
        })
    </script>
</x-layouts.app>