<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div>
            <x-text-input id="nama_lengkap" class="block mt-1 w-full" type="text" name="nama_lengkap" :value="old('nama_lengkap')"
                required placeholder="Masukan Nama Lengkap" />
            <x-input-error :messages="$errors->get('nama_lengkap')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required placeholder="Masukan Email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-text-input id="nomor_identitas" class="block mt-1 w-full" type="text" name="nomor_identitas"
                :value="old('nomor_identitas')" required placeholder="Masukan NIM/NIP/ NIK" />
            <x-input-error :messages="$errors->get('nomor_identitas')" class="mt-2" />
        </div>


        <div class="mt-4">
            <x-text-input id="jurusan" class="block mt-1 w-full" type="text" name="jurusan" :value="old('jurusan')"
                placeholder="Masukan Jurusan/Unit (Masyarakat Umum Kosongi)" />
            <x-input-error :messages="$errors->get('jurusan')" class="mt-2" />
        </div>

        <div class="mt-4">
            <select name="status" id="status" required
                class="block w-full rounded-md border-gray-300 bg-secondary shadow-sm focus:border-border-gray-300 focus:ring-gray-300 focus:ring-opacity-50 text-gray-500">
                <option value="" disabled selected hidden>-- Pilih Status --</option>
                <option value="internal" class="text-black">Internal</option>
                <option value="eksternal" class="text-black">Eksternal</option>
            </select>
            <x-input-error :messages="$errors->get('status')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" :value="old('password')"
                placeholder="Masukan Password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" :value="old('password_confirmation')" placeholder="Konfirmasi Password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-center flex-col mt-4 gap-3">
            <x-secondary-button class="w-full" type="submit">
                {{ __('Verifikasi') }}
            </x-secondary-button>
        </div>
    </form>
</x-guest-layout>
