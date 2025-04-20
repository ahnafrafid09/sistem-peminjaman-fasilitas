<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {


        $status = $request->get('status');

        $query = User::query();

        if ($status) {
            $query->where('status', $status);
        }

        $pengguna = $query->get();

        return view('pengguna.index', compact('pengguna'));

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
    public function show(User $user)
    {
        $roles = Role::all(); // Ambil semua role
        return view('pengguna.show', compact('user', 'roles'));
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|exists:roles,name',
        ]);

        $user->permissions()->detach();


        $user->syncRoles([$request->role]);

        return redirect()->route('pengguna.show', $user->id)->with('success', 'Role berhasil diperbarui!');
    }

    public function permissionForm($id)
    {
        $user = User::findOrFail($id);
        $permissions = Permission::all();

        $groupedPermissions = collect([
            'dashboard',
            'pengguna',
            'fasilitas',
            'manajemen fasilitas',
            'pengajuan peminjaman',
            'konfirmasi peminjaman',
            'pembayaran',
            'laporan'
        ]);

        return view('pengguna.permission', compact('user', 'permissions', 'groupedPermissions'));
    }

    public function updatePermissions(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->input('permissions', []); // array of permission names

        $user->syncPermissions($data);

        return redirect()->route('pengguna.index')->with('success', 'Permission berhasil diperbarui.');
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
    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'Pengguna berhasil dihapus.');
    }
}
