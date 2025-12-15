<x-layouts.admin title="Dashboard Admin">
<div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-semibold mb-4">Edit Profil</h2>

    <form action="{{ route('admin.profil.update', $profil->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label class="block mb-1">Nama</label>
        <input type="text" name="judul" value="{{ old('judul', $profil->judul) }}" class="w-full border p-2 rounded mb-3">

        <label class="block mb-1">Konten</label>
        <textarea name="text" class="w-full border p-2 rounded mb-3 h-50">{{ old('text', $profil->text) }}</textarea>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
</x-layouts.admin>
