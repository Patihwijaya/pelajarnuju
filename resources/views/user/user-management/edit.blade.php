<x-layouts.app-user title="Edit Pengguna">
    <div class="max-w-2xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Edit Pengguna</h1>
                <p class="text-sm text-gray-500 mt-1">Perbarui data akun pengguna</p>
            </div>
            <a href="{{ route('user-management.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Kembali</a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <form action="{{ route('user-management.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block mb-2 font-medium text-gray-700">Nama</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="border border-gray-300 p-2 rounded-xl w-full focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none" required>
                    @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-2 font-medium text-gray-700">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="border border-gray-300 p-2 rounded-xl w-full focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none" required>
                    @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-2 font-medium text-gray-700">Nomor Ponsel</label>
                    <input type="text" name="nomor_ponsel" value="{{ old('nomor_ponsel', $user->nomor_ponsel) }}" class="border border-gray-300 p-2 rounded-xl w-full focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none" required>
                    @error('nomor_ponsel') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-2 font-medium text-gray-700">Role</label>
                    <div class="border border-gray-300 rounded-xl p-3 bg-gray-50">
                        @if($user->isSuperAdmin())
                            <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-lg text-sm">Super Admin</span>
                        @elseif($user->isAdmin())
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-lg text-sm">Admin</span>
                        @else
                            <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded-lg text-sm">User</span>
                        @endif

                        @can('super_admin')
                            <select name="role" class="mt-2 border border-gray-300 p-2 rounded-xl w-full bg-white">
                                <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>User</option>
                                <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        @endcan
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block mb-2 font-medium text-gray-700">Password (kosongkan jika tidak diganti)</label>
                    <input type="password" name="password" class="border border-gray-300 p-2 rounded-xl w-full focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('password') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-6">
                    <label class="block mb-2 font-medium text-gray-700">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="border border-gray-300 p-2 rounded-xl w-full focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-xl hover:bg-green-700 transition-colors">Simpan Perubahan</button>
                    <a href="{{ route('user-management.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-xl hover:bg-gray-300 transition-colors">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app-user>
