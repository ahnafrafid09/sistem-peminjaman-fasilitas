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
        Schema::create('detail_gambar_fasilitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fasilitas_id')->constrained()->onDelete('cascade');
            $table->string('url_gambar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_gambar_fasilitas');
    }
};
