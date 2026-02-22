<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_pelaksana', function (Blueprint $table) {
            $table->string('id_pelaksana', 15)->primary();
            $table->string('nama', 80);
            $table->string('nip', 25)->nullable();
            $table->string('pangkgol', 15)->nullable();
            $table->string('jabatan', 40)->nullable();
            $table->string('alamat', 170)->nullable();
            $table->string('instansi', 170)->nullable();
            $table->tinyInteger('kelas');
            $table->tinyInteger('jenis');
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_pelaksana');
    }
};
