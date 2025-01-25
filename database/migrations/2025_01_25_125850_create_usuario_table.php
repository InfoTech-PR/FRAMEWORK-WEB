<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioTable extends Migration
{
    public function up()
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->bigIncrements('CODIGO');

            $table->bigInteger('COD_FUNCIONARIO')->nullable();

            $table->string('NOME', 15);
            $table->string('SENHA', 60); 
            $table->string('EMAIL', 255)->nullable();
            $table->string('FOTO', 255)->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuario');
    }
}
