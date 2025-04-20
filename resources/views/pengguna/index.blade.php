@extends('layouts.app')

@section('header')
    Pengguna
@endsection

@section('content')
    <div class="overflow-x-auto shadow-lg rounded-lg border border-gray-200 mt-6">
        <table class="min-w-full border border-primary">
            <thead class="bg-primary text-white">
                <tr>
                    <th class="px-4 py-2 text-left">Aksi</th>
                    <th class="px-4 py-2 text-left">Nama</th>
                    <th class="px-4 py-2 text-left">Email</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">Aktif</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengguna as $user)
                    <tr class="border border-primary">
                        <td class="px-4 py-2 flex gap-3 items-center border border-primary">
                            <a href="{{ route('pengguna.show', $user->id) }}"
                                class=" flex items-center gap-1 p-1 rounded bg-blue-500 text-white">
                                <i class="fas fa-eye"></i>

                            </a>
                            <a href="{{ route('pengguna.permission', $user->id) }}"
                                class="flex items-center gap-1 p-1 rounded bg-blue-500 text-white">
                                <i class="fas fa-user-shield"></i>

                            </a>
                            <form method="POST" action="{{ route('pengguna.destroy', $user->id) }}" class="inline-block"
                                onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="cursor-pointer flex items-center gap-1 p-1 rounded bg-blue-500 text-white">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                        <td class="px-4 py-2 border border-primary">{{ $user->nama_lengkap }}</td>
                        <td class="px-4 py-2 border border-primary">{{ $user->email }}</td>
                        <td class="px-4 py-2 border border-primary">{{ $user->status }}</td>
                        <td class="px-4 py-2 border border-primary">
                            @php
                                $lastLogin = DB::table('sessions')
                                    ->where('user_id', $user->id)
                                    ->latest('last_activity')
                                    ->first();
                            @endphp
                            {{ $lastLogin ? \Carbon\Carbon::createFromTimestamp($lastLogin->last_activity)->diffForHumans() : '-' }}
                        </td>


                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
