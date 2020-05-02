<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libros', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('nombre');
            $table->text('descripcion');
            $table->string('autor');
            $table->timestamp('fagregado')->useCurrent();
            $table->date('actualizado');
            $table->float('version')->default(1.0);
            $table->boolean('aceptado')->default(false);
            $table->unsignedBigInteger('idcategoria');

            $table->timestamps();
        });

        Schema::table('libros', function($table){
            $table->foreign('idcategoria')->references('id')->on('categorias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('libros');
    }
}
