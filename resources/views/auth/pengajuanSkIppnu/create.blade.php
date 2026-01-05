<x-layouts.app-user title="Pengajuan SK IPNU">

<div class=" py-5">
    <h3 class="mb-4 text-xl font-bold text-center">Form Pengajuan SK IPPNU</h3>

    @if(session('success'))
        <div class="text-green-500">{{ session('success') }}</div>
    @endif

    <form action="{{ url('/pengajuanSkIppnu') }}" method="POST" enctype="multipart/form-data" class="flex flex-col">
        @csrf

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" value="{{ old('nama') }}" class="w-full border rounded-md p-2" required>
            @error('nama') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Nomor HP</label>
            <input type="text" name="no_hp" value="{{ old('no_hp') }}" class="w-full border rounded-md p-2" required>
            @error('no_hp') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Asal</label>
            <input type="text" name="asal" value="{{ old('asal') }}" class="w-full border rounded-md p-2" required>
            @error('asal') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <hr>
        <h5 class="mt-4 mb-3 font-bold">Upload Berkas (PDF)</h5>
        @php
        $files = [
            'surat_permohonan_pengesahan' => 'Surat Permohonan Pengesahan *',
            'berita_acara_surat_keputusan_konferensi' => 'Berita Acara Pemilihan Ketua *',
            'berita_acara_penyusunan_pengurus_oleh_tim_formatur' => 'Berita Acara Penyusunan Pengurus oleh Formatur *',
            'berita_acara_penyusunan_pengurus_oleh_pengurus_harian' => 'Berita Acara Penyusunan Pengurus oleh Pengurus Harian *',
            'susunan_pengurus_lengkap' => 'Susunan Pengurus Lengkap *',
            'foto_kartu_identitas_pengurus_harian_dan_ketua_lembaga' => 'Foto Kartu identitas Pengurus Harian dan Ketua Lembaga *',
            'surat_rekomendasi_mwcnu_atau_prnu' => 'Surat Rekomendasi MWCNU, PRNU, atau Banom NU Setempat *',
            'surat_rekomendasi_pimpinan_lembaga_pendidikan' => 'Surat Rekomendasi Pimpinan Lembaga Pendidika (Wajib Untuk PK)',
            'surat_rekomendasi_pac_ippnu' => 'Surat Rekomendasi PAC IPPNU (Wajib untuk PR dan PK)',
        ];
        @endphp

        @foreach($files as $name => $label)
        <div class="mb-3">
            <label>{{ $label }} </label>
            <input
                type="file"
                name="{{ $name }}"
                class="w-full border rounded-md p-2"
                {{ !in_array($name, ['surat_rekomendasi_pac_ippnu', 'surat_rekomendasi_pimpinan_lembaga_pendidikan']) ? 'required' : '' }}
                accept="application/pdf"
            >
            @error($name) <small class="text-red-500">{{ $message }}</small> @enderror
        </div>
        @endforeach

        <button class="bg-green-500 hover:bg-green-800 rounded-lg p-3 text-white">Kirim Pengajuan</button>
    </form>
</div>

</x-layouts.app>
