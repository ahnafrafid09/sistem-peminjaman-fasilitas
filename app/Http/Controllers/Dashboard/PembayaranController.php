<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\MetodePembayaran;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $tanggal = $request->input('tanggal');

        $query = Pembayaran::with(['peminjaman', 'metodePembayaran']);

        if ($user->hasRole('admin')) {
            if ($tanggal) {
                $query->whereHas('peminjaman', function ($q) use ($tanggal) {
                    $q->whereDate('tanggal_peminjaman', $tanggal);
                });
            }

            $pembayarans = $query->latest()->get();

            return view('pembayaran.index', [
                'role' => 'admin',
                'pembayarans' => $pembayarans,
                'tanggal' => $tanggal
            ]);
        }

        // Untuk user biasa: hanya bisa melihat pembayaran miliknya
        $query->whereHas('peminjaman', function ($q) use ($user, $tanggal) {
            $q->where('user_id', $user->id);
            if ($tanggal) {
                $q->whereDate('tanggal_peminjaman', $tanggal);
            }
        });

        $pembayarans = $query->latest()->get();

        return view('pembayaran.index', [
            'role' => $user->getRoleNames()->first(),
            'pembayarans' => $pembayarans,
            'tanggal' => $tanggal
        ]);


    }

    public function show(string $id)
    {
        $pembayaran = Pembayaran::with('peminjaman')->findOrFail($id);

        $metode = MetodePembayaran::all();

        return view('pembayaran.show', compact('pembayaran', 'metode'));
    }

    public function pilihMetode(Request $request, $id)
    {
        $request->validate([
            'metode_pembayaran' => 'required|exists:metode_pembayarans,id',
        ]);
        $pembayaran = Pembayaran::findOrFail($id);

        $pembayaran->metode_pembayaran_id = $request->metode_pembayaran;
        $pembayaran->expired_at = now()->addMinutes(30);
        $pembayaran->save();

        return redirect()->route('pembayaran.bayar', $pembayaran->id)
            ->with('success', 'Metode pembayaran berhasil dipilih.');
    }
    public function bayarForm($id)
    {
        // Mengambil data pembayaran
        $pembayaran = Pembayaran::with('metodePembayaran')->findOrFail($id);

        // Hanya menampilkan form jika belum kadaluarsa
        return view('pembayaran.bayar', compact('pembayaran'));
    }

    public function bayarStore(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'bukti_pembayaran' => 'required|image|max:2048',
        ]);

        // Ambil data pembayaran
        $pembayaran = Pembayaran::findOrFail($id);

        // Cek apakah pembayaran sudah kedaluwarsa
        if ($pembayaran->expired_at && now()->gt($pembayaran->expired_at)) {
            $pembayaran->status = 'ditolak';  // Jika kedaluwarsa, ubah status ke 'ditolak'
            $pembayaran->save();
            return back()->with('error', 'Waktu pembayaran telah habis.');
        }

        // Proses upload bukti pembayaran
        $buktiPembayaran = $request->file('bukti_pembayaran');
        $buktiPembayaranName = time() . '_' . $buktiPembayaran->getClientOriginalName();
        $buktiPembayaranPath = $buktiPembayaran->storeAs('images/bukti-pembayaran', $buktiPembayaranName, 'public');

        // Simpan bukti pembayaran dan ubah status menjadi 'menunggu disetujui'
        $pembayaran->bukti_pembayaran = '/storage/' . $buktiPembayaranPath;
        $pembayaran->status = 'menunggu disetujui';
        $pembayaran->save();

        // Redirect ke halaman detail pembayaran
        return redirect()->route('pembayaran.show', $pembayaran->id)->with('success', 'Bukti pembayaran berhasil dikirim.');
    }

    public function konfirmasiPembayaranShow(string $id)
    {
        $pembayaran = Pembayaran::with(['metodePembayaran', 'peminjaman'])->findOrFail($id);
        // dd($pembayaran);
        return view('pembayaran.konfirmasi', compact('pembayaran'));
    }

    public function konfirmasiPembayaran(string $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $pembayaran->status = 'disetujui';
        $pembayaran->save();

        return redirect()->route('pembayaran.index')->with('success', 'Pembyaran berhasil disetujui.');
    }

    public function tolakPembayaran(string $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $pembayaran->status = 'ditolak';
        $pembayaran->save();

        return redirect()->route('pembayaran.index')->with('success', 'Pembyaran berhasil ditolak.');
    }

}
