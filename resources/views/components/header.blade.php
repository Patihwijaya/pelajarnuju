<header class="bg-gray-700 text-white py-4 shadow">
    <div class="px-5 md:px-20 py-5 md:py-20">
        @php
        $sapa = Auth::user()->jenis_kelamin === 'Laki-laki' ? 'Rekan' : 'Rekanita';
        @endphp
        <h1 class="text-xl md:text-3xl font-bold mb-3">Selamat Datang,
            <span>
                <span>
                {{ $sapa }}
                 </span>
                {{ Auth::user()->profil->username ?? Auth::user()->name }}
            </span>
        </h1>
        <p>Semoga aktivitasmu menyenangkan.</p>
    </div>
</header>
