@extends('layouts.app')
@section('header')
    Manajemen Fasilitas | Kondisi Fasilitas
@endsection

@section('content')
    <div class="overflow-x-auto mt-4">
        <table class="min-w-full table-auto border-collapse border border-black">
            <thead>
                <tr class="bg-primary text-white">
                    <th class="px-4 py-2  text-left text-sm font-semibold border border-black">Nama Barang
                    </th>
                    <th class="px-4 py-2 text-left text-sm font-semibold border border-black">Baik</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold border border-black">Perlu
                        Diperbaiki</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold border border-black">Rusak Parah
                    </th>
                    <th class="px-4 py-2 text-left text-sm font-semibold border border-black">Sedang
                        Diperbaiki</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold border border-black">Diganti</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fasilitas->barang as $barang)
                    <tr class=" border-b border-black">
                        <td class="px-4 py-2 text-sm font-medium text-gray-800 border-r border-black">
                            {{ $barang->nama_barang }}</td>

                        <!-- Cek status berdasarkan kondisi barang -->
                        <td class="px-4 py-2 text-center border-r border-black">
                            @if ($barang->kondisi == 'baik')
                                <i class="fa fa-check-circle text-green-500"></i>
                            @endif
                        </td>

                        <td class="px-4 py-2 text-center border-r border-black">
                            @if ($barang->kondisi == 'perlu diperbaiki')
                                <i class="fa fa-check-circle text-green-500"></i>
                            @endif
                        </td>

                        <td class="px-4 py-2 text-center border-r border-black">
                            @if ($barang->kondisi == 'rusak parah')
                                <i class="fa fa-check-circle text-green-500"></i>
                            @endif
                        </td>

                        <td class="px-4 py-2 text-center border-r border-black">
                            @if ($barang->kondisi == 'sedang diperbaiki')
                                <i class="fa fa-check-circle text-green-500"></i>
                            @endif
                        </td>

                        <td class="px-4 py-2 text-center">
                            @if ($barang->kondisi == 'diganti')
                                <i class="fa fa-check-circle text-green-500"></i>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="bg-red-600 hover:bg-red-500 rounded-md">
                <a href="{{ route('manajemen-fasilitas.index') }}">Keluar</a>
            </x-primary-button>
        </div>
    </div>
@endsection
