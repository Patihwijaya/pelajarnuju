<aside class="w-100 bg-gray-100 text-black h-screen flex flex-col gap-5 absolute md:static -left-100">
    <div class="mt-20 ms-20">
        <p class="font-semibold text-lg uppercase">Pengaturan</p>
    </div>
    <ul class="ms-20">
        <a href="/profil">

        <li class="{{ request()->is('profil') ? 'border-l-4 border-gray-700' : '' }} p-2 rounded mb-2 flex hover:bg-slate-200 gap-3">
            <svg class="w-6 h-6 text-gray-800 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-width="2" d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
            </svg>
            <p>Profil</p>
            {{-- <a href="/profil">Profil</a> --}}
        </li>
        </a>

        <a href="/pengaturan">
        <li class="{{ request()->is('pengaturan') ? 'border-l-4 border-gray-700' : '' }} p-2 rounded mb-2 flex hover:bg-slate-200 gap-3">
            <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="square" stroke-linejoin="round" stroke-width="2" d="M10 19H5a1 1 0 0 1-1-1v-1a3 3 0 0 1 3-3h2m10 1a3 3 0 0 1-3 3m3-3a3 3 0 0 0-3-3m3 3h1m-4 3a3 3 0 0 1-3-3m3 3v1m-3-4a3 3 0 0 1 3-3m-3 3h-1m4-3v-1m-2.121 1.879-.707-.707m5.656 5.656-.707-.707m-4.242 0-.707.707m5.656-5.656-.707.707M12 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
            </svg>
            <p>Pengaturan</p>
            {{-- <a href="/pengaturan">Pengaturan</a> --}}
        </li>
        </a>
    </ul>
</aside>

<button class="bg-gray-800 mt-20 max-h-fit p-2 fixed md:hidden" id="tombol">
    <svg id="tombol-buka" class="w-6 h-6 text-white " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
        <path fill-rule="evenodd" d="M11.403 5H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-6.403a3.01 3.01 0 0 1-1.743-1.612l-3.025 3.025A3 3 0 1 1 9.99 9.768l3.025-3.025A3.01 3.01 0 0 1 11.403 5Z" clip-rule="evenodd"/>
        <path fill-rule="evenodd" d="M13.232 4a1 1 0 0 1 1-1H20a1 1 0 0 1 1 1v5.768a1 1 0 1 1-2 0V6.414l-6.182 6.182a1 1 0 0 1-1.414-1.414L17.586 5h-3.354a1 1 0 0 1-1-1Z" clip-rule="evenodd"/>
    </svg>

    <svg id="tombol-tutup" class="ms-55 w-6 h-6 hidden text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
    </svg>
</button>

<div id="asside-menu" class="fixed hidden md:hidden left-0 w-fit bg-gray-100 h-screen">
    <div class="mx-10 mt-20">
        <p class="font-semibold text-lg uppercase">Pengaturan</p>
    </div>
    <ul class="mx-10">
        <a href="/profil">

        <li class="{{ request()->is('profil') ? 'border-l-4 border-gray-700' : '' }} p-2 rounded mb-2 flex hover:bg-slate-200 gap-3">
            <svg class="w-6 h-6 text-gray-800 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-width="2" d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
            </svg>
            <p>Profil</p>
            {{-- <a href="/profil">Profil</a> --}}
        </li>
        </a>

        <a href="/pengaturan">
        <li class="{{ request()->is('pengaturan') ? 'border-l-4 border-gray-700' : '' }} p-2 rounded mb-2 flex hover:bg-slate-200 gap-3">
            <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="square" stroke-linejoin="round" stroke-width="2" d="M10 19H5a1 1 0 0 1-1-1v-1a3 3 0 0 1 3-3h2m10 1a3 3 0 0 1-3 3m3-3a3 3 0 0 0-3-3m3 3h1m-4 3a3 3 0 0 1-3-3m3 3v1m-3-4a3 3 0 0 1 3-3m-3 3h-1m4-3v-1m-2.121 1.879-.707-.707m5.656 5.656-.707-.707m-4.242 0-.707.707m5.656-5.656-.707.707M12 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
            </svg>
            <p>Pengaturan</p>
            {{-- <a href="/pengaturan">Pengaturan</a> --}}
        </li>
        </a>
    </ul>
</div>

<script>
const tombol = document.getElementById('tombol')
const tombolBuka = document.getElementById('tombol-buka')
const tombolTutup = document.getElementById('tombol-tutup')
const assideMenu = document.getElementById('asside-menu')

tombol.addEventListener('click', () =>{
    assideMenu.classList.toggle('hidden')
    tombolBuka.classList.toggle('hidden')
    tombolTutup.classList.toggle('hidden')
})
</script>
