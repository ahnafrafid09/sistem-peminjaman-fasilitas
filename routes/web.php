<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DetailFasilitasController;
use App\Http\Controllers\Dashboard\FasilitasController;
use App\Http\Controllers\Dashboard\KonfirmasiPeminjamanController;
use App\Http\Controllers\Dashboard\LaporanController;
use App\Http\Controllers\Dashboard\ManajemenFasilitasController;
use App\Http\Controllers\Dashboard\PembayaranController;
use App\Http\Controllers\Dashboard\PengajuanPeminjamanController;
use App\Http\Controllers\Dashboard\PenggunaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }

    return redirect('/login');
});

Route::get('/dashboard', [DashboardController::class, "index"])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'permission:read pengguna'])->prefix("/pengguna")->group(function () {
    Route::get('/', [PenggunaController::class, 'index'])->name('pengguna.index');
    Route::get('/{user}', [PenggunaController::class, 'show'])->name('pengguna.show');
    Route::delete('/{user}', [PenggunaController::class, 'destroy'])->name('pengguna.destroy');
    Route::get('/permission/{user}', [PenggunaController::class, 'permissionForm'])->name('pengguna.permission');
    Route::post('/permission/{user}', [PenggunaController::class, 'updatePermissions'])->name('pengguna.permission.update');
    Route::put('/{user}/role', [PenggunaController::class, 'updateRole'])->name('pengguna.updateRole');
});

Route::middleware(['auth'])->prefix("/fasilitas")->group(function () {
    Route::get('', [FasilitasController::class, 'index'])->name('fasilitas.index')->middleware("permission:read fasilitas");
    Route::get('/create', [FasilitasController::class, 'create'])->name('fasilitas.create')->middleware("permission:create fasilitas");
    Route::post('/create', [FasilitasController::class, 'store'])->name('fasilitas.store')->middleware("permission:create fasilitas");
    Route::get('/{id}', [FasilitasController::class, 'show'])->name('fasilitas.show')->middleware("permission:read fasilitas");
    Route::get('/edit/{id}', [FasilitasController::class, 'edit'])->name('fasilitas.edit')->middleware("permission:update fasilitas");
    Route::put('/edit/{id}', [FasilitasController::class, 'update'])->name('fasilitas.update')->middleware("permission:update fasilitas");
    Route::delete('/{id}', [FasilitasController::class, 'destroy'])->name('fasilitas.destroy')->middleware("permission:delete fasilitas");
    Route::delete('/detail/{id}', [DetailFasilitasController::class, 'destroy'])->name('detailFasilitas.destroy')->middleware("permission:delete fasilitas");
});

Route::middleware(['auth'])->prefix("/manajemen-fasilitas")->group(function () {
    Route::get('', [ManajemenFasilitasController::class, 'index'])->name('manajemen-fasilitas.index')->middleware("permission:read manajemen fasilitas");
    Route::get('/create', [ManajemenFasilitasController::class, 'create'])->name('manajemen-fasilitas.create')->middleware("permission:create manajemen fasilitas");
    Route::post('/create', [ManajemenFasilitasController::class, 'store'])->name('manajemen-fasilitas.store')->middleware("permission:create manajemen fasilitas");
    Route::get('/{id}', [ManajemenFasilitasController::class, 'show'])->name('manajemen-fasilitas.show')->middleware("permission:read manajemen fasilitas");
    Route::get('/edit/{id}', [ManajemenFasilitasController::class, 'edit'])->name('manajemen-fasilitas.edit')->middleware("permission:update manajemen fasilitas");
    Route::put('/edit/{id}', [ManajemenFasilitasController::class, 'update'])->name('manajemen-fasilitas.update')->middleware("permission:update manajemen fasilitas");
    Route::delete('/{id}', [ManajemenFasilitasController::class, 'destroy'])->name('manajemen-fasilitas.destroy')->middleware("permission:delete manajemen fasilitas");
});

