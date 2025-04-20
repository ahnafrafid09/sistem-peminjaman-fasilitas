@extends('layouts.app')

@section('header')
    Pembayaran
@endsection

@section('content')
    <form method="GET" action="{{ route('pembayaran.index') }}" class="mb-6 w-full max-w-xl px-4">
        <div class="space-y-4">
            <div class="flex flex-col sm:flex-row items-start gap-2">
                <label for="tanggal" class="text-lg font-bold text-primary sm:w-1/3">Tanggal Peminjaman</label>
                <div class="w-full space-y-2">
                    <x-text-input class="w-full flatpickr" type="text" name="tanggal" placeholder="DD-MM-YYYY" />
                    <div class="flex flex-col sm:flex-row gap-2">
                        <button type="submit"
                            class="bg-transparent text-black border border-primary cursor-pointer px-4 py-2 w-full sm:w-1/2 transition">Filter</button>
                        <a href="{{ route('pembayaran.index') }}"
                            class="bg-transparent text-black border border-primary cursor-pointer px-4 py-2 w-full sm:w-1/2 text-center transition">Reset</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="overflow-x-auto px-4">
        <table class="min-w-full bg-white border border-gray-300 text-sm sm:text-base">
            <thead class="bg-primary text-white">
                <tr>
                    <th class="px-4 py-2 text-left">Action</th>
                    <th class="px-4 py-2 text-left">Kode</th>
                    <th class="px-4 py-2 text-left">Nama</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pembayarans as $data)
                    <tr class="border-b">
                        <td class="px-4 py-2 border border-primary">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('pembayaran.show', $data->id) }}"
                                    class="flex items-center gap-1 p-1 rounded bg-blue-500 text-white text-xs sm:text-sm">
                                    <i class="fas fa-hand-holding-dollar"></i>
                                </a>
                                @role('admin')
                                    <a href="{{ route('pembayaran.konfirmasi.show', $data->id) }}"
                                        class="flex items-center gap-1 p-1 rounded bg-blue-500 text-white text-xs sm:text-sm">
                                        <i class="fa-solid fa-file-pen"></i>
                                    </a>
                                @endrole
                            </div>
                        </td>
                        <td class="px-4 py-2  border border-primary">{{ $data->kode }}</td>
                        <td class="px-4 py-2  border border-primary">{{ $data->peminjaman->user->nama_lengkap }}</td>
                        <td class="px-4 py-2  border border-primary">{{ $data->status }}</td>
                        <td class="px-4 py-2  border border-primary">
                            Status Peminjaman: {{ $data->peminjaman->status }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        flatpickr(".flatpickr", {
            dateFormat: "Y-m-d",
            allowInput: true,
        });
    </script>
@endsection
