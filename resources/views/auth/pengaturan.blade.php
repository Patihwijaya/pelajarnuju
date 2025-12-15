<x-layouts.pengaturan title="Beranda">
<div class="max-w-2xl mx-auto mt-10 p-6 bg-white shadow-lg rounded-lg">

    <h2 class="text-2xl font-semibold mb-6">Pengaturan Profil</h2>

    @if(session('success'))
        <div class="p-3 mb-4 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif

    <form action="{{ route('profil.ubah') }}" method="POST">
        @csrf

        <!-- Email -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Email:</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                   class="border p-2 rounded w-full">
            @error('email')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Nomor Ponsel:</label>
            <input type="text" name="nomor_ponsel" value="{{ old('nomor_ponsel', $user->nomor_ponsel ?? '') }}" class="border p-2 rounded w-full">

        </div>

        <!-- Password -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Password Baru:</label>
            <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah"
                   class="border p-2 rounded w-full">
            @error('password')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Konfirmasi Password -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Konfirmasi Password:</label>
            <input type="password" name="password_confirmation" placeholder="Ulangi password baru"
                   class="border p-2 rounded w-full">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Perubahan</button>
    </form>

</div>
</x-layouts.app>
