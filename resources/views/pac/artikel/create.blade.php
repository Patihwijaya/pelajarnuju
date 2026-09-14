<x-layouts.admin title="Tambah Artikel - Super Admin">
<div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Tambah Artikel Baru</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pac.artikel.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block font-semibold mb-1">Judul Artikel</label>
            <input type="text" name="judul" value="{{ old('judul') }}" class="w-full border rounded-lg p-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Kategori</label>
            <select name="kategori" id="kategori" class="w-full border rounded-lg p-2" required>
                <option value="">-- Pilih Kategori --</option>
                <option value="berita" {{ old('kategori') == 'berita' ? 'selected' : '' }}>Berita</option>
                <option value="opini" {{ old('kategori') == 'opini' ? 'selected' : '' }}>Opini</option>
                <option value="cerpen" {{ old('kategori') == 'cerpen' ? 'selected' : '' }}>Cerpen</option>
                <option value="artikel" {{ old('kategori') == 'artikel' ? 'selected' : '' }}>Artikel</option>
                <option value="kaderisasi" {{ old('kategori') == 'kaderisasi' ? 'selected' : '' }}>Kaderisasi</option>
                <option value="organisasi" {{ old('kategori') == 'organisasi' ? 'selected' : '' }}>Organisasi</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Isi Artikel</label>
            <textarea name="isi" id="editor" rows="8" class="w-full border rounded-lg p-2">{{ old('isi') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Penulis</label>
            <input type="text" name="penulis" value="{{ old('penulis') ?? Auth::user()->name }}" class="w-full border rounded-lg p-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Gambar</label>
            <input type="file" name="gambar" class="border p-2 rounded-lg w-full" accept="image/*">
        </div>

        <div class="flex justify-end">
            <a href="{{ route('admin.artikel.index') }}" class="bg-gray-300 px-4 py-2 rounded-lg mr-2">Batal</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Simpan</button>
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