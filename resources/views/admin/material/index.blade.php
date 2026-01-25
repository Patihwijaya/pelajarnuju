<x-layouts.admin title="Dashboard Admin">

    <div class="max-w-5xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Kelola Materi</h2>
        <a href="{{ route('admin.materials.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
            + Tambah Materi
        </a>
    </div>


    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="">
        <div class="">
            @if($materials->count() == 0)
                <p>Belum ada materi yang dibuat.</p>
            @else
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="p-3 border">Judul</th>
                            <th class="p-3 border">Deskripsi</th>
                            <th class="p-3 border">Tanggal Dibuat</th>
                            <th class="p-3 border">File</th>
                            <th class="p-3 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($materials as $material)
                            <tr class="hover:bg-gray-50">
                                <td class="p-3 border">{{ $material->judul }}</td>
                                <td class="p-3 border">{{ $material->isi_materi }}</td>
                                <td class="p-3 border">{{ $material->created_at->format('d M Y') }}</td>
                                <td class="p-3 border">
                                    @if($material->file)
                                        <a href="{{ asset('uploads/E-Book/'.$material->file) }}" target="_blank">
                                            Lihat File
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="p-3 border">
                                    <a href="{{ route('admin.materials.edit', $material->id) }}"
                                       class="text-blue-600 hover:underline mr-2">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.materials.destroy', $material->id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin hapus materi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 hover:underline">Hapus</button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

</div>

</x-layouts.admin>
