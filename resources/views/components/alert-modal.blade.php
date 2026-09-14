@if(session('success') || session('error') || $errors->any())
    @php
        $isSuccess = session()->has('success');
        $messages = [];
        
        // Menentukan pesan apa yang akan ditampilkan dan memasukannya ke dalam array
        if ($isSuccess) {
            $messages[] = session('success');
        } elseif (session()->has('error')) {
            $messages[] = session('error');
        } else {
            // Ambil SEMUA pesan error validasi
            $messages = $errors->all(); 
        }
    @endphp

    <!-- Overlay Background -->
    <div x-data="{ show: true }"
         x-show="show"
         style="display: none;"
         class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-black bg-opacity-50 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">

        <!-- Modal Card -->
        <div class="relative w-full max-w-md p-4"
             @click.away="show = false"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

            <div class="relative bg-white rounded-2xl shadow-xl border border-gray-100">
                <!-- Tombol Close (X) -->
                <button @click="show = false" type="button" class="absolute top-3 right-3 text-gray-400 bg-transparent hover:bg-gray-100 hover:text-gray-900 rounded-lg text-sm w-8 h-8 flex justify-center items-center transition-colors">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Tutup</span>
                </button>

                <div class="p-6 text-center">
                    @if($isSuccess)
                        <!-- Ikon Sukses -->
                        <div class="mx-auto mb-4 flex items-center justify-center h-14 w-14 rounded-full bg-green-100">
                            <svg class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                        </div>
                    @else
                        <!-- Ikon Error -->
                        <div class="mx-auto mb-4 flex items-center justify-center h-14 w-14 rounded-full bg-red-100">
                            <svg class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                    @endif

                    <!-- Judul -->
                    <h3 class="mb-3 text-xl font-bold text-gray-900">{{ $isSuccess ? 'Berhasil!' : 'Peringatan' }}</h3>
                    
                    <!-- Pesan Error / Sukses -->
                    <div class="mb-6 text-sm text-gray-500">
                        @if(count($messages) == 1)
                            <!-- Jika pesannya cuma 1, tampilkan teks biasa di tengah -->
                            <p>{{ $messages[0] }}</p>
                        @else
                            <!-- Jika pesannya lebih dari 1, tampilkan sebagai list (poin-poin) -->
                            <div class="bg-red-50 p-3 rounded-lg border border-red-100 text-left">
                                <ul class="list-disc list-inside text-red-600 space-y-1">
                                    @foreach($messages as $msg)
                                        <li>{{ $msg }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>

                    <!-- Tombol OK -->
                    <button @click="show = false" type="button" class="w-full text-white {{ $isSuccess ? 'bg-green-600 hover:bg-green-700' : 'bg-red-600 hover:bg-red-700' }} focus:ring-4 focus:outline-none font-semibold rounded-lg text-sm px-5 py-2.5 text-center transition-colors">
                        OK, Mengerti
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif