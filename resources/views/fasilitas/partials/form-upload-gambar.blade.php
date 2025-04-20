<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    {{-- THUMBNAIL --}}
    <div>
        <x-input-label for="thumbnail">Gambar Thumbnail</x-input-label>
        <x-text-input type="file" name="thumbnail" accept=".jpeg,.jpg,.png,.gif,.svg"
            class="w-full border p-2 rounded" />
        @if (isset($fasilitas) && $fasilitas->thumbnail)
            <div class="mt-2">
                <x-input-label for="thumbnail">Gambar Thumbnail Sekarang</x-input-label>
                <img src="{{ asset($fasilitas->thumbnail) }}" alt="Thumbnail"
                    class="w-40 h-40 object-cover rounded-md border">
            </div>
        @endif
    </div>

    {{-- GAMBAR DETAIL --}}
    <div>
        <x-input-label for="gambar_fasilitas[]">Detail Gambar</x-input-label>
        <x-text-input type="file" name="gambar_fasilitas[]" id="gambar_fasilitas[]"
            accept=".jpeg,.jpg,.png,.gif,.svg" multiple class="w-full border p-2 rounded" />
        @if (isset($fasilitas) && $fasilitas->detailGambarFasilitas && $fasilitas->detailGambarFasilitas->count())
            <div class="mt-2">
                <x-input-label for="thumbnail">Detail Gambar Sekarang</x-input-label>
                <div class="flex gap-2">
                    @foreach ($fasilitas->detailGambarFasilitas as $gambar)
                        <img src="{{ asset($gambar->url_gambar) }}" alt="Detail"
                            class="w-40 h-40 object-cover rounded-md border">
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
