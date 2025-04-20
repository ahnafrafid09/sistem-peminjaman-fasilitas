<x-guest-layout>
    <!-- Form Kirim OTP -->
    <form method="POST" action="{{ route('password.otp.request') }}">
        @csrf

        <!-- Email -->
        <div>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                placeholder="Masukkan Email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Kirim Recovery Code (Link) -->
        <div class="mt-2">
            <button type="submit" class="text-sm text-blue-600 hover:underline bg-transparent border-none p-0">
                {{ __('Kirim Recovery Code') }}
            </button>
        </div>
    </form>

    <!-- Form untuk verifikasi OTP -->
    <form method="POST" action="{{ route('password.otp.verify') }}">
        @csrf

        <!-- OTP -->
        <div class="mt-4">
            <x-text-input id="otp" class="block mt-1 w-full" type="text" name="otp" required
                placeholder="Masukkan OTP yang Dikirimkan" />
            <x-input-error :messages="$errors->get('otp')" class="mt-2" />
        </div>


        <div class="mt-4">
            <x-primary-button>
                {{ __('Verifikasi OTP') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
