<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignsToBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('barangs', function (Blueprint $table) {
            $table
                ->foreign('merek_id')
                ->references('id')
                ->on('mereks')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('kategori_id')
                ->references('id')
                ->on('kategoris')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('lokasi_id')
                ->references('id')
                ->on('lokasis')
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
        Schema::table('barangs', function (Blueprint $table) {
            $table->dropForeign(['merek_id']);
            $table->dropForeign(['kategori_id']);
            $table->dropForeign(['lokasi_id']);
        });
    }
}
