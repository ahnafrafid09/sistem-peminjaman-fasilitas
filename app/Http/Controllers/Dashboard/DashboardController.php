<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole(['admin', 'pengelola'])) {
            $peminjamans = Peminjaman::with(['user', 'fasilitas'])->latest()->get();
            return view('dashboard', [
                'role' => 'admin', // untuk layouting nanti
                'peminjamans' => $peminjamans
            ]);
        }

        if ($user->hasRole('peminjam')) {
            $peminjamans = Peminjaman::with('fasilitas')
                ->where('user_id', $user->id)
                ->latest()->get();

            return view('dashboard', [
                'role' => 'peminjam',
                'peminjamans' => $peminjamans
            ]);
        }

        abort(403, 'Unauthorized');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
        //
    }
}
