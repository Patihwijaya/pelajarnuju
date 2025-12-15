<x-layouts.admin title="Dashboard Admin">

<div class="container mx-auto p-6">

    <div class="flex justify-between mb-4">
        <h1 class="text-2xl font-bold">Kelas: {{ $kela->nama_kelas }}</h1>
        <div class="flex gap-2">
            <a href="{{ route('materi.create', $kela->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded">
                Tambah Materi
            </a>
            <a href="/admin/kelas" class="bg-gray-600 text-white px-4 py-2 rounded">
                kembali
            </a>
        </div>
    </div>

    <table class="w-full border">
        <thead>
        <tr class="bg-gray-200">
            <th class="p-3 border">No</th>
            <th class="p-3 border">Judul Materi</th>
            <th class="p-3 border">Aksi</th>
        </tr>
        </thead>

        <tbody>
            @foreach ($kela->materis as $m)
            <tr>
                <td class="p-3 border">{{ $loop->iteration }}</td>
                <td class="p-3 border">{{ $m->judul_materi }}</td>
                <td class="p-3 border flex gap-2">
                    <a href="{{ route('materi.show', [$kela->id, $m->id]) }}" class="text-blue-600">Lihat Materi</a>
                    <a href="{{ route('materi.edit', [$kela->id, $m->id]) }}" class="text-yellow-600">Edit</a>

                    <form action="{{ route('materi.destroy', ['kela' => $kela->id, 'materis' => $m->id]) }}" method="POST"
                          onclick="return confirm('Hapus materi?')">
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
