<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntradaSaidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrada_saidas', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->nullable();
            $table->integer('valor')->nullable();
            $table->integer('tipo')->nullable();
            $table->string('registro')->nullable();
            $table->string('stts')->nullable();
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
        Schema::dropIfExists('entrada_saidas');
    }
}
