<x-layouts.admin title="Dashboard Admin">
    <div class="container mx-auto px-4 py-6">
        <div class="max-w-2xl mx-auto bg-white p-8 rounded shadow-md">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Biodata Organisasi: {{ $adminTarget->name }}</h2>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.admins.biodata.update', $adminTarget->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-4">
                    <label for="nama_organisasi" class="block text-gray-700 text-sm font-bold mb-2">Nama Organisasi</label>
                    <input type="text" name="nama_organisasi" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" value="{{ old('nama_organisasi', $biodata->nama_organisasi ?? '') }}" required>
                </div>

                <div class="mb-4">
                    <label for="alamat_sekretariat" class="block text-gray-700 text-sm font-bold mb-2">Alamat Sekretariat</label>
                    <textarea name="alamat_sekretariat" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>{{ old('alamat_sekretariat', $biodata->alamat_sekretariat ?? '') }}</textarea>
                </div>

                <div class="mb-4 flex gap-4">
                    <div class="w-1/3">
                        <label class="block text-gray-700 text-sm font-bold mb-2">No HP Ketua</label>
                        <input type="text" name="nomor_hp_ketua" class="shadow border rounded w-full py-2 px-3 text-gray-700" value="{{ old('nomor_hp_ketua', $biodata->nomor_hp_ketua ?? '') }}">
                    </div>
                    <div class="w-1/3">
                        <label class="block text-gray-700 text-sm font-bold mb-2">No HP Sekretaris</label>
                        <input type="text" name="nomor_hp_sekretaris" class="shadow border rounded w-full py-2 px-3 text-gray-700" value="{{ old('nomor_hp_sekretaris', $biodata->nomor_hp_sekretaris ?? '') }}">
                    </div>
                    <div class="w-1/3">
                        <label class="block text-gray-700 text-sm font-bold mb-2">No HP Bendahara</label>
                        <input type="text" name="nomor_hp_bendahara" class="shadow border rounded w-full py-2 px-3 text-gray-700" value="{{ old('nomor_hp_bendahara', $biodata->nomor_hp_bendahara ?? '') }}">
                    </div>
                </div>

                <div class="mb-4 flex gap-4">
                    <div class="w-1/2">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Logo / Foto Profil Organisasi</label>
                        <input type="file" name="foto_profil" class="shadow border rounded w-full py-2 px-3 text-gray-700" accept="image/*">
                        <div class="border border-gray-200 p-5 rounded-lg flex items-center gap-4">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center overflow-hidden shrink-0 border">
                                @if(isset($biodata->foto_profil) && $biodata->foto_profil)
                                    <img src="{{ asset('uploads/profil/'.$biodata->foto_profil) }}" alt="Logo" class="w-full h-full object-cover">
                                @else
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                @endif
                            </div>
                            <div>
                                <span class="block text-sm font-bold text-gray-700">Logo Organisasi</span>
                                @if(isset($biodata->foto_profil) && $biodata->foto_profil)
                                    <span class="text-xs font-medium text-green-600">✓ Sudah Terunggah</span>
                                @else
                                    <span class="text-xs text-red-500">Belum ada logo</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="w-1/2">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Upload SK (PDF/Gambar)</label>
                        <input type="file" name="upload_sk" class="shadow border rounded w-full py-2 px-3 text-gray-700" accept=".pdf,image/*">
                        <div>
                            <span class="block text-sm font-bold text-gray-700">Surat Keputusan (SK)</span>
                            @if(isset($biodata->upload_sk) && $biodata->upload_sk)
                                <a href="{{ asset('uploads/sk/'.$biodata->upload_sk) }}" target="_blank" class="text-sm font-medium text-blue-600 hover:underline">Lihat Dokumen</a>
                            @else
                                <span class="text-xs text-red-500">Belum ada SK terunggah</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between mt-8">
                    <a href="{{ route('admin.admins.index') }}" class="text-gray-600 hover:text-gray-800 font-semibold">Kembali</a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Simpan Biodata
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.admin>
