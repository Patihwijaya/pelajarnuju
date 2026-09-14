<x-layouts.admin title="Dashboard Admin">
    <div class="container mx-auto px-4 py-6">
        <div class="max-w-2xl mx-auto bg-white p-8 rounded shadow-md">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Data Admin</h2>

            <form action="{{ route('admin.admins.update', $admin->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
                    <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('name', $admin->name) }}" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Alamat Email</label>
                    <input type="email" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('email', $admin->email) }}" required>
                </div>

                <div class="mb-4 flex gap-4">
                    <div class="w-1/2">
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password Baru (Opsional)</label>
                        <input type="password" name="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Kosongkan jika tidak diubah">
                    </div>
                    <div class="w-1/2">
                        <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                </div>

                <div class="mb-4 flex gap-4">
                    <div class="w-1/2">
                        <label for="role" class="block text-gray-700 text-sm font-bold mb-2">Role</label>
                        <select name="role" id="role" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="admin" {{ $admin->role == 'admin' ? 'selected' : '' }}>Admin (PAC)</option>
                            <option value="super_admin" {{ $admin->role == 'super_admin' ? 'selected' : '' }}>Super Admin (PC)</option>
                        </select>
                    </div>
                    
                    <div class="w-1/2">
                        <label for="asal" class="block text-gray-700 text-sm font-bold mb-2">Asal PAC</label>
                        <select name="asal" id="asal" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="">-- Kosongkan Jika PC --</option>
                            <option value="Cilincing" {{ $admin->asal == 'Cilincing' ? 'selected' : '' }}>PAC Cilincing</option>
                            <option value="Koja" {{ $admin->asal == 'Koja' ? 'selected' : '' }}>PAC Koja</option>
                            <option value="Kelapa Gading" {{ $admin->asal == 'Kelapa Gading' ? 'selected' : '' }}>PAC Kelapa Gading</option>
                            <option value="Tanjung Priok" {{ $admin->asal == 'Tanjung Priok' ? 'selected' : '' }}>PAC Tanjung Priok</option>
                            <option value="Pademangan" {{ $admin->asal == 'Pademangan' ? 'selected' : '' }}>PAC Pademangan</option>
                            <option value="Penjaringan" {{ $admin->asal == 'Penjaringan' ? 'selected' : '' }}>PAC Penjaringan</option>
                        </select>
                    </div>
                </div>

                <div class="flex items-center justify-between mt-8">
                    <a href="{{ route('admin.admins.index') }}" class="text-gray-600 hover:text-gray-800 font-semibold">Batal</a>
                    <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Update Akun
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.admin>
