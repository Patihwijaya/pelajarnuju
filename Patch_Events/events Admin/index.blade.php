<x-layouts.admin>
    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        
        <!-- Header & Tombol Tambah Event -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Manajemen Event pelajarnuju.com</h1>
                <p class="text-sm text-gray-600 mt-1">Kelola seluruh kegiatan organisasi pelajar, formulir pendaftaran, dan data peserta.</p>
            </div>
            <a href="{{ route('admin.events.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-md shadow text-sm whitespace-nowrap">
                + Buat Event Baru
            </a>
        </div>

        <!-- Notifikasi Sukses -->
        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Tabel Daftar Event dengan Scroll Horizontal (overflow-x-auto) -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul & Lokasi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jadwal Acara</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Pendaftar / Kuota</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($events as $event)
                            @php
                                $totalRegistered = $event->registrations()->count();
                                $isFull = $totalRegistered >= $event->max_participants;
                            @endphp
                            <tr>
                                <!-- Judul & Lokasi -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-bold text-gray-900">{{ $event->title }}</div>
                                    <div class="text-xs text-gray-500">📍 {{ $event->location }}</div>
                                </td>

                                <!-- Jadwal -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-xs text-gray-900 font-medium">Mulai: {{ $event->start_date->format('d M Y, H:i') }}</div>
                                    <div class="text-xs text-gray-500">Selesai: {{ $event->end_date->format('d M Y, H:i') }}</div>
                                </td>

                                <!-- Kuota Peserta -->
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $isFull ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800' }}">
                                        {{ $totalRegistered }} / {{ $event->max_participants }} Peserta
                                    </span>
                                </td>

                                <!-- Status Pendaftaran -->
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @if(now() < $event->end_date)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Selesai</span>
                                    @endif
                                </td>

                                <!-- Tombol Aksi -->
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-1">
                                    <a href="{{ route('admin.events.participants', $event->id) }}" class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 px-2 py-1.5 rounded">Kelola Peserta</a>
                                    <a href="{{ route('admin.events.edit', $event->id) }}" class="text-amber-600 hover:text-amber-900 bg-amber-50 px-2 py-1.5 rounded">Edit</a>
                                    <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus event ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 bg-red-50 px-2 py-1.5 rounded">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-sm text-gray-500">
                                    Belum ada event yang dibuat. Silakan klik tombol <strong>"Buat Event Baru"</strong> di atas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $events->links() }}
        </div>
    </div>
</x-app-layout>