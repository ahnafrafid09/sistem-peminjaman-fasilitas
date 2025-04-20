@extends('layouts.app')

@section('header')
    Konfirmasi Peminjaman | Data Peminjam
@endsection

@section('content')
    <div class="flex flex-col sm:flex-row gap-6 sm:gap-10 px-4">
        <!-- Icon & Judul -->
        <div class="flex justify-center">
            <div class="flex flex-col items-center justify-center rounded-md bg-primary w-32 h-32 sm:w-40 sm:h-40">
                <i class="fas fa-user text-5xl sm:text-7xl text-white mb-2 sm:mb-4"></i>
                <h1 class="font-bold text-white text-center text-base sm:text-lg">Data Peminjaman</h1>
            </div>
        </div>

        <!-- Form Info -->
        <div class="w-full sm:w-2/3 lg:w-1/2">
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
                @if ($peminjaman->user->foto_ktp && $peminjaman->user->foto_ktp != '')
                    <a href="{{ asset($peminjaman->user->foto_ktp) }}" target="_blank"
                        class="block w-full text-sm text-blue-600 hover:underline">
                        {{ $peminjaman->user->ktp_name }}
                    </a>
                @else
                    <x-text-input class="w-full" value="Pengguna belum upload foto ktp" disabled />
                @endif
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

            <h1 class="mt-4 font-bold text-base sm:text-lg text-primary">Lama Sewa</h1>

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

            <div class="mb-4 flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4">
                <label for="setuju_sk" class="text-sm text-gray-700">
                    Saya telah membaca dan menyetujui <span class="font-semibold">Syarat & Ketentuan</span> peminjaman
                </label>
                <input type="checkbox" id="setuju_sk" name="setuju_sk" class="w-5 h-5 text-blue-600 border-gray-300 rounded"
                    required>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
                <form action="{{ route('konfirmasi-peminjaman.tolak', $peminjaman->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 w-full sm:w-auto rounded">Tolak</button>
                </form>
                <form action="{{ route('konfirmasi-peminjaman.rincian', $peminjaman->id) }}" method="GET">
                    <button type="submit"
                        class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 w-full sm:w-auto rounded">Setuju</button>
                </form>
            </div>
        </div>
    </div>
@endsection
