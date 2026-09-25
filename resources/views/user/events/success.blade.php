<x-layouts.app title="Pendaftaran Berhasil">
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-12 px-4 sm:px-6 lg:px-8 transition-colors duration-300">
        <div class="max-w-3xl mx-auto space-y-6">
            
            <!-- Header Kartu Sukses -->
            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-3xl overflow-hidden border border-gray-200 dark:border-gray-700 p-8 sm:p-10 text-center transition-colors">
                <div class="w-16 h-16 bg-green-100 dark:bg-green-900/50 text-green-600 dark:text-green-400 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl font-bold">
                    ✓
                </div>
                <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">Pendaftaran Berhasil!</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Anda terdaftar pada kegiatan <strong class="text-blue-600 dark:text-blue-400">{{ $event->title }}</strong>.</p>

                <!-- Nomor ID Unik -->
                <div class="mt-6 inline-flex flex-col items-center justify-center bg-blue-50 dark:bg-gray-700/60 border border-blue-200 dark:border-gray-600 rounded-2xl p-6 w-full max-w-md mx-auto shadow-sm">
                    <span class="block text-xs font-bold uppercase tracking-widest text-blue-600 dark:text-blue-400 mb-1">ID Pendaftaran</span>
                    <span class="text-lg md:text-3xl font-mono font-black text-gray-900 dark:text-white tracking-widest select-all my-2">
                        09.06.5455.{{ str_pad($registration->id, 4, '0', STR_PAD_LEFT) }}
                    </span>
                    <p class="text-xs text-gray-500 dark:text-gray-400 text-center mt-1">Simpan atau catat nomor ID ini untuk keperluan verifikasi dan daftar ulang kegiatan.</p>
                </div>
            </div>

            <!-- === KARTU BUKTI REGISTRASI RESMI + QR CODE === -->
            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-3xl overflow-hidden border border-gray-200 dark:border-gray-700 p-4 sm:p-10 transition-colors">
                <div class="text-center mb-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Kartu Bukti Registrasi Digital</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Unduh kartu peserta resmi Anda di bawah ini untuk ditunjukkan saat check-in.</p>
                </div>

                <!-- Elemen Kartu yang akan dikonversi menjadi Gambar PNG -->
                <div id="registration-card" class="bg-gradient-to-br from-blue-950 via-indigo-950 to-slate-900 text-white px-4 pt-8 pb-10 rounded-3xl shadow-2xl border border-blue-500/30 relative max-w-md mx-auto">
                    <!-- Aksen Background Estetik -->
                    <div class="absolute -right-10 -top-10 w-40 h-40 bg-blue-500/20 rounded-full blur-2xl pointer-events-none"></div>
                    <!-- 1. Identitas Lembaga / Organisasi -->
                    <div class="items-center border-b border-white/10 pb-4 mb-6 relative z-10">
                        <div class="flex items-center justify-center mb-5">
                            <img src="{{ asset('asset/logo IPNU.png') }}" alt="logo pelajarnuju" class="h-7 sm:h-16 w-auto object-contain">
                            <img src="{{ asset('asset/logo pelajarnuju putih.png') }}" alt="logo pelajarnuju" class="h-7 sm:h-16 w-auto object-contain">
                            <img src="{{ asset('asset/logo IPPNU.png') }}" alt="logo pelajarnuju" class="h-7 sm:h-16 w-auto object-contain">
                        </div>
                        <h3 class="text-lg font-extrabold text-white tracking-tight">Bukti Registrasi Resmi</h3>
                    </div>

                    <!-- 2. Judul Kegiatan -->
                    <div class="mb-6 relative z-10">
                        <span class="text-[10px] text-blue-200/70 uppercase tracking-wide font-semibold block mb-1.5">Judul Kegiatan:</span>
                        <h4 class="text-sm sm:text-base font-bold text-white leading-relaxed">
                            {{ $event->title }}
                        </h4>
                    </div>

                    <!-- 3. Data Utama Peserta & QR Code Check-in -->
                    <div class="bg-white/10 backdrop-blur-md p-5 rounded-2xl border border-white/10 flex flex-col sm:flex-row items-center justify-between gap-5 relative z-10 mb-5">
                        <div class="w-full sm:flex-1 text-center sm:text-left min-w-0">
                            <p class="text-[10px] uppercase tracking-wider text-blue-200 font-semibold mb-1.5">Nama Lengkap</p>
                            <!-- Nama akan tampil lebar, natural, dan mudah dibaca tanpa terpotong sempit -->
                            <p class="text-base sm:text-lg font-black text-white tracking-wide break-words uppercase">
                                {{ $registration->answers[$firstFieldName ?? 'nama_lengkap'] ?? '-' }}
                            </p>
                        </div>
                        <!-- QR Code Check-in -->
                        <div class="bg-white p-2.5 rounded-xl shadow-md shrink-0">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=90x90&data={{ urlencode(route('checkin.form', $event->slug)) }}" alt="QR Checkin" class="w-20 h-20 sm:w-24 sm:h-24">
                        </div>
                    </div>

                    <!-- 4. ID Pendaftar Unik & Tanggal -->
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 sm:gap-0 mb-6 text-xs relative z-10">
                        <div>
                            <span class="text-[10px] text-blue-300 block uppercase tracking-wider font-medium mb-1">ID Pendaftar:</span>
                            <span class="font-mono font-black text-sm sm:text-base text-white tracking-wider">
                                09.06.5455.{{ str_pad($registration->id, 4, '0', STR_PAD_LEFT) }}
                            </span>
                        </div>
                        <div class="text-left sm:text-right">
                            <span class="text-[10px] text-blue-300 block uppercase tracking-wider font-medium mb-1">Tanggal Daftar:</span>
                            <span class="font-bold text-white whitespace-nowrap">{{ $registration->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Tombol Eksekusi Unduh Gambar -->
                <div class="mt-6 text-center">
                    <button type="button" onclick="downloadRegistrationCard()" class="inline-flex items-center px-8 py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm rounded-2xl shadow-xl transition-all transform hover:scale-105 focus:ring-4 focus:ring-blue-500/50">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        Unduh Kartu Bukti Pendaftaran (Gambar PNG)
                    </button>
                    <p class="text-[11px] text-gray-500 dark:text-gray-400 mt-2">Simpan kartu ini di galeri HP Anda sebagai bukti registrasi yang sah.</p>
                </div>
            </div>

            <!-- TOMBOL AKSI CEPAT / CALL-TO-ACTION (KUSTOM ADMIN) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Add to Calendar -->
                <a href="{{ $gcalUrl }}" target="_blank" onclick="notifikasiKalender()" class="flex items-center p-4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl shadow-sm hover:shadow-md transition group">
                    <div class="p-3 bg-blue-50 dark:bg-blue-900/40 text-blue-600 dark:text-blue-400 rounded-xl mr-4 group-hover:scale-110 transition">
                        📅
                    </div>
                    <div class="text-left">
                        <h4 class="text-sm font-bold text-gray-900 dark:text-white">Simpan ke Kalender</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Klik untuk simpan otomatis ke Google Calendar</p>
                    </div>
                </a>

                <!-- Gabung Grup WhatsApp -->
                @if(!empty($event->whatsapp_link))
                    <a href="{{ $event->whatsapp_link }}" target="_blank" class="flex items-center p-4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl shadow-sm hover:shadow-md transition group">
                        <div class="p-3 bg-green-50 dark:bg-green-900/40 text-green-600 dark:text-green-400 rounded-xl mr-4 group-hover:scale-110 transition">
                            💬
                        </div>
                        <div class="text-left">
                            <h4 class="text-sm font-bold text-gray-900 dark:text-white">Grup WhatsApp Peserta</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Koordinasi & info penting acara</p>
                        </div>
                    </a>
                @endif

                <!-- Download Booklet / Rundown -->
                @if(!empty($event->booklet_link))
                    <a href="{{ $event->booklet_link }}" target="_blank" class="flex items-center p-4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl shadow-sm hover:shadow-md transition group">
                        <div class="p-3 bg-amber-50 dark:bg-amber-900/40 text-amber-600 dark:text-amber-400 rounded-xl mr-4 group-hover:scale-110 transition">
                            📖
                        </div>
                        <div class="text-left">
                            <h4 class="text-sm font-bold text-gray-900 dark:text-white">Unduh Booklet & Rundown</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Panduan lengkap kegiatan</p>
                        </div>
                    </a>
                @endif

                <!-- Kampanye Twibbon -->
                @if(!empty($event->twibbon_link))
                    <a href="{{ $event->twibbon_link }}" target="_blank" class="flex items-center p-4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl shadow-sm hover:shadow-md transition group">
                        <div class="p-3 bg-purple-50 dark:bg-purple-900/40 text-purple-600 dark:text-purple-400 rounded-xl mr-4 group-hover:scale-110 transition">
                            📸
                        </div>
                        <div class="text-left">
                            <h4 class="text-sm font-bold text-gray-900 dark:text-white">Pasang Twibbon Acara</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Bagikan antusiasmemu di medsos</p>
                        </div>
                    </a>
                @endif
            </div>

            <!-- KOTAK INSTRUKSI / CATATAN LANJUTAN & PRE-TASK -->
            @if(!empty($event->post_registration_note) || !empty($event->pre_task_info))
                <div class="bg-blue-600 dark:bg-blue-800 shadow-lg rounded-2xl p-6 sm:p-8 text-white space-y-4">
                    @if(!empty($event->post_registration_note))
                        <div>
                            <h3 class="text-base font-bold mb-1">📌 Instruksi Panitia</h3>
                            <p class="text-sm text-blue-100 leading-relaxed whitespace-pre-line">{{ $event->post_registration_note }}</p>
                        </div>
                    @endif

                    @if(!empty($event->pre_task_info))
                        <div class="border-t border-blue-500/50 pt-4">
                            <h3 class="text-base font-bold mb-1">📝 Penugasan Pra-Event (Pre-Task)</h3>
                            <p class="text-sm text-blue-100 leading-relaxed whitespace-pre-line">{{ $event->pre_task_info }}</p>
                        </div>
                    @endif
                </div>
            @endif

            <!-- RINGKASAN DATA PENDAFTAR -->
            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-3xl overflow-hidden border border-gray-200 dark:border-gray-700 p-8 transition-colors">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-6 border-b border-gray-100 dark:border-gray-700 pb-3">Ringkasan Data Pendaftaran Anda</h3>

                <div class="space-y-4">
                    @if(is_array($event->form_schema))
                        @foreach($event->form_schema as $field)
                            <div class="flex flex-col sm:flex-row justify-between border-b border-gray-100 dark:border-gray-700/50 pb-3 text-sm">
                                <span class="font-semibold text-gray-500 dark:text-gray-400">{{ $field['label'] }}</span>
                                <span class="font-medium text-gray-900 dark:text-white mt-1 sm:mt-0 text-left sm:text-right">
                                    @php 
                                        $val = $registration->answers[$field['name']] ?? '-'; 
                                    @endphp
                                    @if($field['type'] === 'file' && $val !== '-')
                                        <a href="{{ asset('storage/' . $val) }}" target="_blank" class="text-blue-600 dark:text-blue-400 underline font-medium">Lihat Berkas Terunggah</a>
                                    @else
                                        {{ $val }}
                                    @endif
                                </span>
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700 flex justify-between items-center">
                    <span class="text-xs text-gray-400">Waktu Daftar: {{ $registration->created_at->format('d M Y, H:i') }} WIB</span>
                    <a href="{{ route('events.index') }}" class="px-5 py-2.5 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-800 dark:text-white rounded-xl text-sm font-bold transition">
                        Kembali ke Beranda Event
                    </a>
                </div>
            </div>

        </div>
    </div>

    <!-- Script html2canvas untuk Konversi Kartu ke Gambar PNG -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script>
        function downloadRegistrationCard() {
            const cardElement = document.getElementById('registration-card');
            
            html2canvas(cardElement, {
                scale: 2, // Resolusi tinggi (Retina)
                useCORS: true,
                backgroundColor: null
            }).then(canvas => {
                const imageLink = document.createElement('a');
                imageLink.download = 'Bukti-Pendaftaran-09.06.5455.{{ str_pad($registration->id, 4, '0', STR_PAD_LEFT) }}.png';
                imageLink.href = canvas.toDataURL('image/png');
                imageLink.click();
            });
        }

        function notifikasiKalender() {
            const toast = document.createElement('div');
            toast.className = 'fixed bottom-5 right-5 z-50 bg-green-600 text-white px-5 py-3 rounded-xl shadow-2xl text-sm font-bold flex items-center space-x-2 transition-all transform translate-y-0 opacity-100';
            toast.innerHTML = `
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <span>Mengarahkan ke kalender, silakan klik Simpan</span>
            `;
            
            document.body.appendChild(toast);

            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateY(10px)';
                setTimeout(() => toast.remove(), 300);
            }, 4000);
        }
    </script>
</x-layouts.app>