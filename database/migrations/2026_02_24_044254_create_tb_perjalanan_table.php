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
        Schema::create('tb_perjalanan', function (Blueprint $table) {
            $table->string('id_perjalanan', 15)->primary();
            $table->string('id_anggaran', 15);
            $table->text('dasar');
            $table->text('keperluan');
            $table->string('tujuan', 50);
            $table->date('tgl_berangkat');
            $table->date('tgl_pulang');
            $table->string('angkutan', 50);
            $table->tinyInteger('jenis');
            $table->tinyInteger('pengguna');
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_perjalanan');
    }
};
