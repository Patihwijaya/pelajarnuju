<x-layouts.admin title="Dashboard Admin">

<a href="{{ route('admin.ads.create') }}" class="bg-blue-500 text-white px-3 py-1 rounded mb-3 inline-block">
   + Tambah Ads
</a>

<table class="table-auto w-full border">
    <tr class="bg-gray-200">
        <th class="border p-2">Judul</th>
        <th class="border p-2">Hit</th>
        <th class="border p-2">Expired</th>
        <th class="border p-2">Aksi</th>
    </tr>
    @foreach ($ads as $ad)
    <tr class="border">
        <td class="border p-2">{{ $ad->judul }}</td>
        <td class="border p-2">{{ $ad->hit }} klik</td>
        <td class="border p-2">{{ $ad->expired_at }}</td>
                <td class="flex gap-2 p-2">

            <a href="{{ route('admin.ads.edit', $ad->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">
                Edit
            </a>

            <form action="{{ route('admin.ads.destroy', $ad->id) }}" method="POST" onsubmit="return confirm('Hapus iklan ini?')">
                @csrf
                @method('DELETE')
                <button class="bg-red-600 text-white px-2 py-1 rounded">
                    Hapus
                </button>
            </form>

        </td>
    </tr>
    @endforeach
</table>

</x-layouts.admin>
