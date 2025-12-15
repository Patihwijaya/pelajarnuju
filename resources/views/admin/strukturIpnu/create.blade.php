<x-layouts.admin title="Dashboard Admin">
<div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Tambah Kader Baru</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.strukturIpnu.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block font-semibold mb-1">Nama Kader</label>
            <input type="text" name="nama" value="{{ old('nama') }}" class="w-full border rounded-lg p-2">
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Jabatan</label>
            <input type="text" name="jabatan" value="{{ old('jabatan') }}" class="w-full border rounded-lg p-2">
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Instagram</label>
            <input type="text" name="instagram" value="{{ old('instagram') }}" class="w-full border rounded-lg p-2">
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Gambar</label>
            <input type="file" name="gambar" class="border p-2 rounded-lg w-full">
        </div>

        <div class="flex justify-end">
            <a href="{{ route('admin.strukturIpnu.index') }}" class="bg-gray-300 px-4 py-2 rounded-lg mr-2">Batal</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Simpan</button>
        </div>
    </form>
</div>
</x-layouts.admin>
