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
        Schema::create('detail_fasilitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fasilitas_id')->constrained('fasilitas')->onDelete('cascade');
            $table->string('nama');
            $table->string('unit')->nullable();
            $table->string('luas')->nullable();
            $table->string('lama_sewa')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_fasilitas');
    }
};
