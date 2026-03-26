<x-layouts.app title="Beranda">

</div>
@php
    $ads = \App\Models\Ads::where('status', 1)
    ->whereDate('expired_at', '>=', now())
    ->latest()
    ->get();
@endphp

<div class="w-full inline md:grid md:grid-cols-2 mb-10">
        @if ($banner)
        <section class="w-full bg-white rounded-3xl overflow-hidden">
            <a href="{{ route('user.artikel.show', $banner->slug) }}">
                <div class="w-full h-90 overflow-hidden">
                    <img src="{{ asset('uploads/artikel/' . $banner->gambar) }}" class="w-full rounded object-cover">
                </div>
                <div class="p-5">
                    <div class="flex gap-3 items-center">
                        <p class="text-sm bg-green-200 text-green-800 font-bold px-6 py-1 rounded-full w-fit">{{ $banner->kategori }}</p>
                        <p class="text-sm text-gray-500">{{ $banner->created_at->format('d M Y') }}</p>
                        <p class="text-sm text-gray-500">{{ $banner->created_at->diffForHumans()}}</p>
                    </div>
                    <h1 class="text-sm md:text-2xl font-semibold group-hover:text-green-600">{{ $banner->judul }}</h1>
                    <p class="mt-2 text-sm md:text-md text-gray-700 line-clamp-3">{!! \Illuminate\Support\Str::limit($banner->isi, 90) !!}</p>
                    <a href="{{ route('user.artikel.show', $banner->id) }}" class="text-blue-600 mt-3 inline-block">Baca Selengkapnya</a>
                </div>
            </a>
        </section>
        @endif

        <div class="px-5 flex flex-col gap-2">
        @foreach($artikel as $a)
            <a href="{{ route('user.artikel.show', $a->slug) }}">
                <div class="flex w-full hover:bg-gray-200 group rounded-2xl bg-white">
                    @if($a->gambar)
                    <div class="w-32 h-full overflow-hidden rounded-s-xl">
                        <img src="{{ asset('uploads/artikel/'.$a->gambar) }}" alt="{{ $a->judul }}" class="w-full h-full object-cover ">
                    </div>

                    @else
                    <p>gambar tidak ada</p>
                    @endif

                    <div class="px-5 py-3 w-full flex flex-col ">
                        <div class="flex gap-3">
                            <p class="text-sm text-gray-800">{{ $a->kategori }}</p>
                            <p class="text-sm font-bold text-gray-800">{{ $a->created_at->format('d M Y') }}</p>
                        </div>
                        <h2 class="text-base font-semibold group-hover:text-green-600">{{ $a->judul }}</h2>
                        <small class="text-base text-gray-500">{{ $a->lihats ?? "0" }} kali dibaca</small>
                        <a href="{{ route('user.artikel.show', $a->slug) }}" class="text-blue-600 inline-block">Baca</a>
                    </div>
                </div>
            </a>
        @endforeach
        @foreach($kegiatan as $k)
            <a href="{{ route('user.kegiatan.lihat', $k->id) }}">
                <div class="flex w-full hover:bg-gray-200 group rounded-2xl bg-white">
                    @if($k->gambar)
                    <div class="w-32 h-full overflow-hidden rounded-s-xl">
                        <img src="{{ asset('uploads/kegiatan/'.$k->gambar) }}" alt="{{ $k->judul }}" class="w-full h-full object-cover ">
                    </div>

                    @else
                    <p>gambar tidak ada</p>
                    @endif

                    <div class="px-5 py-3 w-full flex flex-col ">
                        <div class="flex gap-3">
                            {{-- <p class="text-sm text-gray-800">{{ $a->kategori }}</p> --}}
                            <p class="text-sm font-bold text-gray-800">{{ $k->created_at->format('d M Y') }}</p>
                        </div>
                        <h2 class="text-base font-semibold group-hover:text-green-600">{{ $k->judul }}</h2>
                        <small class="text-base text-gray-500">{{ $k->lihats ?? "0" }} kali dibaca</small>
                        <a href="{{ route('user.kegiatan.lihat', $k->id) }}" class="text-blue-600 inline-block">Baca</a>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
    <div class="col-start-1 col-end-3 w-full mt-10 order-2 text-center group ">
        <p><a href="/artikel" class="text-blue-600 hover:bg-gray-200 bg-white p-3 rounded-2xl hover:underline">Lihat Selengkapnya</a></p>
    </div>
</div>


