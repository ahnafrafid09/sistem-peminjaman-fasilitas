<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('fasilitas_id')->constrained()->onDelete('cascade');
            $table->string('kode')->unique();
            $table->date('tanggal_peminjaman');
            $table->date('tanggal_pemasangan_alat')->nullable();
            $table->date('tanggal_pembongkaran_alat')->nullable();
            $table->string('layangan_eksternal')->nullable();
            $table->enum('status', ['pending', 'disetujui', 'ditolak', 'selesai'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
