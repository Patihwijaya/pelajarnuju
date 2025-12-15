<x-layouts.app-user title="Beranda">

    <div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-4">Daftar Notifikasi</h2>

    <div class="mb-4">
        <a href="{{ route('notif.readAll') }}" class="inline-block px-4 py-2 bg-green-500 text-white text-sm rounded hover:bg-green-600">
            Tandai semua sudah dibaca
        </a>
    </div>

    @if($notifications->isEmpty())
        <p class="text-gray-500">Tidak ada notifikasi.</p>
    @else
        <ul class="space-y-2">
            @foreach($notifications as $notif)
                <li class="p-4 border rounded-lg shadow-sm {{ is_null($notif->read_at) ? 'bg-yellow-50' : 'bg-white' }}">
                    <a href="{{ route('notif.read', $notif->id) }}" class="block">
                        <div class="font-semibold text-gray-800">{{ $notif->data['title'] }}</div>
                        <div class="text-gray-600 text-sm">
                            {{ $notif->data['message'] }}
                            @isset($notif->data['catatan'])
                                <br><small>{{ $notif->data['catatan'] }}</small>
                            @endisset
                        </div>
                    </a>
                    <div class="text-gray-400 text-xs mt-1 flex justify-between">
                        <span>{{ $notif->created_at->diffForHumans() }}</span>
                        @if(is_null($notif->read_at))
                            <span class="bg-red-500 text-white px-2 py-0.5 rounded text-xs">baru</span>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>

</x-layouts.app>
