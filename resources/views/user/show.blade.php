<x-layouts.app title="Artikel">
    @push('meta')
    <!-- BASIC SEO -->
    <meta name="description" content="{{ Str::limit(strip_tags($artikels->isi), 150) }}">

    <!-- OPEN GRAPH -->
    <meta property="og:title" content="{{ $artikels->judul }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($artikels->isi), 150) }}">
    <meta property="og:type" content="artikels">
    <meta property="og:url" content="{{ $shareUrl }}">
    <meta property="og:image" content="{{ asset('uploads/artikel/'.$artikels->gambar) }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    <!-- TWITTER -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $artikels->judul }}">
    <meta name="twitter:description" content="{{ Str::limit(strip_tags($artikels->isi), 150) }}">
    <meta name="twitter:image" content="{{ asset('uploads/artikel/'.$artikels->gambar) }}?v={{ $artikels->updated_at->timestamp }}">
    @endpush

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
<div class="w-full bg-white dark:bg-[#091413] shadow-lg rounded-2xl p-3 md:px-20">
    <p class="text-lg md:text-xl font-semibold text-center dark:text-[#3BD59C] rounded-xl p-3 min-w-max ">{{ ucfirst($artikels->kategori) }}</p>
    <h1 class="text-lg md:text-xl font-bold mb-4">{{ $artikels->judul }}</h1>
    <div class="flex items-center gap-2">
        <img src="{{ asset('asset/default.jpg') }}" alt="Penulis" class="w-10 h-10 rounded-full">
        <div>
            <p class="font-bold text-black dark:text-white">{{ $artikels->penulis }}</p>
            <p class="text-gray-500">Penulis</p>
        </div>
    </div>
    <div class="flex justify-center md:justify-start gap-2 my-3">
        <div class="flex gap-2 items-center">
            <svg class="w-5 h-5 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z"/>
            </svg>    
            <p class="text-[10px] md:text-lg text-gray-500">{{ $artikels->created_at->translatedFormat('l, d F Y') }}</p>
        </div>
        <div class="flex gap-2 items-center">
            <svg class="w-5 h-5 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
            </svg>              
            <p class="text-[10px] md:text-lg text-gray-500">{{ $artikels->created_at->diffForHumans()}}</p>
        </div>
        <div class="flex gap-2 items-center">
            <svg class="w-5 h-5 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>
                <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
            </svg>
            <p class="text-[10px] md:text-lg text-gray-500">{{ $artikels->lihats }} Views</p>
        </div>
    </div>
    <div class="w-full h-40 md:h-80 rounded-xl overflow-hidden">
        <img src="{{ asset('uploads/artikel/'.$artikels->gambar) }}" alt="{{ $artikels->judul }}" class="w-full h-[100%] aspect-video object-cover object-center">
    </div>
    
    <h5>Bagikan Artikel:</h5>
    <div class="flex gap-2 mt-2">

        <!-- WhatsApp -->
        <a href="https://wa.me/?text={{ urlencode($shareText . ' ' . $shareUrl. ' '. 'Penulis: ' . $penulis) }}" target="_blank">
            <div class="bg-green-500 p-3 rounded-xl">
                <svg class="w-6 h-6 text-white " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path fill="currentColor" fill-rule="evenodd" d="M12 4a8 8 0 0 0-6.895 12.06l.569.718-.697 2.359 2.32-.648.379.243A8 8 0 1 0 12 4ZM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10a9.96 9.96 0 0 1-5.016-1.347l-4.948 1.382 1.426-4.829-.006-.007-.033-.055A9.958 9.958 0 0 1 2 12Z" clip-rule="evenodd"/>
                    <path fill="currentColor" d="M16.735 13.492c-.038-.018-1.497-.736-1.756-.83a1.008 1.008 0 0 0-.34-.075c-.196 0-.362.098-.49.291-.146.217-.587.732-.723.886-.018.02-.042.045-.057.045-.013 0-.239-.093-.307-.123-1.564-.68-2.751-2.313-2.914-2.589-.023-.04-.024-.057-.024-.057.005-.021.058-.074.085-.101.08-.079.166-.182.249-.283l.117-.14c.121-.14.175-.25.237-.375l.033-.066a.68.68 0 0 0-.02-.64c-.034-.069-.65-1.555-.715-1.711-.158-.377-.366-.552-.655-.552-.027 0 0 0-.112.005-.137.005-.883.104-1.213.311-.35.22-.94.924-.94 2.16 0 1.112.705 2.162 1.008 2.561l.041.06c1.161 1.695 2.608 2.951 4.074 3.537 1.412.564 2.081.63 2.461.63.16 0 .288-.013.4-.024l.072-.007c.488-.043 1.56-.599 1.804-1.276.192-.534.243-1.117.115-1.329-.088-.144-.239-.216-.43-.308Z"/>
                </svg>
            </div>
        </a>

        <!-- Facebook -->
        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($shareUrl) }}" target="_blank">
            <div class="bg-blue-800 p-3 rounded-xl">
                <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M13.135 6H15V3h-1.865a4.147 4.147 0 0 0-4.142 4.142V9H7v3h2v9.938h3V12h2.021l.592-3H12V6.591A.6.6 0 0 1 12.592 6h.543Z" clip-rule="evenodd"/>
                </svg>
            </div>
        </a>

        <!-- Copy Link -->
        <button onclick="copyToClipboard('{{ $shareUrl }}')" class="bg-gray-500 p-3 rounded-xl hover:bg-gray-600 transition duration-300" title="Salin Tautan">
            <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.213 9.787a3.391 3.391 0 0 0-4.795 0l-3.425 3.426a3.39 3.39 0 0 0 4.795 4.794l.321-.304m-.321-4.49a3.39 3.39 0 0 0 4.795 0l3.424-3.426a3.39 3.39 0 0 0-4.794-4.795l-1.028.961"/>
            </svg>
        </button>

        
    </div>
    <!-- Jika konten memiliki paragraf, buat baris baru per paragraf -->
    @if(strip_tags($artikels->isi) === $artikels->isi)
        {{-- FORMAT LAMA --}}
        <div class="mt-8 text-gray-700 leading-relaxed">
            @foreach(explode("\n", $artikels->isi) as $paragraph)
                {{-- Mencegah pencetakan tag <p> kosong jika ada banyak enter --}}
                @if(trim($paragraph) !== '') 
                    <p class="mb-4">{{ $paragraph }}</p>
                @endif
            @endforeach
        </div>
    @else
        {{-- FORMAT BARU --}}
        <div class="mt-8 text-gray-700 dark:text-white text-justify leading-relaxed 
                    [&>h2]:text-2xl [&>h2]:font-bold [&>h2]:mt-8 [&>h2]:mb-4 
                    [&>h3]:text-xl [&>h3]:font-bold [&>h3]:mt-6 [&>h3]:mb-3
                    [&>p]:mb-4 
                    [&>ul]:list-disc [&>ul]:pl-5 [&>ul]:mb-4 [&>ul>li]:mb-1
                    [&>ol]:list-decimal [&>ol]:pl-5 [&>ol]:mb-4 [&>ol>li]:mb-1
                    [&>blockquote]:border-l-4 [&>blockquote]:border-gray-300 [&>blockquote]:pl-4 [&>blockquote]:italic [&>blockquote]:text-gray-600 [&>blockquote]:my-4">
            {!! $artikels->isi !!}
        </div>
    @endif


    <a href="/artikel" class="text-blue-500 hover:underline">Kembali ke daftar artikel</a>

    <!-- Toast Notification -->
    <div id="copy-toast" class="fixed bottom-5 right-5 transform translate-y-10 opacity-0 transition-all duration-300 bg-gray-800 text-white px-4 py-3 rounded-lg shadow-lg flex items-center gap-3 pointer-events-none z-50">
        <!-- Ikon Centang (Sukses) -->
        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>
        <span class="text-sm font-medium">Tautan berhasil disalin!</span>
    </div>
    <script>
        function copyToClipboard(url) {
        navigator.clipboard.writeText(url).then(() => {
            showToast();
        }).catch(err => {
            console.error('Gagal menyalin tautan: ', err);
            alert('Gagal menyalin tautan.'); // Tetap gunakan alert jika terjadi error (jarang terjadi)
        });
    }

    function showToast() {
        const toast = document.getElementById('copy-toast');
        
        // Memunculkan toast (menghilangkan transparan dan menggeser ke atas)
        toast.classList.remove('translate-y-10', 'opacity-0');
        
        // Menyembunyikan toast secara otomatis setelah 3 detik (3000 milidetik)
        setTimeout(() => {
            toast.classList.add('translate-y-10', 'opacity-0');
        }, 3000);
    }
    </script>
</div>
</x-layouts.app>
