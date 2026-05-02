<x-layouts.admin title="Dashboard Admin">
    <div class="max-w-5xl mx-auto mt-10 bg-white p-6 rounded-lg shadow" x-data="tabelArtikel()">
    
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Daftar Artikel</h1>
            <a href="{{ route('admin.artikel.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                + Tambah Artikel
            </a>
        </div>
    
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
    
        <!-- Area Filter & Pencarian -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-4 gap-4 bg-gray-50 p-4 rounded-lg border">
            <div class="flex items-center gap-2">
                <label class="text-sm font-medium text-gray-700">Tampilkan:</label>
                <select x-model="perPage" class="border-gray-300 rounded-md shadow-sm sm:text-sm py-1.5 pl-3 pr-8">
                    <option value="5">5</option>
                    <option value="15">15</option>
                    <option value="50">50</option>
                </select>
                <span class="text-sm text-gray-700">data</span>
            </div>

            <div class="flex items-center gap-2">
                <label class="text-sm font-medium text-gray-700">Kategori:</label>
                <select x-model="kategori" class="border-gray-300 rounded-md shadow-sm sm:text-sm py-1.5">
                    <option value="">Semua Kategori</option>
                    <option value="berita">Berita</option>
                    <option value="opini">Opini</option>
                    <option value="cerpen">Cerpen</option>
                    <option value="artikel">Artikel</option>
                    <option value="kaderisasi">Kaderisasi</option>
                    <option value="organisasi">Organisasi</option>
                    <option value="ekonomi">Ekonomi</option>
                    <!-- Tambahkan option lain sesuai kategori di database Anda -->
                </select>
            </div>
    
            <div class="flex items-center gap-2 w-full md:w-auto">
                <input type="text" x-model.debounce.500ms="search" placeholder="Cari judul atau penulis..." class="w-full md:w-64 border-gray-300 rounded-md shadow-sm sm:text-sm py-1.5 px-3">
            </div>
        </div>
    
        <!-- Area Tabel yang akan dirender ulang oleh Alpine -->
        <div x-ref="tempatTabel" @click="tanganiPaginasi($event)">
            @include('admin.artikel.partials.table', ['artikels' => $artikels])
        </div>
    
    </div>
    
    <!-- Script Alpine.js -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('tabelArtikel', () => ({
                search: '',
                perPage: 5,
                // tabelHtml: '',
                kategori: '',
    
                init() {
                    this.$watch('search', () => this.fetchData());
                    this.$watch('perPage', () => this.fetchData());
                    this.$watch('kategori', () => this.fetchData());
                },
    
                fetchData(url = '{{ route('admin.artikel.index') }}') {
                    let urlObj = new URL(url);
                    urlObj.searchParams.set('search', this.search);
                    urlObj.searchParams.set('per_page', this.perPage);

                    if (this.kategori !== '') {
                        urlObj.searchParams.set('kategori', this.kategori);
                    }
    
                    fetch(urlObj.toString(), {
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    })
                    .then(response => response.text())
                    .then(html => {
                        this.$refs.tempatTabel.innerHTML = html; 
                    });
                },
    
                tanganiPaginasi(e) {
                    // Mencegat klik pada tombol paginasi bawaan Tailwind/Laravel
                    let link = e.target.closest('a');
                    if (link && link.href && link.href.includes('?page=')) {
                        e.preventDefault();
                        this.fetchData(link.href);
                    }
                }
            }))
        })
    </script>
</x-layouts.admin>
