<nav x-data="{ open: false }" class="bg-primary text-white shadow-sm w-full fixed top-0 left-0 z-10">
    <div class="px-4 py-4 flex justify-between items-center">
        <!-- Logo & Nama -->
        <div class="flex items-center gap-2">
            <img src="{{ asset('images/logo.webp') }}" alt="Logo" class="h-16 w-16">
            <span class="font-semibold text-xl">SISTEM PEMINJAMAN FASILITAS KAMPUS POLINEMA</span>
        </div>

        <!-- Dropdown User -->
        <div class="relative">
            <button @click="open = ! open" class="flex items-center gap-2 focus:outline-hidden cursor-pointer">
                <!-- Avatar Image -->
                <img src="{{ asset('images/avatar.png') }}" alt="Avatar" class="h-10 w-10 rounded-full" />
                <!-- User's Name -->
                <span class="text-lg uppercase">{{ Auth::user()->nama_lengkap }}</span>
                <!-- Dropdown Arrow -->
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>

            <!-- Dropdown Menu -->
            <div x-show="open" @click.away="open = false"
                class="absolute right-0 mt-2 w-48 bg-white border rounded-sm shadow-sm z-20">
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-black hover:bg-gray-100">Profil</a>
                <a href="{{ route('password.edit') }}" class="block px-4 py-2 text-black  hover:bg-gray-100">Ubah Kata
                    Sandi</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full text-left px-4 py-2 text-black  hover:bg-gray-100">Keluar</button>
                </form>
            </div>
        </div>
    </div>
</nav>
