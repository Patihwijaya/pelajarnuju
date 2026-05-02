<x-layouts.app title="kontak">
    @php
    $ads = \App\Models\Ads::where('status', 1)
    ->whereDate('expired_at', '>=', now())
    ->latest()
    ->get();
@endphp

@if($ads->count())
    <div class="relative w-full aspect-[5/1] overflow-hidden mb-5">
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
<section class="relative isolate overflow-hidden bg-gradient-to-br from-slate-50 via-white to-indigo-50 dark:from-gray-900 dark:via-gray-800 dark:to-indigo-950 px-6 py-16 sm:py-24 lg:px-8">
    <!-- Decorative background element - Top -->
    <div aria-hidden="true" class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80">
        <div style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)" 
        class="relative left-1/2 -z-10 aspect-[1155/678] w-[36.125rem] max-w-none -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-20 dark:opacity-10 sm:left-[calc(50%-40rem)] sm:w-[72.1875rem]"></div>
    </div>

    <div class="mx-auto max-w-7xl">
        <!-- Header -->
        <div class="mx-auto max-w-2xl text-center mb-12 lg:mb-16">
            <p class="text-sm tracking-wide text-indigo-600 dark:text-indigo-400 uppercase font-semibold">
                MARI BERSINERGI
            </p>
            <h2 class="mt-4 text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white tracking-tight">
                Terhubung dengan PC IPNU IPPNU Jakarta Utara
            </h2>
            <p class="mt-4 text-base sm:text-lg text-gray-600 dark:text-gray-400">
                Punya gagasan inovatif, pertanyaan seputar keanggotaan, atau ingin berkolaborasi dalam program kerja? Jangan ragu untuk menyapa kami. Mari bersama-sama wujudkan ruang yang progresif bagi pelajar di Jakarta Utara!
            </p>
        </div>

        <div class="grid lg:grid-cols-3 gap-6 lg:gap-12">
        <!-- Contact Form - Takes 2 columns -->
            <div class="lg:col-span-2">
                <div class="bg-white/70 dark:bg-gray-800/70 backdrop-blur-sm rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 p-6 sm:p-8 lg:p-10">
                    @if(session('success'))
                        <div class="text-green-600 mb-2">{{ session('success') }}</div>
                    @endif
                    <form class="space-y-6" action="{{ route('kontak.store') }}" method="POST">
                        @csrf
                        <div>
                            <label for="firstName" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2.5">
                                Nama Lengkap
                            </label>
                            <input id="firstName" type="text" name="nama" autocomplete="given-name"
                                class="block w-full rounded-lg border-0 bg-white dark:bg-gray-900 px-4 py-3 text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-600 placeholder:text-gray-400 dark:placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-indigo-600 dark:focus:ring-indigo-500 transition-all"
                                placeholder="Ahmad Eko Satrio Welliyan"/>
                        </div>
        
                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2.5">
                            Email
                            </label>
                            <input id="email" type="email" name="email"
                            autocomplete="email"
                            class="block w-full rounded-lg border-0 bg-white dark:bg-gray-900 px-4 py-3 text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-600 placeholder:text-gray-400 dark:placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-indigo-600 dark:focus:ring-indigo-500 transition-all"
                            placeholder="ekosatrio@gmail.com"/>
                        </div>
        
                        <!-- Message -->
                        <div>
                            <label for="message" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2.5">
                            Pesan
                            </label>
                            <textarea id="message" name="pesan" rows="4"
                            class="block w-full rounded-lg border-0 bg-white dark:bg-gray-900 px-4 py-3 text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-600 placeholder:text-gray-400 dark:placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-indigo-600 dark:focus:ring-indigo-500 transition-all" placeholder="Tinggalkan Pesanmu Disini"></textarea>
                        </div>
        
                        <!-- Submit Button -->
                        <div class="pt-4">
                            <button type="submit" class="w-full flex items-center justify-center gap-2 rounded-lg bg-indigo-600 dark:bg-indigo-500 px-6 py-3.5 text-sm font-semibold text-white shadow-lg hover:bg-indigo-500 dark:hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 dark:focus-visible:outline-indigo-500 transition-all duration-200 hover:shadow-xl">
                            Kirim
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        <!-- Contact Information Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Office Location -->
                <div class="bg-white/70 dark:bg-gray-800/70 backdrop-blur-sm rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Hubungi Kami</h3>
                        <div class="space-y-4">
                            <div class="flex gap-3">
                                <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-900 dark:text-white">Gedung PCNU Jakarta Utara</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Jl. Kramat Jaya No.02 Kel. Tugu Utara, Kec. Koja, Kota Administrasi Jakarta Utara</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">DKI Jakarta</p>
                                </div>
                            </div>
            
                            <div class="flex gap-3">
                                <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-900 dark:text-white">+62 889-7595-7112 (Ahmad Eko Satrio Welliyan)</p>
                                    <p class="text-sm text-gray-900 dark:text-white">+62 898-4677-425 (Rida Rigita)</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-500">Senin-Minggu, 24 Jam</p>
                                </div>
                            </div>
            
                            <div class="flex gap-3">
                                <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-900 dark:text-white">pcipnu.jakut@gmail.com</p>
                                    <p class="text-sm text-gray-900 dark:text-white">pcippnujakartautara@gmail.com</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-500">24 jam</p>
                                </div>
                            </div>
                        </div>
                </div>

                <!-- Map -->
                <div class="bg-white/70 dark:bg-gray-800/70 backdrop-blur-sm rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="h-64 w-full">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3967.0326809080584!2d106.91420877409497!3d-6.126304560067415!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6a210062135481%3A0x4b9b0f1259f4b8d!2sPCNU%20Kota%20Jakarta%20Utara!5e0!3m2!1sen!2sid!4v1761832636693!5m2!1sen!2sid"
                        width="100%"
                        height="100%"
                        style="border: 0;"
                        allowfullscreen
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Office Location Map"
                        class="dark:opacity-90"
                    ></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom decorative element -->
    <div aria-hidden="true" class="absolute inset-x-0 -bottom-40 -z-10 transform-gpu overflow-hidden blur-3xl">
        <div style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"
        class="relative left-1/2 -z-10 aspect-[1155/678] w-[36.125rem] max-w-none -translate-x-1/2 rotate-[180deg] bg-gradient-to-tr from-[#9089fc] to-[#ff80b5] opacity-15 dark:opacity-5 sm:left-[calc(50%+30rem)] sm:w-[72.1875rem]"
        ></div>
    </div>
</section>
</x-layouts.app>
