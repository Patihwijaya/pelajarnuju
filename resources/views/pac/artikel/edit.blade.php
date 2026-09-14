<x-layouts.admin title="Edit Artikel">
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

    <form action="{{ route('pac.artikel.update', $artikel->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-semibold mb-1">Judul Artikel</label>
            <input type="text" name="judul" value="{{ old('judul', $artikel->title) }}" class="w-full border rounded-lg p-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Kategori</label>
            <select name="kategori" class="w-full border rounded-lg p-2" required>
                <option value="berita" {{ old('kategori', $artikel->kategori) == 'berita' ? 'selected' : '' }}>Berita</option>
                <option value="opini" {{ old('kategori', $artikel->kategori) == 'opini' ? 'selected' : '' }}>Opini</option>
                <option value="cerpen" {{ old('kategori', $artikel->kategori) == 'cerpen' ? 'selected' : '' }}>Cerpen</option>
                <option value="artikel" {{ old('kategori', $artikel->kategori) == 'artikel' ? 'selected' : '' }}>Artikel</option>
                <option value="kaderisasi" {{ old('kategori', $artikel->kategori) == 'kaderisasi' ? 'selected' : '' }}>Kaderisasi</option>
                <option value="organisasi" {{ old('kategori', $artikel->kategori) == 'organisasi' ? 'selected' : '' }}>Organisasi</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Isi Artikel</label>
            <!-- Atribut required dihapus agar tidak bentrok dengan validasi TinyMCE -->
            <textarea name="isi" id="editor" rows="8" class="w-full border rounded-lg p-2">{{ old('isi', $artikel->content) }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Penulis</label>
            <input type="text" name="penulis" value="{{ old('penulis', $artikel->penulis) }}" class="w-full border rounded-lg p-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Gambar</label>
            @if($artikel->gambar)
                <div class="mb-3">
                    <img src="{{ asset('uploads/artikel/'.$artikel->gambar) }}" alt="Gambar Artikel" class="w-40 rounded-md shadow-sm border">
                </div>
            @endif
            <input type="file" name="gambar" class="border p-2 rounded-lg w-full" accept="image/*">
            <p class="text-xs text-gray-500 mt-1">* Biarkan kosong jika tidak ingin mengubah gambar.</p>
        </div>

        <div class="flex justify-end pt-4">
            <a href="{{ route('pac.artikel.index') }}" class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded-lg mr-2 transition-colors">Batal</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">Update</button>
        </div>
    </form>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#editor',
            height: 500,
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | removeformat',
            
            // [TAMBAHKAN DUA BARIS INI UNTUK MENCEGAH LINK RUSAK]
            relative_urls: false,
            remove_script_host: false,

            automatic_uploads: true,
            images_upload_handler: function (blobInfo, progress) {
                return new Promise((resolve, reject) => {
                    const xhr = new XMLHttpRequest();
                    xhr.open('POST', '{{ route("pac.artikel.upload") }}');
                    xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                    
                    xhr.onload = function() {
                        if (xhr.status !== 200) {
                            reject('HTTP Error: ' + xhr.status);
                            return;
                        }
                        const json = JSON.parse(xhr.responseText);
                        if (!json || typeof json.url != 'string') {
                            reject('Invalid JSON: ' + xhr.responseText);
                            return;
                        }
                        resolve(json.url); // Ini akan mengembalikan URL absolut (lengkap)
                    };
                    
                    const formData = new FormData();
                    formData.append('upload', blobInfo.blob(), blobInfo.filename());
                    xhr.send(formData);
                });
            },
            content_style: `
                body { font-family: ui-sans-serif, system-ui, sans-serif; font-size: 15px; } 
                img { max-width: 100%; height: auto; cursor: pointer; }
                iframe { width: 100%; aspect-ratio: 16 / 9; height: auto; }
            `
        });
    </script>
@endpush
</x-layouts.admin>