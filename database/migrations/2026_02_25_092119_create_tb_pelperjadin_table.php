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
        Schema::create('tb_pelperjadin', function (Blueprint $table) {
            $table->string('id_pelperjadin', 15)->primary();
            $table->string('id_perjalanan', 15);
            $table->string('id_pelaksana', 15);
            $table->string('penginapan', 100)->nullable();
            $table->string('maskapaib', 80)->nullable();
            $table->string('bandarab', 80)->nullable();
            $table->string('no_tiketb', 50)->nullable();
            $table->string('no_bookingb', 50)->nullable();
            $table->string('maskapaip', 80)->nullable();
            $table->string('bandarap', 80)->nullable();
            $table->string('no_tiketp', 50)->nullable();
            $table->string('no_bookingp', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_pelperjadin');
    }
};
