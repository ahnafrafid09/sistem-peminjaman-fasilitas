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

        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('name', 'nama_lengkap');
            $table->string('nomor_identitas')->after('email');
            $table->string('jurusan')->nullable()->after('nomor_identitas');
            $table->enum('status', ['internal', 'eksternal'])->after('jurusan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('nama_lengkap', 'name');
            $table->dropColumn(['nomor_identitas', 'jurusan', 'status']);
        });
    }
};