<div class="my-10">
    <h1 class="text-center text-xl mb-5 font-bold">Telah Dipercaya Oleh:</h1>
    <div class="md:grid md:grid-cols-5 flex flex-col gap-3">
        <div class="border border-gray-500 px-16 py-2">
            <img src="{{ asset('asset/logo IPNU.png') }}" alt="logo IPNU" class="h-20 mx-auto">
        </div>
        <div class="border border-gray-500 px-16 py-2">
            <img src="{{ asset('asset/logo IPPNU.png') }}" alt="logo IPPNU" class="h-20 mx-auto">
        </div>
        <div class="border border-gray-500 px-16 py-2">
            <img src="{{ asset('asset/logo cbp.png') }}" alt="logo cbp" class="h-20 mx-auto">
        </div>
        <div class="border border-gray-500 px-16 py-2">
            <img src="{{ asset('asset/logo kpp.png') }}" alt="logo kpp" class="h-20 mx-auto">
        </div>
        <div class="border border-gray-500 px-16 py-2">
            <img src="{{ asset('asset/logo ansor.png') }}" alt="logo ansor" class="h-20 mx-auto">
        </div>
        <div class="border border-gray-500 px-16 py-2">
            <img src="{{ asset('asset/logo nu.png') }}" alt="logo nu" class="h-20 mx-auto">
        </div>
    </div>
</div>

<div class="flex flex-col md:flex md:flex-row gap-4 justify-center mb-5">
    <div class="bg-white shadow-md rounded-2xl p-8 w-full text-center">
        <div class="flex justify-center">
            <h2 class="text-5xl font-extrabold text-gray-900 transition-all duration-500 ease-in-out" id="counter">0</h2>
            <h2 class="text-5xl font-extrabold text-gray-900">+</h2>
        </div>
        <p class="text-gray-600 mt-2">Anggota</p>
    </div>

    <div class="bg-white shadow-md rounded-2xl p-8 w-full text-center">
        <div class="flex justify-center">
            <h2 class="text-5xl font-extrabold text-gray-900 transition-all duration-500 ease-in-out" id="pac">0</h2>
        </div>
        <p class="text-gray-600 mt-2">Pimpinan Anak Cabang</p>
    </div>

    <div class="bg-white shadow-md rounded-2xl p-8 w-full text-center">
        <div class="flex justify-center">
            <h2 class="text-5xl font-extrabold text-gray-900 transition-all duration-500 ease-in-out" id="pr">0</h2>
        </div>
        <p class="text-gray-600 mt-2">Pimpinan Ranting</p>
    </div>

    <div class="bg-white shadow-md rounded-2xl p-8 w-full text-center">
        <div class="flex justify-center">
            <h2 class="text-5xl font-extrabold text-gray-900 transition-all duration-500 ease-in-out" id="pk">0</h2>
        </div>
        <p class="text-gray-600 mt-2">Pimpinan Komisariat</p>
    </div>
</div>

<script>
// anggota
document.addEventListener('DOMContentLoaded', function () {
    const counter = document.getElementById('counter');
    let count = 0;
    const target = 800; // batas hitungan
    const duration = 1000; // durasi animasi (ms)
    const stepTime = Math.abs(Math.floor(duration / target));

    const timer = setInterval(() => {
        count++;
        counter.textContent = count;
        if (count >= target) clearInterval(timer);
    }, stepTime);
});
// pac
document.addEventListener('DOMContentLoaded', function () {
    const counter = document.getElementById('pac');
    let count = 0;
    const target = 6; // batas hitungan
    const duration = 1000; // durasi animasi (ms)
    const stepTime = Math.abs(Math.floor(duration / target));

    const timer = setInterval(() => {
        count++;
        counter.textContent = count;
        if (count >= target) clearInterval(timer);
    }, stepTime);
});
// pr
document.addEventListener('DOMContentLoaded', function () {
    const counter = document.getElementById('pr');
    let count = 0;
    const target = 30; // batas hitungan
    const duration = 1000; // durasi animasi (ms)
    const stepTime = Math.abs(Math.floor(duration / target));

    const timer = setInterval(() => {
        count++;
        counter.textContent = count;
        if (count >= target) clearInterval(timer);
    }, stepTime);
});
// pk
document.addEventListener('DOMContentLoaded', function () {
    const counter = document.getElementById('pk');
    let count = 0;
    const target = 50; // batas hitungan
    const duration = 1000; // durasi animasi (ms)
    const stepTime = Math.abs(Math.floor(duration / target));

    const timer = setInterval(() => {
        count++;
        counter.textContent = count;
        if (count >= target) clearInterval(timer);
    }, stepTime);
});
</script>





