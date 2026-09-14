<x-layouts.admin title="Update Biodata - PAC">
<div class="max-w-3xl mx-auto mt-10 bg-white p-6 md:p-8 rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-3">Update Biodata Saya</h1>

    <!-- Menampilkan Pesan Sukses -->
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Menampilkan Pesan Error Validasi -->
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc ml-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pac.biodata.update') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block font-semibold mb-1 text-gray-700">Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name', $admin->name) }}" class="w-full border border-gray-300 rounded-lg p-2.5 focus:border-blue-500 focus:ring-blue-500" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1 text-gray-700">Email Akun</label>
            <input type="email" name="email" value="{{ old('email', $admin->email) }}" class="w-full border border-gray-300 rounded-lg p-2.5 focus:border-blue-500 focus:ring-blue-500" required>
        </div>

        <div class="mb-4 mt-8">
            <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-3">Keamanan Akun</h3>
            <label class="block font-semibold mb-1 text-gray-700">Password Baru (Opsional)</label>
            <input type="password" name="password" class="w-full border border-gray-300 rounded-lg p-2.5 focus:border-blue-500 focus:ring-blue-500" placeholder="Kosongkan jika tidak ingin mengubah password">
        </div>

        <div class="mb-6">
            <label class="block font-semibold mb-1 text-gray-700">Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation" class="w-full border border-gray-300 rounded-lg p-2.5 focus:border-blue-500 focus:ring-blue-500" placeholder="Ketik ulang password baru">
        </div>

        <div class="flex justify-end pt-4 border-t border-gray-200">
            <a href="{{ route('pac.dashboard') }}" class="bg-gray-200 text-gray-800 px-5 py-2.5 rounded-lg mr-3 hover:bg-gray-300 transition-colors font-medium">Kembali</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg shadow transition-colors font-medium">Simpan Perubahan</button>
        </div>
    </form>
</div>
</x-layouts.admin>