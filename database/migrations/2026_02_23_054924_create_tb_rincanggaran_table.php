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
        Schema::create('tb_rincanggaran', function (Blueprint $table) {
            $table->string('id_rincanggaran', 15)->primary();
            $table->string('id_anggaran', 15);
            $table->text('uraian');
            $table->text('spesifikasi');
            $table->decimal('harga', 15, 2);
            $table->integer('volume');
            $table->string('satuan', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_rincanggaran');
    }
};
