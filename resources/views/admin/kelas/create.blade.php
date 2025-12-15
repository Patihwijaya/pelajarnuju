<x-layouts.admin title="Dashboard Admin">

<div class="container mx-auto p-6">

    <h1 class="text-2xl font-bold mb-4">Tambah Kelas</h1>

    <form action="{{ route('kelas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="block mb-2">Nama Kelas</label>
            <input type="text" name="nama_kelas" class="w-full p-2 border rounded mb-4">
        </div>
        <div class="mb-3">
            <label class="block mb-2">Gambar Kelas</label>
            <input type="file" name="gambar_kelas" class="w-full p-2 border rounded mb-4">
        </div>
        <div class="mb-3">
            <label class="block mb-2">Deskripsi Kelas</label>
            <input type="text" name="deskripsi" class="w-full p-2 border rounded mb-4">
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded" type="submit">Simpan</button>
    </form>

</div>

</x-layouts.admin>
