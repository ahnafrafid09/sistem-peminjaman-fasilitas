@extends('layouts.app')

@section('header')
    Pembayaran | Detail Pembayaran
@endsection

@section('content')
    @if ($pembayaran->status === 'menunggu pembayaran')
        <form action="{{ route('pembayaran.pilih-metode', $pembayaran->id) }}" method="POST">
            @csrf
            <div class="flex gap-10">
                <div class="w-1/2">
                    <h1 class="text-4xl font-bold text-primary mb-4">Metode Pembayaran</h1>
                    @foreach ($metode as $item)
                        <label for="metode-{{ $item['id'] }}"
                            class="border rounded-xl p-4 cursor-pointer shadow-lg flex items-center gap-4">
                            <input type="radio" name="metode_pembayaran" value="{{ $item['id'] }}"
                                id="metode-{{ $item['id'] }}" class="w-5 h-5 text-primary">
                            <div>
                                <h2 class="text-2xl font-semibold">{{ $item['nama_bank'] }}</h2>
                            </div>
                        </label>
                    @endforeach
                </div>
                <div class="w-1/2">
                    <h1 class="text-4xl font-bold text-primary">Rincian Pembayaran</h1>
                    <div class=" rounded-xl shadow-lg p-6">
                        <table class="w-full text-lg text-left ">
                            <tbody>
                                <tr class="">
                                    <td class="px-2 py-1 font-semibold">Fasilitas</td>
                                    <td class="px-2 py-1">: {{ $pembayaran->peminjaman->fasilitas->nama }}</td>
                                </tr>
                                <tr class="">
                                    <td class="px-2 py-1 font-semibold">Harga</td>
                                    <td class="px-2 py-1">:
                                        {{ 'Rp ' . number_format($pembayaran->peminjaman->tarif->harga ?? 0, 0, ',', '.') }}
                                    </td>
                                </tr>
                                <tr class="">
                                    <td class="px-2 py-1 font-semibold">Total Harga</td>
                                    <td class="px-2 py-1 font-bold">
                                        : {{ 'Rp ' . number_format($pembayaran->total_harga ?? 0, 0, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="mt-5 flex items-center justify-end">
                <x-secondary-button type="submit" class="text-sm rounded-sm font-normal">Bayar</x-secondary-button>
            </div>
        </form>
    @else
        <div class="w-1/2">
            <h1 class="text-4xl font-bold text-primary">Rincian Pembayaran</h1>
            <div class=" rounded-xl shadow-lg p-6">
                <table class="w-full text-lg text-left ">
                    <tbody>
                        <tr class="">
                            <td class="px-2 py-1 font-semibold">Fasilitas</td>
                            <td class="px-2 py-1">: {{ $pembayaran->peminjaman->fasilitas->nama }}</td>
                        </tr>
                        <tr class="">
                            <td class="px-2 py-1 font-semibold">Harga</td>
                            <td class="px-2 py-1">:
                                {{ 'Rp ' . number_format($pembayaran->peminjaman->tarif->harga ?? 0, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr class="">
                            <td class="px-2 py-1 font-semibold">Total Harga</td>
                            <td class="px-2 py-1 font-bold">
                                : {{ 'Rp ' . number_format($pembayaran->total_harga ?? 0, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="mt-5 flex items-center justify-end">
                <x-secondary-button class="text-sm rounded-sm font-normal bg-red-500 hover:bg-red-400"><a
                        href="{{ route('pembayaran.index') }}">Kembali</a></x-secondary-button>
            </div>
        </div>
    @endif
@endsection
