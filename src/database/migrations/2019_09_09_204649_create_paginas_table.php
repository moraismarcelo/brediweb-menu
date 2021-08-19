<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaginasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paginas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('menu_id')->unsigned()->nullable();
            $table->foreign('menu_id')->references('id')->on('menus');
            $table->string('titulo');
            $table->text('descricao')->nullable();
            $table->longText('texto')->nullable();
            $table->date('data')->nullable();
            $table->string('link')->nullable();
            $table->string('imagem')->nullable();
            $table->enum('ativo', ['0', '1']);
            $table->integer('order')->nullable();
            $table->string('slug')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paginas');
    }
}
