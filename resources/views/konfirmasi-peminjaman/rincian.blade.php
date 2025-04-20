@extends('layouts.app')

@section('header')
    Konfirmasi Peminjaman | Rincian Pembayaran
@endsection

@section('content')
    <div class="w-full mx-auto max-w-6xl px-4">
        <h1 class="font-bold text-2xl sm:text-3xl">Rincian Pembayaran</h1>

        <div class="rounded shadow-lg p-4 mt-4">
            <div class="overflow-x-auto">
                <table class="w-full text-sm sm:text-base text-left border border-primary">
                    <tbody>
                        <tr class="border border-primary">
                            <td class="px-2 py-2 font-semibold whitespace-nowrap">Fasilitas</td>
                            <td class="px-2 py-2">: {{ $peminjaman->fasilitas->nama }}</td>
                        </tr>
                        <tr class="border border-primary">
                            <td class="px-2 py-2 font-semibold whitespace-nowrap">Harga</td>
                            <td class="px-2 py-2">: {{ 'Rp ' . number_format($peminjaman->tarif->harga ?? 0, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr class="border border-primary">
                            <td class="px-2 py-2 font-semibold whitespace-nowrap">Total harus dibayar</td>
                            <td class="px-2 py-2 font-bold text-red-600">
                                : {{ 'Rp ' . number_format($peminjaman->tarif->harga ?? 0, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="w-full flex items-center justify-end mt-4">
                <form action="{{ route('konfirmasi-peminjaman.setuju', $peminjaman->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <x-primary-button type="submit"
                        class="rounded-md font-normal text-sm sm:text-base py-2 px-4">Kirim</x-primary-button>
                </form>
            </div>
        </div>
    </div>
@endsection