<div class="w-full flex flex-col md:flex-row py-5 justify-center mb-15">
    <div class="">
        <h1 class="font-bold text-xl">Kenapa IPNU Jakarta Utara?</h1>
        <p class="text-sm text-gray-600">IPNU Jakut adalah rumah tumbuh bagi pelajar NU: belajar bareng, berkarya nyata, dan bergerak untuk umat & bangsa.</p>
        <div class="bg-green-100 p-3 m-5 rounded-xl">
            <h1 class="text-sm font-bold text-green-800">Visi</h1>
            <p class="text-sm text-gray-600">Terwujudnya pelajar Nahdliyyin yang berilmu, berakhlak, berjejaring, dan berdaya saing.</p>
        </div>
    </div>
    <div class="flex flex-wrap gap-3 justify-end">
        <div class="bg-white w-80 p-5 rounded-xl">
            <span>🎓</span>
            <h1 class="font-bold text-xl">Belajar</h1>
            <p class="text-sm text-gray-600">Kajian rutin, kelas skill, diskusi isu pelajar.</p>
        </div>
        <div class="bg-white w-80 p-5 rounded-xl">
            <span>🌍</span>
            <h1 class="font-bold text-xl">Berjuang</h1>
            <p class="text-sm text-gray-600">Aksi sosial, advokasi, dan pengabdian warga.</p>
        </div>
        <div class="bg-white w-80 p-5 rounded-xl">
            <span>🕌</span>
            <h1 class="font-bold text-xl">Bertaqwa</h1>
            <p class="text-sm text-gray-800">Tradisi Aswaja yang ramah, moderat, dan relevan.</p>
        </div>
        <div class="bg-white w-80 p-5 rounded-xl">
            <span>🤝</span>
            <h1 class="font-bold text-xl">Berjejaring</h1>
            <p class="text-sm text-gray-600">Teman seperjuangan se‑Jakut, se‑NU, se‑Indonesia.</p>
        </div>
    </div>
</div>

<div class="grid grid-row-3 gap-3 md:grid-cols-3 mb-5">
    <div class="col-span-2">
        <h1 class="font-bold text-2xl">Artikel Populer</h1>
        @php
            $no = 1;
        @endphp
        @foreach($totalArtikel as $artikel)
            <a href="{{ route('user.artikel.show', $artikel->id) }}">
                <div class="p-5 flex gap-2 mb-5 mt-5 w-full hover:bg-gray-200 group relative">
                    <div class="absolute flex items-center justify-center text-white bg-green-500 rounded-full w-10 h-10 z-20 top-0 left-0">
                        <h1 class="font-bold text-lg ">{{ $no++ }}</h1>
                    </div>
                    <div class="overflow-hidden w-full h-20 md:w-20 md:h-20 rounded-lg">
                        @if($artikel->gambar)
                        <img src="{{ asset('uploads/artikel/'.$artikel->gambar) }}" alt="{{ $artikel->judul }}" class="w-full h-full object-cover transition duration-300 ease-in-out group-hover:-translate-y-1 group-hover:scale-200">
                        @else
                        <p>gambar tidak ada</p>
                        @endif
                    </div>
                    <div class="ps-5 w-full md:w-1/2">
                        <h2 class="text-sm md:text-2xl font-semibold group-hover:text-green-600">{{ $artikel->judul }}</h2>
                        <p class="mt-2 text-sm md:text-md text-gray-700 line-clamp-3">{{ Str::limit(strip_tags($artikel->isi), 50) }}</p>
                    </div>
                </div>
            </a>
        @endforeach
        <p><a href="/artikel" class="text-blue-600 hover:underline">Lihat Selengkapnya</a></p>
    </div>

    @if($ads->count())
        <div class="relative w-full max-h-min overflow-hidden">
            <div id="carousel" class="flex transition-transform duration-700">
                    @foreach ($ads as $ad)
                        <div class="min-w-full">
                            <a href="{{ route('ads.click', $ad->id) }}" target="_blank">
                                @if ($ad->gambar)
                                    <img src="{{ asset('uploads/ads/'.$ad->gambar) }}" class="rounded shadow w-full max-h-min object-cover">
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
                                <img src="{{ asset('uploads/ads/'.$ads[0]->gambar) }}" class="rounded shadow w-full max-h-min object-cover">
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
    <div class="w-full h-48 rounded shadow bg-gray-400 flex flex-col items-center justify-center">
        <p class="text-xl text-black font-bold">ini adalah iklan</p>
    </div>
    @endif
</div>

<script>
    const carousel = document.getElementById('carousel');
    const slides = carousel.children;
    let index = 0;
    let slideCount = slides.length;

    function nextSlide() {
        index++;
        carousel.style.transition = 'transform 0.7s ease-in-out';
        carousel.style.transform = `translateX(-${index * 100}%)`;

        // Reset tanpa animasi saat mencapai duplikasi slide pertama
        if(index === slideCount - 1) {
            setTimeout(() => {
                carousel.style.transition = 'none';
                index = 0;
                carousel.style.transform = `translateX(0)`;
            }, 700); // harus sama dengan duration di CSS
        }
    }

    setInterval(nextSlide, 3000); // slide otomatis setiap 3 detik
</script>

</x-layouts.app>
