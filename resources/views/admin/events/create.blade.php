<x-layouts.admin>
    <div class="max-w-6xl mx-auto py-8 px-4 sm:px-6 lg:px-8" x-data="eventBuilder()">
        
        <!-- Header Halaman -->
        <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Tambah Event Baru</h1>
                <p class="text-sm text-gray-500 mt-1">Buat kegiatan organisasi dan atur kolom pendaftaran pesertanya di sini.</p>
            </div>
            <a href="{{ route('admin.events.index') }}" class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-blue-600 transition">
                &larr; Batal & Kembali
            </a>
        </div>

        <!-- PERHATIKan enctype="multipart/form-data" WAJIB ADA UNTUK UPLOAD GAMBAR -->
        <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <!-- CARD 1: INFORMASI UTAMA EVENT -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-bold text-gray-800">Informasi Dasar Kegiatan</h2>
                </div>
                
                <div class="p-6 sm:p-8 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Judul Event -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Event <span class="text-red-500">*</span></label>
                            <input type="text" name="title" required placeholder="Contoh: LDK Angkatan 2026" 
                                class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2.5 text-sm text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-shadow">
                        </div>
                        
                        <!-- Kategori Event -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori Event <span class="text-red-500">*</span></label>
                            <select name="category" required class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2.5 text-sm text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-shadow">
                                <option value="" disabled selected>-- Pilih Kategori --</option>
                                <option value="Leadership">Leadership</option>
                                <option value="Pelatihan">Pelatihan</option>
                                <option value="Seminar">Seminar</option>
                                <option value="Workshop">Workshop</option>
                                <option value="Kaderisasi">Kaderisasi</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Kuota -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Maksimal Peserta (Kuota) <span class="text-red-500">*</span></label>
                            <input type="number" name="max_participants" required placeholder="Contoh: 50" 
                                class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2.5 text-sm text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-shadow">
                        </div>

                        <!-- Gambar Thumbnail Event -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Gambar Thumbnail Banner</label>
                            <input type="file" name="thumbnail" accept="image/png, image/jpeg, image/webp" 
                                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border border-gray-300 rounded-lg bg-white">
                            <p class="text-[11px] text-gray-400 mt-1">Format: JPG, PNG, WebP (Maks. 2MB)</p>
                        </div>
                    </div>

                    <!-- Waktu Pendaftaran -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Waktu Mulai Pendaftaran <span class="text-red-500">*</span></label>
                            <input type="datetime-local" name="start_date" required 
                                class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2.5 text-sm text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-shadow">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Waktu Selesai Pendaftaran <span class="text-red-500">*</span></label>
                            <input type="datetime-local" name="end_date" required 
                                class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2.5 text-sm text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-shadow">
                        </div>
                    </div>

                    <!-- Waktu Pelaksanaan Event (OPSIONAL) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-blue-50/50 p-4 rounded-xl border border-blue-100">
                        <div>
                            <label class="block text-sm font-semibold text-blue-900 mb-1">Waktu Pelaksanaan Mulai <span class="text-xs text-gray-500 font-normal">(Opsional)</span></label>
                            <input type="datetime-local" name="event_start_date" 
                                class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2 text-sm text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-blue-900 mb-1">Waktu Pelaksanaan Selesai <span class="text-xs text-gray-500 font-normal">(Opsional)</span></label>
                            <input type="datetime-local" name="event_end_date" 
                                class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2 text-sm text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <!-- Lokasi -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Lokasi / Tautan Acara <span class="text-red-500">*</span></label>
                        <input type="text" name="location" required placeholder="Contoh: Aula Utama PCNU Jakarta Utara / Link Zoom" 
                            class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2.5 text-sm text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-shadow">
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Lengkap <span class="text-red-500">*</span></label>
                        <textarea name="description" rows="5" required placeholder="Jelaskan detail kegiatan, fasilitas, dan ketentuan di sini..." 
                            class="w-full bg-white border border-gray-300 rounded-lg px-4 py-3 text-sm text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-shadow"></textarea>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 space-y-4">
                <div class="flex items-center space-x-3">
                    <input type="checkbox" id="is_paid" x-model="isPaid" name="is_paid" value="1" class="w-5 h-5 text-blue-600 rounded border-gray-300 cursor-pointer">
                    <label for="is_paid" class="text-sm font-bold text-gray-800 cursor-pointer">Event Berbayar / Memiliki HTM (Biaya Pendaftaran)</label>
                </div>

                <!-- Container Rekening Dinamis (Muncul jika isPaid True) -->
                <div x-show="isPaid" x-transition class="space-y-4 pt-3 border-t border-gray-200">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-sm font-bold text-gray-800">Daftar Rekening Pembayaran / E-Wallet</h3>
                            <p class="text-xs text-gray-500">Tambahkan satu atau beberapa rekening tujuan transfer.</p>
                        </div>
                        <button type="button" @click="addAccount()" class="px-3 py-1.5 bg-blue-600 text-white rounded-lg text-xs font-bold hover:bg-blue-700 transition">
                            + Tambah Rekening
                        </button>
                    </div>

                    <template x-for="(acc, index) in paymentAccounts" :key="index">
                        <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm grid grid-cols-1 md:grid-cols-3 gap-3 relative">
                            <div>
                                <label class="block text-[11px] font-bold text-gray-600 uppercase mb-1">Nama Bank / E-Wallet</label>
                                <input type="text" :name="`payment_info[${index}][bank_name]`" x-model="acc.bank_name" placeholder="Contoh: BCA / DANA" class="w-full text-sm border-gray-300 rounded-lg px-3 py-2" required>
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-gray-600 uppercase mb-1">Nomor Rekening</label>
                                <input type="text" :name="`payment_info[${index}][account_number]`" x-model="acc.account_number" placeholder="Contoh: 1234567890" class="w-full text-sm border-gray-300 rounded-lg px-3 py-2" required>
                            </div>
                            <div class="flex items-end gap-2">
                                <div class="w-full">
                                    <label class="block text-[11px] font-bold text-gray-600 uppercase mb-1">Atas Nama (A.n)</label>
                                    <input type="text" :name="`payment_info[${index}][account_holder]`" x-model="acc.account_holder" placeholder="Contoh: Panitia Pelajar Nuju" class="w-full text-sm border-gray-300 rounded-lg px-3 py-2" required>
                                </div>
                                <button type="button" @click="removeAccount(index)" class="mb-0.5 px-3 py-2 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg text-xs font-bold">
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <!-- CARD 2: DYNAMIC FORM BUILDER -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h2 class="text-lg font-bold text-gray-800">Kustomisasi Formulir Pendaftaran</h2>
                        <p class="text-xs text-gray-500 mt-1">Tambahkan kolom pertanyaan yang harus diisi peserta saat mendaftar.</p>
                    </div>
                    <button type="button" @click="addField()" class="inline-flex items-center px-4 py-2 bg-blue-50 text-blue-700 border border-blue-200 rounded-lg text-sm font-bold hover:bg-blue-100 transition">
                        + Tambah Kolom
                    </button>
                </div>

                <div class="p-6 sm:p-8">
                    <div class="space-y-6">
                        <template x-for="(field, index) in fields" :key="index">
                            <div class="bg-white border border-gray-200 shadow-sm rounded-xl relative overflow-hidden">
                                <div class="absolute top-0 left-0 w-1.5 h-full bg-blue-500"></div>
                                <div class="p-5 sm:p-6 pl-6 sm:pl-8">
                                    <div class="flex justify-between items-center mb-4 border-b border-gray-100 pb-3">
                                        <span class="font-bold text-sm text-gray-800" x-text="'Kolom #' + (index + 1)"></span>
                                        <button type="button" @click="removeField(index)" class="text-red-500 hover:text-red-700 text-sm font-semibold">Hapus</button>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                                        <div>
                                            <label class="block text-xs font-bold text-gray-600 uppercase mb-2">Label Kolom *</label>
                                            <input type="text" :name="`form_schema[${index}][label]`" x-model="field.label" placeholder="Contoh: Asal Sekolah" class="w-full bg-gray-50 border border-gray-300 rounded-lg px-3 py-2 text-sm" required>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-bold text-gray-600 uppercase mb-2">Nama Sistem (Slug) *</label>
                                            <input type="text" :name="`form_schema[${index}][name]`" x-model="field.name" placeholder="contoh: asal_sekolah" class="w-full bg-gray-50 border border-gray-300 rounded-lg px-3 py-2 text-sm" required>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-bold text-gray-600 uppercase mb-2">Tipe Input</label>
                                            <select :name="`form_schema[${index}][type]`" x-model="field.type" class="w-full bg-gray-50 border border-gray-300 rounded-lg px-3 py-2 text-sm">
                                                <option value="text">Teks Singkat</option>
                                                <option value="textarea">Teks Panjang</option>
                                                <option value="number">Angka</option>
                                                <option value="email">Email</option>
                                                <option value="date">Tanggal</option>
                                                <option value="dropdown">Dropdown (Pilihan)</option>
                                                <!-- OPSI BARU: RADIO BUTTON -->
                                                <option value="radio">Radio Button (Pilihan Satu)</option>
                                                <option value="file">Upload File</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- KOTAK INPUT OPSI (TAMPIL JIKA DROPDOWN ATAU RADIO DIPILIH) -->
                                    <div x-show="field.type === 'dropdown' || field.type === 'radio'" class="mt-4 bg-blue-50 p-3 rounded-lg">
                                        <label class="block text-xs font-bold text-blue-800 uppercase mb-1">Opsi Pilihan (Pisahkan dengan koma)</label>
                                        <input type="text" :name="`form_schema[${index}][options]`" x-model="field.options" placeholder="Opsi A, Opsi B" class="w-full bg-white border border-gray-300 rounded px-3 py-1.5 text-sm">
                                    </div>

                                    <div class="mt-4 flex items-center">
                                        <input type="checkbox" :name="`form_schema[${index}][required]`" x-model="field.required" value="1" class="w-4 h-4 text-blue-600 border-gray-300 rounded">
                                        <label class="ml-2 text-sm font-medium text-gray-700">Wajib Diisi (Required)</label>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <!-- KARTU PENGATURAN HALAMAN SUKSES (FEEDBACK) -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-bold text-gray-800">Pengaturan Halaman Sukses Pendaftaran (Feedback)</h2>
                    <p class="text-xs text-gray-500 mt-0.5">Sesuaikan instruksi, link grup, booklet, dan penugasan yang dilihat peserta setelah berhasil mendaftar.</p>
                </div>
                <div class="p-6 sm:p-8 space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Catatan / Instruksi Lanjutan (Contoh: Konfirmasi Pembayaran)</label>
                        <textarea name="post_registration_note" rows="3" placeholder="Tulis instruksi khusus untuk peserta di sini..." 
                            class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2.5 text-sm text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('post_registration_note', $event->post_registration_note ?? '') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Tautan Grup WhatsApp</label>
                            <input type="url" name="whatsapp_link" value="{{ old('whatsapp_link', $event->whatsapp_link ?? '') }}" placeholder="https://chat.whatsapp.com/..." 
                                class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2 text-sm text-gray-900 focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Tautan Booklet / Rundown (PDF/Link)</label>
                            <input type="url" name="booklet_link" value="{{ old('booklet_link', $event->booklet_link ?? '') }}" placeholder="https://..." 
                                class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2 text-sm text-gray-900 focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Tautan Kampanye Twibbon</label>
                            <input type="url" name="twibbon_link" value="{{ old('twibbon_link', $event->twibbon_link ?? '') }}" placeholder="https://twibbonize.com/..." 
                                class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2 text-sm text-gray-900 focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Informasi Penugasan / Pre-Task (Opsional)</label>
                        <textarea name="pre_task_info" rows="3" placeholder="Contoh: Peserta diwajibkan membawa laptop dan membaca modul sebelum acara dimulai..." 
                            class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2.5 text-sm text-gray-900 focus:ring-2 focus:ring-blue-500">{{ old('pre_task_info', $event->pre_task_info ?? '') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Footer Action -->
            <div class="flex justify-end pt-4 space-x-4">
                <a href="{{ route('admin.events.index') }}" class="px-6 py-2.5 bg-white border border-gray-300 rounded-lg text-sm font-bold text-gray-700 hover:bg-gray-50 shadow-sm">Batalkan</a>
                <button type="submit" class="px-8 py-2.5 bg-blue-600 rounded-lg text-sm font-bold text-white hover:bg-blue-700 shadow-md">Simpan & Publikasikan Event</button>
            </div>
        </form>
    </div>

    <script>
        function eventBuilder() {
            return {
                isPaid: false,
                paymentAccounts: [],
                addAccount() {
                    this.paymentAccounts.push({ bank_name: '', account_number: '', account_holder: '' });
                },
                removeAccount(index) {
                    this.paymentAccounts.splice(index, 1);
                },
                fields: [
                    { label: 'Nama Lengkap', name: 'nama_lengkap', type: 'text', options: '', required: true },
                    { label: 'Asal Instansi / Sekolah', name: 'asal_instansi', type: 'text', options: '', required: true }
                ],
                addField() {
                    this.fields.push({ label: '', name: '', type: 'text', options: '', required: false });
                },
                removeField(index) {
                    this.fields.splice(index, 1);
                }
            }
        }
    </script>
</x-layouts.admin>