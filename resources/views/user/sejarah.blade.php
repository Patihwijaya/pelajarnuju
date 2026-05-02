<x-layouts.app title="sejarah">
<div class="w-full mx-auto bg-white dark:bg-[#0C0C0C] p-3 md:px-20 rounded-lg shadow">
    <div class="w-full mx-auto py-12" x-data="{ tab: 'ipnu' }">

            <!-- TITLE -->
            <div class="text-center mb-6">
            <h1 class="text-3xl font-semibold text-gray-800 dark:text-white">
                Ikatan Pelajar Nahdlatul Ulama
            </h1>
            <p class="text-gray-500 dark:text-white mt-2 text-sm leading-relaxed">
                Badan otonom di bawah naungan Nahdlatul Ulama yang berfokus pada pembinaan,
                kaderisasi, dan penguatan nilai-nilai Ahlussunnah wal Jama'ah (Aswaja).
            </p>
            </div>
        
            <!-- TAB SWITCH -->
            <div class="w-full max-w-3xl mx-auto overflow-x-auto pb-4 custom-scrollbar">
                <div class="flex gap-4 w-max px-2">
            
                    <button 
                        @click="tab = 'ipnu'"
                        :class="{ 'bg-white shadow-sm text-green-700 font-semibold': tab === 'ipnu', 'text-gray-500 hover:text-gray-700 font-medium': tab !== 'ipnu' }"
                        class="shrink-0 flex items-center gap-2 px-6 py-3 bg-white rounded-full shadow-sm border border-gray-200 text-green-700 font-bold transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Sejarah IPNU
                    </button>
            
                    <button 
                        @click="tab = 'ippnu'"
                        :class="{ 'bg-white shadow-sm text-green-700 font-semibold': tab === 'ippnu', 'text-gray-500 hover:text-gray-700 font-medium': tab !== 'ippnu' }"
                        class="shrink-0 flex items-center gap-2 px-6 py-3 bg-white rounded-full shadow-sm border border-gray-200 text-green-700 font-bold transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Sejarah IPPNU
                    </button>
            
                    <button 
                        @click="tab = 'pc'"
                        :class="{ 'bg-white shadow-sm text-green-700 font-semibold': tab === 'pc', 'text-gray-500 hover:text-gray-700 font-medium': tab !== 'pc' }"
                        class="shrink-0 flex items-center gap-2 px-6 py-3 bg-white rounded-full shadow-sm border border-gray-200 text-green-700 font-bold transition-all">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 4h12M6 4v16M6 4H5m13 0v16m0-16h1m-1 16H6m12 0h1M6 20H5M9 7h1v1H9V7Zm5 0h1v1h-1V7Zm-5 4h1v1H9v-1Zm5 0h1v1h-1v-1Zm-3 4h2a1 1 0 0 1 1 1v4h-4v-4a1 1 0 0 1 1-1Z"/>
                        </svg>
                        Profil PC
                    </button>
                </div>
            </div>
        
            <!-- CONTENT -->
            <div class=" rounded-2xl">
        
            <!-- IPNU -->
            <div x-show="tab === 'ipnu'" x-transition>
                <!-- Roadmaps & Timelines 1: Vertical Timeline with Icons -->
                <section class="">
                    <div class="mx-auto w-full px-6 lg:px-8">
                        <div class="mx-auto max-w-2xl text-center mb-16">
                            <h2 class="mt-2 text-lg font-semibold tracking-tight text-pretty text-gray-900 dark:text-white sm:text-3xl">IKATAN PELAJAR NAHDLATUL ULAMA</h2>
                            <p class="mt-6 text-sm font-medium text-pretty text-gray-600 dark:text-white sm:text-lg">Badan otonom di bawah naungan Nahdlatul Ulama yang berfokus pada pembinaan, kaderisasi, dan penguatan nilai-nilai Ahlussunnah wal Jama'ah (Aswaja) bagi pelajar, santri, dan pemuda putra.</p>
                        </div>
                        
                        <div class="">
                            <div class="w-full mx-auto">
                                <div class="relative">
                                    <!-- Vertical Line -->
                                    <div class="absolute left-[15px] top-2 bottom-2 w-0.5 bg-gray-200"></div>
                                    
                                    <!-- Events -->
                                    <div class="space-y-8">
                                        <div class="relative pl-12">
                                            <!-- Icon -->
                                            <div class="absolute left-0 top-0">
                                                <svg class="w-8 h-8  text-[#67C090] bg-white dark:bg-[#0C0C0C] rounded-full" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <!-- Content -->
                                            <div class="bg-gray-50 dark:bg-[#222831] rounded-lg p-3 transition-all hover:shadow-md hover:border-s-4 hover:border-[#67C090]">
                                                <div class="bg-[#DDF4E7] px-3 py-1 rounded-full max-w-[200px] text-center">
                                                    <span class="text-[#67C090] text-sm md:text-xl">Pra 1954</span>
                                                </div>
                                                <h3 class="text-gray-900 dark:text-white text-lg md:text-2xl font-bold my-2">Latar Belakang & Embrio</h3>
                                                <p class="text-gray-600 dark:text-white text-sm md:text-xl">Sebelum terbentuk secara nasional, muncul perkumpulan lokal seperti PERSANO (1939), IMNU di Malang (1947), serta PARPENO di Kediri. Namun, gerakan ini masih bersifat kedaerahan tanpa koordinasi terpusat.</p>
                                            </div>
                                        </div>
                            
                                        <div class="relative pl-12">
                                            <div class="absolute left-0 top-0">
                                                <svg class="w-8 h-8 text-[#67C090] bg-white dark:bg-[#0C0C0C] rounded-full" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <div class="bg-gray-50 dark:bg-[#222831] rounded-lg p-3 transition-all hover:shadow-md hover:border-s-4 hover:border-[#67C090]">
                                                <div class="bg-[#DDF4E7] px-3 py-1 rounded-full max-w-[200px] text-center">
                                                    <span class="text-[#67C090] text-sm md:text-xl">24 Februari 1954</span>
                                                </div>
                                                <h3 class="text-gray-900 dark:text-white text-lg md:text-2xl font-bold my-2">Momen Pendirian</h3>
                                                <p class="text-gray-600 dark:text-white text-sm md:text-xl">Diinisiasi oleh Tholchah Mansyur, Sofyan Cholil, dan Mustahal, IPNU resmi didirikan bertepatan dengan Kongres LP Ma'arif NU di Semarang. Prof. Dr. KH. Tolchah Mansoer ditetapkan sebagai Ketua Umum pertama.</p>
                                            </div>
                                        </div>
                            
                                        <div class="relative pl-12">
                                            <div class="absolute left-0 top-0">
                                                <svg class="w-8 h-8 text-emerald-500 bg-white dark:bg-[#0C0C0C] rounded-full" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <div class="bg-gray-50 dark:bg-[#222831] rounded-lg p-3 transition-all hover:shadow-md hover:border-s-4 hover:border-[#67C090]">
                                                <div class="bg-[#DDF4E7] px-3 py-1 rounded-full max-w-[200px] text-center">
                                                    <span class="text-[#67C090] text-sm md:text-xl">1958</span>
                                                </div>
                                                <h3 class="text-gray-900 dark:text-white text-lg md:text-2xl font-bold my-2">Menjadi Ikatan Putra NU</h3>
                                                <p class="text-gray-600 dark:text-white text-sm md:text-xl">Akibat kebijakan represif Orde Baru (OSIS sebagai asas tunggal kepelajaran), pada Kongres ke-X di Jombang, IPNU mengubah nama menjadi Ikatan Putra Nahdlatul Ulama agar tetap bisa beroperasi di ranah remaja/pemuda.</p>
                                            </div>
                                        </div>
                            
                                        <div class="relative pl-12">
                                            <div class="absolute left-0 top-0">
                                                <svg class="w-8 h-8 text-emerald-500 bg-white dark:bg-[#0C0C0C] rounded-full" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <div class="bg-gray-50 dark:bg-[#222831] rounded-lg p-3 transition-all hover:shadow-md hover:border-s-4 hover:border-[#67C090]">
                                                <div class="bg-[#DDF4E7] px-3 py-1 rounded-full max-w-[200px] text-center">
                                                    <span class="text-[#67C090] text-sm md:text-xl">2003</span>
                                                </div>
                                                <h3 class="text-gray-900 dark:text-white text-lg md:text-2xl font-bold my-2">Kembali ke Khittah</h3>
                                                <p class="text-gray-600 dark:text-white text-sm md:text-xl">Pasca-reformasi pada Kongres ke-XIV di Surabaya, organisasi resmi mengembalikan identitasnya menjadi Ikatan Pelajar Nahdlatul Ulama untuk kembali fokus pada basis sekolah, madrasah, dan pesantren.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        
            <!-- IPPNU -->
            <div x-show="tab === 'ippnu'" x-transition>
                <!-- Roadmaps & Timelines 1: Vertical Timeline with Icons -->
                <section class="">
                    <div class="mx-auto max-w-7xl px-6 lg:px-8">
                        <div class="mx-auto max-w-2xl text-center mb-16">
                            <h2 class="mt-2 text-lg font-semibold tracking-tight text-pretty text-gray-900 dark:text-white sm:text-3xl">IKATAN PELAJAR PUTRI NAHDLATUL ULAMA</h2>
                            <p class="mt-6 text-sm font-medium text-pretty text-gray-600 dark:text-white sm:text-lg">Sebagai mitra sejajar IPNU, IPPNU adalah wadah kaderisasi bagi pelajar dan santri putri NU untuk mengembangkan potensi diri dan memperdalam pemahaman keagamaan yang moderat.</p>
                        </div>
                        
                        <div class="">
                            <div class="max-w-3xl mx-auto">
                                <div class="relative">
                                    <!-- Vertical Line -->
                                    <div class="absolute left-[15px] top-2 bottom-2 w-0.5 bg-gray-200"></div>
                                    
                                    <!-- Events -->
                                    <div class="space-y-8">
                                        <div class="relative pl-12">
                                            <!-- Icon -->
                                            <div class="absolute left-0 top-0">
                                                <svg class="w-8 h-8 text-emerald-500 bg-white dark:bg-[#0C0C0C] rounded-full" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <!-- Content -->
                                            <div class="bg-gray-50 dark:bg-[#222831] rounded-lg p-3 transition-all hover:shadow-md hover:border-s-4 hover:border-[#67C090]">
                                                <div class="bg-[#DDF4E7] px-3 py-1 rounded-full max-w-[200px] text-center">
                                                    <span class="text-[#67C090] text-sm md:text-xl">Pra 1955</span>
                                                </div>
                                                <h3 class="text-gray-900 dark:text-white text-lg md:text-2xl font-bold my-2">Gagasan Awal</h3>
                                                <p class="text-gray-600 dark:text-white text-sm">Bermula dari perbincangan santriwati di Sekolah Guru Agama (SGA) Surakarta yang menyadari kebutuhan ruang gerak khusus untuk mewadahi isu-isu serta mengelola kaderisasi pelajar putri NU.</p>
                                            </div>
                                        </div>
                            
                                        <div class="relative pl-12">
                                            <div class="absolute left-0 top-0">
                                                <svg class="w-8 h-8 text-emerald-500 bg-white dark:bg-[#0C0C0C] rounded-full" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <div class="bg-gray-50 dark:bg-[#222831] rounded-lg p-3 transition-all hover:shadow-md hover:border-s-4 hover:border-[#67C090]">
                                                <div class="bg-[#DDF4E7] px-3 py-1 rounded-full max-w-[200px] text-center">
                                                    <span class="text-[#67C090] text-sm md:text-xl">2 Maret 1955</span>
                                                </div>
                                                <h3 class="text-gray-900 dark:text-white md:text-2xl font-bold my-2">Momen Pendirian</h3>
                                                <p class="text-gray-600 dark:text-white text-sm">Melalui musyawarah dan dukungan ulama, IPPNU resmi didirikan di Malang, Jawa Timur. Hj. Umroh Machfudzoh menjadi pelopor utama dan terpilih sebagai Ketua Umum pertama.</p>
                                            </div>
                                        </div>
                            
                                        <div class="relative pl-12">
                                            <div class="absolute left-0 top-0">
                                                <svg class="w-8 h-8 text-emerald-500 bg-white dark:bg-[#0C0C0C] rounded-full" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <div class="bg-gray-50 dark:bg-[#222831] rounded-lg p-3 transition-all hover:shadow-md hover:border-s-4 hover:border-[#67C090]">
                                                <div class="bg-[#DDF4E7] px-3 py-1 rounded-full max-w-[200px] text-center">
                                                    <span class="text-[#67C090] text-sm md:text-xl">1988</span>
                                                </div>
                                                <h3 class="text-gray-900 dark:text-white md:text-2xl font-bold my-2">Ikatan Putri-Putri NU</h3>
                                                <p class="text-gray-600 dark:text-white text-sm">Sejalan dengan tekanan politik OSIS Orde Baru, IPPNU menyesuaikan identitas di Kongres Jombang menjadi Ikatan Putri-Putri Nahdlatul Ulama, memperluas jangkauan ke pemudi di luar sekolah.</p>
                                            </div>
                                        </div>
                            
                                        <div class="relative pl-12">
                                            <div class="absolute left-0 top-0">
                                                <svg class="w-8 h-8 text-emerald-500 bg-white dark:bg-[#0C0C0C] rounded-full" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <div class="bg-gray-50 dark:bg-[#222831] rounded-lg p-3 transition-all hover:shadow-md hover:border-s-4 hover:border-[#67C090]">
                                                <div class="bg-[#DDF4E7] px-3 py-1 rounded-full max-w-[200px] text-center">
                                                    <span class="text-[#67C090] text-sm md:text-xl">2003</span>
                                                </div>
                                                <h3 class="text-gray-900 dark:text-white md:text-2xl font-bold my-2">Kembali ke Semangat Awal</h3>
                                                <p class="text-gray-600 dark:text-white text-sm">Pada Kongres ke-XIII di Surabaya, IPPNU memutuskan kembali memakai nama Ikatan Pelajar Putri Nahdlatul Ulama, memfokuskan program pada wilayah keterpelajaran santriwati dan siswi.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        
            <!-- PROFIL PC -->
            <div x-show="tab === 'pc'" x-transition>
                @if($profil)
                    <div class="flex items-center space-x-4">
                        <div>
                            <h2 class="text-2xl font-bold">{{ $profil->judul }}</h2>
                        </div>
                    </div>
                    <p class="mt-4 text-gray-700 text-justify">{!! nl2br(e($profil->text)) !!}</p>
                @else
                    <p class="mt-4">Belum ada data .</p>
                @endif
            </div>
        
            </div>
        
        </div>

</div>
</x-layouts.app>
