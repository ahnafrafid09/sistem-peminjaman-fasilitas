<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <select name="jenis_fasilitas_id" x-model="fasilitas.jenis_fasilitas_id"
            class="block w-full rounded-md border-gray-300 bg-secondary shadow-sm text-black">
            <option value="" disabled hidden>-- Pilih Jenis --</option>
            @foreach ($jenisFasilitas as $jenis)
                <option value="{{ $jenis->id }}">{{ $jenis->nama }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <x-text-input type="text" name="nama" x-model="fasilitas.nama" required value="{{ old('nama') }}"
            class="w-full border p-2 rounded" placeholder="Masukan Nama Fasilitas" />
    </div>
    <div>
        <x-text-input type="number" name="unit" x-model="fasilitas.unit" value="{{ old('unit') }}"
            class="w-full border p-2 rounded" placeholder="Masukan Jumlah Unit" />
    </div>
    <div>
        <x-text-input type="number" step="0.01" name="luas" x-model="fasilitas.luas" value="{{ old('luas') }}"
            class="w-full border p-2 rounded" placeholder="Masukan Total Luas" />
    </div>
    <div>
        <x-text-input type="text" name="lama_sewa" x-model="fasilitas.lama_sewa" value="{{ old('lama_sewa') }}"
            class="w-full border p-2 rounded" placeholder="Masukan Lama Sewa: Contoh (Per Hari)" />
    </div>
</div>

<div class="mt-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <template x-for="(item, index) in fasilitas.fitur" :key="index">
            <div class="relative">
                <input type="text" :name="'fitur[' + index + ']'" x-model="fasilitas.fitur[index]"
                    class="w-full border-gray-300 focus:border-gray-300 focus:ring-gray-300 rounded-md shadow-xs text-black bg-secondary"
                    placeholder="Masukan Fasilitas Tambahan" :required="index === 0" />
                <!-- Tombol Hapus untuk item selain index pertama -->
                <button type="button" x-show="index > 0" @click="hapusFitur(index)"
                    class="absolute right-2 top-1/2 -translate-y-1/2 text-red-600 text-xs">
                    Hapus
                </button>
            </div>
        </template>
    </div>

    <button type="button" @click="fasilitas.fitur.push('')" class="text-blue-800 text-sm mt-2">
        + Tambah Fasilitas
    </button>
</div>
