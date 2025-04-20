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
        Schema::create('fasilitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId("jenis_fasilitas_id")->constrained("jenis_fasilitas")->onDelete("cascade");
            $table->string("kode_fasilitas")->unique();
            $table->string(column: "nama");
            $table->string("unit")->nullable();
            $table->string("luas")->nullable();
            $table->string("lama_sewa")->nullable();
            $table->boolean('is_acara')->default(false);
            $table->boolean('is_sub_fasilitas')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fasilitas');
    }
};
