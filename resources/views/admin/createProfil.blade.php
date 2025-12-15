<x-layouts.admin title="Dashboard Admin">
<div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-semibold mb-4">Tambah Profil</h2>

    <form action="{{ route('admin.profile.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label class="block mb-1">Nama</label>
        <input type="text" name="nama" class="w-full border p-2 rounded mb-3">

        <label class="block mb-1">Jabatan</label>
        <input type="text" name="jabatan" class="w-full border p-2 rounded mb-3">

        <label class="block mb-1">Deskripsi</label>
        <textarea name="deskripsi" class="w-full border p-2 rounded mb-3"></textarea>

        <label class="block mb-1">Foto</label>
        <input type="file" name="foto" class="w-full border p-2 rounded mb-3">

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
</x-layouts.admin>
