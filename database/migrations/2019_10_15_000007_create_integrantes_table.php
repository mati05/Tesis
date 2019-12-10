<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntegrantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('integrantes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_alumno_id')->unsigned()->nullable();
            $table->foreign('user_alumno_id')->references('id')->on('users');
            $table->bigInteger('proyecto_titulo_id')->unsigned()->nullable();
            $table->foreign('proyecto_titulo_id')->references('id')->on('proyecto_titulos');
            $table->bigInteger('user_docente_id')->unsigned()->nullable();
            $table->foreign('user_docente_id')->references('id')->on('users');
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
        Schema::dropIfExists('integrantes');
    }
}
