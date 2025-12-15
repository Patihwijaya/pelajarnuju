<x-layouts.admin title="Dashboard Admin">

<div class="container mx-auto p-6">

<h1 class="text-2xl font-bold mb-4">Edit Materi</h1>

    <form action="{{ route('materi.update', ['kela' => $kela->id, 'materis' => $materis->id]) }}"
          method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label class="block mb-2">Judul Materi</label>
        <input type="text" name="judul_materi" value="{{ $materis->judul_materi }}"
               class="w-full p-2 border rounded mb-4">

        <label class="block mb-2">Deskripsi</label>
        <textarea name="konten" class="w-full p-2 border rounded mb-4">{{ $materis->konten }}</textarea>

        <label class="block mb-2">Gambar (opsional)</label>
        <input type="file" name="gambar" class="w-full p-2 border rounded mb-4">

        <label class="block mb-2">Link Video YouTube</label>
        <input type="text" name="video_url" value="{{ $materis->video_url }}"
               class="w-full p-2 border rounded mb-4">

        <button class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
    </form>

</div>

</x-layouts.admin>
