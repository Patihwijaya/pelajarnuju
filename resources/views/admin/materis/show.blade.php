<x-layouts.admin title="Dashboard Admin">

<div class="container mx-auto p-6">

    <div class="flex justify-between">
        <h1 class="text-2xl font-bold mb-4">Daftar Materi Kelas: {{ $kela->nama_kelas }}</h1>
        <a href="{{ route('kelas.show', $kela->id) }}" class="bg-blue-500 hover:bg-blue-800 px-5 py-2 text-white">kembali</a>
    </div>
    @foreach($kela->materis as $materi)
    <h1 class="text-2xl font-bold mb-4">judul Materi: {{ $materi->judul_materi }}</h1>
    <h1 class="text-2xl font-bold">isi Materi:</h1>
    <p class="mb-5"> {{ $materi->konten }}</p>

    @if ($materi->gambar)
        <img src="{{ asset('storage/materiS/' . $materi->gambar) }}" class="w-full mb-4 rounded shadow" >
    @else
    <p class="text-xl text-gray-800">tidak ada gambar</p>
    @endif

    @if ($materi->video)
    <a href="{{ $materi->video }}" target="_blank" class="bg-red-600 text-white px-4 py-2 rounded inline-block">
        Tonton Video YouTube
    </a>
    @else
    <p class="text-xl text-gray-800">tidak ada Video</p>
    @endif
@endforeach


</div>

</x-layouts.admin>
