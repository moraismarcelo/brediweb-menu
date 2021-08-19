<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaginaIdToPaginasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('paginas', function (Blueprint $table) {
            $table->bigInteger('pagina_id')->unsigned()->nullable();
            $table->foreign('pagina_id')->references('id')->on('paginas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paginas', function (Blueprint $table) {
            $table->dropForeign(['pagina_id']);
            $table->dropColumn('pagina_id');
        });
    }
}
