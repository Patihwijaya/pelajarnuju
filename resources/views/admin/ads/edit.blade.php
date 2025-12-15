<x-layouts.admin title="Edit Ads">

<form action="{{ route('admin.ads.update', $ad->id) }}" method="POST" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
        <label>Judul</label>
        <input type="text" name="judul" class="border p-2 w-full"
               value="{{ $ad->judul }}">
    </div>

    <div>
        <label>Link URL</label>
        <input type="text" name="link" class="border p-2 w-full"
               value="{{ $ad->link }}">
    </div>

    <div>
        <label>Tanggal Expired</label>
        <input type="date" name="expired_at" class="border p-2 w-full"
               value="{{ $ad->expired_at }}">
    </div>

    <button class="bg-green-600 text-white px-4 py-2 rounded">
        Update
    </button>
</form>

</x-layouts.admin>
