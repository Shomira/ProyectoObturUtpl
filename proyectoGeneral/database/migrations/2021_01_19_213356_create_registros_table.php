<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registros', function (Blueprint $table) {
            $table->id();
            $table->string('fecha');
            $table->integer('checkins');
            $table->integer('checkouts');
            $table->integer('pernoctaciones');
            $table->integer('nacionales');
            $table->integer('extranjeros');
            $table->integer('habitaciones_ocupadas');
            $table->integer('habitaciones_disponibles');
            $table->string('tipo_tarifa');
            $table->double('tarifa_promedio', 8, 2);
            $table->double('TAR_PER', 8, 2);
            $table->double('ventas_netas', 8, 2);
            $table->string('porcentaje_ocupacion');
            $table->double('revpar', 8, 2);
            $table->integer('empleados_temporales');
            $table->string('estado');
            $table->string('opciones');

            $table->unsignedBigInteger('idEstablecimiento')->nullable($value = true);
            $table->foreign('idEstablecimiento')->references('id')->on('Establecimientos')->onDelete('cascade');
        
            $table->unsignedBigInteger('idArchivo')->nullable($value = true);
            $table->foreign('idArchivo')->references('id')->on('Archivos')->onDelete('cascade');
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
        Schema::dropIfExists('registros');
    }
}
