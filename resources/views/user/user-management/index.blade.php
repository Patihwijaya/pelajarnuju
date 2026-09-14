<x-layouts.app-user title="Kelola Pengguna">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Kelola Pengguna</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola akun pengguna sesuai hak akses Anda</p>
        </div>
        @can('create', App\Models\User::class)
            <a href="{{ route('user-management.create') }}" class="inline-flex items-center gap-2 bg-green-600 text-white px-4 py-2 rounded-xl hover:bg-green-700 transition-colors">
                + Tambah Pengguna
            </a>
        @endcan
    </div>

    @if(session('success'))
        <div class="p-3 mb-4 bg-green-100 text-green-800 rounded-xl">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="p-3 mb-4 bg-red-100 text-red-800 rounded-xl">{{ session('error') }}</div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 text-left text-xs uppercase tracking-wide text-gray-500">
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Nomor Ponsel</th>
                        <th class="px-4 py-3">Role</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($users as $index => $user)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-4 py-3 text-sm text-gray-600">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $user->profil->username ?? $user->name }}</td>
                        <td class="px-4 py-3 text-sm text-gray-600">{{ $user->email }}</td>
                        <td class="px-4 py-3 text-sm text-gray-600">{{ $user->nomor_ponsel }}</td>
                        <td class="px-4 py-3">
                            @if($user->isSuperAdmin())
                                <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-lg text-xs font-medium">Super Admin</span>
                            @elseif($user->isAdmin())
                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-lg text-xs font-medium">Admin</span>
                            @else
                                <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded-lg text-xs font-medium">User</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-right">
                            @can('update', $user)
                                <div class="inline-flex items-center gap-2">
                                    <a href="{{ route('user-management.edit', $user->id) }}" class="text-green-600 hover:text-green-800 text-sm font-medium">Edit</a>
                                    <form action="{{ route('user-management.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus pengguna ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">Hapus</button>
                                    </form>
                                </div>
                            @endcan
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-gray-400 text-sm">Belum ada pengguna</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app-user>
