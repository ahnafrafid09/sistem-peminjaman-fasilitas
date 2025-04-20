<x-guest-layout>
    <form method="POST" action="{{ route('password.reset.custom.submit') }}">
        @csrf

        <input type="hidden" name="email" value="{{ old('email', request('email')) }}">

        <!-- Password Baru -->
        <div class="mt-4">
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                placeholder="Password baru" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Konfirmasi Password -->
        <div class="mt-4">
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required placeholder="Konfirmasi password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
