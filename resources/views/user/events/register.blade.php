<x-layouts.app>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-12 px-4 sm:px-6 lg:px-8 transition-colors duration-300 flex justify-center items-start">
        <div class="w-full max-w-3xl mt-4 sm:mt-8">
            
            <!-- Card Container Utama -->
            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700 transition-colors duration-300 p-8 sm:p-12">
                
                <!-- Header Judul Formulir -->
                <div class="mb-8 border-b border-gray-200 dark:border-gray-700 pb-6">
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight mb-2 leading-snug">
                        Formulir Pendaftaran: <br class="hidden sm:block"> 
                        <span class="text-blue-600 dark:text-blue-400">{{ $event->title }}</span>
                    </h1>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Lengkapi data di bawah ini sesuai instruksi panitia.</p>
                </div>

                <!-- Form Pendaftaran -->
                <form action="{{ route('events.store', $event->slug) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    @if(is_array($event->form_schema))
                        @foreach($event->form_schema as $field)
                            <div class="flex flex-col">
                                <!-- Label -->
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    {{ $field['label'] }} @if(isset($field['required']) && $field['required']) <span class="text-red-500">*</span> @endif
                                </label>

                                @php
                                    // Mengambil nilai lama (old value) dari array answers
                                    $oldValue = old('answers.' . $field['name']);
                                @endphp

                                <!-- Input Teks Panjang (Textarea) -->
                                @if($field['type'] === 'textarea')
                                    <textarea name="answers[{{ $field['name'] }}]" rows="3" class="w-full bg-transparent border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" placeholder="Ketik jawaban Anda di sini..." {{ (isset($field['required']) && $field['required']) ? 'required' : '' }}>{{ $oldValue }}</textarea>
                                
                                <!-- Input Upload File -->
                                @elseif($field['type'] === 'file')
                                    <input type="file" name="answers[{{ $field['name'] }}]" class="w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-blue-900/50 dark:file:text-blue-300 transition-colors border border-gray-300 dark:border-gray-600 rounded-lg bg-transparent" {{ (isset($field['required']) && $field['required']) ? 'required' : '' }}>
                                    <p class="mt-1.5 text-xs text-gray-500 dark:text-gray-400">Maksimal 2MB (JPG, PNG, PDF)</p>
                                
                                <!-- Input Dropdown (Select) -->
                                @elseif($field['type'] === 'dropdown')
                                    <select name="answers[{{ $field['name'] }}]" class="w-full bg-transparent border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" {{ (isset($field['required']) && $field['required']) ? 'required' : '' }}>
                                        <option value="" disabled {{ empty($oldValue) ? 'selected' : '' }} class="text-gray-400 dark:bg-gray-800">-- Pilih Opsi --</option>
                                        @foreach(explode(',', $field['options'] ?? '') as $opt)
                                            <option value="{{ trim($opt) }}" class="dark:text-white dark:bg-gray-800" {{ $oldValue == trim($opt) ? 'selected' : '' }}>{{ trim($opt) }}</option>
                                        @endforeach
                                    </select>
                                
                                <!-- Input Radio Button (Pilihan Satu) -->
                                @elseif($field['type'] === 'radio')
                                    <div class="mt-2 space-y-2">
                                        @php 
                                            $options = isset($field['options']) ? explode(',', $field['options']) : []; 
                                        @endphp
                                        
                                        <div class="flex flex-wrap gap-4">
                                            @foreach($options as $option)
                                                @php $option = trim($option); @endphp
                                                <label class="inline-flex items-center cursor-pointer group">
                                                    <input type="radio" 
                                                        name="answers[{{ $field['name'] }}]" 
                                                        value="{{ $option }}" 
                                                        {{ $oldValue == $option ? 'checked' : '' }}
                                                        {{ (isset($field['required']) && $field['required']) ? 'required' : '' }}
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 cursor-pointer">
                                                    <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300 group-hover:text-blue-600 transition-colors">
                                                        {{ $option }}
                                                    </span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>

                                <!-- Input Tanggal (Date) -->
                                @elseif($field['type'] === 'date')
                                    <input type="date" name="answers[{{ $field['name'] }}]" value="{{ $oldValue }}" class="w-full bg-transparent border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" {{ (isset($field['required']) && $field['required']) ? 'required' : '' }}>

                                <!-- Input Teks Singkat / Angka / Email -->
                                @else
                                    <input type="{{ $field['type'] }}" name="answers[{{ $field['name'] }}]" value="{{ $oldValue }}" class="w-full bg-transparent border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" placeholder="Ketik di sini..." {{ (isset($field['required']) && $field['required']) ? 'required' : '' }}>
                                @endif

                                <!-- Pesan Error Validasi -->
                                @error('answers.' . $field['name'])
                                    <p class="mt-2 text-sm text-red-500 flex items-center">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        @endforeach
                    @endif

                    <!-- Kotak Informasi Keamanan Data -->
                    <div class="bg-blue-50 dark:bg-blue-900/30 border border-blue-100 dark:border-blue-800/50 rounded-xl p-5 mt-6">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 mr-3 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <div>
                                <span class="block text-sm font-bold text-blue-900 dark:text-blue-300 mb-1">Keamanan Data</span>
                                <p class="text-xs text-blue-700 dark:text-blue-400 leading-relaxed">Seluruh data yang Anda kirimkan terenkripsi dengan aman (🔒) dan hanya digunakan untuk keperluan pendaftaran dan pendataan kegiatan Pelajar Nuju.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Navigasi & Tombol Submit -->
                    <div class="pt-8 mt-4 border-t border-gray-200 dark:border-gray-700 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <a href="{{ route('events.show', $event->slug) }}" class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition flex items-center order-2 sm:order-1">
                            &larr; Batalkan
                        </a>
                        
                        <button type="submit" class="w-full sm:w-auto px-8 py-3 rounded-lg text-white font-bold bg-blue-600 hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-500 shadow-md transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 order-1 sm:order-2 flex justify-center items-center">
                            Kirim Pendaftaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>