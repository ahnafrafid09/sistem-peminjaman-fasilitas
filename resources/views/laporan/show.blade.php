@extends('layouts.app')

@section('header')
    Laporan Peminajaman | Detail Laporan Peminjaman
@endsection

@section('content')
    <div class="flex gap-10">
        <div>
            <div class="flex flex-col items-center justify-center rounded-md bg-primary w-40 h-40">
                <i class="fas fa-user text-7xl text-white mb-4"></i>
                <h1 class="font-bold text-white text-center text-lg">Data Peminjaman</h1>
            </div>
        </div>
        <div class="w-1/3">
            <div class="mb-4">
                <x-input-label>Email</x-input-label>
                <x-text-input class="w-full" value='{{ $peminjaman->user->email }}' disabled />
            </div>
            <div class="mb-4">
                <x-input-label>Nama Pengguna</x-input-label>
                <x-text-input class="w-full" value='{{ $peminjaman->user->nama_lengkap }}' disabled />
            </div>
            <div class="mb-4">
                <x-input-label>Status</x-input-label>
                <x-text-input class="w-full" value='{{ $peminjaman->user->status }}' disabled />
            </div>
            <div class="mb-4">
                <x-input-label>Alamat</x-input-label>
                <x-text-input class="w-full"
                    value="{{ $peminjaman->user->alamat && $peminjaman->user->alamat != '' ? $peminjaman->user->alamat : 'Pengguna belum lengkapi alamat' }}"
                    disabled />
            </div>
            <div class="mb-4">
                <x-input-label>Kartu Tanda Penduduk</x-input-label>
                <x-text-input class="w-full"
                    value="{{ $peminjaman->user->foto_ktp && $peminjaman->user->foto_ktp != '' ? $peminjaman->user->foto_ktp : 'Pengguna belum upload foto ktp' }}"
                    disabled />
            </div>
            <div class="mb-4">
                <x-input-label>Jenis Fasilitas</x-input-label>
                <x-text-input class="w-full" value='{{ $peminjaman->fasilitas->jenisFasilitas->nama }}' disabled />
            </div>
            <div class="mb-4">
                <x-input-label>Nama Fasilitas</x-input-label>
                <x-text-input class="w-full" value='{{ $peminjaman->fasilitas->nama }}' disabled />
            </div>
            @if ($peminjaman->detailFasilitas)
                <div class="mb-4">
                    <x-input-label>Nama Detail Fasilitas</x-input-label>
                    <x-text-input class="w-full" value="{{ $peminjaman->detailFasilitas->nama }}" disabled />
                </div>
            @endif
            <h1 class="mt-4 font-bold text-lg text-primary">Lama Sewa</h1>
            <div class="my-4">
                <x-input-label>Acara</x-input-label>
                <x-text-input class="w-full" value="{{ $peminjaman->tanggal_peminjaman }}" disabled />
            </div>
            <div class="mb-4">
                <x-input-label>Pemasangan Peralatan Acara</x-input-label>
                <x-text-input class="w-full" value="{{ $peminjaman->tanggal_pemasangan_alat }}" disabled />
            </div>
            <div class="mb-4">
                <x-input-label>Pembongkaran Peralatan Acara</x-input-label>
                <x-text-input class="w-full" value="{{ $peminjaman->tanggal_pembongkaran_alat }}" disabled />
            </div>
            @if ($pembayaran)
                <h1 class="mt-4 font-bold text-lg text-primary">Rincian Pembayaran</h1>
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
                                    :
                                    {{ 'Rp ' . number_format($pembayaran->total_harga ?? 0, 0, ',', '.') }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @else
                <h1 class="font-bold text-lg">Belum Melakukan Pembayaran</h1>
            @endif
        </div>
    </div>
@endsection
