<x-layouts.app-user title="Beranda">

<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-2xl p-6">
    <h2 class="text-2xl font-semibold text-center text-gray-800 mb-2">🕌 Jadwal Ibadah</h2>
    <p class="text-center text-gray-600 mb-4">{{ $city }}</p>

    <div class="text-center mb-6">
        <p class="text-lg font-semibold text-gray-800">{{ $tanggalMasehi }}</p>
        <p class="text-sm text-gray-500 italic">{{ $tanggalHijriah }}</p>
        <p id="jamRealtime" class="text-xl font-bold text-indigo-700 mt-2">--:--:-- WIB</p>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 text-center">
        @foreach($jadwalFiltered as $nama => $waktu)
            <div class="p-3 bg-gray-50 rounded-xl shadow-sm">
                <p class="text-gray-700 font-medium">{{ ucfirst($nama) }}</p>
                <p class="text-xl font-bold text-gray-900">{{ $waktu }}</p>
            </div>
        @endforeach
    </div>
</div>


</x-layouts.app>
