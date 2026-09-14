<x-layouts.app-user title="Tambah Pengguna">
    <div class="max-w-2xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Tambah Pengguna</h1>
                <p class="text-sm text-gray-500 mt-1">Buat akun pengguna baru</p>
            </div>
            <a href="{{ route('user-management.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Kembali</a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <form action="{{ route('user-management.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block mb-2 font-medium text-gray-700">Nama</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="border border-gray-300 p-2 rounded-xl w-full focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none" required>
                    @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-2 font-medium text-gray-700">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="border border-gray-300 p-2 rounded-xl w-full focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none" required>
                    @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-2 font-medium text-gray-700">Nomor Ponsel</label>
                    <input type="text" name="nomor_ponsel" value="{{ old('nomor_ponsel') }}" class="border border-gray-300 p-2 rounded-xl w-full focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none" required>
                    @error('nomor_ponsel') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-2 font-medium text-gray-700">Password</label>
                    <input type="password" name="password" class="border border-gray-300 p-2 rounded-xl w-full focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none" required>
                    @error('password') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-6">
                    <label class="block mb-2 font-medium text-gray-700">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="border border-gray-300 p-2 rounded-xl w-full focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none" required>
                </div>

                @can('super_admin')
                    <div class="mb-6">
                        <label class="block mb-2 font-medium text-gray-700">Role</label>
                        <select name="role" class="border border-gray-300 p-2 rounded-xl w-full bg-white focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                            <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>User</option>
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>
                @endcan

                <div class="flex gap-3">
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-xl hover:bg-green-700 transition-colors">Simpan</button>
                    <a href="{{ route('user-management.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-xl hover:bg-gray-300 transition-colors">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app-user>
