@extends('layouts.app')

@section('header')
    Profile
@endsection

@section('content')
    <div class="flex gap-10">
        <div>
            <div class="flex flex-col items-center justify-center rounded-md bg-primary w-40 h-40">
                <i class="fas fa-user text-7xl text-white mb-4"></i>
                <h1 class="font-bold text-white text-center text-lg">Data Pengguna</h1>
            </div>
        </div>
        <div class="w-1/3">
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                {{-- Email --}}
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)"
                        required autocomplete="username" />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                </div>

                {{-- Nama Lengkap --}}
                <div class="mt-4">
                    <x-input-label for="nama_lengkap" :value="__('Nama Pengguna')" />
                    <x-text-input id="nama_lengkap" name="nama_lengkap" type="text" class="mt-1 block w-full"
                        :value="old('nama_lengkap', $user->nama_lengkap)" required autofocus autocomplete="nama_lengkap" />
                    <x-input-error class="mt-2" :messages="$errors->get('nama_lengkap')" />
                </div>

                {{-- Status --}}
                <div class="mt-4">
                    <x-input-label for="status" :value="__('Status')" />
                    <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="internal" {{ old('status', $user->status) === 'internal' ? 'selected' : '' }}>
                            Internal</option>
                        <option value="eksternal" {{ old('status', $user->status) === 'eksternal' ? 'selected' : '' }}>
                            Eksternal</option>
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('status')" />
                </div>

                {{-- Alamat --}}
                <div class="mt-4">
                    <x-input-label for="alamat" :value="__('Alamat')" />
                    <x-text-input id="alamat" name="alamat" type="text" class="mt-1 block w-full" :value="old('alamat', $user->alamat)"
                        required autocomplete="alamat" />
                    <x-input-error class="mt-2" :messages="$errors->get('alamat')" />
                </div>

                {{-- Upload KTP --}}
                <div class="mt-4">
                    <x-input-label for="ktp" :value="__('Upload KTP')" />
                    @if ($user->foto_ktp)
                        {{-- Jika sudah ada file KTP --}}
                        <p class="text-sm text-gray-700 mt-1">
                            <strong>Nama File:</strong>
                            <a href="{{ asset($user->foto_ktp) }}" target="_blank" class="underline text-blue-500">
                                {{ $user->ktp_name }}
                            </a>
                        </p>
                        <img src="{{ asset($user->foto_ktp) }}" class="mt-2 w-64 rounded shadow" alt="Foto KTP">
                    @endif
                    <input type="file" name="ktp" id="ktp" class="mt-1 block w-full" accept="image/*">
                    <x-input-error class="mt-2" :messages="$errors->get('ktp')" />
                </div>

                <div class="mt-6 flex items-center justify-end">
                    <x-primary-button type="submit" class="text-sm font-normal rounded-md">Update Profil</x-primary-button>
                </div>
            </form>

        </div>
    </div>
    {{-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow-sm sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white shadow-sm sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white shadow-sm sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div> --}}
@endsection
