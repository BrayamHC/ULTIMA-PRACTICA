<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUrlImagenToUsuariosSistemaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usuarios_sistema', function (Blueprint $table) {
            $table->string('url_imagen')->nullable(); // Agregar el campo url_imagen
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usuarios_sistema', function (Blueprint $table) {
            $table->dropColumn('url_imagen'); // Eliminar el campo url_imagen si la migración es revertida
        });
    }
}
