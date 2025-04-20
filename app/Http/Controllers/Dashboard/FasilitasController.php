<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\DetailFasilitas;
use App\Models\DetailGambarFasilitas;
use App\Models\Fasilitas;
use App\Models\JenisFasilitas;
use App\Models\Tarif;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $jenisId = $request->input('jenis_fasilitas_id');

        $query = Fasilitas::with('jenisFasilitas');

        if ($search) {
            $query->where('nama', 'like', '%' . $search . '%');
        }

        if ($jenisId) {
            $query->where('jenis_fasilitas_id', $jenisId);
        }

        $fasilitas = $query->get();
        $jenisList = JenisFasilitas::all();

        return view('fasilitas.index', compact('fasilitas', 'jenisList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenisFasilitas = JenisFasilitas::all();
        return view("fasilitas.create", compact('jenisFasilitas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    private function generateKodeFasilitas()
    {
        $lastKode = Fasilitas::orderBy('id', 'desc')->value('kode_fasilitas');

        if ($lastKode && preg_match('/^F-(\d{4})$/', $lastKode, $matches)) {
            $number = (int) $matches[1] + 1;
        } else {
            $number = 1;
        }

        return 'F-' . str_pad($number, 4, '0', STR_PAD_LEFT); // contoh: F-0001
    }
    public function store(Request $request)
    {
        $request->validate([
            'jenis_fasilitas_id' => 'required|exists:jenis_fasilitas,id',
            'nama' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|max:2048',
            'unit' => 'nullable|string|max:255',
            'luas' => 'nullable|numeric',
            'lama_sewa' => 'nullable|string',
            'gambar_fasilitas' => 'nullable|array',
            'gambar_fasilitas.*' => 'nullable|image',
            'detail_fasilitas' => 'nullable|array',
            'detail_fasilitas.*.nama' => 'required|string|max:255',
            'detail_fasilitas.*.unit' => 'nullable|string|max:255',
            'detail_fasilitas.*.luas' => 'nullable|numeric',
            'detail_fasilitas.*.tarif.eksternal.harga' => 'nullable|numeric',
            'detail_fasilitas.*.tarif.internal.harga' => 'nullable|numeric',
            'detail_fasilitas.*.tarif.sosial.harga' => 'nullable|numeric',
            'detail_fasilitas.*.lama_sewa' => 'nullable|string|max:255',
            'tarif' => 'nullable|array',
            'tarif.*.kelompok_tarif' => 'nullable|string|in:eksternal,internal,sosial',
            'tarif.*.harga' => 'nullable|numeric',
            'fitur' => 'nullable|array',
            'fitur.*' => 'nullable|string|max:255'
        ]);

        $kodeFasilitas = $this->generateKodeFasilitas();

        $thumbnail = $request->file('thumbnail');
        $thumbnailName = time() . '_' . $thumbnail->getClientOriginalName();
        $thumbnailPath = $thumbnail->storeAs('images/thumbnail', $thumbnailName, 'public');

        // Menyimpan fasilitas
        $fasilitas = Fasilitas::create([
            'jenis_fasilitas_id' => $request->jenis_fasilitas_id,
            'kode_fasilitas' => $kodeFasilitas,
            'nama' => $request->nama,
            'unit' => $request->unit,
            'luas' => $request->luas,
            'lama_sewa' => $request->lama_sewa,
            'thumbnail' => 'storage/' . $thumbnailPath,
            'fitur' => $request->fitur
        ]);

        if ($request->hasFile('gambar_fasilitas')) {
            foreach ($request->file('gambar_fasilitas') as $gambar) {
                $namaGambar = time() . '_' . $gambar->getClientOriginalName();
                $gambarPath = $gambar->storeAs('images/detail-image', $namaGambar, 'public');

                DetailGambarFasilitas::create([
                    'fasilitas_id' => $fasilitas->id,
                    'url_gambar' => 'storage/' . $gambarPath // untuk diakses via URL
                ]);
            }
        }

        // Menyimpan detail fasilitas jika ada
        if ($request->has('detail_fasilitas')) {
            foreach ($request->detail_fasilitas as $detail) {
                $detail_fasilitas = DetailFasilitas::create([
                    'fasilitas_id' => $fasilitas->id,
                    'nama' => $detail['nama'],
                    'unit' => $detail['unit'],
                    'luas' => $detail['luas'],
                    'lama_sewa' => $detail['lama_sewa'],
                ]);

                // Menyimpan tarif untuk setiap detail fasilitas
                foreach (['eksternal', 'internal', 'sosial'] as $kelompok) {
                    Tarif::create([
                        'kelompok_tarif' => $kelompok,
                        'harga' => $detail['tarif'][$kelompok]['harga'],
                        'detail_fasilitas_id' => $detail_fasilitas->id,
                    ]);
                }
            }
        } else {
            // Menyimpan tarif untuk fasilitas
            foreach (['eksternal', 'internal', 'sosial'] as $kelompok) {
                Tarif::create([
                    'kelompok_tarif' => $kelompok,
                    'harga' => $request->tarif[$kelompok]['harga'],
                    'fasilitas_id' => $fasilitas->id,
                ]);
            }
        }

        return redirect()->route('fasilitas.index')->with('success', 'Fasilitas berhasil dibuat!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $fasilitas = Fasilitas::with(['detailFasilitas.tarif', 'tarif', 'detailGambarFasilitas', 'tarifDetailFasilitas'])->findOrFail($id);
        return view(
            'fasilitas.show',
            compact('fasilitas'),
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $fasilitas = Fasilitas::with(['detailFasilitas.tarif', 'tarif', 'detailGambarFasilitas', 'tarifDetailFasilitas'])->findOrFail($id);

        $jenisFasilitas = JenisFasilitas::all();

        return view('fasilitas.edit', [
            'fasilitas' => $fasilitas,
            'jenisFasilitas' => $jenisFasilitas
        ]);
    }

    /**
     * Update the specified resource in storage.
     */


    public function update(Request $request, $id)
    {
        $fasilitas = Fasilitas::findOrFail($id);

        $request->validate([
            'jenis_fasilitas_id' => 'nullable|exists:jenis_fasilitas,id',
            'nama' => 'nullable|string|max:255',
            'thumbnail' => 'nullable|image|max:2048',
            'unit' => 'nullable|string|max:255',
            'luas' => 'nullable|numeric',
            'lama_sewa' => 'nullable|string',
            'gambar_fasilitas' => 'nullable|array',
            'gambar_fasilitas.*' => 'nullable|image',
            'detail_fasilitas' => 'nullable|array',
            'detail_fasilitas.*.nama' => 'nullable|string|max:255',
            'detail_fasilitas.*.unit' => 'nullable|string|max:255',
            'detail_fasilitas.*.luas' => 'nullable|numeric',
            'detail_fasilitas.*.tarif.eksternal.harga' => 'nullable|numeric',
            'detail_fasilitas.*.tarif.internal.harga' => 'nullable|numeric',
            'detail_fasilitas.*.tarif.sosial.harga' => 'nullable|numeric',
            'detail_fasilitas.*.lama_sewa' => 'nullable|numeric',
            'tarif' => 'nullable|array',
            'tarif.*.kelompok_tarif' => 'nullable|string|in:eksternal,internal,sosial',
            'tarif.*.harga' => 'nullable|numeric',
            'fitur' => 'nullable|array',
            'fitur.*' => 'nullable|string|max:255'
        ]);

        // 🔄 Handle thumbnail update
        if ($request->hasFile('thumbnail')) {
            if ($fasilitas->thumbnail && Storage::disk('public')->exists(str_replace('storage/', '', $fasilitas->thumbnail))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $fasilitas->thumbnail));
            }

            $thumbnail = $request->file('thumbnail');
            $thumbnailName = time() . '_' . $thumbnail->getClientOriginalName();
            $thumbnail->move(public_path('images/thumbnail'), $thumbnailName);
            $fasilitas->thumbnail = 'images/thumbnail/' . $thumbnailName;
        }

        // 🔄 Update fasilitas
        $fasilitas->update([
            'jenis_fasilitas_id' => $request->jenis_fasilitas_id,
            'nama' => $request->nama,
            'unit' => $request->unit,
            'luas' => $request->luas,
            'lama_sewa' => $request->lama_sewa,
            'thumbnail' => $fasilitas->thumbnail,
            'fitur' => $request->fitur
        ]);

        // 🔄 Update gambar fasilitas
        if ($request->hasFile('gambar_fasilitas')) {
            foreach ($fasilitas->detailGambarFasilitas as $gambar) {
                if ($gambar->url_gambar && Storage::disk('public')->exists(str_replace('storage/', '', $gambar->url_gambar))) {
                    Storage::disk('public')->delete(str_replace('storage/', '', $gambar->url_gambar));
                }
                $gambar->delete();
            }

            foreach ($request->file('gambar_fasilitas') as $gambarBaru) {
                $gambarPath = $gambarBaru->store('images/detail-image', 'public');
                DetailGambarFasilitas::create([
                    'fasilitas_id' => $fasilitas->id,
                    'url_gambar' => 'storage/' . $gambarPath,
                ]);
            }
        }

        // 🔁 Handle detail_fasilitas
        if ($request->has('detail_fasilitas')) {
            // Hapus tarif langsung dari fasilitas jika sebelumnya ada
            Tarif::where('fasilitas_id', $fasilitas->id)->delete();

            foreach ($request->detail_fasilitas as $detail) {
                // Menggunakan updateOrCreate untuk detail fasilitas
                $detailFasilitas = DetailFasilitas::updateOrCreate(
                    ['id' => $detail['id'] ?? null], // Mencari berdasarkan ID jika ada
                    [
                        'fasilitas_id' => $fasilitas->id,
                        'nama' => $detail['nama'],
                        'unit' => $detail['unit'],
                        'luas' => $detail['luas'],
                        'lama_sewa' => $detail['lama_sewa'],
                    ]
                );

                // Menyimpan tarif jika ada tarif dalam detail fasilitas
                foreach (['eksternal', 'internal', 'sosial'] as $kelompok) {
                    $harga = $detail['tarif'][$kelompok]['harga'] ?? null;
                    if ($harga !== null) {
                        // Gunakan updateOrCreate untuk tarif
                        Tarif::updateOrCreate(
                            [
                                'detail_fasilitas_id' => $detailFasilitas->id,
                                'kelompok_tarif' => $kelompok
                            ],
                            [
                                'harga' => $harga
                            ]
                        );
                    }
                }
            }
        } else {
            // 🧹 Jika tidak ada detail fasilitas, hapus semua detail dan tarifnya
            foreach ($fasilitas->detailFasilitas as $detail) {
                $detail->tarif()->delete();
                $detail->delete();
            }

            // Simpan tarif langsung ke fasilitas
            foreach (['eksternal', 'internal', 'sosial'] as $kelompok) {
                $harga = $request->tarif[$kelompok]['harga'] ?? null;
                if ($harga !== null) {
                    Tarif::updateOrCreate(
                        [
                            'fasilitas_id' => $fasilitas->id,
                            'kelompok_tarif' => $kelompok
                        ],
                        [
                            'harga' => $harga
                        ]
                    );
                }
            }
        }

        return redirect()->route('fasilitas.show')->with('success', 'Fasilitas berhasil diperbarui!');
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Mencari fasilitas berdasarkan ID
        $fasilitas = Fasilitas::findOrFail($id);

        // Menghapus gambar thumbnail jika ada
        if ($fasilitas->thumbnail && Storage::disk('public')->exists(str_replace('storage/', '', $fasilitas->thumbnail))) {
            Storage::disk('public')->delete(str_replace('storage/', '', $fasilitas->thumbnail));
        }

        // Menghapus gambar fasilitas yang terkait
        $detailGambarFasilitas = DetailGambarFasilitas::where('fasilitas_id', $fasilitas->id)->get();
        foreach ($detailGambarFasilitas as $gambar) {
            if ($gambar->url_gambar && Storage::disk('public')->exists(str_replace('storage/', '', $gambar->url_gambar))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $gambar->url_gambar));
            }
            $gambar->delete();
        }

        $fasilitas->delete();

        return redirect()->route('fasilitas.index')->with('success', 'Fasilitas berhasil dihapus!');
    }

}
