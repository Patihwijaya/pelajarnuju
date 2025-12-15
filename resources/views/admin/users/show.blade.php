<x-layouts.admin title="Dashboard Admin">
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-semibold mb-4">Detail Profil User</h2>

    <div class="grid grid-cols-2 gap-4">
        <p><strong>Nama:</strong> {{ $user->profil->username ?? $user->name }}</p>
        <p><strong>NIK:</strong> {{ $user->profil->nik ?? '-' }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Nomor Ponsel:</strong> {{ $user->nomor_ponsel ?? '-' }}</p>
        <p><strong>Asal:</strong> {{ $user->profil->asal ?? '-' }}</p>
        <p><strong>Tempat Lahir:</strong> {{ $user->profil->tempat_lahir ?? '-' }}</p>
        <p><strong>Tanggal Lahir:</strong> {{ $user->profil->tanggal_lahir ?? '-' }}</p>
        <p><strong>Kecamatan:</strong> {{ $user->profil->kecamatan ?? '-' }}</p>
        <p><strong>Kelurahan:</strong> {{ $user->profil->kelurahan ?? '-' }}</p>
        <p><strong>Hobi:</strong> {{ $user->profil->hobi ?? '-' }}</p>
    </div>

    @if ($user->profil->foto_profil)
        <div class="mt-4">
            <strong>Foto Profil:</strong><br>
            <img src="{{ asset('uploads/foto_profil/' . $user->profil->foto_profil) }}" class="w-32 h-32 object-cover rounded-lg">
        </div>
    @else
        <div class="mt-4">
            <h1>tidak ada foto profile</h1>
        </div>
    @endif

    @if ($user->profil->sertifikat_kaderisasi)
        <div class="mt-4">
            <strong>Sertifikat Kaderisasi:</strong><br>
            <a href="{{ asset('uploads/sertifikat_kaderisasi/' . $user->profil->sertifikat_kaderisasi) }}" target="_blank" class="text-blue-600 underline">Lihat Sertifikat</a>
        </div>
    @endif

    <div class="mt-6">
        <a href="{{ route('admin.users.index') }}" class="bg-gray-700 text-white px-4 py-2 rounded">Kembali</a>
    </div>
</div>
</x-layouts.admin>
