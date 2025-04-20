@isset($dataPeminjaman)
    <div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mx-auto max-w-7xl">

            <div class="bg-primary p-4 rounded-lg shadow-lg max-w-xs">
                <div class="text-center flex items-center justify-center gap-2 flex-col">
                    <i class="fas fa-gear  text-4xl text-white mb-4"></i>
                    <h3 class="text-lg text-white font-semibold mb-2">Manajemen Fasilitas</h3>
                    <a href="{{ route('manajemen-fasilitas.index') }}"
                        class="w-full p-3 bg-white mt-2 text-primary font-bold text-lg hover:underline flex items-center justify-between">
                        Lihat Detail
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div class="bg-primary p-4 rounded-lg shadow-lg max-w-xs">
                <div class="text-center flex items-center justify-center gap-2 flex-col">
                    <i class="fas fa-clipboard-check text-4xl text-white mb-4"></i>
                    <h3 class="text-lg text-white font-semibold mb-2">Pembayaran</h3>
                    <a href="{{ route('pembayaran.index') }}"
                        class="w-full p-3 bg-white mt-2 text-primary font-bold text-lg hover:underline flex items-center justify-between">
                        Lihat Detail
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Card Fasilitas -->
            <div class="bg-primary p-4 rounded-lg shadow-lg max-w-xs">
                <div class="text-center flex items-center justify-center gap-2 flex-col">
                    <i class="fas fa-house text-4xl text-white mb-4"></i>
                    <h3 class="text-lg  text-white font-semibold mb-2">Data Fasilitas</h3>
                    <a href="{{ route('fasilitas.index') }}"
                        class="w-full p-3 bg-white mt-2 text-primary font-bold text-lg hover:underline flex items-center justify-between">
                        Lihat Detail
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Card Pembayaran -->
            @role('pengelola')
                <div class="bg-primary p-4 rounded-lg shadow-lg max-w-xs">
                    <div class="text-center flex items-center justify-center gap-2 flex-col">
                        <i class="fas fa-user text-4xl text-white mb-4"></i>
                        <h3 class="text-lg text-white font-semibold mb-2">Pengajuan Peminjaman</h3>
                        <a href="{{ route('pengajuan.index') }}"
                            class="w-full p-3 bg-white mt-2 text-primary font-bold text-lg hover:underline flex items-center justify-between">
                            Lihat Detail
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            @endrole

            @role('admin')
                <div class="bg-primary p-4 rounded-lg shadow-lg max-w-xs">
                    <div class="text-center flex items-center justify-center gap-2 flex-col">
                        <i class="fas fa-user text-4xl text-white mb-4"></i>
                        <h3 class="text-lg text-white font-semibold mb-2">Manajemen Pengguna</h3>
                        <a href="{{ route('pengguna.index') }}"
                            class="w-full p-3 bg-white mt-2 text-primary font-bold text-lg hover:underline flex items-center justify-between">
                            Lihat Detail
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            @endrole

        </div>
    </div>
    <div class="mt-6">
        <h2 class="text-2xl font-bold text-center">Data Peminjaman</h2>
        <table class="w-full text-left border-collapse">
            <thead class="bg-primary text-white">
                <tr class="border-b">
                    <th class="p-2">#</th>
                    <th class="p-2">Nama Peminjam</th>
                    <th class="p-2">Fasilitas</th>
                    <th class="p-2">Tanggal Peminjaman</th>
                    <th class="p-2">Keterangan</th>
                </tr>
            </thead>
            <tbody class="border border-primary">
                @forelse ($dataPeminjaman as $peminjaman)
                    <tr class=" ">
                        <td class="p-2 border border-primary">{{ $loop->iteration }}</td>
                        <td class="p-2 border border-primary">{{ $peminjaman->user->nama_lengkap }}</td>
                        <td class="p-2 border border-primary">{{ $peminjaman->fasilitas->nama }}</td>
                        <td class="p-2 border border-primary">{{ $peminjaman->tanggal_peminjaman }}</td>
                        <td class="p-2 border border-primary">Status pengajuan peminjaman {{ $peminjaman->status }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-2 text-center text-primary">Data tidak tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endisset
