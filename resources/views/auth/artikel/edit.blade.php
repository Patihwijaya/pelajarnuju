<x-layouts.app-user title="Edit Artikel - Pelajarnuju">
    <div class="max-w-5xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        
        <!-- HEADER & TOMBOL KEMBALI -->
        <div class="mb-6">
            <a href="{{ route('user.artikel.index') }}" class="text-[#083C30] dark:text-[#3BD59C] hover:underline flex items-center gap-1 text-sm font-medium mb-3 transition-colors w-fit">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Daftar Artikel
            </a>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Edit Artikel</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Perbarui ide, opini, atau liputan kegiatan Anda.</p>
        </div>

        <x-alert-modal />

        <!-- FORM CONTAINER -->
        <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl p-6 md:p-8 border border-gray-100 dark:border-gray-700">
            <form action="{{ route('user.artikel.update', $artikel->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- INPUT JUDUL -->
                    <div class="md:col-span-2">
                        <label for="judul" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul Artikel <span class="text-red-500">*</span></label>
                        <input type="text" name="judul" id="judul" value="{{ old('judul', $artikel->title) }}" placeholder="Masukkan judul yang menarik..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#083C30] focus:border-[#083C30] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                    </div>

                    <!-- INPUT PENULIS -->
                    <div>
                        <label for="penulis" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Penulis <span class="text-red-500">*</span></label>
                        <input type="text" name="penulis" id="penulis" value="{{ old('penulis', $artikel->penulis) }}" readonly class="bg-gray-100 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400 cursor-not-allowed select-none">
                    </div>

                    <!-- INPUT KATEGORI -->
                    <div>
                        <label for="kategori" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori <span class="text-red-500">*</span></label>
                        <select name="kategori" id="kategori" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#083C30] focus:border-[#083C30] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            <option value="" disabled>-- Pilih Kategori --</option>
                            <option value="Berita" {{ old('kategori', $artikel->kategori) == 'Berita' ? 'selected' : '' }}>Berita / Liputan</option>
                            <option value="Opini" {{ old('kategori', $artikel->kategori) == 'Opini' ? 'selected' : '' }}>Opini / Esai</option>
                            <option value="Sastra" {{ old('kategori', $artikel->kategori) == 'Sastra' ? 'selected' : '' }}>Sastra (Puisi/Cerpen)</option>
                            <option value="Keislaman" {{ old('kategori', $artikel->kategori) == 'Keislaman' ? 'selected' : '' }}>Kajian Keislaman</option>
                            <option value="Organisasi" {{ old('kategori', $artikel->kategori) == 'Organisasi' ? 'selected' : '' }}>Organisasi</option>
                        </select>
                    </div>
                </div>

                <!-- INPUT GAMBAR SAMPUL -->
                <!-- Menarik gambar lama secara otomatis jika ada ke dalam Alpine.js -->
                <div x-data="{ imagePreview: {{ $artikel->gambar ? "'" . asset('uploads/artikel/' . $artikel->gambar) . "'" : 'null' }} }">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar Sampul (Thumbnail)</label>
                    <div class="flex items-center justify-center w-full">
                        <label for="gambar" class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 relative overflow-hidden transition-colors">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6" x-show="!imagePreview">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="none" viewBox="0 0 20 16"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/></svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Klik untuk mengubah gambar</span></p>
                            </div>
                            <template x-if="imagePreview">
                                <img :src="imagePreview" class="object-cover w-full h-full absolute inset-0 z-0">
                            </template>
                            <input id="gambar" name="gambar" type="file" class="hidden" accept="image/png, image/jpeg, image/jpg" @change="imagePreview = URL.createObjectURL($event.target.files[0])" />
                        </label>
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Abaikan jika tidak ingin mengubah gambar.</p>
                </div>

                <!-- INPUT ISI ARTIKEL (TINYMCE) -->
                <div>
                    <label for="isi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Isi Artikel <span class="text-red-500">*</span></label>
                    <textarea id="isi" name="isi" rows="15" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300">{{ old('isi', $artikel->content) }}</textarea>
                </div>

                <!-- TOMBOL SUBMIT -->
                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('user.artikel.index') }}" class="text-gray-700 bg-gray-100 hover:bg-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-700 dark:text-gray-300">Batal</a>
                    <button type="submit" class="text-white bg-[#083C30] hover:bg-[#062c23] font-medium rounded-lg text-sm px-5 py-2.5 shadow-md">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- SCRIPT TINYMCE -->
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
            tinymce.init({
                selector: '#isi',
                height: 500,
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | removeformat',
                automatic_uploads: true,
                images_upload_handler: function (blobInfo, progress) {
                    return new Promise((resolve, reject) => {
                        const xhr = new XMLHttpRequest();
                        xhr.open('POST', '{{ route("user.artikel.upload") }}');
                        xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                        
                        xhr.onload = function() {
                            if (xhr.status !== 200) {
                                reject('HTTP Error: ' + xhr.status);
                                return;
                            }
                            const json = JSON.parse(xhr.responseText);
                            if (!json || typeof json.url != 'string') {
                                reject('Invalid JSON: ' + xhr.responseText);
                                return;
                            }
                            resolve(json.url);
                        };
                        
                        const formData = new FormData();
                        formData.append('upload', blobInfo.blob(), blobInfo.filename());
                        xhr.send(formData);
                    });
                },
                content_style: 'body { font-family: ui-sans-serif, system-ui, sans-serif; font-size: 15px; } img { max-width: 100%; height: auto; cursor: pointer; }'
            });
        </script>
    @endpush
</x-layouts.app-user>