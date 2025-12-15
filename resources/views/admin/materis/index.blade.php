<x-layouts.admin title="Dashboard Admin">

<h1>Daftar Materi Kelas: {{ $kela->nama }}</h1>

@if($materis->count())
    <ul>
        @foreach($materis as $item)
            <li>{{ $item->judul }} - {{ $item->konten }}</li>
        @endforeach
    </ul>
@else
    <p>Tidak ada materi.</p>
@endif

</x-layouts.admin>
