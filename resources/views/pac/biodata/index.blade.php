<x-layouts.admin title="Biodata Organisasi">
<div class="max-w-4xl mx-auto mt-10 bg-white p-6 md:p-10 rounded-lg shadow-sm border border-gray-100 relative">
    
    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 border-b pb-4">
        <h1 class="text-2xl font-bold text-gray-800">Biodata Organisasi: {{ $admin->name }}</h1>
        <button type="button" id="btn-edit" class="mt-4 md:mt-0 bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-2 px-5 rounded inline-flex items-center gap-2 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
            Edit Biodata
        </button>
    </div>

    <!-- 1. TAMPILAN STATIS -->
    <div id="static-view" class="space-y-6">
        <div class="bg-gray-50 border border-gray-200 p-6 rounded-lg grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <span class="block text-sm font-semibold text-gray-500 mb-1">Nama Organisasi</span>
                <span class="block text-lg font-medium text-gray-900">{{ $biodata->nama_organisasi ?? $admin->name }}</span>
            </div>

            <div class="md:col-span-2">
                <span class="block text-sm font-semibold text-gray-500 mb-1">Alamat Sekretariat</span>
                <span class="block text-base text-gray-900 whitespace-pre-line">{{ $biodata->alamat_sekretariat ?? 'Belum diisi' }}</span>
            </div>

            <div>
                <span class="block text-sm font-semibold text-gray-500 mb-1">No HP Ketua</span>
                <span class="block text-base text-gray-900">{{ $biodata->nomor_hp_ketua ?? 'Belum diisi' }}</span>
            </div>

            <div>
                <span class="block text-sm font-semibold text-gray-500 mb-1">No HP Sekretaris</span>
                <span class="block text-base text-gray-900">{{ $biodata->nomor_hp_sekretaris ?? 'Belum diisi' }}</span>
            </div>

            <div>
                <span class="block text-sm font-semibold text-gray-500 mb-1">No HP Bendahara</span>
                <span class="block text-base text-gray-900">{{ $biodata->nomor_hp_bendahara ?? 'Belum diisi' }}</span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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

            <div class="border border-gray-200 p-5 rounded-lg flex items-center gap-4">
                <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center shrink-0 border">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
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
    </div>

    <!-- 2. TAMPILAN FORM EDIT -->
    <form id="edit-form" action="{{ route('pac.biodata.update') }}" method="POST" enctype="multipart/form-data" class="hidden">
        @csrf

        <div class="mb-5">
            <label class="block font-bold mb-2 text-gray-700 text-sm">Nama Organisasi</label>
            <input type="text" name="nama_organisasi" value="{{ old('nama_organisasi', $biodata->nama_organisasi ?? $admin->name) }}" class="w-full border border-gray-300 rounded p-2.5 text-gray-700 focus:outline-none focus:border-blue-500" required>
        </div>

        <div class="mb-5">
            <label class="block font-bold mb-2 text-gray-700 text-sm">Alamat Sekretariat</label>
            <textarea name="alamat_sekretariat" rows="4" class="w-full border border-gray-300 rounded p-2.5 text-gray-700 focus:outline-none focus:border-blue-500" required>{{ old('alamat_sekretariat', $biodata->alamat_sekretariat ?? '') }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-5">
            <div>
                <label class="block font-bold mb-2 text-gray-700 text-sm">No HP Ketua</label>
                <input type="text" name="nomor_hp_ketua" value="{{ old('nomor_hp_ketua', $biodata->nomor_hp_ketua ?? '') }}" class="w-full border border-gray-300 rounded p-2.5 text-gray-700 focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <label class="block font-bold mb-2 text-gray-700 text-sm">No HP Sekretaris</label>
                <input type="text" name="nomor_hp_sekretaris" value="{{ old('nomor_hp_sekretaris', $biodata->nomor_hp_sekretaris ?? '') }}" class="w-full border border-gray-300 rounded p-2.5 text-gray-700 focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <label class="block font-bold mb-2 text-gray-700 text-sm">No HP Bendahara</label>
                <input type="text" name="nomor_hp_bendahara" value="{{ old('nomor_hp_bendahara', $biodata->nomor_hp_bendahara ?? '') }}" class="w-full border border-gray-300 rounded p-2.5 text-gray-700 focus:outline-none focus:border-blue-500">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-8">
            <div class="bg-gray-50 p-4 border border-gray-200 rounded-lg">
                <label class="block font-bold mb-2 text-gray-700 text-sm">Logo / Foto Profil Organisasi</label>
                <input type="file" name="foto_profil" class="w-full border border-gray-300 rounded p-2 text-gray-700 focus:outline-none focus:border-blue-500 bg-white mb-2" accept="image/*">
                @if(isset($biodata->foto_profil) && $biodata->foto_profil)
                    <p class="text-xs text-green-600 font-semibold">✓ File saat ini sudah terunggah.</p>
                @else
                    <p class="text-xs text-gray-500">* Biarkan kosong jika tidak ingin mengubah</p>
                @endif
            </div>
            <div class="bg-gray-50 p-4 border border-gray-200 rounded-lg">
                <label class="block font-bold mb-2 text-gray-700 text-sm">Upload SK (PDF/Gambar)</label>
                <input type="file" name="upload_sk" class="w-full border border-gray-300 rounded p-2 text-gray-700 focus:outline-none focus:border-blue-500 bg-white mb-2" accept=".pdf, image/*">
                @if(isset($biodata->upload_sk) && $biodata->upload_sk)
                    <p class="text-xs text-green-600 font-semibold">✓ SK saat ini sudah terunggah.</p>
                @else
                    <p class="text-xs text-gray-500">* Biarkan kosong jika tidak ingin mengubah</p>
                @endif
            </div>
        </div>

        <div class="flex justify-between items-center mt-6 pt-5 border-t">
            <button type="button" id="btn-batal" class="text-gray-600 hover:text-gray-900 font-medium transition-colors py-2.5 px-4 bg-gray-100 hover:bg-gray-200 rounded">Batal Edit</button>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Simpan Biodata</button>
        </div>
    </form>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const staticView = document.getElementById('static-view');
            const editForm   = document.getElementById('edit-form');
            const btnEdit    = document.getElementById('btn-edit');
            const btnBatal   = document.getElementById('btn-batal');

            function switchToEdit() {
                staticView.classList.add('hidden');
                editForm.classList.remove('hidden');
                btnEdit.classList.add('hidden');
            }

            function switchToStatic() {
                editForm.classList.add('hidden');
                staticView.classList.remove('hidden');
                btnEdit.classList.remove('hidden');
            }

            btnEdit.addEventListener('click', switchToEdit);
            btnBatal.addEventListener('click', switchToStatic);

            @if ($errors->any())
                switchToEdit();
                let errorHtml = '<ul class="text-left text-sm text-red-600 list-disc pl-5 mt-2 space-y-1">';
                @foreach ($errors->all() as $error)
                    errorHtml += '<li>{{ $error }}</li>';
                @endforeach
                errorHtml += '</ul>';

                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Menyimpan',
                    html: errorHtml,
                    confirmButtonText: 'Perbaiki',
                    confirmButtonColor: '#d33',
                    customClass: { popup: 'rounded-xl' }
                });
            @endif

            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session("success") }}',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#1f5ce6',
                    timer: 3000
                });
            @endif
        });
    </script>
@endpush
</x-layouts.admin>