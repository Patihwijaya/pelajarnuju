<x-layouts.admin title="Dashboard Admin">
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

    <!-- Artikel -->
    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="text-gray-500 text-sm">Jumlah Artikel</h3>
        <p class="text-3xl font-bold mt-2">{{ $jumlahArtikel ?? 0 }}</p>
    </div>

    <!-- User -->
    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="text-gray-500 text-sm">User Terdaftar</h3>
        <p class="text-3xl font-bold mt-2">{{ $jumlahUser }}</p>
    </div>

    <!-- Kontak -->
    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="text-gray-500 text-sm">Kontak Masuk</h3>
        <p class="text-3xl font-bold mt-2">{{ $jumlahKontak }}</p>
    </div>

    <!-- Pengajuan SK -->
    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="text-gray-500 text-sm">Pengajuan SK Ipnu Belum Dicek</h3>
        <p class="text-3xl font-bold mt-2 text-red-600">
            {{ $skIpnuBelumDicek }}
        </p>
    </div>
    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="text-gray-500 text-sm">Pengajuan SK Ippnu Belum Dicek</h3>
        <p class="text-3xl font-bold mt-2 text-red-600">
            {{ $skIppnuBelumDicek }}
        </p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow">
    <h3 class="text-gray-500 text-sm">Total Pengunjung</h3>
    <p class="text-3xl font-bold text-blue-600">
        {{ $totalPengunjung }}
    </p>
</div>

<div class="bg-white p-6 rounded-xl shadow">
    <h3 class="text-gray-500 text-sm">Pengunjung Hari Ini</h3>
    <p class="text-3xl font-bold text-green-600">
        {{ $pengunjungHariIni }}
    </p>
</div>
</div>

<div class="bg-white p-6 mt-6 rounded-xl shadow">
    <h3 class="text-gray-500 text-sm mb-4">Grafik Pengunjung 7 Hari Terakhir</h3>
    <canvas id="visitorChart" class="w-full h-64"></canvas>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('visitorChart').getContext('2d');
    const visitorChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($dates),
            datasets: [{
                label: 'Jumlah Pengunjung',
                data: @json($visitors),
                fill: true,
                borderColor: 'rgba(59, 130, 246, 1)', // biru
                backgroundColor: 'rgba(59, 130, 246, 0.2)',
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                },
            },
            scales: {
                y: {
                    beginAtZero: true,
                    stepSize: 1
                }
            }
        }
    });
</script>
@endpush
</x-layouts.admin>
