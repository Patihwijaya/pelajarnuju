<x-layouts.admin title="Dashboard Admin">
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

    <form action="{{ route('admin.kegiatan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block font-semibold mb-1">Judul Kegiatan</label>
            <input type="text" name="judul" value="{{ old('judul') }}" class="w-full border rounded-lg p-2" required>
        </div>

        <!-- Kolom Baru: Tanggal Acara & Lokasi (Dibuat bersebelahan) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block font-semibold mb-1">Tanggal Acara</label>
                <input type="date" name="tanggal_acara" value="{{ old('tanggal_acara') }}" class="w-full border rounded-lg p-2" required>
            </div>
            <div>
                <label class="block font-semibold mb-1">Lokasi</label>
                <input type="text" name="lokasi" value="{{ old('lokasi') }}" placeholder="Contoh: Jakarta Utara" class="w-full border rounded-lg p-2" required>
            </div>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Isi Kegiatan</label>
            <textarea name="deskripsi" rows="8" class="w-full border rounded-lg p-2" required>{{ old('deskripsi') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Gambar Utama (Cover)</label>
            <input type="file" name="gambar" accept="image/*" class="border p-2 rounded-lg w-full" required>
        </div>

        <!-- Kolom Baru: Galeri (Bisa banyak foto) -->
        <div class="mb-6 p-4 border border-dashed border-gray-400 bg-gray-50 rounded-lg">
            <label class="block font-semibold mb-1">Dokumentasi Lainnya (Bisa pilih banyak)</label>
            <!-- Perhatikan penambahan kurung siku [] dan atribut multiple -->
            <input type="file" name="galeri[]" accept="image/*" multiple class="border p-2 rounded-lg w-full bg-white">
            <p class="text-sm text-gray-500 mt-2">Tekan <b>CTRL</b> (atau Command) sambil mengklik foto untuk memilih lebih dari satu.</p>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('admin.kegiatan.index') }}" class="bg-gray-300 px-4 py-2 rounded-lg mr-2">Batal</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Simpan</button>
        </div>
    </form>
</div>
</x-layouts.admin>
