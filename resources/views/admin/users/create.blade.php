<x-layouts.admin title="Dashboard Admin">
<div class="max-w-2xl mx-auto mt-10 p-6 bg-white shadow rounded">
    <h2 class="text-2xl font-bold mb-6">Tambah User</h2>

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block mb-2 font-medium">Nama</label>
            <input type="text" name="name" class="border p-2 rounded w-full" value="{{ old('name') }}" required>
            @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-medium">Email</label>
            <input type="email" name="email" class="border p-2 rounded w-full" value="{{ old('email') }}" required>
            @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-medium">Nomor Ponsel</label>
            <input type="text" name="nomor_ponsel" class="border p-2 rounded w-full" value="{{ old('nomor_ponsel') }}" required>
            @error('nomor_ponsel') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-medium">Password</label>
            <input type="password" name="password" class="border p-2 rounded w-full" required>
            @error('password') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-medium">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="border p-2 rounded w-full" required>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
</x-layouts.admin>
