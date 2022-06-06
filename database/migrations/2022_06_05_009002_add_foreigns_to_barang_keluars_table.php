<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignsToBarangKeluarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('barang_keluars', function (Blueprint $table) {
            $table
                ->foreign('lokasi_id')
                ->references('id')
                ->on('lokasis')
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
        Schema::table('barang_keluars', function (Blueprint $table) {
            $table->dropForeign(['lokasi_id']);
            $table->dropForeign(['barang_id']);
        });
    }
}
