<x-layouts.app-user title="Materi">


<div class="max-w-5xl mx-auto bg-white shadow-lg rounded-2xl p-6">
    <h2 class="mb-4 text-xl font-bold text-center">Daftar E-Book</h2>

    <ul class="">
        @foreach ($materials as $material)
        <li class="border border-gray-400 mb-5 p-5 w-full h-20 hover:shadow-lg">
            <a href="{{ route('material.show', $material->id)}}">
            <div class="">
                    <h1 class="font-semibold uppercase">{{ $material->judul }}</h1>
                    <a href="{{ route('material.show', $material->id) }}" class="btn btn-primary btn-sm">Baca</a>
                </div>
            </a>
        </li>

        @endforeach
    </ul>
</div>

</x-layouts.app>
