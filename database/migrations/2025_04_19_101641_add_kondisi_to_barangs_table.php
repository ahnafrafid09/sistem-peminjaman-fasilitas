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
        Schema::table('barangs', function (Blueprint $table) {
            $table->date("tanggal");
            $table->enum("kondisi", ["baik", "perlu diperbaiki", "rusak parah", "sedang diperbaiki", "diganti"]);
            $table->string("keterangan")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('barangs', function (Blueprint $table) {
            $table->dropColumn("tanggal");
            $table->dropColumn("kondisi", ["baik", "perlu diperbaiki", "rusak parah", "sedang diperbaiki", "diganti"]);
            $table->dropColumn("keterangan");
        });
    }
};
