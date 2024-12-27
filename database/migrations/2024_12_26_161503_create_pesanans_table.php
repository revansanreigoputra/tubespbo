<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
    Schema::create('pesanans', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->integer('harga_tiket');
        $table->integer('jumlah_tiket');
        $table->integer('total_harga');
        $table->timestamp('tanggal_pesanan');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
