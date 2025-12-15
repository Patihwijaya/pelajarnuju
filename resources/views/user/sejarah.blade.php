<x-layouts.app title="sejarah">
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow">
    @if($profil)
        <div class="flex items-center space-x-4">
            <div>
                <h2 class="text-2xl font-bold">{{ $profil->judul }}</h2>
            </div>
        </div>
        <p class="mt-4 text-gray-700 text-justify">{!! nl2br(e($profil->text)) !!}</p>
    @else
        <p class="mt-4">Belum ada data Sejarah.</p>
    @endif

</div>
</x-layouts.app>
