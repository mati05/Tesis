<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleEvaluacionDefensa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_evaluacion_defensa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('evaluacion1');
            $table->float('evaluacion2');
            $table->float('evaluacion3');
            $table->bigInteger('evaluacion_defensa_id')->unsigned()->nullable();
            $table->foreign('evaluacion_defensa_id')->references('id')->on('evaluacion_defensas');
            $table->bigInteger('user_docente_id')->unsigned()->nullable();
            $table->foreign('user_docente_id')->references('id')->on('users');
            $table->bigInteger('user_alumno_id')->unsigned()->nullable();
            $table->foreign('user_alumno_id')->references('id')->on('users');
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
        Schema::dropIfExists('detalle_evaluacion_defensa');
    }
}
