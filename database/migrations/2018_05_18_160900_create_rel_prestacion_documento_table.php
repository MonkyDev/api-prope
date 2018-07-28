<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelPrestacionDocumentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rel_prestacion_documento', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('fk_prestamo');
            $table->unsignedInteger('fk_documento');
            $table->string('tipo_documento',15);
            $table->string('anotaciones');

            $table->timestamps();
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->foreign('fk_prestamo')->references('id')->on('tbl_prestaciones');
            $table->foreign('fk_documento')->references('id')->on('cat_documentos');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rel_prestacion_documento');
    }
}
