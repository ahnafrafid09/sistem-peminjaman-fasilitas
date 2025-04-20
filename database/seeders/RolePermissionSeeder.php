<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ["admin", "pengelola", "peminjam"];
        foreach ($roles as $role) {
            Role::firstOrCreate(["name" => $role]);
        }
        $menus = ['dashboard', 'pengguna', 'fasilitas', 'manajemen fasilitas', 'pengajuan peminjaman', 'konfirmasi peminjaman', 'pembayaran', 'laporan'];
        $actions = ['create', 'read', 'update', 'delete'];

        foreach ($menus as $menu) {
            foreach ($actions as $action) {
                Permission::firstOrCreate(["name" => "$action $menu"]);
            }
        }
        $adminRole = Role::where('name', 'admin')->first();
        $adminRole->syncPermissions(Permission::all());

        $pengelolaRole = Role::where('name', 'pengelola')->first();
        $pengelolaPermissions = [
            'create dashboard',
            'read dashboard',
            'update dashboard',
            'delete dashboard',
            'create manajemen fasilitas',
            'read manajemen fasilitas',
            'update manajemen fasilitas',
            'delete manajemen fasilitas',
            'create fasilitas',
            'update fasilitas',
            'delete fasilitas',
            'read fasilitas',
            'create pengajuan peminjaman',
            'read pengajuan peminjaman',
            'create pembayaran',
            'read pembayaran',
            'read laporan',
        ];
        $pengelolaRole->syncPermissions($pengelolaPermissions);

        $peminjamRole = Role::where('name', 'peminjam')->first();
        $peminjamPermissions = [
            'create dashboard',
            'read dashboard',
            'update dashboard',
            'delete dashboard',
            'read fasilitas',
            'create pengajuan peminjaman',
            'read pengajuan peminjaman',
            'create pembayaran',
            'read pembayaran',
        ];
        $peminjamRole->syncPermissions($peminjamPermissions);

        $admin = User::create([
            'nama_lengkap' => 'Admin Sistem',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'nomor_identitas' => '1234567890',
            'jurusan' => null,
            'status' => 'internal',
        ]);
        $admin->assignRole('admin');

        // Tambah user pengelola
        $pengelola = User::create([
            'nama_lengkap' => 'Pengelola Fasilitas',
            'email' => 'pengelola@example.com',
            'password' => Hash::make('pengelola'),
            'nomor_identitas' => '0987654321',
            'jurusan' => null,
            'status' => 'internal',
        ]);
        $pengelola->assignRole('pengelola');

        // Tambah user peminjam
        $peminjam = User::create([
            'nama_lengkap' => 'Mahasiswa Aktif',
            'email' => 'peminjam@example.com',
            'password' => Hash::make('peminjam'),
            'nomor_identitas' => '2022101001',
            'jurusan' => 'Teknik Informatika',
            'status' => 'internal',
        ]);
        $peminjam->assignRole('peminjam');
    }
}
