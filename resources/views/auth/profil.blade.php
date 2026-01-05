<x-layouts.pengaturan title="Beranda">

<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-2xl p-8 mt-10">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Lengkapi Profil Anda</h2>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            succes
        </div>
    @endif

    <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        {{-- <pre>{{ var_dump($profil) }}</pre> --}}
        {{-- FOTO PROFIL --}}
        <div class="flex items-center gap-4">
            <img src="{{ $profil->foto_profil ? asset('uploads/foto_profil/' . $profil->foto_profil) : asset('default-avatar.png') }}"
                 class="w-24 h-24 object-cover">
            <div>
                <label class="block text-gray-700 text-sm font-medium">Foto Profil</label>
                <input type="file" name="foto_profil" class="border border-gray-300 rounded-lg p-2 w-full mt-1">
            </div>
        </div>

        {{-- FORM INPUT --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 text-sm font-medium">Username</label>
                <input type="text" name="username" value="{{ old('username', $profil->username) }}" class="border rounded-lg w-full p-2">
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-medium">NIK</label>
                <input type="text" name="nik" value="{{ old('nik', $profil->nik ?? '') }}" class="border rounded-lg w-full p-2">
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-medium">Asal Pimpinan</label>
                <input type="text" name="asal" value="{{ old('asal', $profil->asal) }}" class="border rounded-lg w-full p-2">
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-medium">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $profil->tempat_lahir) }}" class="border rounded-lg w-full p-2">
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-medium">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $profil->tanggal_lahir) }}" class="border rounded-lg w-full p-2">
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-medium">Kecamatan</label>
                <input type="text" name="kecamatan" value="{{ old('kecamatan', $profil->kecamatan) }}" class="border rounded-lg w-full p-2">
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-medium">Kelurahan</label>
                <input type="text" name="kelurahan" value="{{ old('kelurahan', $profil->kelurahan) }}" class="border rounded-lg w-full p-2">
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-medium">Hobi</label>
                <input type="text" name="hobi" value="{{ old('hobi', $profil->hobi) }}" class="border rounded-lg w-full p-2">
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-medium">Sertifikat Kaderisasi</label>
                <input type="file" name="sertifikat_kaderisasi" class="border rounded-lg w-full p-2">
                 @if($profil->sertifikat_kaderisasi)
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Sertifikat Kaderisasi:</label>
                        <iframe src="{{ asset('uploads/sertifikat_kaderisasi/' . $profil->sertifikat_kaderisasi) }}"
                                class="w-full h-[500px] border" frameborder="0">
                        </iframe>
                        <a href="{{ asset('uploads/sertifikat_kaderisasi/' . $profil->sertifikat_kaderisasi) }}"
                        target="_blank"
                        class="text-blue-600 underline mt-2 inline-block">
                        Lihat di Tab Baru
                        </a>
                    </div>
                @endif
            </div>
        </div>
        <div class="flex justify-end mt-6">
            <button type="submit" class="bg-green-800 text-white px-6 py-2 rounded-lg hover:opacity-90 transition">
                Simpan Perubahan
            </button>
        </div>

    </form>
</div>
</x-layouts.app>
