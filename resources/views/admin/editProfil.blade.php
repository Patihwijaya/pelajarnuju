<x-layouts.admin title="Dashboard Admin">
<div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-semibold mb-4">Edit Profil</h2>

    <form action="{{ route('admin.profile.update', $profile->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label class="block mb-1">Nama</label>
        <input type="text" name="nama" value="{{ old('nama', $profile->nama) }}" class="w-full border p-2 rounded mb-3">

        <label class="block mb-1">Jabatan</label>
        <input type="text" name="jabatan" value="{{ old('jabatan', $profile->jabatan) }}" class="w-full border p-2 rounded mb-3">

        <label class="block mb-1">Deskripsi</label>
        <textarea name="deskripsi" class="w-full border p-2 rounded mb-3">{{ old('deskripsi', $profile->deskripsi) }}</textarea>

        <label class="block mb-1">Foto</label>
        @if($profile->foto)
            <img src="{{ asset('storage/'.$profile->foto) }}" alt="Foto" class="w-20 h-20 rounded-full mb-2">
        @endif
        <input type="file" name="foto" class="w-full border p-2 rounded mb-3">

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
</x-layouts.admin>
