<div x-show="showDetail">
    <template x-for="(detail, index) in detailList" :key="index">
        <div class="border border-gray-300 p-4 rounded mb-4">
            <!-- Input Detail Fasilitas -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <!-- Input Nama -->
                <input type="text" :name="'detail_fasilitas[' + index + '][nama]'" placeholder="Nama Detail Fasilitas"
                    x-model="detail.nama" class="w-full border-gray-300 rounded-md bg-secondary text-black">
                <!-- Input Unit -->
                <input type="text" :name="'detail_fasilitas[' + index + '][unit]'" placeholder="Jumlah Unit"
                    x-model="detail.unit" class="w-full border-gray-300 rounded-md bg-secondary text-black">
                <!-- Input Luas -->
                <input type="number" :name="'detail_fasilitas[' + index + '][luas]'" placeholder="Luas"
                    x-model="detail.luas" class="w-full border-gray-300 rounded-md bg-secondary text-black">
                <!-- Input Lama Sewa -->
                <input type="text" :name="'detail_fasilitas[' + index + '][lama_sewa]'" placeholder="Lama Sewa"
                    x-model="detail.lama_sewa" class="w-full border-gray-300 rounded-md bg-secondary text-black">
            </div>

            <!-- Input Tarif (Eksternal, Internal, Sosial) -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <template x-for="group in ['eksternal', 'internal', 'sosial']" :key="group">
                    <input type="number" :name="'detail_fasilitas[' + index + '][tarif][' + group + '][harga]'"
                        :placeholder="'Tarif ' + group" x-model="detail.tarif[group]"
                        class="w-full border-gray-300 rounded-md bg-secondary text-black" :required="showDetail">
                </template>
            </div>

            <!-- Input Hidden ID -->
            <input type="hidden" :name="'detail_fasilitas[' + index + '][id]'" :value="detail.id">

            <!-- Tombol Hapus Detail -->
            <x-secondary-button type="button" @click="hapusDetail(index)"
                class="text-white bg-red-500 hover:bg-red-400 text-xs rounded-sm mt-3">Hapus</x-secondary-button>
        </div>
    </template>

    <!-- Tombol Tambah Detail -->
    <x-secondary-button type="button" @click="tambahDetail()" class="rounded-sm text-sm">
        + Tambah Detail Lagi
    </x-secondary-button>
</div>
