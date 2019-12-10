<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsistenteInternosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asistente_internos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_docente_id')->unsigned()->nullable();
            $table->foreign('user_docente_id')->references('id')->on('users');
            $table->bigInteger('convocatoria_id')->unsigned()->nullable();
            $table->foreign('convocatoria_id')->references('id')->on('convocatorias');
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
        Schema::dropIfExists('asistente_internos');
    }
}
