<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjetoTable extends Migration {
    public function up()
    {
        Schema::create('projeto', function (Blueprint $table) {
            $table->float('CODIGO')->primary(); // Supondo que CODIGO seja a chave primária
            $table->date('DATA_CADASTRO')->nullable();
            $table->date('DATA_ALTERACAO')->nullable();
            $table->float('COD_FUNCIONARIO_RESP')->nullable();
            $table->string('NOME_PROJETO', 90)->nullable();
            $table->float('COD_CLIENTE')->nullable();
            $table->string('CONTATO_EMPRESA', 90)->nullable();
            $table->float('COD_PROGRAMADOR_CHEFE')->nullable();
            $table->text('OBSERVACOES')->nullable();
            $table->float('COD_STATUS_SOFTWARE')->nullable();
            $table->string('NOTIF_CLIENTE', 1)->nullable();
            $table->string('NOTIF_PROGRAMADOR', 1)->nullable();
            $table->date('DATA_INICIAL')->nullable();
            $table->date('DATA_FINAL')->nullable();
            $table->float('NUM_DEPENDENCIAS')->nullable();
            $table->float('COD_ANALISTA_RESP')->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('projeto');
    }
}
