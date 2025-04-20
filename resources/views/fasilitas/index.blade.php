@extends('layouts.app')

@section('header')
    Fasilitas
@endsection

@section('content')
    <div class="container mx-auto px-4 py-6">
        {{-- Filter Form --}}
        <form method="GET" action="{{ route('fasilitas.index') }}" class="mb-6 w-full max-w-xl">
            <div class="space-y-4">
                <div class="flex items-start">
                    <label for="jenis_fasilitas_id" class="text-lg font-bold w-1/3 text-primary">Jenis Fasilitas</label>
                    <div class="w-full space-y-2">
                        <select name="jenis_fasilitas_id" id="jenis_fasilitas_id"
                            class="border-gray-300 rounded-md w-full shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">-- Semua Jenis --</option>
                            @foreach ($jenisList as $jenis)
                                <option value="{{ $jenis->id }}"
                                    {{ request('jenis_fasilitas_id') == $jenis->id ? 'selected' : '' }}>
                                    {{ $jenis->nama }}
                                </option>
                            @endforeach
                        </select>
                        <div class="flex justify-start">
                            <button type="submit"
                                class="bg-transparent text-black border border-primary cursor-pointer px-4 py-2 w-1/2 transition">Filter</button>
                            <a href="{{ route('fasilitas.index') }}"
                                class="bg-transparent text-black border border-primary cursor-pointer px-4 py-2 text-center w-1/2  transition">Reset</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        @can('create fasilitas')
            <div class="mb-4 text-right">
                <a href="{{ route('fasilitas.create') }}"
                    class="bg-primary text-white px-4 py-2 rounded hover:bg-primary/80 transition">
                    Tambah Fasilitas
                </a>
            </div>
        @endcan

        {{-- Menampilkan pesan jika tidak ada fasilitas --}}
        @if ($fasilitas->isEmpty())
            <div class="text-center py-6 text-gray-500">
                <p>Tidak ada fasilitas yang ditemukan</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($fasilitas as $item)
                    <div class="bg-primary rounded-lg shadow hover:shadow-md transition overflow-hidden p-4">
                        @if ($item->thumbnail)
                            <img src="{{ asset($item->thumbnail) }}" alt="{{ $item->nama }}"
                                class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">
                                Tidak ada gambar
                            </div>
                        @endif

                        <h3 class="text-lg text-white mt-2 font-semibold text-center mb-2">{{ $item->nama }}</h3>
                        <a href="{{ route('fasilitas.show', $item->id) }}"
                            class="w-full p-4 bg-white mt-2 text-primary font-bold text-lg hover:underline flex items-center justify-between">
                            Lihat Detail
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