Route::middleware(['auth'])->prefix("/pengajuan")->group(function () {
    Route::get('/', [PengajuanPeminjamanController::class, 'create'])->name('pengajuan.create')->middleware("permission:create pengajuan peminjaman");
    Route::post('/', [PengajuanPeminjamanController::class, 'store'])->name('pengajuan.store')->middleware("permission:create pengajuan peminjaman");
});

Route::middleware(['auth'])->prefix("/konfirmasi-peminjaman")->group(function () {
    Route::get('/', [KonfirmasiPeminjamanController::class, 'index'])->name('konfirmasi-peminjaman.index')->middleware("permission:read konfirmasi peminjaman");
    Route::get('/{id}', [KonfirmasiPeminjamanController::class, 'show'])->name('konfirmasi-peminjaman.show')->middleware("permission:read konfirmasi peminjaman");
    Route::put('/{id}/tolak', [KonfirmasiPeminjamanController::class, 'tolak'])->name('konfirmasi-peminjaman.tolak')->middleware('permission:update konfirmasi peminjaman');
    Route::get('/{id}/rincian', [KonfirmasiPeminjamanController::class, 'rincianPembayaran'])->name('konfirmasi-peminjaman.rincian')->middleware('permission:update konfirmasi peminjaman');
    Route::put('/{id}/setuju', [KonfirmasiPeminjamanController::class, 'konfirmasiPeminjaman'])->name('konfirmasi-peminjaman.setuju')->middleware('permission:update konfirmasi peminjaman');
    Route::delete('/{id}', [KonfirmasiPeminjamanController::class, 'destroy'])->name('konfirmasi-peminjaman.destroy')->middleware('permission:delete konfirmasi peminjaman');
});

Route::middleware(['auth'])->prefix("/pembayaran")->group(function () {
    Route::get('/', [PembayaranController::class, 'index'])->name('pembayaran.index')->middleware("permission:read pembayaran");
    Route::get('/{id}', [PembayaranController::class, 'show'])->name('pembayaran.show')->middleware("permission:read pembayaran");
    Route::get('/bayar/{id}', [PembayaranController::class, 'show'])->name('pembayaran.bayar')->middleware("permission:read pembayaran");
    Route::post('/{id}/pilih-metode', [PembayaranController::class, 'pilihMetode'])->name('pembayaran.pilih-metode')->middleware('permission:read pembayaran');
    Route::get('/{id}/bayar', [PembayaranController::class, 'bayarForm'])->name('pembayaran.bayar')->middleware('permission:read pembayaran');
    Route::post('/{id}/bayar', [PembayaranController::class, 'bayarStore'])->name('pembayaran.bayar.store')->middleware('permission:read pembayaran');
    Route::get('/konfirmasi/{id}', [PembayaranController::class, 'konfirmasiPembayaranShow'])->name('pembayaran.konfirmasi.show')->middleware('permission:update pembayaran|delete pembayaran');
    Route::put('/konfirmasi/{id}/setuju', [PembayaranController::class, 'konfirmasiPembayaran'])->name('pembayaran.konfirmasi.setuju')->middleware('permission:update pembayaran|delete pembayaran');
    Route::put('/konfirmasi/{id}/tolak', [PembayaranController::class, 'tolakPembayaran'])->name('pembayaran.konfirmasi.tolak')->middleware('permission:update pembayaran|delete pembayaran');
});

Route::middleware(['auth'])->prefix("/laporan")->group(function () {
    Route::get('/', [LaporanController::class, 'index'])->name('laporan.index')->middleware("permission:read laporan");
    Route::get('/{id}', [LaporanController::class, 'show'])->name('laporan.show')->middleware("permission:read laporan");
    Route::delete('/{id}', [LaporanController::class, 'destroy'])->name('laporan.destroy')->middleware("permission:delete laporan");
});

require __DIR__ . '/auth.php';
