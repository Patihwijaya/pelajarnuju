<x-layouts.app title="strukturIpnu">
<div>
    <h1 class="font-bold text-2xl">Susunan Pengurus PC IPNU Jakarta Utara</h1>

    <div class="mt-5 overflow-hidden flex flex-col md:flex md:flex-wrap md:flex-row gap-5 mx-5 md:mx-0 justify-center">
         @foreach($strukturIpnu as $struktur)
            @php
                $username = getInstagramUsername($struktur->instagram);
            @endphp
            <div class="relative w-60 overflow-hidden" x-data="{ open:false }" @click.outside="open = false">
                    @if($struktur->gambar)
                    <img src="{{ asset('uploads/strukturIpnu/'.$struktur->gambar) }}" alt="{{ $struktur->judul }}" class="w-60 object-cover cursor-pointer" @click="open = !open">
                    @endif
            <div
                x-show="open"
                x-transition:enter="transition transform duration-500"
                x-transition:enter-start="translate-y-full opacity-0"
                x-transition:enter-end="translate-y-0 opacity-0"
                x-transition:leave="transition transform duration-500"
                x-transition:leave-start="translate-y-0 opacity-0"
                x-transition:leave-end="translate-y-full opacity-0"
                class="absolute inset-x-0 bottom-0 h-full bg-green-600 opacity-80 text-white flex flex-col justify-center items-center text-center"
                >
                    <p class="text-xl text-wrap">{{ $struktur->nama }}</p>
                    <p class="text-xl">{{ $struktur->jabatan }}</p>
                    <div class="flex gap-1 items-center">
                        <svg class="w-6 h-6 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path fill="currentColor" fill-rule="evenodd" d="M3 8a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v8a5 5 0 0 1-5 5H8a5 5 0 0 1-5-5V8Zm5-3a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8a3 3 0 0 0-3-3H8Zm7.597 2.214a1 1 0 0 1 1-1h.01a1 1 0 1 1 0 2h-.01a1 1 0 0 1-1-1ZM12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm-5 3a5 5 0 1 1 10 0 5 5 0 0 1-10 0Z" clip-rule="evenodd"/>
                        </svg>

                        <a href="{{ $struktur->instagram }}" target="_blank" class="text-yellow-400 text-xl font-bold italic hover:underline hover:bg-white">
                            {{ $username ?? 'tidak ada' }}
                        </a>
                    </div>
                </div>
            </div>

        @endforeach
</div>
</x-layouts.app>
