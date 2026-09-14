<x-layouts.admin title="Edit User">
<div class="max-w-2xl mx-auto mt-10 p-6 bg-white shadow rounded">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Edit User</h2>
        <a href="{{ route('admin.users.index') }}" class="text-gray-600 hover:text-gray-800 text-sm">← Kembali</a>
    </div>

    @if(session('success'))
        <div class="p-3 mb-4 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-2 font-medium">Nama</label>
            <input type="text" name="name" class="border p-2 rounded w-full" value="{{ old('name', $user->name) }}" required>
            @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-medium">Email</label>
            <input type="email" name="email" class="border p-2 rounded w-full" value="{{ old('email', $user->email) }}" required>
            @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-medium">Nomor Ponsel</label>
            <input type="text" name="nomor_ponsel" class="border p-2 rounded w-full" value="{{ old('nomor_ponsel', $user->nomor_ponsel) }}" required>
            @error('nomor_ponsel') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-medium">Role</label>
            <div class="border p-2 rounded bg-gray-50">
                @if($user->isSuperAdmin())
                    <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded text-sm">Super Admin</span>
                @elseif($user->isAdmin())
                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm">Admin</span>
                @else
                    <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-sm">User</span>
                @endif

                @can('super_admin')
                    <select name="role" class="mt-2 border p-2 rounded w-full bg-white">
                        <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                @endcan
            </div>
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-medium">Password (kosongkan jika tidak diganti)</label>
            <input type="password" name="password" class="border p-2 rounded w-full">
            @error('password') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-medium">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="border p-2 rounded w-full">
        </div>

        <div class="flex gap-3">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan Perubahan</button>
            <a href="{{ route('admin.users.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Batal</a>
        </div>
    </form>
</div>
</x-layouts.admin>
