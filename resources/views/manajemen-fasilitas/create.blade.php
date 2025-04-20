@extends('layouts.app')

@section('header')
    Manajemen Fasilitas | Tambah Barang
@endsection

@section('content')
    {{-- Include CSS Flatpickr --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <div>
        <form action="{{ route('manajemen-fasilitas.store') }}" method="POST">
            @csrf

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-4 rounded">
                    <strong>Terjadi kesalahan!</strong>
                    <ul class="mt-2 list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <select name="fasilitas_id" class="block w-full rounded-md border-gray-300 bg-secondary shadow-sm text-black">
                    <option value="">-- Pilih Fasilitas --</option>
                    @foreach ($fasilitas as $data)
                        <option value="{{ $data->id }}">{{ $data->nama }}</option>
                    @endforeach
                </select>

                <x-text-input name="nama_barang" placeholder="Masukan Nama Barang" value="{{ old('nama') }}" />

                {{-- Input tanggal dengan Flatpickr --}}
                <div class="w-full">
                    <x-text-input class="w-full flatpickr" name="tanggal" placeholder="Masukan Tanggal Pemeriksaan"
                        value="{{ old('tanggal') }}" />
                    <x-input-label>Masukan Tanggal Pemeriksaan</x-input-label>
                </div>

                <select name="kondisi" class="block w-full rounded-md border-gray-300 bg-secondary shadow-sm text-black">
                    <option value="">-- Pilih Status --</option>
                    <option value="baik">Baik</option>
                    <option value="perlu diperbaiki">Perlu Diperbaiki</option>
                    <option value="rusak parah">Rusak Parah</option>
                    <option value="sedang diperbaiki">Sedang Diperbaiki</option>
                    <option value="diganti">Diganti</option>
                </select>

                <x-text-input class="w-full" name="keterangan" placeholder="Masukan Keterangan"
                    value="{{ old('keterangan') }}" />
            </div>

            <div class="flex justify-end mt-2 gap-2">
                <x-primary-button type="button" class="rounded-md text-sm font-normal bg-red-600 hover:bg-red-500">
                    <a href="{{ route('manajemen-fasilitas.index') }}">Keluar</a>
                </x-primary-button>
                <x-primary-button type="submit" class="rounded-md text-sm font-normal">Tambah Barang</x-primary-button>
            </div>
        </form>
    </div>

    <script>
        flatpickr(".flatpickr", {
            dateFormat: "Y-m-d", // Format: 2025-04-20
            altInput: true,
            minDate: "today",
            altFormat: "d F Y", // Format tampilan: 20 April 2025
            allowInput: true,
        });
    </script>
@endsection
