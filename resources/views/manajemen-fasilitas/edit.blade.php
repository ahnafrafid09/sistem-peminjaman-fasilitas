@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-xl font-semibold mb-4">Edit Barang di Fasilitas: {{ $fasilitas->nama_fasilitas }}</h2>

        <form action="{{ route('manajemen-fasilitas.update', $fasilitas->id) }}" method="POST">
            @csrf
            @method('PUT')

            <input type="hidden" name="fasilitas_id" value="{{ $fasilitas->id }}">

            <div class="space-y-4">
                @foreach ($fasilitas->barang as $barang)
                    <div class="border p-4 rounded-md">
                        <div class="mb-4">
                            <label for="nama_barang_{{ $barang->id }}" class="block font-medium text-gray-700">Nama
                                Barang</label>
                            <input type="text" id="nama_barang_{{ $barang->id }}"
                                name="barang[{{ $barang->id }}][nama_barang]"
                                value="{{ old('barang.' . $barang->id . '.nama_barang', $barang->nama_barang) }}"
                                class="w-full p-2 border border-gray-300 rounded-md" required>
                        </div>

                        <div class="mb-4">
                            <label for="tanggal_{{ $barang->id }}" class="block font-medium text-gray-700">Tanggal</label>
                            <input type="date" id="tanggal_{{ $barang->id }}"
                                name="barang[{{ $barang->id }}][tanggal]"
                                value="{{ old('barang.' . $barang->id . '.tanggal', $barang->tanggal) }}"
                                class="w-full p-2 border border-gray-300 rounded-md flatpickr" required>
                        </div>

                        <div class="mb-4">
                            <label for="kondisi_{{ $barang->id }}"
                                class="block font-medium text-gray-700">Kondisi</label>
                            <select id="kondisi_{{ $barang->id }}" name="barang[{{ $barang->id }}][kondisi]"
                                class="w-full p-2 border border-gray-300 rounded-md" required>
                                <option value="baik"
                                    {{ old('barang.' . $barang->id . '.kondisi', $barang->kondisi) == 'baik' ? 'selected' : '' }}>
                                    Baik</option>
                                <option value="perlu diperbaiki"
                                    {{ old('barang.' . $barang->id . '.kondisi', $barang->kondisi) == 'perlu diperbaiki' ? 'selected' : '' }}>
                                    Perlu Diperbaiki</option>
                                <option value="rusak parah"
                                    {{ old('barang.' . $barang->id . '.kondisi', $barang->kondisi) == 'rusak parah' ? 'selected' : '' }}>
                                    Rusak Parah</option>
                                <option value="sedang diperbaiki"
                                    {{ old('barang.' . $barang->id . '.kondisi', $barang->kondisi) == 'sedang diperbaiki' ? 'selected' : '' }}>
                                    Sedang Diperbaiki</option>
                                <option value="diganti"
                                    {{ old('barang.' . $barang->id . '.kondisi', $barang->kondisi) == 'diganti' ? 'selected' : '' }}>
                                    Diganti</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="keterangan_{{ $barang->id }}"
                                class="block font-medium text-gray-700">Keterangan</label>
                            <textarea id="keterangan_{{ $barang->id }}" name="barang[{{ $barang->id }}][keterangan]"
                                class="w-full p-2 border border-gray-300 rounded-md">{{ old('barang.' . $barang->id . '.keterangan', $barang->keterangan) }}</textarea>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md">Update Data Barang</button>
            </div>
        </form>
    </div>
    <script>
        flatpickr(".flatpickr", {
            dateFormat: "Y-m-d", // Format: 2025-04-20
            altInput: true,
            altFormat: "d F Y", // Format tampilan: 20 April 2025
            allowInput: true,
        });
    </script>
@endsection
