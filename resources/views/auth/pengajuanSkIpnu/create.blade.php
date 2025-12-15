<x-layouts.app-user title="Pengajuan SK IPNU">

<div class=" py-5">
    <h3 class="mb-4 text-xl font-bold text-center">Form Pengajuan SK</h3>

    @if(session('success'))
        <div class="text-green-500">{{ session('success') }}</div>
    @endif

    <form action="{{ url('/pengajuanSkIpnu') }}" method="POST" enctype="multipart/form-data" class="flex flex-col">
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
        <div class="w-full shadow-lg p-3 my-5 flex flex-col gap-3">
            <h3 class="text-red-500">Contoh Surat Surat</h3>
            <ul>
                <p>Surat Permohonan Pengesahan</p>
                <li class="text-blue-500 underline"><a href="{{ asset('contoh/SPP_PAC.pdf') }}">Pimpinan Anak Cabang</a></li>
                <li class="text-blue-500 underline"><a href="{{ asset('contoh/SPP_PR.pdf') }}">Pimpinan Ranting</a></li>
                <li class="text-blue-500 underline"><a href="{{ asset('contoh/SPP_PK.pdf') }}">Pimpinan Komisariat</a></li>
            </ul>
            <ul>
                <p>Berita Acara Pemilihan Ketua</p>
                <li class="text-blue-500 underline"><a href="{{ asset('contoh/BAPK_RA.pdf') }}">Lihat</a></li>
            </ul>
            <ul>
                <p>Berita Acara Rapat Formatur</p>
                <li class="text-blue-500 underline"><a href="{{ asset('contoh/BAPK.pdf') }}">Lihat</a></li>
            </ul>
            <ul>
                <p>Lampiran Susunan Pengurus</p>
                <li class="text-blue-500 underline"><a href="{{ asset('contoh/LSP.pdf') }}">Lihat</a></li>
            </ul>
            <ul>
                <p>Curriculum Vitae</p>
                <li class="text-blue-500 underline"><a href="{{ asset('contoh/CV.pdf') }}">Lihat</a></li>
            </ul>
            <ul>
                <p>Biodata</p>
                <li class="text-blue-500 underline"><a href="{{ asset('contoh/Biodata.pdf') }}">Lihat</a></li>
            </ul>
            <ul>
                <p>Surat Pernyataan Kesediaan Menjadi Pengurus</p>
                <li class="text-blue-500 underline"><a href="{{ asset('contoh/SPKP.pdf') }}">Lihat</a></li>
            </ul>
            <ul>
                <p>Profil</p>
                <li class="text-blue-500 underline"><a href="{{ asset('contoh/Profil.pdf') }}">Lihat</a></li>
            </ul>
        </div>

        @php
        $files = [
            'surat_permhonan_pengesahan' => 'Surat Permohonan Pengesahan *',
            'berita_acara_hasil_konferensi' => 'Berita Acara Pemilihan Ketua *',
            'berita_acara_penyusunan_pengurus' => 'Berita Acara Rapat Formatur *',
            'lampiran_susunan_pengurus' => 'Lampiran Susunan Pengurus *',
            'surat_rekomendasi_mwcnu_prnu' => 'Surat Rekomendasi MWCNU/PRNU *',
            'surat_rekomendasi_pac' => 'Surat Rekomendasi PAC (Tidak Wajib Bagi PAC, Jika yang mengajukan PR, PK maka wajib)',
            'cv' => 'Curriculum Vitae (CV) Ketua, Sekertaris, Bendahara *',
            'biodata' => 'Biodata Ketua, Sekertaris, Bendahara *',
            'surat_pernyataan' => 'Surat Pernyataan Ketua, Sekertaris, Bendahara *',
            'hasil_konferensi' => 'Hasil Konferensi *',
            'lpj' => 'Laporan Pertanggung Jawaban (LPJ) *',
            'profil' => 'Profil *'
        ];
        @endphp

        @foreach($files as $name => $label)
        <div class="mb-3">
            <label>{{ $label }} </label>
            <input
                type="file"
                name="{{ $name }}"
                class="w-full border rounded-md p-2"
                {{ $name != 'surat_rekomendasi_pac' ? 'required' : '' }}
                accept="application/pdf"
            >
            @error($name) <small class="text-red-500">{{ $message }}</small> @enderror
        </div>
        @endforeach

        <button class="bg-green-500 hover:bg-green-800 rounded-lg p-3 text-white">Kirim Pengajuan</button>
    </form>
</div>

</x-layouts.app>
