@extends('layouts.app')
@section('header')
    Manajemen Fasilitas
@endsection

@section('content')
    <div class="container mx-auto px-4 py-6">
        <form method="GET" action="{{ route('manajemen-fasilitas.index') }}" class="mb-6 w-full max-w-xl">
            <div class="space-y-4">
                <div class="flex items-start">
                    <label for="kondisi" class="text-lg font-bold w-1/3 text-primary">Fasilitas</label>
                    <select name="kondisi"
                        class="border-gray-300 rounded-md w-full shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Pilih Kondisi --</option>
                        <option value="baik" {{ $kondisi == 'baik' ? 'selected' : '' }}>Baik</option>
                        <option value="perlu diperbaiki" {{ $kondisi == 'perlu diperbaiki' ? 'selected' : '' }}>Perlu
                            Diperbaiki</option>
                        <option value="rusak parah" {{ $kondisi == 'rusak parah' ? 'selected' : '' }}>Rusak Parah
                        </option>
                        <option value="sedang diperbaiki" {{ $kondisi == 'sedang diperbaiki' ? 'selected' : '' }}>
                            Sedang Diperbaiki</option>
                        <option value="diganti" {{ $kondisi == 'diganti' ? 'selected' : '' }}>Diganti</option>
                    </select>
                    <div class="flex justify-start">
                        <button type="submit"
                            class="bg-transparent text-black border border-primary cursor-pointer px-4 py-2 w-1/2 transition">Filter</button>
                        <a href="{{ route('manajemen-fasilitas.index') }}"
                            class="bg-transparent text-black border border-primary cursor-pointer px-4 py-2 text-center w-1/2  transition">Reset</a>
                    </div>
                </div>
            </div>
        </form>
        @can('create manajemen fasilitas')
            <div class="mb-4 text-right">
                <a href="{{ route('manajemen-fasilitas.create') }}"
                    class="bg-primary text-white px-4 py-2 rounded hover:bg-primary/80 transition">
                    Tambah Barang
                </a>
            </div>
        @endcan

        {{-- Menampilkan pesan jika tidak ada fasilitas --}}
        @if ($fasilitas->isEmpty())
            <div class="text-center py-6 text-gray-500">
                <p>Tidak ada fasilitas yang ditemukan</p>
            </div>
        @else
            <table class="min-w-full bg-white">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="px-4 py-2 text-left">Aksi</th>
                        <th class="px-4 py-2 text-left">Nama</th>
                        <th class="px-4 py-2 text-left">Tanggal</th>
                        <th class="px-4 py-2 text-left">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fasilitas as $data)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="px-4 py-2 flex gap-3 items-center border border-primary">
                                <a href="{{ route('manajemen-fasilitas.show', $data->id) }}"
                                    class=" flex items-center justify-center gap-1 p-1 rounded bg-blue-500 text-white">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('manajemen-fasilitas.edit', $data->id) }}"
                                    class=" flex items-center justify-center gap-1 p-1 rounded bg-blue-500 text-white">
                                    <i class="fa-solid fa-file-pen"></i>
                                </a>
                                <form method="POST" action="{{ route('manajemen-fasilitas.destroy', $data->id) }}"
                                    class="inline-block" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="cursor-pointer flex items-center gap-1 p-1 rounded bg-blue-500 text-white">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                            <td class="px-4 py-2 border border-primary">{{ $data->nama }}</td>
                            <td class="px-4 py-2 border border-primary">{{ $data->barang_terbaru->tanggal ?? '-' }}</td>
                            <td class="px-4 py-2 border border-primary">{{ $data->barang_terbaru->keterangan ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
