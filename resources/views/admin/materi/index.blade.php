<x-layouts.admin title="Dashboard Admin">

<h2 class="text-xl font-bold mb-4">Materi Kelas: {{ $kelas->nama }}</h2>

<a href="{{ route('admin.materiKelas.create', $kelas->id) }}"
   class="bg-green-600 text-white px-3 py-2 rounded">
   Tambah Materi
</a>

<table class="w-full mt-4 border">
    <tr class="bg-gray-200">
        <th class="p-2">Judul</th>
        <th>Aksi</th>
    </tr>

    @foreach ($materi as $m)
    <tr>
        <td class="p-2">{{ $m->judul }}</td>
        <td class="p-2">
            <a href="{{ route('admin.materiKelas.edit', [$kelas->id, $m->id]) }}"
               class="text-blue-600">Edit</a>

            <form action="{{ route('admin.materiKelas.destroy', [$kelas->id, $m->id]) }}"
                  method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Hapus materi?')" class="text-red-600 ml-3">
                    Hapus
                </button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

</x-layouts.admin>
