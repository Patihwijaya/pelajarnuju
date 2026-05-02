<table class="min-w-full divide-y divide-gray-200">
    <thead>
        <tr class="bg-gray-200">
            <th class="p-3 border">#</th>
            <th class="p-3 border">Penulis</th>
            <th class="p-3 border">Judul</th>
            <th class="p-3 border">Kategori</th>
            <th class="p-3 border">Klik</th>
            <th class="p-3 border">Tanggal</th>
            <th class="p-3 border text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($artikels as $key => $artikel)
            <tr class="hover:bg-gray-50">
                <td class="p-3 border text-center">{{ $artikels->firstItem() + $key }}</td>
                <td class="p-3 border">{{ $artikel->penulis }}</td>
                <td class="p-3 border">{{ $artikel->judul }}</td>
                <td class="p-3 border capitalize">{{ $artikel->kategori }}</td>
                <td class="p-3 border capitalize">{{ $artikel->lihats }} kali</td>
                <td class="p-3 border">{{ $artikel->created_at->format('d M Y') }}</td>
                <td class="p-3 border text-center">
                    <a href="{{ route('admin.artikel.edit', $artikel->id) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                    <form action="{{ route('admin.artikel.destroy', $artikel->id) }}" method="POST" class="inline-block"
                        onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center p-4 text-gray-500">Belum ada artikel.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<!-- Menampilkan Link Paginasi -->
<div class="mt-4">
    {{ $artikels->links() }}
</div>