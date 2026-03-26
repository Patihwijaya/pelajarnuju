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

    <form action="{{ route('admin.artikel.update', $artikel->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-semibold mb-1">Judul Artikel</label>
            <input type="text" name="judul" value="{{ old('judul', $artikel->judul) }}" class="w-full border rounded-lg p-2">
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Kategori</label>
            <select name="kategori" class="w-full border rounded-lg p-2">
                <option value="berita" {{ $artikel->kategori == 'berita' ? 'selected' : '' }}>Berita</option>
                <option value="opini" {{ $artikel->kategori == 'opini' ? 'selected' : '' }}>Opini</option>
                <option value="cerpen" {{ $artikel->kategori == 'cerpen' ? 'selected' : '' }}>Cerpen</option>
                <option value="artikel" {{ $artikel->kategori == 'artikel' ? 'selected' : '' }}>Artikel</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Isi Artikel</label>
            <textarea name="isi" id="editor" rows="8" class="w-full border rounded-lg p-2">{{ old('isi', $artikel->isi) }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Penulis</label>
            <input type="text" name="penulis" value="{{ old('penulis') }}" class="w-full border rounded-lg p-2">
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Gambar</label>
            @if($artikel->gambar)
                <img src="{{ asset('uploads/artikel/'.$artikel->gambar) }}" alt="Gambar Artikel" class="w-40 mb-2">
            @endif
            <input type="file" name="gambar" class="border p-2 rounded-lg w-full">
        </div>

        <div class="flex justify-end">
            <a href="{{ route('admin.artikel.index') }}" class="bg-gray-300 px-4 py-2 rounded-lg mr-2">Batal</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Update</button>
        </div>
    </form>
</div>
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

<script>
    CKEDITOR.replace('editor', {
        height: 300,

        toolbar: [
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Blockquote'] },
            { name: 'styles', items: ['Format'] },
            { name: 'insert', items: ['Link', 'Image', 'Table'] },
            { name: 'tools', items: ['Maximize'] }
        ]
    });
</script>
</x-layouts.admin>
