<x-layouts.app-user title="Beranda">
    <div class="w-full flex flex-wrap gap-5 border-2 justify-center py-10 border-gray-300 rounded-xl">
        {{-- card waktu ibadah --}}
        <div class="w-[200px] md:w-[350px] rounded-2xl overflow-hidden relative shadow-lg hover:shadow-2xl">
            <a href="/ibadah">
                <img src="{{ asset('asset/jam.jpg') }}" alt="" class="object-cover w-full h-[204px]">
                <div class="flex flex-col gap-3 px-[10px] py-[10px]">
                    <h3 class="text-lg md:text-2xl font-bold">Waktu Sholat 5 Waktu</h3>
                    <p class="text-base">Waktu Sholat 5 Waktu: Dzuhur, Ashr, Magrib, Isya, Subuh</p>
                    <a href="/ibadah" class="px-2 py-2 bg-[#EC7924] rounded-full text-center text-white font-bold">Selengkapnya</a>
                    <p class="px-5 py-2 bg-[#3BD59C] text-[#083C30] font-bold text-base text-center absolute top-5 right-5 rounded-2xl">UMUM</p>
                </div>
            </a>
        </div>
        {{-- card pengajuan surat pengesahan IPNU --}}
        <div class="w-[200px] md:w-[350px] rounded-2xl overflow-hidden relative shadow-lg hover:shadow-2xl">
            <a href="/pengajuanSkIpnu">
                <img src="{{ asset('asset/foto ipnu.jpeg') }}" alt="" class="object-cover w-full h-[204px]">
                <div class="flex flex-col gap-3 px-[10px] py-[10px]">
                    <h3 class="text-lg md:text-2xl font-bold">Pengajuan Surat Pengesahan</h3>
                    <p class="text-base">Tempat Pengajuan Surat Pengesaha (SP) untuk PAC, PR, dan PK IPNU Se-Jakarta Utara</p>
                    <a href="/pengajuanSkIpnu" class="px-2 py-2 bg-[#EC7924] rounded-full text-center text-white font-bold">Selengkapnya</a>
                    <p class="px-5 py-2 bg-[#3BD59C] text-[#083C30] font-bold text-base text-center absolute top-5 right-5 rounded-2xl">IPNU</p>
                </div>
            </a>
        </div>
        {{-- card pengajuan surat pengesahan IPPNU --}}
        <div class="w-[200px] md:w-[350px] rounded-2xl overflow-hidden relative shadow-lg hover:shadow-2xl">
            <a href="/pengajuanSkIppnu">
                <img src="{{ asset('asset/foto ippnu.jpeg') }}" alt="" class="object-cover w-full h-[204px]">
                <div class="flex flex-col gap-3 px-[10px] py-[10px]">
                    <h3 class="text-lg md:text-2xl font-bold">Pengajuan Surat Pengesahan</h3>
                    <p class="text-base">Tempat Pengajuan Surat Pengesaha (SP) untuk PAC, PR, dan PK IPPNU Se-Jakarta Utara</p>
                    <a href="/pengajuanSkIppnu" class="px-2 py-2 bg-[#EC7924] rounded-full text-center text-white font-bold">Selengkapnya</a>
                    <p class="px-5 py-2 bg-[#3BD59C] text-[#083C30] font-bold text-base text-center absolute top-5 right-5 rounded-2xl">IPPNU</p>
                </div>
            </a>
        </div>
        {{-- card E-book --}}
        <div class="w-[200px] md:w-[350px] rounded-2xl overflow-hidden relative shadow-lg hover:shadow-2xl">
            <a href="/material">
                <img src="{{ asset('asset/buku.jpg') }}" alt="" class="object-cover w-full h-[204px]">
                <div class="flex flex-col gap-3 px-[10px] py-[10px]">
                    <h3 class="text-lg md:text-2xl font-bold">E-Book</h3>
                    <p class="text-base">Tempat Bacaan E-Book Gratis yang telah disediakan oleh PC IPNU IPPNU Jakarta Utara</p>
                    <a href="/material" class="px-2 py-2 bg-[#EC7924] rounded-full text-center text-white font-bold">Selengkapnya</a>
                    <p class="px-5 py-2 bg-[#3BD59C] text-[#083C30] font-bold text-base text-center absolute top-5 right-5 rounded-2xl">UMUM</p>
                </div>
            </a>
        </div>
    </div>
</x-layouts.app>
