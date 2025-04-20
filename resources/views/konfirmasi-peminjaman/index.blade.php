@extends('layouts.app')

@section('header')
    Konfirmasi Peminjaman
@endsection

@section('content')
    <form method="GET" action="{{ route('konfirmasi-peminjaman.index') }}" class="mb-6 w-full max-w-xl">
        <div class="space-y-4">
            <div class="flex flex-col sm:flex-row items-start">
                <label for="tanggal" class="text-lg font-bold sm:w-1/3 text-primary mb-2 sm:mb-0">Tanggal Peminjaman</label>
                <div class="w-full space-y-2">
                    <x-text-input class="w-full flatpickr" type="text" name="tanggal" placeholder="DD-MM-YYYY" />
                    <div class="flex flex-col sm:flex-row justify-start gap-2">
                        <button type="submit"
                            class="bg-transparent text-black border border-primary cursor-pointer px-4 py-2 w-full sm:w-1/2 transition">Filter</button>
                        <a href="{{ route('konfirmasi-peminjaman.index') }}"
                            class="bg-transparent text-black border border-primary cursor-pointer px-4 py-2 text-center w-full sm:w-1/2 transition">Reset</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-primary text-sm sm:text-base">
            <thead class="bg-primary text-white">
                <tr>
                    <th class="px-4 py-2 text-left border border-primary">Action</th>
                    <th class="px-4 py-2 text-left border border-primary">Kode</th>
                    <th class="px-4 py-2 text-left border border-primary">Nama</th>
                    <th class="px-4 py-2 text-left border border-primary">Harga</th>
                    <th class="px-4 py-2 text-left border border-primary">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($peminjaman as $data)
                    <tr class="hover:bg-gray-100">
                        <td class="px-4 py-2 border border-primary">
                            <div class="flex gap-3 items-center">
                                <a href="{{ route('konfirmasi-peminjaman.show', $data->id) }}"
                                    class="flex items-center gap-1 p-1 rounded bg-blue-500 text-white">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form method="POST" action="{{ route('konfirmasi-peminjaman.destroy', $data->id) }}"
                                    class="inline-block" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="cursor-pointer flex items-center gap-1 p-1 rounded bg-blue-500 text-white">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                        <td class="px-4 py-2 border border-primary">{{ $data->kode }}</td>
                        <td class="px-4 py-2 border border-primary">{{ $data->user->nama_lengkap }}</td>
                        <td class="px-4 py-2 border border-primary">
                            {{ 'Rp ' . number_format($data->tarif->harga ?? 0, 0, ',', '.') }}</td>
                        <td class="px-4 py-2 border border-primary">{{ $data->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        flatpickr(".flatpickr", {
            dateFormat: "d-m-Y",
            allowInput: true
        });
    </script>
@endsection
