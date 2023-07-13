<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCamposEntradaSaidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entrada_saidas', function (Blueprint $table) {
            $table->integer('valor_venda')->nullable();
            $table->integer('quantidade')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('entrada_saidas', function (Blueprint $table) {
            $table->dropColumn('valor_venda');
            $table->dropColumn('quantidade');
        });
    }
}
