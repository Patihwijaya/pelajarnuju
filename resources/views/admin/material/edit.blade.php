<x-layouts.admin title="Dashboard Admin">

<div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">

    <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Materi</h2>


            <form action="{{ route('admin.materials.update', $material->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="block font-semibold mb-1">Judul Materi</label>
                    <input type="text" class="w-full border rounded-lg p-2" name="judul" value="{{ $material->judul }}" required>
                </div>

                <div class="mb-3">
                    <label class="block font-semibold mb-1">Isi Materi</label>
                    <textarea name="isi_materi" class="w-full border rounded-lg p-2" rows="5" required>{{ $material->isi_materi }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="block font-semibold mb-1">File Saat Ini</label>
                    @if($material->file)
                        <p>
                            <a href="{{ asset('uploads/E-Book/'.$material->file) }}" target="_blank">Lihat File</a>
                        </p>
                    @else
                        <p>- Tidak ada file -</p>
                    @endif

                    <label class="form-label">Ganti File (Opsional)</label>
                    <input type="file" name="file" class="w-full border rounded-lg p-2">
                </div>

                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Perbarui</button>
                <a href="{{ route('admin.materials.index') }}" class="bg-gray-300 px-4 py-2 rounded-lg mr-2">Kembali</a>

            </form>

</div>

</x-layouts.admin>
