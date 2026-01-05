<x-layouts.admin title="Dashboard Admin">

<div class="">
    <h3 class="font-bold text-xl">Detail Pengajuan SK IPNU</h3>
@if ($pengajuan->isNotEmpty())
    @foreach ($pengajuan as $item)
    <div class="p-5 rounded-lg border-2 border-gray-300 mt-5">
            <div class="flex flex-col gap-3 mb-3">
                <h1 class="font-bold text-md">Detail Pengajuan</h1>
                <span class="text-lg p-2 rounded-xl w-50 text-center text-white
                    @if($item->status=='diproses') bg-yellow-500
                    @elseif($item->status=='dikembalikan') bg-red-500
                    @else bg-green-500 @endif">
                    {{ strtoupper($item->status) }}
                </span>
            </div>

            <div class="">
                <table class="w-full">
                    <tr><th class="border w-80 p-2 text-start">Nama</th><td class="border p-2">{{ $item->nama }}</td></tr>
                    <tr><th class="border text-start p-2">No HP</th><td class="border p-2">{{ $item->no_hp }}</td></tr>
                    <tr><th class="border text-start p-2">Asal</th><td class="border p-2">{{ $item->asal }}</td></tr>

                    @php
                    $berkas = [
                        'surat_permhonan_pengesahan' => 'Surat Permohonan Pengesahan',
                        'berita_acara_hasil_konferensi' => 'Berita Acara Hasil Konferensi',
                        'berita_acara_penyusunan_pengurus' => 'Berita Acara Penyusunan Pengurus',
                        'lampiran_susunan_pengurus' => 'Lampiran Susunan Pengurus',
                        'surat_rekomendasi_mwcnu_prnu' => 'Surat Rekomendasi MWCNU / PRNU',
                        'surat_rekomendasi_pac' => 'Surat Rekomendasi PAC (Opsional)',
                        'cv' => 'CV',
                        'biodata' => 'Biodata',
                        'surat_pernyataan' => 'Surat Pernyataan',
                        'hasil_konferensi' => 'Hasil Konferensi',
                        'lpj' => 'LPJ',
                        'profil' => 'Profil'
                    ];
                    @endphp

                    @foreach($berkas as $field => $label)
                        <tr>
                            <th class="border text-start p-2">{{ $label }}</th>
                            <td class="border">
                                @if($item->$field)
                                    <a class="text-blue-500 hover:underline p-2"
                                    href="{{ asset($item->$field) }}"
                                    target="_blank">Lihat File</a>
                                @else
                                    <span class="text-red-500 p-2">Belum Upload</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    <tr>
                        <th class="border text-start p-2">Catatan Pengembalian</th>
                        <td class="border p-2">
                            @if($item->catatan)
                                <div class="alert alert-danger">{{ $item->catatan }}</div>
                            @else
                                <span class="text-red-500 text-xl">-</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>

            <div class="flex gap-3 text-white my-5">
                @if($item->status != 'diterima')
                <form action="{{ route('admin.pengajuanSkIpnu.updateStatus', $item->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="status" value="diterima">
                    <button class="bg-green-500 hover:bg-green-800 rounded-lg p-3">Terima</button>
                </form>
                @endif

                @if($item->status != 'dikembalikan')
                <button class="bg-red-500 p-3 hover:bg-red-800 rounded-lg" data-bs-toggle="modal" data-bs-target="#modalKembalikan">Kembalikan</button>
                @endif
                <form action="{{ route('admin.pengajuanSkIpnu.destroy', $item->id) }}" method="POST" class="inline-block"
                        onsubmit="return confirm('Yakin ingin menghapus pengajuan ini?')">
                        @csrf
                        @method('DELETE')
                    <button type="submit" class="bg-red-500 p-3 hover:bg-red-800 rounded-lg">Hapus</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Kembalikan -->
    <div class="border-2 border-gray-300 p-5 rounded-lg mt-5" id="modalKembalikan">
    <div class="">
        <div class="">
        <form action="{{ route('admin.pengajuanSkIpnu.updateStatus', $item->id) }}" method="POST">
            @csrf
            <input type="hidden" name="status" value="dikembalikan" class="w-full border">
            <div class="modal-header">
                <h5 class="font-bold text-xl">Kembalikan Pengajuan</h5>
            </div>
            <div class="modal-body">
            <label class="text-gray-500">Catatan Perbaikan:</label>
            <textarea name="catatan" class="w-full border rounded-lg p-2" rows="4" required></textarea>
            </div>
            <div class="flex gap-2 text-white">
            <button class="bg-sky-500 hover:bg-sky-800 rounded-lg p-3" data-bs-dismiss="modal">Batal</button>
            <button class="bg-red-500 hover:bg-red-800 rounded-lg p-3">Kembalikan</button>
            </div>
        </form>
        </div>
    </div>
    </div>
@endforeach
@else
    <div class="w-full p-3 bg-gray-200 rounded-lg text-center mt-5">
        <h1 class="text-red-500 font-bold text-xl">tidak ada pengajuan</h1>
    </div>
@endif

</x-layouts.admin>
