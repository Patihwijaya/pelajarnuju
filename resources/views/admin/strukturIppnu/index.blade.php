<x-layouts.admin title="Dashboard Admin">
<div class="max-w-5xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Pengurus IPPNU</h1>
        <a href="{{ route('admin.strukturIppnu.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
            + Tambah Pengurus IPPNU
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
                <th class="p-3 border">No</th>
                <th class="p-3 border">Nama Pengurus</th>
                <th class="p-3 border">Jabatan</th>
                <th class="p-3 border">instagram</th>
                <th class="p-3 border">Foto</th>
                <th class="p-3 border text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($strukturIppnu as $key => $strukturIppnu)
            @php
                $username = getInstagramUsername($strukturIppnu->instagram);
            @endphp
                <tr class="hover:bg-gray-50">
                    <td class="p-3 border">{{ $key + 1 }}</td>
                    <td class="p-3 border">{{ $strukturIppnu->nama }}</td>
                    <td class="p-3 border">{{ $strukturIppnu->jabatan }}</td>
                    <td class="p-3 border">
                        <a href="{{ $strukturIppnu->instagram }}" target="_blank" class="text-blue-600 hover:underline">
                            {{ $username ?? 'tidak ada' }}
                        </a>
                    </td>
                    @if ($strukturIppnu->gambar)
                    <td class="p-3 border">
                        <img src="{{ asset('uploads/strukturIppnu/' . $strukturIppnu->gambar) }}" class="w-20 h-30 object-cover mx-auto">
                    </td>

                    @endif
                    {{-- <td class="p-3 border">{{ $strukturIppnu->created_at->format('d M Y') }}</td> --}}
                    <td class="p-3 border text-center">
                        <a href="{{ route('admin.strukturIppnu.edit', $strukturIppnu->id) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                        <form action="{{ route('admin.strukturIppnu.destroy', $strukturIppnu->id) }}" method="POST" class="inline-block"
                            onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center p-4 text-gray-500">Belum ada data pengurus.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
</x-layouts.admin>
