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
        Schema::create('tb_spj', function (Blueprint $table) {
            $table->id('id_spj');
            $table->string('id_user', 15);
            $table->string('id_tahun', 6);
            $table->string('id_anggaran', 15);
            $table->date('tgl');
            $table->text('uraian');
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
        Schema::dropIfExists('tb_spj');
    }
};
