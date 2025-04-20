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
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->foreignId('detail_fasilitas_id')->nullable()->constrained()->onDelete('cascade')->after('fasilitas_id');
            $table->foreignId('tarif_id')->constrained()->onDelete('cascade')->after('detail_fasilitas_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->foreignId('detail_fasilitas_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('tarif_id')->constrained()->onDelete('cascade');
        });
    }
};
