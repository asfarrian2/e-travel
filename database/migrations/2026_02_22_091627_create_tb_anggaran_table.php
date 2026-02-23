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
        Schema::create('tb_anggaran', function (Blueprint $table) {
            $table->string('id_anggaran', 15)->primary();
            $table->string('id_tahun', 6);
            $table->string('id_subkegiatan', 8);
            $table->string('id_rekening', 8);
            $table->string('nm_anggaran', 150);
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_anggaran');
    }
};
