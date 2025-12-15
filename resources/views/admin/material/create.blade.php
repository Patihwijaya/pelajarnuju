<x-layouts.admin title="Dashboard Admin">

<div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">

    <h2 class="text-2xl font-bold mb-6 text-gray-800">Tambah Materi</h2>


            <form action="{{ route('admin.materials.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="block font-semibold mb-1">Judul Materi</label>
                    <input type="text" class="w-full border rounded-lg p-2" name="judul" required>
                </div>

                <div class="mb-3">
                    <label class="block font-semibold mb-1">Isi Materi</label>
                    <textarea name="isi_materi" class="w-full border rounded-lg p-2" rows="5" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="block font-semibold mb-1">Upload File (Opsional)</label>
                    <input type="file" name="file" class="w-full border rounded-lg p-2">
                </div>

                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Simpan</button>
                <a href="{{ route('admin.materials.index') }}" class="bg-gray-300 px-4 py-2 rounded-lg mr-2">Kembali</a>

            </form>


</div>

</x-layouts.admin>
