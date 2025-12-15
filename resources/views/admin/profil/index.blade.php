<x-layouts.admin title="Dashboard Admin">
    <div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-4">Data Profil</h1>

    @if ($profil ?? false)
        <p><strong>judul:</strong> {{ $profil->judul }}</p>
        <p><strong>Konten:</strong> {!! nl2br(e($profil->text)) !!}</p>
        <a href="{{ route('admin.profil.edit', $profil->id) }}" class="text-blue-600">Edit</a>
        <form action="{{ route('admin.profil.destroy', $profil->id) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button class="text-red-600">Hapus</button>
        </form>
    @else
        <a href="{{ route('admin.profil.create') }}" class="text-green-600">Tambah Profil</a>
    @endif
</div>
</x-layouts.admin>
