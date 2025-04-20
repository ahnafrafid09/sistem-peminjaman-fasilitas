<div x-show="!showDetail" class="grid grid-cols-1 sm:grid-cols-3 gap-4">
    <template x-for="group in ['eksternal', 'internal', 'sosial']" :key="group">
        <input type="number"
            class="w-full border-gray-300 focus:border-gray-300 focus:ring-gray-300 rounded-md shadow-xs text-black bg-secondary"
            :name="'tarif[' + group + '][harga]'" x-model="tarif[group]" :placeholder="'Masukan Tarif ' + group"
            :required="!showDetail">
    </template>
</div>
