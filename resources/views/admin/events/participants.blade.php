<x-layouts.admin>
    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        
        <!-- Header & Tombol Kembali -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Kelola Peserta: {{ $event->title }}</h1>
                <p class="text-sm text-gray-600 mt-1">Daftar peserta yang sudah mendaftar dan QR Code check-in acara.</p>
            </div>
            <a href="{{ route('admin.events.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-4 py-2 rounded-md shadow text-sm whitespace-nowrap">
                &larr; Kembali ke Daftar Event
            </a>
        </div>

        <!-- Notifikasi Sukses -->
        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Kotak QR Code Check-in untuk Panitia -->
        <!-- Kotak QR Code Check-in Pintu Masuk -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 mb-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-4">
                <div>
                    <h3 class="text-base font-bold text-gray-900">QR Code Check-in Pintu Masuk</h3>
                    <p class="text-xs text-gray-500">Tampilkan QR code ini di meja registrasi/pintu masuk atau unduh untuk dicetak pada banner.</p>
                </div>

                <!-- FORM RADIO BUTTON STATUS (AUTO-SUBMIT) -->
                <form action="{{ route('admin.events.update-checkin', $event->id) }}" method="POST" class="bg-gray-50 px-4 py-2 rounded-xl border border-gray-200 flex items-center space-x-4">
                    @csrf
                    <span class="text-xs font-bold text-gray-700">Status:</span>
                    <label class="inline-flex items-center text-xs font-bold text-green-700 cursor-pointer">
                        <input type="radio" name="is_checkin_active" value="1" {{ $isCheckinActive ? 'checked' : '' }} onchange="this.form.submit()" class="text-green-600 focus:ring-green-500">
                        <span class="ml-1.5">Aktif</span>
                    </label>
                    <label class="inline-flex items-center text-xs font-bold text-red-700 cursor-pointer">
                        <input type="radio" name="is_checkin_active" value="0" {{ !$isCheckinActive ? 'checked' : '' }} onchange="this.form.submit()" class="text-red-600 focus:ring-red-500">
                        <span class="ml-1.5">Nonaktif</span>
                    </label>
                </form>
            </div>

            <!-- Tampilan QR Code (Diberi efek redup jika nonaktif) -->
            <div class="flex flex-col md:flex-row items-center gap-6 p-4 bg-gray-50 rounded-xl border border-gray-100">
                <div class="relative">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ urlencode(route('checkin.form', $event->slug)) }}" 
                        alt="QR Code" 
                        class="w-36 h-36 bg-white p-2 rounded-lg border shadow-sm {{ !$isCheckinActive ? 'opacity-30 grayscale' : '' }}">
                    
                    @if(!$isCheckinActive)
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="bg-red-600 text-white text-[10px] font-black px-2.5 py-1 rounded-md shadow uppercase tracking-wider rotate-[-10deg]">
                                DINONAKTIFKAN
                            </span>
                        </div>
                    @endif
                </div>

                <div class="flex-1 w-full space-y-3">
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Link URL Check-in Manual:</label>
                        <div class="flex shadow-sm rounded border border-gray-300 bg-white" x-data="{ copied: false, link: '{{ route('checkin.form', $event->slug) }}' }">
                            <input type="text" readonly :value="link" class="flex-1 block w-full bg-transparent text-gray-600 text-xs px-2 py-2 border-0 focus:ring-0 select-all">
                            <button type="button" @click="navigator.clipboard.writeText(link); copied = true; setTimeout(() => copied = false, 2000)" class="inline-flex items-center px-3 py-2 bg-blue-50 border-l border-gray-300 hover:bg-blue-100 text-xs font-bold text-blue-700 transition-colors">
                                <span x-show="!copied">Salin</span>
                                <span x-show="copied" style="display: none;" class="text-green-600">Disalin!</span>
                            </button>
                        </div>
                    </div>
                    
                    @if(!$isCheckinActive)
                        <p class="text-xs font-medium text-red-600 bg-red-50 p-2 rounded-lg border border-red-200">
                            ⚠️ QR Code saat ini dalam status <strong>Nonaktif</strong>. Peserta atau operator tidak dapat melakukan scan atau akses halaman check-in.
                        </p>
                    @endif
                </div>
            </div>
        </div>

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div class="w-full">
                <h1 class="text-xl font-extrabold text-gray-900 tracking-tight">Kelola Peserta: {{ $event->title }}</h1>
                <p class="text-sm text-gray-500 mt-1">Daftar peserta yang sudah mendaftar dan QR Code check-in acara.</p>
            </div>
            
            <div class="flex flex-wrap items-center gap-2">
                <!-- Tombol Ekspor Berkas (ZIP) Baru -->
                <a href="{{ route('admin.events.export-files', $event->id) }}" class="inline-flex items-center px-4 py-2.5 bg-amber-500 hover:bg-amber-600 text-white text-sm font-bold rounded-xl shadow-md transition transform hover:-translate-y-0.5">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                    Unduh Berkas (ZIP)
                </a>

                <!-- Tombol Ekspor Excel (Tetap Dipertahankan) -->
                <a href="{{ route('admin.events.export', $event->id) }}" class="inline-flex items-center px-4 py-2.5 bg-green-600 hover:bg-green-700 text-white text-sm font-bold rounded-xl shadow-md transition transform hover:-translate-y-0.5">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Unduh Data (Excel)
                </a>
            </div>
        </div>

        <!-- Tabel Data Peserta Dinamis -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-800">Daftar Pendaftar (Total: {{ $event->registrations->count() }} / Kuota: {{ $event->max_participants }})</h3>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Pendaftar</th>
                            
                            <!-- Looping kolom dinamis berdasarkan Google Form Builder admin -->
                            @if(is_array($event->form_schema))
                                @foreach($event->form_schema as $field)
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ $field['label'] }}</th>
                                @endforeach
                            @endif

                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status Kehadiran</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($event->registrations as $index => $reg)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">09.06.5455.{{ str_pad($reg->id, 4, '0', STR_PAD_LEFT) }}</td>
                                
                                <!-- Menampilkan jawaban peserta sesuai kolom dinamis -->
                                @if(is_array($event->form_schema))
                                    @foreach($event->form_schema as $field)
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            @php 
                                                $val = $reg->answers[$field['name']] ?? '-'; 
                                            @endphp
                                            @if($field['type'] === 'file' && $val !== '-')
                                                <a href="{{ asset('storage/' . $val) }}" target="_blank" class="text-blue-600 underline font-medium text-xs">Lihat File</a>
                                            @else
                                                {{ $val }}
                                            @endif
                                        </td>
                                    @endforeach
                                @endif

                                <!-- Status Kehadiran -->
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @if($reg->attended_at)
                                        <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Hadir (<span class="local-time" data-timestamp="{{ $reg->attended_at->toIso8601String() }}">Mengambil waktu...</span>)
                                        </span>
                                    @else
                                        <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                            Belum Hadir
                                        </span>
                                    @endif
                                </td>

                                <!-- Aksi Hapus Peserta -->
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <form action="{{ route('admin.participants.destroy', $reg->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus peserta ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 bg-red-50 px-2.5 py-1.5 rounded">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ count($event->form_schema ?? []) + 3 }}" class="px-6 py-10 text-center text-sm text-gray-500">
                                    Belum ada peserta yang mendaftar pada event ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- JavaScript untuk Handle Download Gambar QR -->
