<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <!-- Email Address -->
        <div>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" placeholder="Masukan Email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" placeholder="Masukan Password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>


        <div class="flex items-center justify-center flex-col mt-4 gap-3">

            <x-primary-button class="w-full" type="submit">
                {{ __('Log in') }}
            </x-primary-button>

            @if (Route::has('password.request'))
                <a class="text-button-primary hover:text-button-primary/80 rounded-md focus:outline-hidden focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}">
                    {{ __('Lupa Kata Sandi?') }}
                </a>
            @endif
            <div class="flex items-center justify-center w-full gap-2">
                <span class="border border-gray-400 h-.5 w-full"></span>
                <p class="text-gray-400">atau</p>
                <span class="border border-gray-400 h-.5 w-full"></span>
            </div>
            <x-secondary-button class="w-full">
                <a href="{{ route('register') }}">Buat Akun Baru</a>
            </x-secondary-button>


        </div>
    </form>
</x-guest-layout>
