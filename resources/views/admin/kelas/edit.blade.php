<x-layouts.admin title="Dashboard Admin">

<h2 class="text-xl font-bold mb-4">Edit Kelas</h2>

<form action="{{ route('kelas.update', $kela->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label>Nama Kelas</label>
    <input type="text" name="nama_kelas" value="{{ $kela->nama_kelas }}" class="border p-2 w-full">

    <label>Deskripsi Kelas</label>
    <input type="text" name="deskripsi" value="{{ $kela->deskripsi }}" class="border p-2 w-full">


    <label>Gambar</label>
    <input type="file" name="gambar_kelas" class="border p-2 w-full">

    @if($kela->gambar_kelas)
        <img src="{{ asset('uploads/kelas/'.$kela->gambar_kelas) }}" class="w-80 h-50 my-2 object-cover">
    @endif

    <button class="bg-blue-600 text-white px-3 py-2 mt-4 rounded">
        Update
    </button>
</form>

</x-layouts.admin>
