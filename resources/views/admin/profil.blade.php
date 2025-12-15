<x-layouts.admin title="Dashboard Admin">
<div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Daftar Profil</h2>
        <a href="{{ route('admin.profile.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ Tambah Profil</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">{{ session('success') }}</div>
    @endif

    @forelse($profil as $profile)
        <div class="border p-4 rounded mb-4 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                @if($profile->foto)
                    <img src="{{ asset('storage/'.$profile->foto) }}" alt="Foto" class="w-16 h-16 rounded-full">
                @endif
                <div>
                    <h3 class="font-semibold text-lg">{{ $profile->nama }}</h3>
                    <p class="text-gray-600">{{ $profile->jabatan }}</p>
                </div>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('admin.profile.edit', $profile->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded">Edit</a>
                <form action="{{ route('admin.profile.destroy', $profile->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus profil ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-600 text-white px-3 py-1 rounded">Hapus</button>
                </form>
            </div>
        </div>
    @empty
        <p>Belum ada data profil.</p>
    @endforelse
</div>
</x-layouts.admin>
