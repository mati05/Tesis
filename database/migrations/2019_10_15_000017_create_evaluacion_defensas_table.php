<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluacionDefensasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluacion_defensas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('nota');
            $table->bigInteger('user_docente_id')->unsigned()->nullable();
            $table->foreign('user_docente_id')->references('id')->on('users');
            $table->bigInteger('user_alumno_id')->unsigned()->nullable();
            $table->foreign('user_alumno_id')->references('id')->on('users');
            $table->bigInteger('defensa_titulo_id')->unsigned()->nullable();
            $table->foreign('defensa_titulo_id')->references('id')->on('defensa_titulos');
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
        Schema::dropIfExists('evaluacion_defensas');
    }
}
