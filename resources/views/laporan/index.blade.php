@extends('layouts.app')

@section('header')
    Laporan
@endsection

@section('content')
    <form method="GET" action="{{ route('laporan.index') }}" class="mb-6 w-full max-w-xl">
        <div class="space-y-4">
            <div class="flex items-start">
                <label for="tanggal" class="text-lg font-bold w-1/3 text-primary">Tanggal Peminjaman</label>
                <div class="w-full space-y-2">
                    <x-text-input class="w-full flatpickr" type="text" name="tanggal" placeholder="DD-MM-YYYY" />
                    <div class="flex justify-start">
                        <button type="submit"
                            class="bg-transparent text-black border border-primary cursor-pointer px-4 py-2 w-1/2 transition">Filter</button>
                        <a href="{{ route('laporan.index') }}"
                            class="bg-transparent text-black border border-primary cursor-pointer px-4 py-2 text-center w-1/2  transition">Reset</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <table class="min-w-full bg-white">
        <thead class="bg-primary text-white">
            <tr>
                <th class="px-4 py-2 text-left">Action</th>
                <th class="px-4 py-2 text-left">Kode</th>
                <th class="px-4 py-2 text-left">Nama</th>
                <th class="px-4 py-2 text-left">Harga</th>
                <th class="px-4 py-2 text-left">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peminjaman as $data)
                <tr class="border-b hover:bg-gray-100">
                    <td class="px-4 py-2 flex gap-3 items-center ">
                        <a href="{{ route('laporan.show', $data->id) }}"
                            class=" flex items-center justify-center gap-1 p-1 rounded bg-blue-500 text-white">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <form method="POST" action="{{ route('laporan.destroy', $data->id) }}" class="inline-block"
                            onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="cursor-pointer flex items-center gap-1 p-1 rounded bg-blue-500 text-white">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                    <td class="px-4 py-2">{{ $data->kode }}</td>
                    <td class="px-4 py-2">{{ $data->user->nama_lengkap ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $data->tarif->harga ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $data->status ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
