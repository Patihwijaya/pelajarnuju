<x-layouts.admin title="Dashboard Admin">

<form action="{{ route('admin.ads.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
    @csrf

    <label>Judul</label>
    <input type="text" name="judul" class="border rounded w-full p-2" required>

    <label>Deskripsi</label>
    <textarea name="deskripsi" class="border rounded w-full h-30 p-2"></textarea>

    <label>Link Iklan</label>
    <input type="text" name="link" class="border rounded w-full p-2">

    <label>Expired Date</label>
    <input type="date" name="expired_at" class="border rounded w-full p-2" required>

    <label>Gambar Iklan</label>
    <input type="file" name="gambar" class="border rounded w-full p-2">

    <button class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
</form>

</x-layouts.admin>
