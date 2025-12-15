<x-layouts.admin title="Pesan Masuk">
<div class="flex gap-6">

    {{-- Tabel Pesan --}}
    <div class="w-200 bg-white p-4 rounded shadow">
        <h2 class="font-bold text-lg mb-3">Pesan Masuk</h2>

        <table class="w-full border">
            <tr class="bg-gray-200">
                <th class="p-2">Nama</th>
                <th>Email</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>

            @foreach($massages as $msg)
                <tr class="border-b">
                    <td class="p-2">{{ $msg->nama }}</td>
                    <td>{{ $msg->email }}</td>
                    <td>
                        @if($msg->dibalas)
                            <span class="text-green-600 font-semibold">Sudah dibalas</span>
                        @else
                            <span class="text-red-600 font-semibold">Belum dibalas</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.kontak.show', $msg->id) }}" class="text-blue-600 font-semibold">
                            Lihat
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>


    {{-- Panel Detail / Balasan --}}
    <div class="w-1/2 bg-white p-4 rounded shadow">

        @isset($selected)
        <h2 class="font-bold text-lg mb-3">Detail Pesan</h2>

        <p><b>Nama:</b> {{ $selected->nama }}</p>
        <p><b>Email:</b> {{ $selected->email }}</p>

        <p class="mt-3 font-semibold">Pesan:</p>
        <div class="bg-gray-100 p-3 rounded whitespace-pre-line">
            {{ $selected->pesan }}
        </div>

        @if(!$selected->dibalas)
        <form method="POST" action="{{ route('admin.kontak.reply', $selected->id) }}" class="mt-4">
            @csrf
            <label class="font-semibold">Balasan:</label>
            <textarea name="balasan" class="w-full p-2 border rounded h-32" required></textarea>

            <button class="mt-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Kirim Balasan
            </button>
        </form>
        @else
            <p class="mt-3 text-green-600 font-bold">Pesan sudah dibalas ✅</p>
        @endif

        @else
            <p class="text-gray-600">Klik pesan untuk melihat detail atau membalas.</p>
        @endisset

    </div>

</div>

</x-layouts.admin>
