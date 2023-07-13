<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsEntradaSaidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entrada_saidas', function (Blueprint $table) {
            $table->float('total', 5, 2)->nullable();
            $table->float('valor_venda', 5, 2)->nullable();
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
            $table->dropColumn('total', 5, 2);
            $table->dropColumn('valor_venda', 5, 2);
        });
    }
}
