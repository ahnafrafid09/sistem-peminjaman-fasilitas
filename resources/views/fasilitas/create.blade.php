@extends('layouts.app')

@section('header')
    Tambah Fasilitas
@endsection

@section('content')
    <div x-data="fasilitasForm()">

        <form method="POST" action="{{ route('fasilitas.store') }}" enctype="multipart/form-data">
            @csrf

            @include('fasilitas.partials.form-error')
            <div class="mb-2">
                <h2 class="font-bold text-lg">Data Fasilitas</h2>
                @include('fasilitas.partials.form-fasilitas', ['jenisFasilitas' => $jenisFasilitas])
            </div>
            <div class="mb-2 mt-8">
                <h2 class="font-bold text-lg">Upload Gambar</h2>
                @include('fasilitas.partials.form-upload-gambar')
            </div>
            <div x-show="!showDetail" class="mt-8">
                <x-secondary-button type="button" @click="aktifkanDetail()" class="text-sm rounded-sm">+ Tambah Detail
                    Fasilitas</x-secondary-button>
            </div>
            <div class="mb-2 mt-8" x-show="!showDetail">
                <h2 class="font-bold text-lg">Data Tarif</h2>
                @include('fasilitas.partials.form-tarif')
            </div>
            <div class="mb-2 mt-8" x-show="showDetail">
                <h2 class="font-bold text-lg">Data Detail Fasilitas</h2>
                @include('fasilitas.partials.form-detail-fasilitas')
            </div>


            <div class="flex items-center justify-end gap-2 mt-10">
                <x-secondary-button class="bg-red-600 hover:bg-red-500 font-normal rounded-md">
                    <a href={{ route('fasilitas.index') }}>Keluar</a>
                </x-secondary-button>
                <x-secondary-button type="submit" class=" font-normal rounded-md">
                    Simpan
                </x-secondary-button>
            </div>
        </form>
    </div>


    <script>
        function fasilitasForm() {
            return {
                fasilitas: {
                    jenis_fasilitas_id: '',
                    nama: '',
                    unit: '',
                    luas: '',
                    lama_sewa: '',
                    fitur: [''] // Inisialisasi array dengan satu input fitur default
                },
                fiturBaru: '',
                tarif: {
                    eksternal: '',
                    internal: '',
                    sosial: ''
                },
                showDetail: false,
                detailList: [],

                aktifkanDetail() {
                    this.showDetail = true;
                    this.tarif = {
                        eksternal: '',
                        internal: '',
                        sosial: ''
                    };
                    this.tambahDetail();
                },

                tambahDetail() {
                    this.detailList.push({
                        nama: '',
                        unit: '',
                        luas: '',
                        lama_sewa: '',
                        tarif: {
                            eksternal: '',
                            internal: '',
                            sosial: ''
                        }
                    });
                },

                hapusDetail(index) {
                    this.detailList.splice(index, 1);
                    if (this.detailList.length === 0) {
                        this.showDetail = false;
                    }
                },

                tambahFitur() {
                    if (this.fiturBaru.trim() !== '') {
                        this.form.fitur.push(this.fiturBaru.trim());
                        this.fiturBaru = '';
                    }
                },

                hapusFitur(index) {
                    this.form.fitur.splice(index, 1);
                }
            }
        }
    </script>
@endsection
