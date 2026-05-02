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
            <input type="text" name="judul" value="{{ old('judul', $kegiatan->judul) }}" class="w-full border rounded-lg p-2" required>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block font-semibold mb-1">Tanggal Acara</label>
                <!-- Format tanggal harus Y-m-d agar terbaca oleh input type="date" -->
                <input type="date" name="tanggal_acara" value="{{ old('tanggal_acara', $kegiatan->tanggal_acara ? $kegiatan->tanggal_acara->format('Y-m-d') : '') }}" class="w-full border rounded-lg p-2" required>
            </div>
            <div>
                <label class="block font-semibold mb-1">Lokasi</label>
                <input type="text" name="lokasi" value="{{ old('lokasi', $kegiatan->lokasi) }}" placeholder="Contoh: Jakarta Utara" class="w-full border rounded-lg p-2" required>
            </div>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Isi Kegiatan</label>
            <textarea name="deskripsi" rows="8" class="w-full border rounded-lg p-2" required>{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Gambar Utama (Cover)</label>
            
            <!-- Tampilkan Cover Lama -->
            <div class="mb-2">
                <img src="{{ asset('uploads/kegiatan/' . $kegiatan->gambar) }}" alt="Cover Saat Ini" class="h-32 w-auto object-cover rounded-lg border border-gray-300">
            </div>

            <!-- Input untuk ubah cover (Tanpa required) -->
            <input type="file" name="gambar" accept="image/*" class="border p-2 rounded-lg w-full">
            <p class="text-sm text-gray-500 mt-1">*Abaikan jika tidak ingin mengganti cover utama.</p>
        </div>

        <div class="mb-6 p-4 border border-dashed border-gray-400 bg-gray-50 rounded-lg">
            <label class="block font-semibold mb-2">Dokumentasi Lainnya (Galeri)</label>
            
            <!-- Tampilkan Galeri Lama Jika Ada -->
            @if($kegiatan->galleries->count() > 0)
                <div class="flex flex-wrap gap-3 mb-4">
                    @foreach($kegiatan->galleries as $galeri)
                        <img src="{{ asset('uploads/kegiatan/galeri/' . $galeri->foto) }}" alt="Foto Galeri" class="h-24 w-24 object-cover rounded-lg border border-gray-300 shadow-sm">
                    @endforeach
                </div>
            @endif

            <label class="block text-sm font-semibold mb-1">Tambah Foto Baru</label>
            <input type="file" name="galeri[]" accept="image/*" multiple class="border p-2 rounded-lg w-full bg-white">
            <p class="text-sm text-gray-500 mt-2">*Abaikan jika tidak ingin menambah foto galeri baru. Tekan <b>CTRL</b> (atau Command) sambil mengklik foto untuk memilih lebih dari satu.</p>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('admin.artikel.index') }}" class="bg-gray-300 px-4 py-2 rounded-lg mr-2">Batal</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Update</button>
        </div>
    </form>
</div>
</x-layouts.admin>
