@php
    // Daftar link dengan penyesuaian URL berdasarkan role pengguna
    $links = [
        ['label' => 'Dashboard', 'url' => route('dashboard'), 'permission' => 'read dashboard'],
        ['label' => 'Pengguna', 'url' => route('pengguna.index'), 'permission' => 'read pengguna'],
        ['label' => 'Fasilitas', 'url' => route('fasilitas.index'), 'permission' => 'read fasilitas'],
        [
            'label' => 'Manajemen Fasilitas',
            'url' => route('manajemen-fasilitas.index'),
            'permission' => 'read manajemen fasilitas',
        ],
        [
            'label' => 'Pengajuan Peminjaman',
            'url' => route('pengajuan.create'),
            'permission' => 'read pengajuan peminjaman',
        ],
        [
            'label' => 'Konfirmasi Peminjaman',
            'url' => route('konfirmasi-peminjaman.index'),
            'permission' => 'read konfirmasi peminjaman',
        ],
        ['label' => 'Pembayaran', 'url' => route('pembayaran.index'), 'permission' => 'read pembayaran'],
        ['label' => 'Laporan', 'url' => route('laporan.index'), 'permission' => 'read laporan'],
    ];

@endphp

@foreach ($links as $link)
    @if ($link['permission'] === null || auth()->user()->can($link['permission']))
        <a href={{ $link['url'] }}
            class="flex items-center gap-4 px-4 py-2 rounded-md hover:bg-gray-800 transition sidebar-link">
            <span class="sidebar-text">{{ $link['label'] }}</span>
        </a>
    @endif
@endforeach
