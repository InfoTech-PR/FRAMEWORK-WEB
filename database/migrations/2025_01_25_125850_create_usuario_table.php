<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioTable extends Migration
{
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->bigIncrements('CODIGO');

            $table->bigInteger('COD_FUNCIONARIO')->nullable();

            $table->string('NOME', 15);
            $table->string('SENHA', 60); // Isso precisa ser modificado no banco diretamente
            $table->string('EMAIL', 255)->nullable(); // Isso precisa ser modificado no banco diretamente
            $table->string('FOTO', 255)->nullable(); // Isso precisa ser modificado no banco diretamente

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuario');
    }
}
