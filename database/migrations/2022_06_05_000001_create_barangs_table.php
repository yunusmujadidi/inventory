<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('kode_barang');
            $table->char('nama_barang');
            $table->bigInteger('stok');
            $table->decimal('harga');
            $table->unsignedBigInteger('merek_id');
            $table->unsignedBigInteger('kategori_id');
            $table->unsignedBigInteger('lokasi_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barangs');
    }
}
