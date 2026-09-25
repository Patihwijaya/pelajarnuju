<x-layouts.app tittle="Events">
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-12 px-4 sm:px-6 lg:px-8 transition-colors duration-300 flex justify-center items-center">
        <div class="max-w-md w-full">
            
            <!-- Notifikasi -->
            @if(session('success'))
                <div class="mb-6 rounded-xl bg-green-100 dark:bg-green-900/40 border border-green-200 dark:border-green-800 p-4 text-center">
                    <p class="text-lg font-bold text-green-800 dark:text-green-400">✔️ {{ session('success') }}</p>
                </div>
            @endif
            @if(session('error'))
                <div class="mb-6 rounded-xl bg-red-100 dark:bg-red-900/40 border border-red-200 dark:border-red-800 p-4 text-center">
                    <p class="text-sm font-bold text-red-800 dark:text-red-400">❌ {{ session('error') }}</p>
                </div>
            @endif
            @if(session('info'))
                <div class="mb-6 rounded-xl bg-blue-100 dark:bg-blue-900/40 border border-blue-200 dark:border-blue-800 p-4 text-center">
                    <p class="text-sm font-bold text-blue-800 dark:text-blue-400">ℹ️ {{ session('info') }}</p>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-3xl overflow-hidden border border-gray-200 dark:border-gray-700 transition-colors duration-300">
                <div class="bg-blue-600 dark:bg-blue-800 p-6 text-center">
                    <h1 class="text-2xl font-bold text-white tracking-tight">Self Check-in</h1>
                    <p class="text-blue-100 text-sm mt-1 line-clamp-1">{{ $event->title }}</p>
                </div>

                <div class="p-8">
                    <p class="text-sm text-gray-600 dark:text-gray-300 mb-6 text-center">Silakan verifikasi kehadiran Anda dengan memasukkan data di bawah ini.</p>

                    <form action="{{ route('checkin.process', $event->id) }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-200 mb-2 text-center uppercase tracking-wider">
                                Masukkan {{ $firstFieldLabel }}
                            </label>
                            <input type="text" name="search_data" required placeholder="Ketik persis seperti saat mendaftar..." 
                                class="w-full text-center bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        </div>

                        <button type="submit" class="w-full px-8 py-3 rounded-xl text-white font-bold bg-blue-600 hover:bg-blue-700 shadow-md transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Hadir & Check-in
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>