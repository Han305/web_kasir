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
        Schema::create('detail_transaksis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kode_produk');
            $table->unsignedBigInteger('no_invoice');
            $table->integer('qty');
            $table->integer('subtotal');
            $table->timestamps();
            $table->foreign('kode_produk')->references('kode_produk')->on('products');
            $table->foreign('no_invoice')->references('no_invoice')->on('transaksis');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transaksis');
    }
};
