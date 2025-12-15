<x-layouts.admin title="Dashboard Admin">

<h2 class="text-xl font-bold mb-4">Edit Materi</h2>

<form action="{{ route('admin.materiKelas.update', [$kelas->id, $materi->id]) }}"
      method="POST" enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <label>Judul</label>
    <input type="text" name="judul" value="{{ $materi->judul }}" class="border p-2 w-full">

    <label class="mt-3">Isi Materi</label>
    <textarea name="isi" class="border p-2 w-full" rows="6">{{ $materi->isi }}</textarea>

    <label class="mt-3">Gambar</label>
    <input type="file" name="gambar" class="border p-2 w-full">

    @if ($materi->gambar)
        <img src="/storage/{{ $materi->gambar }}" class="w-40 my-3">
    @endif

    <button class="bg-blue-600 text-white px-3 py-2 mt-4 rounded">
        Update
    </button>
</form>

</x-layouts.admin>