<script>
    function downloadQRCode() {
        // Menggunakan resolusi lebih besar (500x500) agar tajam saat dicetak
        const qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size=500x500&data={{ route('checkin.verify', $event->id) }}";
        const fileName = "QRCode-Event-{{ Str::slug($event->title) }}.png";

        fetch(qrUrl)
            .then(response => response.blob())
            .then(blob => {
                const link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = fileName;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            })
            .catch(error => {
                alert('Gagal mendownload QR Code. Pastikan terhubung ke internet.');
                console.error(error);
            });
    }

    document.addEventListener("DOMContentLoaded", function() {
        // Cari semua elemen yang memiliki class 'local-time'
        const timeElements = document.querySelectorAll('.local-time');
        
        timeElements.forEach(function(el) {
            const timestamp = el.getAttribute('data-timestamp');
            if (timestamp) {
                // Ubah timestamp server menjadi waktu lokal sesuai perangkat yang membuka web
                const localDate = new Date(timestamp);
                
                // Format hanya menampilkan Jam dan Menit (Contoh: 20:28)
                const formattedTime = localDate.toLocaleTimeString(undefined, { 
                    hour: '2-digit', 
                    minute: '2-digit',
                    hour12: false 
                });
                
                // Tampilkan ke layar
                el.textContent = formattedTime;
            }
        });
    });
</script>
</x-layouts.admin>