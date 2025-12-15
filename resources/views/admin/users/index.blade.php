<x-layouts.admin title="Dashboard Admin">
<div class="container mx-auto mt-6">
    <h1 class="text-2xl font-bold mb-4">Daftar User</h1>

    @if(session('success'))
        <div class="p-3 mb-4 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif


    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">No</th>
                <th class="border p-2">Nama</th>
                <th class="border p-2">Email</th>
                <th class="border p-2">Nomor Ponsel</th>
                <th class="border p-2">Asal</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $index => $user)
            <tr>
                <td class="border p-2">{{ $index + 1 }}</td>
                <td class="border p-2">{{ $user->profil->username ?? $user->name }}</td>
                <td class="border p-2">{{ $user->email }}</td>
                <td class="border p-2">{{ $user->nomor_ponsel }}</td>
                <td class="border p-2">{{ $user->profil->asal ?? '-' }}</td>
                <td class="border p-2">
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus user ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 ml-2">Hapus</button>
                        <a href="{{ route('admin.users.show', $user->id) }}" class="text-blue-600">Detail</a>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</x-layouts.admin>
