<x-layouts.admin title="Dashboard Admin">
<div class="max-w-5xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Kegiatan</h1>
        <a href="{{ route('admin.kegiatan.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
            + Tambah Kegiatan
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-3 border">#</th>
                <th class="p-3 border">Judul</th>
                <th class="p-3 border">Tanggal</th>
                <th class="p-3 border text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kegiatan as $key => $kegiatan)
                <tr class="hover:bg-gray-50">
                    <td class="p-3 border">{{ $key + 1 }}</td>
                    <td class="p-3 border">{{ $kegiatan->judul }}</td>
                    <td class="p-3 border">{{ $kegiatan->created_at->format('d M Y') }}</td>
                    <td class="p-3 border text-center">
                        <a href="{{ route('admin.kegiatan.edit', $kegiatan->id) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                        <form action="{{ route('admin.kegiatan.destroy', $kegiatan->id) }}" method="POST" class="inline-block"
                            onsubmit="return confirm('Yakin ingin menghapus kegiatan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center p-4 text-gray-500">Belum ada Kegiatan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
</x-layouts.admin>
