<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Fasilitas;
use App\Models\KondisiBarang;
use Illuminate\Http\Request;

class ManajemenFasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil kondisi dari query string (misalnya: ?kondisi=baik)
        $kondisi = $request->input('kondisi');

        // Ambil semua fasilitas beserta barang terbaru yang sesuai kondisi
        $fasilitas = Fasilitas::with([
            'barang' => function ($query) use ($kondisi) {
                // Filter berdasarkan kondisi jika diberikan
                if ($kondisi) {
                    $query->where('kondisi', $kondisi);
                }
                // Urutkan berdasarkan tanggal dan ambil yang paling baru
                $query->latest('tanggal');
            }
        ])->get();

        // Ambil hanya barang pertama yang terbaru untuk setiap fasilitas
        $fasilitas = $fasilitas->map(function ($f) {
            // Ambil barang terbaru (pertama setelah diurutkan)
            $f->barang_terbaru = $f->barang->first();
            return $f;
        });

        // Filter hanya fasilitas yang memiliki barang terbaru (tidak null)
        $fasilitas = $fasilitas->filter(function ($f) {
            return $f->barang_terbaru !== null;
        })->values();

        return view("manajemen-fasilitas.index", compact('fasilitas', 'kondisi'));
    }





    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fasilitas = Fasilitas::all();
        return view("manajemen-fasilitas.create", compact('fasilitas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fasilitas_id' => 'required|exists:fasilitas,id',
            'nama_barang' => 'required|string',
            'tanggal' => 'required|date|after_or_equal:today',
            'kondisi' => 'required|string',
            'keterangan' => 'nullable|string'
        ]);

        Barang::create([
            'fasilitas_id' => $request->fasilitas_id,
            'nama_barang' => $request->nama_barang,
            'tanggal' => $request->tanggal,
            'kondisi' => $request->kondisi,
            'keterangan' => $request->keterangan,
        ]);
        return redirect()->route('manajemen-fasilitas.index')
            ->with('success', 'Berhasil Membuat Data Barang!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $fasilitas = Fasilitas::with('barang')->findOrFail($id);

        return view('manajemen-fasilitas.show', compact('fasilitas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Ambil data fasilitas beserta barang yang berelasi
        $fasilitas = Fasilitas::with('barang')->findOrFail($id);

        return view('manajemen-fasilitas.edit', compact('fasilitas'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $fasilitas_id)
    {
        $request->validate([
            'barang.*.nama_barang' => 'required|string',
            'barang.*.tanggal' => 'required|date|after_or_equal:today',
            'barang.*.kondisi' => 'required|string',
            'barang.*.keterangan' => 'nullable|string',
        ]);

        // Ambil data fasilitas
        $fasilitas = Fasilitas::findOrFail($fasilitas_id);

        // Looping untuk update setiap barang terkait fasilitas ini
        foreach ($request->barang as $key => $barangData) {
            $barang = Barang::findOrFail($key);
            $barang->update([
                'nama_barang' => $barangData['nama_barang'],
                'tanggal' => $barangData['tanggal'],
                'kondisi' => $barangData['kondisi'],
                'keterangan' => $barangData['keterangan'],
            ]);
        }

        return redirect()->route('manajemen-fasilitas.index')
            ->with('success', 'Berhasil Mengupdate Data Barang!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $barang = Barang::where('fasilitas_id', $id)->firstOrFail();


        $barang->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('manajemen-fasilitas.index')
            ->with('success', 'Data Barang berhasil dihapus!');
    }

}
