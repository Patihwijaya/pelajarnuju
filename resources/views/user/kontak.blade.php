<x-layouts.app title="kontak">

<div class="max-w-lg mx-auto mt-10 bg-white p-6 rounded-lg shadow">
    <h1 class="text-xl font-bold mb-3">Kontak & Saran</h1>

    @if(session('success'))
        <div class="text-green-600 mb-2">{{ session('success') }}</div>
    @endif

    <form action="{{ route('kontak.store') }}" method="POST">
        @csrf

        <label>Nama</label>
        <input type="text" name="nama" class="w-full border rounded p-2 mb-2">

        <label>Email</label>
        <input type="email" name="email" class="w-full border rounded p-2 mb-2">

        <label>Pesan</label>
        <textarea name="pesan" class="w-full border rounded p-2 mb-2" rows="4"></textarea>

        <button class="bg-green-600 text-white px-4 py-2 rounded">Kirim</button>
    </form>
</div>
<div class="mt-10 mb-5">
    <h1 class="text-xl font-bold mb-5">Alamat Kami:</h1>
    <iframe
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3967.0326809080584!2d106.91420877409497!3d-6.126304560067415!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6a210062135481%3A0x4b9b0f1259f4b8d!2sPCNU%20Kota%20Jakarta%20Utara!5e0!3m2!1sen!2sid!4v1761832636693!5m2!1sen!2sid"
    class="w-full h-80 rounded-xl hover:shadow-2xl"
    style="border:0;"
    allowfullscreen=""
    loading="lazy"
    referrerpolicy="no-referrer-when-downgrade">
    </iframe>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>


</x-layouts.app>
