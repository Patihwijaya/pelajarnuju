<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('asset/logoPelajarnuju.png') }}" type="image/png">
    <title>Lupa Password - Pelajarnuju</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<div class="min-h-screen flex flex-col md:flex-row bg-gray-50 dark:bg-gray-900">
    
    <!-- Sisi Kiri: Branding & Visual -->
    <div class="md:w-5/12 bg-gradient-to-br from-[#083C30] via-[#0b4d40] to-[#04241d] p-8 md:p-12 flex flex-col justify-between text-white relative overflow-hidden hidden md:flex">
        <div class="absolute -top-24 -left-24 w-72 h-72 bg-[#3BD59C]/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-24 w-80 h-80 bg-emerald-400/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10">
            <a href="{{ route('home') }}" class="inline-block">
                <img src="{{ asset('asset/logo pelajarnuju putih.png') }}" alt="Logo Pelajar Nuju" class="h-10 w-auto object-contain">
            </a>
        </div>

        <div class="relative z-10 my-auto py-10">
            <span class="inline-block bg-[#3BD59C]/20 text-[#3BD59C] text-xs font-semibold px-3 py-1 rounded-full mb-4 border border-[#3BD59C]/30">
                Pemulihan Akun
            </span>
            <h1 class="text-3xl md:text-4xl font-bold tracking-tight mb-4 leading-snug">
                Hallo Rekan dan Rekanita! 👋
            </h1>
            <p class="text-gray-300 text-sm md:text-base leading-relaxed">
                Lupa password? Tenang, kami akan membantu Anda memulihkan akses ke portal resmi PC IPNU IPPNU Jakarta Utara.
            </p>
        </div>

        <div class="relative z-10 text-xs text-gray-400 flex items-center justify-between border-t border-white/10 pt-6">
            <span>&copy; 2026 Pelajarnuju. All rights reserved.</span>
            <a href="{{ route('home') }}" class="hover:text-[#3BD59C] transition-colors flex items-center gap-1">
                &larr; Kembali ke Beranda
            </a>
        </div>
    </div>

    <!-- Sisi Kanan: Form Lupa Password -->
    <div class="md:w-7/12 flex items-center justify-center p-6 md:py-10 md:px-12 relative w-full">
        
        <!-- Tombol Kembali Mobile -->
        <a href="{{ route('login') }}" class="absolute top-6 left-6 text-sm font-medium text-[#083C30] hover:underline flex items-center gap-1 md:hidden">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/>
            </svg>
            Kembali
        </a>

        <div class="w-full max-w-lg bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 mt-8 md:mt-0">
            
            <div class="mb-6 text-center md:text-left">
                <img src="{{ asset('asset/logo pelajarnuju hijau.png') }}" alt="Logo" class="h-8 w-auto mx-auto md:mx-0 mb-3 object-contain">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Reset Password</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Masukkan email Anda yang terdaftar untuk menerima kode OTP pemulihan.</p>
            </div>

            @if(session('error'))
                <div class="bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-400 px-4 py-3 rounded-xl relative mb-4 text-sm text-center">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
                @csrf
                
                <!-- TAHAP 1: INPUT EMAIL -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email Terdaftar</label>
                    <div class="flex gap-2">
                        <input type="email" name="email" id="email" placeholder="nama@email.com" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-[#083C30] focus:border-transparent outline-none transition-all text-sm" required>
                        <button type="button" id="btn-send-otp" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-4 rounded-xl transition-colors whitespace-nowrap text-sm shadow-sm">
                            Kirim OTP
                        </button>
                    </div>
                    <span id="email-msg" class="text-xs font-semibold hidden mt-1"></span>
                </div>

                <!-- TAHAP 2: INPUT OTP (Tersembunyi secara default) -->
                <div id="otp-container" class="hidden">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Kode OTP</label>
                    <div class="flex gap-2">
                        <input type="text" id="otp-input" placeholder="Masukkan 6 Digit OTP" maxlength="6" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-[#083C30] focus:border-transparent outline-none transition-all font-mono text-center tracking-widest text-lg">
                        <button type="button" id="btn-verify-otp" class="bg-[#083C30] hover:bg-[#062d24] text-white font-semibold px-4 rounded-xl transition-colors whitespace-nowrap text-sm shadow-sm">
                            Cek OTP
                        </button>
                    </div>
                    <span id="otp-msg" class="text-xs text-red-500 font-semibold hidden mt-1"></span>
                </div>

                <!-- TAHAP 3: FORM PASSWORD BARU (Tersembunyi secara default) -->
                <div id="new-password-container" class="hidden space-y-4 pt-3 border-t border-gray-200 dark:border-gray-700">
                    <p class="text-sm font-semibold text-green-600 dark:text-green-400">✓ Verifikasi berhasil! Silakan buat password baru.</p>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password Baru</label>
                        <div class="relative">
                            <input type="password" name="password" id="password" placeholder="••••••••" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-[#083C30] focus:border-transparent outline-none transition-all text-sm pr-12">
                            <button type="button" onclick="togglePassword('password', 'eye-password')" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-[#083C30] focus:outline-none">
                                <svg id="eye-password" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    <ul class="text-xs font-semibold space-y-1">
                        <li id="req-length" class="text-red-500 transition-colors duration-300" data-text="Minimal 8 karakter">✗ Minimal 8 karakter</li>
                        <li id="req-upper" class="text-red-500 transition-colors duration-300" data-text="Minimal 1 huruf besar">✗ Minimal 1 huruf besar</li>
                        <li id="req-number" class="text-red-500 transition-colors duration-300" data-text="Minimal 1 angka">✗ Minimal 1 angka</li>
                    </ul>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Konfirmasi Password Baru</label>
                        <div class="relative">
                            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-[#083C30] focus:border-transparent outline-none transition-all text-sm pr-12">
                            <button type="button" onclick="togglePassword('password_confirmation', 'eye-password-confirmation')" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-[#083C30] focus:outline-none">
                                <svg id="eye-password-confirmation" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <button type="submit" id="btn-submit-form" class="w-full py-3 px-4 bg-[#083C30] hover:bg-[#062d24] text-white font-semibold rounded-xl shadow-lg shadow-[#083C30]/20 transition-all duration-200 text-sm flex items-center justify-center gap-2">
                        Simpan Password Baru
                    </button>
                </div>

                <!-- Tombol Kembali ke Login -->
                <div id="back-to-login" class="mt-5 text-center">
                    <p class="text-sm text-gray-600 dark:text-gray-400">Ingat password Anda? <a href="{{ route('login') }}" class="text-[#083C30] dark:text-[#3BD59C] font-semibold hover:underline">Login Sekarang!</a></p>
                </div>

            </form>

        </div>
    </div>
</div>

<script>
    const btnSendOtp = document.getElementById('btn-send-otp');
    const btnVerifyOtp = document.getElementById('btn-verify-otp');
    const emailInput = document.getElementById('email');
    const otpContainer = document.getElementById('otp-container');
    const otpInput = document.getElementById('otp-input');
    const emailMsg = document.getElementById('email-msg');
    const otpMsg = document.getElementById('otp-msg');
    const newPasswordContainer = document.getElementById('new-password-container');
    const backToLogin = document.getElementById('back-to-login');
    
    const csrfToken = document.querySelector('input[name="_token"]').value;

    // 1. AJAX Kirim OTP
    btnSendOtp.addEventListener('click', function() {
        const email = emailInput.value;
        if(!email) {
            alert('Harap isi alamat email terlebih dahulu!');
            return;
        }

        btnSendOtp.innerText = "Mengirim...";
        btnSendOtp.disabled = true;

        fetch('{{ route("ajax.send.reset.otp") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ email: email })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                otpContainer.classList.remove('hidden');
                emailMsg.innerText = data.message;
                emailMsg.classList.remove('hidden', 'text-red-500');
                emailMsg.classList.add('text-green-600');
                btnSendOtp.innerText = "Kirim Ulang";
            } else {
                let errorText = data.message || 'Email tidak ditemukan di sistem.';
                if(data.errors && data.errors.email) {
                    errorText = data.errors.email[0];
                }
                emailMsg.innerText = errorText;
                emailMsg.classList.remove('hidden', 'text-green-600');
                emailMsg.classList.add('text-red-500');
                btnSendOtp.innerText = "Kirim OTP";
            }
        })
        .catch(error => {
            emailMsg.innerText = "Terjadi kesalahan server/email tidak terdaftar.";
            emailMsg.classList.remove('hidden', 'text-green-600');
            emailMsg.classList.add('text-red-500');
            btnSendOtp.innerText = "Kirim OTP";
        })
        .finally(() => {
            btnSendOtp.disabled = false;
        });
    });

    // 2. AJAX Verifikasi OTP
    btnVerifyOtp.addEventListener('click', function() {
        const email = emailInput.value;
        const otp = otpInput.value;

        if(!otp) return;

        btnVerifyOtp.innerText = "Mengecek...";

        fetch('{{ route("ajax.verify.otp") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ email: email, otp: otp })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                emailInput.readOnly = true;
                emailInput.classList.add('bg-gray-100', 'text-gray-500', 'dark:bg-gray-800');
                btnSendOtp.classList.add('hidden');
                otpContainer.classList.add('hidden');
                emailMsg.classList.add('hidden');
                backToLogin.classList.add('hidden');
                
                newPasswordContainer.classList.remove('hidden');
                
                document.getElementById('password').required = true;
                document.getElementById('password_confirmation').required = true;
            } else {
                otpMsg.innerText = data.message;
                otpMsg.classList.remove('hidden');
            }
        })
        .finally(() => {
            btnVerifyOtp.innerText = "Cek OTP";
        });
    });

    // 3. SCRIPT TOGGLE MATA PASSWORD
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

    // 4. SCRIPT VALIDASI PASSWORD REAL-TIME
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('password');

        if(passwordInput) {
            passwordInput.addEventListener('input', function() {
                const val = this.value;
                updateReqUI('req-length', val.length >= 8);
                updateReqUI('req-upper', /[A-Z]/.test(val));
                updateReqUI('req-number', /[0-9]/.test(val));
            });
        }

        function updateReqUI(id, isValid) {
            const el = document.getElementById(id);
            const originalText = el.getAttribute('data-text');
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
</body>
</html>