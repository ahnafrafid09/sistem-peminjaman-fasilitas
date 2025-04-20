@isset($dataPeminjaman)
    <div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mx-auto max-w-7xl">

            <!-- Card Pengajuan Peminjaman -->
            <div class="bg-primary p-4 rounded-lg shadow-lg max-w-xs">
                <div class="text-center flex items-center justify-center gap-2 flex-col">
                    <i class="fas fa-clipboard-check text-4xl text-white mb-4"></i>
                    <h3 class="text-lg text-white font-semibold mb-2">Pengajuan Peminjaman</h3>
                    <a href="{{ route('pengajuan.create') }}"
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
                    <h3 class="text-lg  text-white font-semibold mb-2">Fasilitas</h3>
                    <a href="{{ route('fasilitas.index') }}"
                        class="w-full p-3 bg-white mt-2 text-primary font-bold text-lg hover:underline flex items-center justify-between">
                        Lihat Detail
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Card Pembayaran -->
            <div class="bg-primary p-4 rounded-lg shadow-lg max-w-xs">
                <div class="text-center flex items-center justify-center gap-2 flex-col">
                    <i class="fas fa-hand-holding-dollar text-4xl text-white mb-4"></i>
                    <h3 class="text-lg text-white font-semibold mb-2">Pembayaran</h3>
                    <a href="{{ route('pembayaran.index') }}"
                        class="w-full p-3 bg-white mt-2 text-primary font-bold text-lg hover:underline flex items-center justify-between">
                        Lihat Detail
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>

    <div class="mt-6">
        <h1 class="text-center font-bold text-2xl">Data Peminjam</h1>
        <table class="w-full text-left border border-primary ">
            <thead class="bg-primary text-white">
                <tr class="border-b">
                    <th class="p-2">No</th>
                    <th class="p-2">Fasilitas</th>
                    <th class="p-2">Aktif</th>
                    <th class="p-2">Menunggu</th>
                    <th class="p-2">Disetujui</th>
                    <th class="p-2">Ditolak</th>
                    <th class="p-2">Keterangan</th>
                </tr>
            </thead>
            <tbody class="border border-primary">
                @forelse ($dataPeminjaman as $peminjaman)
                    <tr class="">
                        <td class="p-2 border border-primary">{{ $loop->iteration }}</td>
                        <td class="p-2 border border-primary">{{ $peminjaman->fasilitas->nama ?? '-' }}</td>

                        {{-- Kolom Aktif --}}
                        <td class="p-2 text-center border border-primary">
                            @if ($peminjaman->status === 'aktif')
                                <i class="fas fa-check-circle text-green-500"></i>
                            @endif
                        </td>

                        {{-- Kolom Menunggu --}}
                        <td class="p-2 text-center border border-primary">
                            @if ($peminjaman->status === 'menunggu')
                                <i class="fas fa-check-circle text-green-500"></i>
                            @endif
                        </td>

                        {{-- Kolom Disetujui --}}
                        <td class="p-2 text-center border border-primary">
                            @if ($peminjaman->status === 'disetujui')
                                <i class="fas fa-check-circle text-green-500"></i>
                            @endif
                        </td>

                        {{-- Kolom Ditolak --}}
                        <td class="p-2 text-center border border-primary">
                            @if ($peminjaman->status === 'ditolak')
                                <i class="fas fa-check-circle text-green-500"></i>
                            @endif
                        </td>

                        {{-- Kolom Keterangan --}}
                        <td class="p-2 border border-primary">
                            Status pengajuan peminjaman fasilitas anda adalah {{ $peminjaman->status }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="p-2 text-center text-primary">Data tidak tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">
        <h2 class="text-2xl font-bold text-center">Syarat dan Ketentuan</h2>
        <div class="rounded p-6 space-y-4 shadow-2xl">

            <!-- 1. Pihak yang Berhak Mengajukan Peminjaman -->
            <div>
                <h3 class="font-semibold text-lg mb-2">1. Pihak yang Berhak Mengajukan Peminjaman</h3>
                <ul class="list-disc list-inside space-y-1">
                    <li>Mahasiswa aktif, dosen, staf kampus, dan masyarakat umum</li>
                    <li>Harus memiliki akun terdaftar di sistem</li>
                    <li>Peminjaman atas nama organisasi wajib mencantumkan penanggung jawab resmi</li>
                </ul>
            </div>

            <!-- 2. Prosedur Peminjaman -->
            <div>
                <h3 class="font-semibold text-lg mb-2">2. Prosedur Peminjaman</h3>
                <ul class="list-disc list-inside space-y-1">
                    <li>Melakukan pengecekan ketersediaan fasilitas melalui sistem</li>
                    <li>Mengisi form pengajuan lengkap, termasuk tanggal, waktu, dan keperluan</li>
                    <li>Menunggu verifikasi dan persetujuan dari admin</li>
                    <li>Melakukan pembayaran (jika berlaku)</li>
                    <li>Menyimpan bukti peminjaman yang telah disetujui</li>
                </ul>
            </div>

            <!-- 3. Ketentuan Penggunaan -->
            <div>
                <h3 class="font-semibold text-lg mb-2">3. Ketentuan Penggunaan</h3>
                <ul class="list-disc list-inside space-y-1">
                    <li>Peminjam bertanggung jawab penuh atas kebersihan dan keamanan fasilitas</li>
                    <li>Tidak diperbolehkan menggunakan fasilitas untuk kegiatan yang melanggar hukum atau norma kampus</li>
                    <li>Tidak boleh memindahkan atau merusak komponen dalam fasilitas (meja, kursi, AC, lampu, gorden, dll)
                    </li>
                    <li>Dilarang menginap tanpa izin tertulis</li>
                </ul>
            </div>

            <!-- 4. Pembatalan & Perubahan Jadwal -->
            <div>
                <h3 class="font-semibold text-lg mb-2">4. Pembatalan & Perubahan Jadwal</h3>
                <ul class="list-disc list-inside space-y-1">
                    <li>Pembatalan maksimal H-2 sebelum tanggal pemakaian</li>
                    <li>Perubahan jadwal harus disetujui ulang oleh admin</li>
                    <li>Pembayaran tidak dikembalikan jika pembatalan dilakukan pada hari-H</li>
                </ul>
            </div>

            <!-- 5. Pemeriksaan & Tindak Lanjut -->
            <div>
                <h3 class="font-semibold text-lg mb-2">5. Pemeriksaan & Tindak Lanjut</h3>
                <ul class="list-disc list-inside space-y-1">
                    <li>Pengelola akan melakukan pengecekan sebelum dan sesudah peminjaman</li>
                    <li>Jika ditemukan kerusakan atau kehilangan, peminjam wajib mengganti sesuai nilai kerugian</li>
                    <li>Pelanggaran akan dikenai sanksi administratif sesuai kebijakan kampus</li>
                </ul>
            </div>

            <!-- 6. Hak Pengelola & Admin -->
            <div>
                <h3 class="font-semibold text-lg mb-2">6. Hak Pengelola & Admin</h3>
                <ul class="list-disc list-inside space-y-1">
                    <li>Berhak menolak pengajuan yang tidak sesuai</li>
                    <li>Berhak mengubah jadwal atau lokasi dengan pemberitahuan sebelumnya</li>
                    <li>Berhak membatalkan peminjaman jika ditemukan penyalahgunaan</li>
                </ul>
            </div>

        </div>
    </div>
    <div class="bg-primary text-white p-4 mt-10 flex flex-col md:flex-row w-full justify-between items-start">

        <div class="flex flex-col sm:flex-row sm:items-start sm:space-x-4 w-1/3">
            <!-- Logo -->
            <div class="mb-2 sm:mb-0">
                <img src="/images/logo.webp" alt="Logo" class="w-20 h-20 object-contain">
            </div>

            <!-- Judul dan Kontak -->
            <div>
                <h3 class="text-xl font-bold">Politeknik Negeri Malang</h3>
                <div class="mt-2">
                    <p> <span class="font-semibold">Telepon: </span>0852-4661-4433</p>

                </div>
            </div>
        </div>

        <!-- Kanan: Alamat dan Jam Layanan -->
        <div class="text-left w-2/3">
            <h4 class="text-lg font-bold mb-2">Alamat Pengelola Usaha</h4>
            <p>
                Jl. Soekarno Hatta No. 09 Lowokwaru Malang Kantor Pusat Politeknik
                Negeri Malang Gedung AA Lantai 1 – Ruang Pengelola Usaha
            </p>


            <h4 class="text-lg font-bold mt-4 mb-2">Jam Layanan</h4>
            <p>Hari Kerja: Senin - Jumat</p>
            <p>Jam Kerja: 08.00 - 16.00</p>
        </div>
    </div>
    </div>


@endisset
