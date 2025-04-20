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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peminjaman_id')->constrained('peminjaman')->onDelete('cascade');
            $table->foreignId('metode_pembayaran_id')->nullable()->constrained()->onDelete('set null');
            $table->string('kode')->unique();
            $table->enum('status', ['menunggu pembayaran', 'menunggu disetujui', 'disetujui', 'ditolak'])->default('menunggu pembayaran');
            $table->string('bukti_pembayaran')->nullable();
            $table->integer('total_harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
