<x-layouts.admin title="Dashboard Admin">
    <div class="container mx-auto px-4 py-6">
        <div class="max-w-2xl mx-auto bg-white p-8 rounded shadow-md">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Tambah Admin Baru</h2>

            <form action="{{ route('admin.admins.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
                    <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('name') }}" required>
                    @error('name') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Alamat Email</label>
                    <input type="email" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('email') }}" required>
                    @error('email') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4 flex gap-4">
                    <div class="w-1/2">
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                        <div class="relative">
                            <!-- Tambah pr-10 agar teks yang diketik tidak bertabrakan dengan icon mata -->
                            <input type="password" name="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 pr-10 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            <button type="button" onclick="togglePassword('password', 'eye-password')" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-gray-700 focus:outline-none">
                                <svg id="eye-password" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </button>
                        </div>
                        
                        <!-- TAMBAHKAN TEKS INI -->
                        <ul class="mt-2 text-xs font-semibold space-y-1">
                            <li id="req-length" class="text-red-500 transition-colors duration-300" data-text="Minimal 8 karakter">✗ Minimal 8 karakter</li>
                            <li id="req-upper" class="text-red-500 transition-colors duration-300" data-text="Minimal 1 huruf besar">✗ Minimal 1 huruf besar</li>
                            <li id="req-number" class="text-red-500 transition-colors duration-300" data-text="Minimal 1 angka">✗ Minimal 1 angka</li>
                        </ul>
                        <!-- ================== -->

                        @error('password') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="w-1/2">
                        <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Konfirmasi Password</label>
                        <div class="relative">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="shadow appearance-none border rounded w-full py-2 px-3 pr-10 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            <button type="button" onclick="togglePassword('password_confirmation', 'eye-password-confirmation')" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-gray-700 focus:outline-none">
                                <svg id="eye-password-confirmation" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="mb-4 flex gap-4">
                    <div class="w-1/2">
                        <label for="role" class="block text-gray-700 text-sm font-bold mb-2">Pilih Role</label>
                        <select name="role" id="role" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            <option value="admin">Admin (PAC Tingkat Kecamatan)</option>
                            <option value="super_admin">Super Admin (PC Tingkat Kota)</option>
                        </select>
                    </div>
                    
                    <div class="w-1/2">
                        <label for="asal" class="block text-gray-700 text-sm font-bold mb-2">Asal PAC (Khusus Role Admin)</label>
                        <select name="asal" id="asal" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="">-- Kosongkan Jika PC --</option>
                            <option value="PAC IPNU IPPNU Cilincing">PAC IPNU IPPNU Cilincing</option>
                            <option value="PAC IPNU IPPNU Koja">PAC IPNU IPPNU Koja</option>
                            <option value="PAC IPNU IPPNU Kelapa Gading">PAC IPNU IPPNU Kelapa Gading</option>
                            <option value="PAC IPNU IPPNU Tanjung Priok">PAC IPNU IPPNU Tanjung Priok</option>
                            <option value="PAC IPNU IPPNU Pademangan">PAC IPNU IPPNU Pademangan</option>
                            <option value="PAC IPNU IPPNU Penjaringan">PAC IPNU IPPNU Penjaringan</option>
                        </select>
                    </div>
                </div>

                <div class="flex items-center justify-between mt-8">
                    <a href="{{ route('admin.admins.index') }}" class="text-gray-600 hover:text-gray-800 font-semibold">Batal</a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Simpan Akun
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        // 1. Fungsi Buka/Tutup Mata Password
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />';
            } else {
                input.type = 'password';
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />';
            }
        }

        // 2. Fungsi Validasi Real-time
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');

            if(passwordInput) {
                passwordInput.addEventListener('input', function() {
                    const val = this.value;

                    // Cek Aturan (Regex)
                    const isLengthValid = val.length >= 8;
                    const isUpperValid = /[A-Z]/.test(val); // Mencari minimal 1 huruf A-Z
                    const isNumberValid = /[0-9]/.test(val); // Mencari minimal 1 angka 0-9

                    // Panggil fungsi untuk mengubah UI HTML-nya
                    updateReqUI('req-length', isLengthValid);
                    updateReqUI('req-upper', isUpperValid);
                    updateReqUI('req-number', isNumberValid);
                });
            }

            // Fungsi Helper untuk ganti warna dan icon
            function updateReqUI(id, isValid) {
                const el = document.getElementById(id);
                const originalText = el.getAttribute('data-text'); // Ambil teks asli dari data-text
                
                if (isValid) {
                    el.classList.remove('text-red-500');
                    el.classList.add('text-green-600');
                    el.innerHTML = '✓ ' + originalText;
                } else {
                    el.classList.remove('text-green-600');
                    el.classList.add('text-red-500');
                    el.innerHTML = '✗ ' + originalText;
                }
            }
        });
    </script>
</x-layouts.admin>
