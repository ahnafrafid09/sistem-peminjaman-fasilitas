@extends('layouts.app')

@section('header')
    Fasilitas | Detail Fasilitas
@endsection

@section('content')
    <div>
        {{-- Gambar Fasilitas --}}
        @php
            $jumlahGambar = $fasilitas->detailGambarFasilitas->count();
        @endphp

        <div class="flex justify-center sm:justify-{{ $jumlahGambar === 1 ? 'center' : 'start' }} flex-wrap gap-6 mb-10">
            @if ($jumlahGambar > 0)
                @foreach ($fasilitas->detailGambarFasilitas as $gambar)
                    <div class="w-full sm:w-80 h-48 sm:h-56 md:h-64 bg-primary p-2 rounded-lg overflow-hidden shadow-md">
                        <img src="{{ asset($gambar->url_gambar) }}" alt="Gambar Fasilitas"
                            class="w-full h-full object-cover object-center">
                    </div>
                @endforeach
            @else
                <div class="w-full sm:w-80 h-48 sm:h-56 md:h-64 bg-primary rounded-lg overflow-hidden shadow-md">
                    <img src="{{ asset($fasilitas->thumbnail) }}" alt="Gambar Fasilitas"
                        class="w-full h-full object-cover object-center">
                </div>
            @endif
        </div>

        {{-- Detail Fasilitas --}}
        <table class="table-auto w-full border border-collapse border-black text-sm md:text-base">
            {{-- Nama Fasilitas --}}
            <tr>
                <td colspan="2"
                    class="border border-black p-3 font-bold text-center bg-gray-200 text-lg md:text-xl uppercase">
                    {{ $fasilitas->nama }}
                </td>
            </tr>
            <tr>
                <td class="border border-black p-2 w-1/2 font-bold">Unit</td>
                <td class="border border-black p-2">{{ $fasilitas->unit ?? '-' }}</td>
            </tr>
            <tr>
                <td class="border border-black p-2 font-bold">Luas</td>
                <td class="border border-black p-2">{{ $fasilitas->luas ? $fasilitas->luas . ' m²' : '-' }}</td>
            </tr>

            {{-- Fitur --}}
            <tr>
                <td colspan="2" class="border border-black p-2  text-lg md:text-xl font-bold text-center">
                    Fasilitas yang Didapatkan
                </td>
            </tr>
            @if (is_array($fasilitas->fitur) && count($fasilitas->fitur) > 0)
                @foreach (array_chunk($fasilitas->fitur, 2) as $chunk)
                    <tr>
                        @foreach ($chunk as $fitur)
                            <td class="border border-black p-2 w-1/2">{{ $fitur }}</td>
                        @endforeach
                        @if (count($chunk) == 1)
                            <td class="border border-black p-2 w-1/2">-</td>
                        @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="2" class="border border-black p-2 text-center">-</td>
                </tr>
            @endif

            {{-- Tarif Layanan --}}
            <tr>
                <td colspan="2" class="border border-black p-2 font-bold text-lg md:text-xl text-center">
                    Tarif Layanan Non Akademik Aset Barang Milik Negara (Per Hari)
                </td>
            </tr>

            @if ($fasilitas->detailFasilitas && $fasilitas->detailFasilitas->count() > 0)
                @foreach ($fasilitas->detailFasilitas as $detail)
                    <tr>
                        <!-- Nama Detail Fasilitas -->
                        <td class="border border-black p-2" rowspan="4">{{ $detail->nama }}</td>
                        @foreach (['eksternal', 'internal', 'sosial'] as $kelompok)
                            @php
                                $harga = optional($detail->tarif->firstWhere('kelompok_tarif', $kelompok))->harga;
                            @endphp
                    <tr>
                        <td class="border border-black p-2">{{ ucfirst($kelompok) }} :
                            {{ 'Rp ' . number_format($harga ?? 0, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
                </tr>
            @endforeach
        @else
            @foreach (['eksternal', 'internal', 'sosial'] as $kelompok)
                @php
                    $harga = optional($fasilitas->tarif->firstWhere('kelompok_tarif', $kelompok))->harga;
                @endphp
                <tr>
                    <td class="border border-black p-2">{{ ucfirst($kelompok) }}</td>
                    <td class="border border-black p-2">{{ 'Rp ' . number_format($harga ?? 0, 0, ',', '.') }}</td>
                </tr>
            @endforeach
            @endif
        </table>
        <div class="w-full flex items-center justify-end mt-10">
            <div class="flex space-x-4">
                <x-secondary-button class="rounded-md font-normal bg-red-600 hover:bg-red-500 text-sm h-12 w-30">
                    <a href={{ route('fasilitas.index') }}>Kembali</a>
                </x-secondary-button>

                @can('update fasilitas')
                    <x-primary-button class="rounded-md font-normal text-sm h-12 w-30">
                        <a href={{ route('fasilitas.edit', ['id' => $fasilitas->id]) }}>Edit</a>
                    </x-primary-button>
                @endcan
                <x-secondary-button class="rounded-md font-normal text-sm h-12 w-30">
                    <a href="#">Ajukan Peminjaman</a>
                </x-secondary-button>
                @can('delete fasilitas')
                    <form action="{{ route('fasilitas.destroy', $fasilitas->id) }}" method="POST"
                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus fasilitas ini?')">
                        @csrf
                        @method('DELETE') <!-- Menandakan bahwa ini adalah permintaan DELETE -->
                        <x-primary-button type="submit"
                            class="rounded-md font-normal bg-red-600 hover:bg-red-500 text-sm h-12 w-30">
                            Hapus
                        </x-primary-button>
                    </form>
                @endcan
            </div>
        </div>
    </div>
@endsection
