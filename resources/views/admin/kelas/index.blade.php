<x-layouts.admin title="Dashboard Admin">

<div class="container mx-auto p-6">

    <div class="flex justify-between mb-4">
        <h1 class="text-2xl font-bold">Data Kelas</h1>
        <a href="{{ route('kelas.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Tambah Kelas</a>
    </div>

    <table class="w-full border">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-3 border">No</th>
                <th class="p-3 border">Nama Kelas</th>
                <th class="p-3 border">Gambar Kelas</th>
                <th class="p-3 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kelas as $k)
            <tr>
                <td class="p-3 border">{{ $loop->iteration }}</td>
                <td class="p-3 border">{{ $k->nama_kelas }}</td>
                <td class="p-3 border">
                    <img src="{{ asset('uploads/kelas/' . $k->gambar_kelas ) }}" alt="" class="w-100 h-50 object-cover">
                </td>
                <td class="p-3 border flex gap-2">
                    <a href="{{ route('kelas.show', $k->id) }}" class="text-blue-600">Lihat</a>
                    <a href="{{ route('kelas.edit', $k->id) }}" class="text-yellow-600">Edit</a>

                    <form action="{{ route('kelas.destroy', $k->id) }}" method="POST" onclick="return confirm('Hapus kelas?')">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

</x-layouts.admin>
