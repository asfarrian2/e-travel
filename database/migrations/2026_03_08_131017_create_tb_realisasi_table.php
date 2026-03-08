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
        Schema::create('tb_realisasi', function (Blueprint $table) {
            $table->id('id_realisasi');
            $table->string('id_rincanggaran', 20);
            $table->string('id_pelperjadin', 20);
            $table->decimal('nilai', 15);
            $table->integer('volume');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_realisasi');
    }
};
