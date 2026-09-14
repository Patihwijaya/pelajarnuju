<!-- Ads Carousel Component -->
@php
    // Disarankan ke depannya query ini dipindah ke View Composer, bukan di View.
    // Tapi untuk sementara kita isolasi di komponen ini agar layout utama bersih.
    $ads = \App\Models\Ads::where('status', 1)
        ->whereDate('expired_at', '>=', now())
        ->latest()
        ->get();
@endphp

@if($ads->count())
    <div class="relative w-full aspect-[5/1] overflow-hidden mb-5 md:1">
        <div id="carousel" class="flex transition-transform duration-1000">
            @foreach ($ads as $ad)
                <div class="min-w-full">
                    <a href="{{ route('ads.click', $ad->id) }}" target="_blank">
                        @if ($ad->gambar)
                            <img src="{{ asset('uploads/ads/'.$ad->gambar) }}" class="w-full h-auto object-cover object-center" alt="{{ $ad->judul }}">
                        @else
                            <div class="bg-yellow-200 p-4 rounded shadow">
                                <h2 class="text-lg font-bold">{{ $ad->judul }}</h2>
                                <p>{{ $ad->deskripsi }}</p>
                            </div>
                        @endif
                    </a>
                </div>
            @endforeach
            
            <!-- Duplikasi slide pertama untuk infinite loop -->
            @if ($ads->count() > 0)
                <div class="min-w-full">
                    <a href="{{ route('ads.click', $ads[0]->id) }}" target="_blank">
                        @if ($ads[0]->gambar)
                            <img src="{{ asset('uploads/ads/'.$ads[0]->gambar) }}" class="w-full h-auto object-cover object-center" alt="{{ $ads[0]->judul }}">
                        @else
                            <div class="bg-yellow-200 p-4 rounded shadow">
                                <h2 class="text-lg font-bold">{{ $ads[0]->judul }}</h2>
                                <p>{{ $ads[0]->deskripsi }}</p>
                            </div>
                        @endif
                    </a>
                </div>
            @endif
        </div>
    </div>

    <script>
        const carousel = document.getElementById('carousel');
        const slides = carousel.children;
        let index = 0;
        let slideCount = slides.length;

        function nextSlide() {
            index++;
            carousel.style.transition = 'transform 1s ease-in-out';
            carousel.style.transform = `translateX(-${index * 100}%)`;

            if(index === slideCount - 1) {
                setTimeout(() => {
                    carousel.style.transition = 'none';
                    index = 0;
                    carousel.style.transform = `translateX(0)`;
                }, 1000); 
            }
        }
        setInterval(nextSlide, 5000);
    </script>
@else
    <div class="w-full aspect-[5/1] rounded shadow bg-gray-400 dark:bg-gray-700 flex flex-col items-center justify-center mb-5">
        <p class="text-xl lg:text-3xl text-gray-800 dark:text-gray-300 font-bold uppercase tracking-widest">Tempat Iklan</p>
    </div>
@endif