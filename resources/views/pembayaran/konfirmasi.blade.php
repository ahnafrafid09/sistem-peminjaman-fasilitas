@extends('layouts.app')

@section('header')
    Pembayaran | Konfirmasi Pembayaran
@endsection

@section(section: 'content')
    <div class="w-full flex items-center justify-center">
        <div class="w-full max-w-4xl p-4 shadow-xl radius mx-auto">
            <div>
                <x-input-label>Nama Peminjam</x-input-label>
                <x-text-input class="w-1/2" value="{{ $pembayaran->peminjaman->user->nama_lengkap }}" disabled />
            </div>
            <div class="mt-4">
                <x-input-label>Fasilitas</x-input-label>
                <x-text-input class="w-1/2" value="{{ $pembayaran->peminjaman->fasilitas->nama }}" disabled />
            </div>
            <div class="mt-4">
                <x-input-label>Metode Pembayaran</x-input-label>
                <x-text-input class="w-1/2" value="{{ $pembayaran->metodePembayaran->nama_bank ?? 'Belum ada pembayaran' }}"
                    disabled />
            </div>
            <div class="mt-4">
                <x-input-label>Fasilitas</x-input-label>
                @if ($pembayaran->bukti_pembayaran)
                    <img src="{{ asset($pembayaran->bukti_pembayaran) }}" class="w-40 h-40" alt="">
                @endif
                <h1>Belum Melakukan Pembayaran</h1>
            </div>
            <div class="flex items-center justify-end mt-4 gap-4">
                <form action="{{ route('pembayaran.konfirmasi.tolak', $pembayaran->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <x-primary-button type="submit"
                        class="bg-red-600 hover:bg-red-500  rounded-md text-sm font-normal">Tolak</x-primary-button>
                </form>
                <form action="{{ route('pembayaran.konfirmasi.setuju', $pembayaran->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <x-primary-button type="submit" class=" rounded-md text-sm font-normal">Konfirmasi</x-primary-button>
                </form>
            </div>
        </div>
    </div>
@endsection
