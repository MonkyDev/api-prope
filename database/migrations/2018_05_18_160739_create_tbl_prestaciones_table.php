<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblPrestacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_prestaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dni',10);
            $table->string('tipo_dni',15);

            $table->unsignedInteger('fk_motivo');
            $table->unsignedInteger('fk_trabajador_entrega');
            $table->unsignedInteger('fk_trabajador_recibe')->nullable();
            $table->unsignedInteger('fk_status')->default(1);

            $table->unsignedTinyInteger('dias_permitidos')->default(1);
            $table->dateTime('salida');
            $table->dateTime('regresa')->nullable();
            
            $table->timestamps();
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->foreign('fk_motivo')->references('id')->on('cat_motivos');
            $table->foreign('fk_trabajador_entrega')->references('id')->on('users');
            $table->foreign('fk_trabajador_recibe')->references('id')->on('users');
            $table->foreign('fk_status')->references('id')->on('cat_status');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_prestaciones');
    }
}
