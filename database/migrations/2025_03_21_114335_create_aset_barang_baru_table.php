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
        Schema::create('aset_barang_baru', function (Blueprint $table) {
            $table->id('id');
            $table->string('nama_barang', 255);
            $table->string('gambar_barang', 40);
            $table->integer('harga_jual_barang');
            $table->string('jenis_barang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aset_barang_baru');
    }
};
