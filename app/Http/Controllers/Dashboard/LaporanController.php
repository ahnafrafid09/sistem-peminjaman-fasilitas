<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $peminjaman = Peminjaman::with('tarif')->when($request->tanggal, function ($query) use ($request) {
            $query->whereDate('tanggal_peminjaman', $request->tanggal);
        })->get();

        return view('laporan.index', compact('peminjaman'));
    }

    public function show($id)
    {
        $peminjaman = Peminjaman::with(['tarif', 'fasilitas', 'user', 'detailFasilitas'])->findOrFail($id);

        $pembayaran = Pembayaran::where('peminjaman_id', $peminjaman->id)->first(); // atau ->get() kalau ingin semua

        // dd($peminjaman, $pembayaran);

        return view('laporan.show', compact('peminjaman', 'pembayaran'));
    }

    public function destroy($id)
    {
        // Ambil data peminjaman dengan relasi terkait
        $peminjaman = Peminjaman::with(['tarif', 'fasilitas', 'user', 'detailFasilitas'])->findOrFail($id);

        // Hapus pembayaran terkait (jika ada)
        Pembayaran::where('peminjaman_id', $peminjaman->id)->delete();

        // Hapus peminjaman
        $peminjaman->delete();

        return redirect()->route('laporan.index')->with('success', 'Data peminjaman berhasil dihapus.');
    }
}
