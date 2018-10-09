<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluacions', function (Blueprint $table) {
            $table->increments('idEvaluacion');
            $table->unsignedInteger('idCliente');
            $table->dateTime('FEncuesta'); //fecha de la encuenta
            $table->json('Habitos'); 
            $table->json('APersonales'); //antecedentes personales
            $table->json('AFamiliares'); //antecedentes familiares
            $table->json('EMedica')->nullable(); //evaluación médica
            $table->mediumText('Diagnostico')->nullable();
            $table->dateTime('FDiagnostico')->nullable();
            //Creación de claves primarias, foráneas e índices
            //$table->primary('idAnamnesis');
            $table->foreign('idCliente')->references('id')->on('users');
            $table->index('idCliente');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluacions');
    }
}
