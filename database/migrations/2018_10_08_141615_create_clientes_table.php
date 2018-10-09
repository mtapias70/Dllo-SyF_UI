<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->UnsignedInteger('idCliente');
            $table->dateTime('FCreacion');
            $table->enum('Genero',['Masculino','Femenino']);
            $table->dateTime('FNacimiento');
            $table->string('Ocupacion',100);
            $table->string('Acudiente',100);
            $table->string('TelAcudiente',15);
            $table->string('EPS',50);
            $table->string('SangreRH',5);
            $table->UnsignedTinyInteger('Talla',3);
            $table->timestamps();
            //creación de clave primaria,foránea e índices
            //$table->primary('idCliente'); 
            $table->foreign('idCliente')->references('id')->on('users');
            //$table->increments('idCliente');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
