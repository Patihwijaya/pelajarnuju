<x-layouts.app title="FAQ">
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
    <div class="space-y-3 text-center">
        <h1 class="text-3xl text-gray-800 dark:text-white font-semibold">
            FAQ
        </h1>
        <p class="text-gray-600 dark:text-white max-w-lg mx-auto text-lg">
            Temukan jawaban seputar organisasi, keanggotaan, dan kegiatan di sini.
        </p>
    </div>
    {{-- Mengenai Organisasi --}}
    <div x-data="{ selectedFaq: null, faqs: [
            { q: 'Apa itu PC IPNU IPPNU Jakarta Utara?', a: 'PC IPNU IPPNU Jakarta Utara adalah Pimpinan Cabang organisasi pelajar Nahdlatul Ulama yang menjadi wadah pengembangan pelajar di wilayah Jakarta Utara.' },
            { q: 'Siapa saja yang bisa menjadi anggota?', a: 'Pelajar SMP, SMA/SMK, dan mahasiswa yang ingin aktif dalam kegiatan ke-NU-an dan pengembangan diri.' },
            { q: 'Apa manfaat bergabung di IPNU IPPNU?', a: 'Mendapatkan pengalaman organisasi, relasi, pelatihan kepemimpinan, serta penguatan nilai keislaman dan kebangsaan.' },
            ] }">
        <section class="leading-relaxed max-w-screen-xl mt-12 mx-auto px-4 md:px-8">
            <div class="mt-14 max-w-2xl mx-auto">
                <div class="flex gap-2 items-center mb-3">
                    <div class="flex flex-col gap-2">
                        <h1 class="font-bold text-lg">Mengenai Organisasi</h1>
                        <div class="flex gap-1">
                            <div class="w-[46px] h-1 rounded-full bg-[#083C30]"></div>
                            <div class="w-[23px] h-1 rounded-full bg-[#3BD59C]"></div>
                            <div class="w-[6px] h-1 rounded-full bg-[#99FFD9]"></div>
                        </div>
                    </div>
                    <div class="border border-[#696767] border-dashed max-w-min h-0.5"></div>
                </div>
                <template x-for="(item, index) in faqs" :key="index">
                    <div class="space-y-3 mt-5 overflow-hidden border-b" @click="selectedFaq = selectedFaq === index ? null : index">
                        <h4 class="cursor-pointer pb-5 flex items-center justify-between text-lg text-gray-700 dark:text-white font-medium">
                            <span x-text="item.q"></span>
                            <svg x-show="selectedFaq === index" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-white ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                            </svg>
                            <svg x-show="selectedFaq !== index" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-white ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </h4>
                        <div x-ref="answerElRef" class="transition-[max-height,opacity] overflow-hidden duration-500 ease-in-out" :style="{maxHeight: selectedFaq === index ? '1000px' : '0px', opacity: selectedFaq === index ? 1 : 0,}">
                            <div>
                                <p class="text-gray-500 dark:text-white pb-4" x-text="item.a"></p>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </section>
    </div>
    {{-- Pendaftaran --}}
    <div x-data="{ selectedFaq: null, faqs: [
            { q: 'Bagaimana cara mendaftar menjadi anggota?', a: 'Bisa melalui form online di website atau menghubungi pengurus PAC/ranting terdekat.' },
            { q: 'Apakah ada syarat khusus untuk mendaftar?', a: 'Umumnya hanya mengisi formulir, mengikuti proses kaderisasi (MAKESTA), dan memiliki komitmen aktif.' },
            { q: 'Apakah pendaftaran dikenakan biaya?', a: 'Biaya biasanya menyesuaikan kegiatan kaderisasi di masing-masing wilayah.' },
            ] }">
        <section class="leading-relaxed max-w-screen-xl mt-12 mx-auto px-4 md:px-8">
            <div class="mt-14 max-w-2xl mx-auto">
                <div class="flex gap-2 items-center mb-3">
                    <div class="flex flex-col gap-2">
                        <h1 class="font-bold text-lg">Pendaftaran</h1>
                        <div class="flex gap-1">
                            <div class="w-[46px] h-1 rounded-full bg-[#083C30]"></div>
                            <div class="w-[23px] h-1 rounded-full bg-[#3BD59C]"></div>
                            <div class="w-[6px] h-1 rounded-full bg-[#99FFD9]"></div>
                        </div>
                    </div>
                    <div class="border border-[#696767] border-dashed max-w-min h-0.5"></div>
                </div>
                <template x-for="(item, index) in faqs" :key="index">
                    <div class="space-y-3 mt-5 overflow-hidden border-b" @click="selectedFaq = selectedFaq === index ? null : index">
                        <h4 class="cursor-pointer pb-5 flex items-center justify-between text-lg text-gray-700 dark:text-white font-medium">
                            <span x-text="item.q"></span>
                            <svg x-show="selectedFaq === index" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-white ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                            </svg>
                            <svg x-show="selectedFaq !== index" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-white ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </h4>
                        <div x-ref="answerElRef" class="transition-[max-height,opacity] overflow-hidden duration-500 ease-in-out" :style="{maxHeight: selectedFaq === index ? '1000px' : '0px', opacity: selectedFaq === index ? 1 : 0,}">
                            <div>
                                <p class="text-gray-500 dark:text-white pb-4" x-text="item.a"></p>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </section>
    </div>
    {{-- Kegiatan & Program --}}
    <div x-data="{ selectedFaq: null, faqs: [
            { q: 'Kegiatan apa saja yang dilakukan?', a: 'Kegiatan meliputi kaderisasi (MAKESTA, LAKMUD), kajian keislaman, pelatihan, bakti sosial, dan kegiatan kepemudaan lainnya.' },
            { q: 'Apakah anggota wajib mengikuti semua kegiatan?', a: 'Tidak wajib semua, namun dianjurkan aktif untuk mendapatkan manfaat maksimal.' },
            { q: 'Apakah ada sertifikat untuk setiap kegiatan?', a: 'Biasanya ada, terutama untuk kegiatan formal seperti kaderisasi dan pelatihan.' },
            ] }">
        <section class="leading-relaxed max-w-screen-xl mt-12 mx-auto px-4 md:px-8">
            <div class="mt-14 max-w-2xl mx-auto">
                <div class="flex gap-2 items-center mb-3">
                    <div class="flex flex-col gap-2">
                        <h1 class="font-bold text-lg">Kegiatan & Program</h1>
                        <div class="flex gap-1">
                            <div class="w-[46px] h-1 rounded-full bg-[#083C30]"></div>
                            <div class="w-[23px] h-1 rounded-full bg-[#3BD59C]"></div>
                            <div class="w-[6px] h-1 rounded-full bg-[#99FFD9]"></div>
                        </div>
                    </div>
                    <div class="border border-[#696767] border-dashed max-w-min h-0.5"></div>
                </div>
                <template x-for="(item, index) in faqs" :key="index">
                    <div class="space-y-3 mt-5 overflow-hidden border-b" @click="selectedFaq = selectedFaq === index ? null : index">
                        <h4 class="cursor-pointer pb-5 flex items-center justify-between text-lg text-gray-700 dark:text-white font-medium">
                            <span x-text="item.q"></span>
                            <svg x-show="selectedFaq === index" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-white ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                            </svg>
                            <svg x-show="selectedFaq !== index" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-white ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </h4>
                        <div x-ref="answerElRef" class="transition-[max-height,opacity] overflow-hidden duration-500 ease-in-out" :style="{maxHeight: selectedFaq === index ? '1000px' : '0px', opacity: selectedFaq === index ? 1 : 0,}">
                            <div>
                                <p class="text-gray-500 dark:text-white pb-4" x-text="item.a"></p>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </section>
    </div>
    {{-- Tentang Organisasi --}}
    <div x-data="{ selectedFaq: null, faqs: [
            { q: 'Apa perbedaan IPNU dan IPPNU?', a: 'IPNU untuk pelajar putra, sedangkan IPPNU untuk pelajar putri.' },
            { q: 'Apakah organisasi ini resmi?', a: 'Ya, IPNU IPPNU merupakan badan otonom dari Nahdlatul Ulama yang diakui secara nasional.' },
            ] }">
        <section class="leading-relaxed max-w-screen-xl mt-12 mx-auto px-4 md:px-8">
            <div class="mt-14 max-w-2xl mx-auto">
                <div class="flex gap-2 items-center mb-3">
                    <div class="flex flex-col gap-2">
                        <h1 class="font-bold text-lg">Tentang Organisasi</h1>
                        <div class="flex gap-1">
                            <div class="w-[46px] h-1 rounded-full bg-[#083C30]"></div>
                            <div class="w-[23px] h-1 rounded-full bg-[#3BD59C]"></div>
                            <div class="w-[6px] h-1 rounded-full bg-[#99FFD9]"></div>
                        </div>
                    </div>
                    <div class="border border-[#696767] border-dashed max-w-min h-0.5"></div>
                </div>
                <template x-for="(item, index) in faqs" :key="index">
                    <div class="space-y-3 mt-5 overflow-hidden border-b" @click="selectedFaq = selectedFaq === index ? null : index">
                        <h4 class="cursor-pointer pb-5 flex items-center justify-between text-lg text-gray-700 dark:text-white font-medium">
                            <span x-text="item.q"></span>
                            <svg x-show="selectedFaq === index" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-white ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                            </svg>
                            <svg x-show="selectedFaq !== index" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-white ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </h4>
                        <div x-ref="answerElRef" class="transition-[max-height,opacity] overflow-hidden duration-500 ease-in-out" :style="{maxHeight: selectedFaq === index ? '1000px' : '0px', opacity: selectedFaq === index ? 1 : 0,}">
                            <div>
                                <p class="text-gray-500 dark:text-white pb-4" x-text="item.a"></p>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </section>
    </div>
    {{-- Kontak & Informasi --}}
    <div x-data="{ selectedFaq: null, faqs: [
            { q: 'Bagaimana cara menghubungi pengurus?', a: 'Bisa melalui media sosial resmi atau kontak WhatsApp yang tersedia di website.' },
            { q: 'Di mana lokasi sekretariat PC IPNU IPPNU Jakarta Utara?', a: 'Informasi alamat dapat dilihat di halaman kontak atau profil organisasi.' },
            { q: 'Bagaimana cara mendapatkan informasi kegiatan terbaru?', a: 'Ikuti media sosial resmi atau cek website secara berkala.' },
            ] }">
        <section class="leading-relaxed max-w-screen-xl mt-12 mx-auto px-4 md:px-8">
            <div class="mt-14 max-w-2xl mx-auto">
                <div class="flex gap-2 items-center mb-3">
                    <div class="flex flex-col gap-2">
                        <h1 class="font-bold text-lg">Kontak & Informasi</h1>
                        <div class="flex gap-1">
                            <div class="w-[46px] h-1 rounded-full bg-[#083C30]"></div>
                            <div class="w-[23px] h-1 rounded-full bg-[#3BD59C]"></div>
                            <div class="w-[6px] h-1 rounded-full bg-[#99FFD9]"></div>
                        </div>
                    </div>
                    <div class="border border-[#696767] border-dashed max-w-min h-0.5"></div>
                </div>
                <template x-for="(item, index) in faqs" :key="index">
                    <div class="space-y-3 mt-5 overflow-hidden border-b" @click="selectedFaq = selectedFaq === index ? null : index">
                        <h4 class="cursor-pointer pb-5 flex items-center justify-between text-lg text-gray-700 dark:text-white font-medium">
                            <span x-text="item.q"></span>
                            <svg x-show="selectedFaq === index" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-white ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                            </svg>
                            <svg x-show="selectedFaq !== index" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-white ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </h4>
                        <div x-ref="answerElRef" class="transition-[max-height,opacity] overflow-hidden duration-500 ease-in-out" :style="{maxHeight: selectedFaq === index ? '1000px' : '0px', opacity: selectedFaq === index ? 1 : 0,}">
                            <div>
                                <p class="text-gray-500 dark:text-white pb-4" x-text="item.a"></p>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </section>
    </div>

    
</x-layouts.app>