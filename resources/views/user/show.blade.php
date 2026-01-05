<x-layouts.app title="Artikel">
    @push('meta')
    <!-- BASIC SEO -->
    <meta name="description" content="{{ Str::limit(strip_tags($artikels->isi), 150) }}">

    <!-- OPEN GRAPH -->
    <meta property="og:title" content="{{ $artikels->judul }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($artikels->isi), 150) }}">
    <meta property="og:type" content="artikels">
    <meta property="og:url" content="{{ $shareUrl }}">
    <meta property="og:image" content="{{ $shareImage }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    <!-- TWITTER -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $artikels->judul }}">
    <meta name="twitter:description" content="{{ Str::limit(strip_tags($artikels->isi), 150) }}">
    <meta name="twitter:image" content="{{ asset('uploads/artikel/'.$artikels->gambar) }}?v={{ $artikels->updated_at->timestamp }}">
    @endpush
<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-2xl p-8 ">

    <h1 class="text-xl md:text-2xl font-bold mb-4">{{ $artikels->judul }}</h1>
    <img src="{{ asset('uploads/artikel/'.$artikels->gambar) }}" alt="{{ $artikels->judul }}" class="w-full h-50 md:h-100 object-cover">

    <p class="text-gray-500 mb-6">Dibuat pada: {{ $artikels->created_at->format('d M Y') }}</p>

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

        <!-- Twitter -->
        <a href="https://twitter.com/intent/tweet?text={{ urlencode($shareText) }}&url={{ urlencode($shareUrl) }}" target="_blank">
            <div class="bg-black p-3 rounded-xl">
                <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M13.795 10.533 20.68 2h-3.073l-5.255 6.517L7.69 2H1l7.806 10.91L1.47 22h3.074l5.705-7.07L15.31 22H22l-8.205-11.467Zm-2.38 2.95L9.97 11.464 4.36 3.627h2.31l4.528 6.317 1.443 2.02 6.018 8.409h-2.31l-4.934-6.89Z"/>
                </svg>
            </div>
        </a>

        <!-- instagram -->
        <a href="https://instagram.com/stories/share?url={{ urlencode($shareUrl) }}" target="_blank">
            <div class="bg-pink-500 p-3 rounded-xl">
                <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path fill="currentColor" fill-rule="evenodd" d="M3 8a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v8a5 5 0 0 1-5 5H8a5 5 0 0 1-5-5V8Zm5-3a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8a3 3 0 0 0-3-3H8Zm7.597 2.214a1 1 0 0 1 1-1h.01a1 1 0 1 1 0 2h-.01a1 1 0 0 1-1-1ZM12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm-5 3a5 5 0 1 1 10 0 5 5 0 0 1-10 0Z" clip-rule="evenodd"/>
                </svg>
            </div>
        </a>
    </div>
    <!-- Jika konten memiliki paragraf, buat baris baru per paragraf -->
    @foreach(explode("\n", $artikels->isi) as $paragraph)
        <p class="mb-4 mt-5">{{ $paragraph }}</p>
    @endforeach

    <p class="mb-4 text-gray-500">Penulis: {{ $artikels->penulis }}</p>
    <a href="/artikel" class="text-blue-500 hover:underline">Kembali ke daftar artikel</a>

</div>
</x-layouts.app>
