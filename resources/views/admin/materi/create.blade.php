<x-layouts.admin title="Dashboard Admin">

<h2 class="text-xl font-bold mb-4">Tambah Materi untuk {{ $kelas->nama }}</h2>

<form action="{{ route('admin.materiKelas.store', $kelas->id) }}"
      method="POST" enctype="multipart/form-data">

    @csrf

    <label>Judul</label>
    <input type="text" name="judul" class="border p-2 w-full">

    <label class="mt-3">Isi Materi</label>
    <textarea name="isi" class="border p-2 w-full" rows="6"></textarea>

    <label class="mt-3">Gambar (opsional)</label>
    <input type="file" name="gambar" class="border p-2 w-full">

    <button class="bg-green-600 text-white px-3 py-2 mt-4 rounded">
        Simpan
    </button>
</form>

</x-layouts.admin>
