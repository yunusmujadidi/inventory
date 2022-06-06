<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignsToBarangMasuksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('barang_masuks', function (Blueprint $table) {
            $table
                ->foreign('supplier_id')
                ->references('id')
                ->on('suppliers')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('barang_id')
                ->references('id')
                ->on('barangs')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('barang_masuks', function (Blueprint $table) {
            $table->dropForeign(['supplier_id']);
            $table->dropForeign(['barang_id']);
        });
    }
}
