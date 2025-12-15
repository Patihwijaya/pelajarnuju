<x-layouts.admin title="Dashboard Admin">


<div class="container mx-auto p-6">

    <h1 class="text-2xl font-bold mb-4">Tambah Materi</h1>

    <form action="{{ route('materi.store', $kela->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-5">
            <label class="block mb-2">Judul Materi</label>
            <input type="text" name="judul_materi" class="w-full p-2 border rounded ">
        </div>

        <div class="mb-5">
            <label class="block mb-2">isi Materi</label>
            <textarea name="konten" class="w-full p-2 border rounded "></textarea>
        </div>

        <div class="mb-5">
            <label class="block mb-2">Upload Gambar</label>
            <input type="file" name="gambar" class="w-full p-2 border rounded ">
        </div>

        <div class="mb-5">
            <label class="block mb-2">Link Video YouTube</label>
            <input type="text" name="video_url" placeholder="" class="w-full p-2 border rounded ">
            <p class="text-sm text-gray-400 italic">Contoh : https://www.youtube.com/watch?v=xxxxx</p>
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded" type="submit">Simpan</button>
    </form>

</div>

</x-layouts.admin>
