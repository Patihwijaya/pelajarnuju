<x-layouts.admin title="Dashboard Admin">
<div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Edit Artikel</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.kegiatan.update', $kegiatan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-semibold mb-1">Judul Kegiatan</label>
            <input type="text" name="judul" value="{{ old('judul', $kegiatan->judul) }}" class="w-full border rounded-lg p-2">
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Isi Kegiatan</label>
            <textarea name="deskripsi" rows="8" class="w-full border rounded-lg p-2">{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Gambar</label>
            @if($kegiatan->gambar)
                <img src="{{ asset('uploads/kegiatan/'.$kegiatan->gambar) }}" alt="Gambar kegiatan" class="w-40 mb-2">
            @endif
            <input type="file" name="gambar" class="border p-2 rounded-lg w-full">
        </div>

        <div class="flex justify-end">
            <a href="{{ route('admin.artikel.index') }}" class="bg-gray-300 px-4 py-2 rounded-lg mr-2">Batal</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Update</button>
        </div>
    </form>
</div>
</x-layouts.admin>
