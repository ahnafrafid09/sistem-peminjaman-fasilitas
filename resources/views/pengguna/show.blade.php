@extends('layouts.app')

@section('header')
    Detail Pengguna
@endsection

@section('content')
    <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-6 space-y-6">
        <h2 class="text-2xl font-bold">Informasi Pengguna</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="text-gray-600 font-semibold">Nama Lengkap:</p>
                <p class="text-gray-900">{{ $user->nama_lengkap }}</p>
            </div>
            <div>
                <p class="text-gray-600 font-semibold">Email:</p>
                <p class="text-gray-900">{{ $user->email }}</p>
            </div>
            <div>
                <p class="text-gray-600 font-semibold">Status:</p>
                <p class="text-gray-900">{{ $user->status }}</p>
            </div>
            <div>
                <p class="text-gray-600 font-semibold">Role Saat Ini:</p>
                <p class="text-blue-600 font-semibold">{{ $user->getRoleNames()->first() ?? 'Tidak Ada' }}</p>
            </div>
        </div>

        <!-- Form Ubah Role -->
        <div class="border-t pt-6">
            <h3 class="text-xl font-semibold mb-4">Perbarui Role</h3>

            <form action="{{ route('pengguna.updateRole', $user->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700">Pilih Role</label>
                    <select name="role" id="role"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                {{ ucfirst($role->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('pengguna.index') }}" class="ml-4 text-gray-600 hover:underline">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection
