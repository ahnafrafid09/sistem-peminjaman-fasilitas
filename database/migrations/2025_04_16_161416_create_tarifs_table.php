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
        Schema::create('tarifs', function (Blueprint $table) {
            $table->id();
            $table->enum('kelompok_tarif', ['eksternal', 'internal', 'sosial']);
            $table->unsignedBigInteger('harga');
            $table->foreignId('fasilitas_id')->nullable()->constrained('fasilitas')->onDelete('cascade');
            $table->foreignId('detail_fasilitas_id')->nullable()->constrained('detail_fasilitas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarifs');
    }
};
