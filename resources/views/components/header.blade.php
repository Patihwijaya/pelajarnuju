<!-- 1. HERO BANNER DINAMIS & PERSONAL -->
<div class="relative overflow-hidden bg-gradient-to-br from-[#083C30] via-[#0b4d40] to-[#04241d] p-6 sm:p-10 text-white shadow-xl">
            <!-- Elemen Dekoratif Cahaya -->
            <div class="absolute -top-24 -right-24 w-80 h-80 bg-[#3BD59C]/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-24 -left-24 w-80 h-80 bg-emerald-400/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div>
                    <div class="flex items-center gap-2 mb-3">
                        <span class="inline-block bg-[#3BD59C]/20 text-[#3BD59C] text-xs font-semibold px-3 py-1 rounded-full border border-[#3BD59C]/30">
                            Kader Resmi PC IPNU IPPNU Jakarta Utara
                        </span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold tracking-tight mb-2">
                        Selamat Datang, {{ auth()->user()->name ?? 'Rekan / Rekanita' }}! 👋
                    </h1>
                    <p class="text-gray-300 text-sm sm:text-base max-w-xl leading-relaxed">
                        Semoga aktivitasmu menyenangkan. Akses layanan administrasi, literasi, dan studio kepenulisan dengan mudah di sini.
                    </p>
                </div>

                <!-- Quick Action Buttons di Banner -->
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('user.artikel.index') }}" class="px-5 py-2.5 bg-[#3BD59C] hover:bg-[#32be8a] text-[#083C30] font-bold rounded-xl shadow-lg transition-all text-sm flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                        Tulis Artikel
                    </a>
                    <a href="{{ url('pengajuanSkIpnu') }}" class="px-5 py-2.5 bg-white/10 hover:bg-white/20 text-white font-semibold rounded-xl border border-white/20 transition-all text-sm backdrop-blur-sm flex items-center gap-2">
                        Ajukan SK
                    </a>
                </div>
            </div>
        </div>