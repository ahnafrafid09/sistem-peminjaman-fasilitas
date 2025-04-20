<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class KonfirmasiPeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $peminjaman = Peminjaman::when($request->tanggal, function ($query) use ($request) {
            $query->whereDate('tanggal_peminjaman', $request->tanggal);
        })->where('status', 'menunggu')->get();

        return view('konfirmasi-peminjaman.index', compact('peminjaman'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $peminjaman = Peminjaman::with(['user', 'fasilitas', 'fasilitas.jenisFasilitas', 'detailFasilitas'])->findOrFail($id);

        return view('konfirmasi-peminjaman.show', compact('peminjaman'));
    }

    public function tolak(string $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status = 'ditolak';
        $peminjaman->save();

        return redirect()->route('konfirmasi-peminjaman.index')->with('message', 'Peminjaman telah ditolak.');
    }

    public function rincianPembayaran($id)
    {
        $peminjaman = Peminjaman::with(['fasilitas', 'tarif'])->findOrFail($id);

        // Tampilkan view rincian pembayaran, kamu bisa ganti view-nya sesuai kebutuhan
        return view('konfirmasi-peminjaman.rincian', compact('peminjaman'));
    }

    public function konfirmasiPeminjaman($id)
    {
        $peminjaman = Peminjaman::with("tarif")->findOrFail($id);

        // Update status peminjaman
        $peminjaman->status = 'disetujui';
        $peminjaman->save();

        // Buat kode pembayaran unik
        $kodeUnik = 'BYR-' . now()->format('YmdHis') . '-' . rand(1000, 9999);

        // Create atau Update pembayaran
        Pembayaran::updateOrCreate(
            ['peminjaman_id' => $peminjaman->id],
            [
                'kode' => $kodeUnik,
                'total_harga' => $peminjaman->tarif->harga,
                'status' => 'menunggu pembayaran',
            ]
        );

        return redirect()->route('konfirmasi-peminjaman.index')
            ->with('success', 'Peminjaman disetujui dan pembayaran telah diperbarui/dibuat.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->delete();

        return redirect()->route('konfirmasi-peminjaman.index')->with('success', 'Data Pengajuan Peminjaman Berhasil Dihapus!');
    }
}
