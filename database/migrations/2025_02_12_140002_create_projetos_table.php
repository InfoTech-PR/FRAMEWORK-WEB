<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjetosTable extends Migration
{
    public function up()
    {
        Schema::create('projetos', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade'); // Chave estrangeira para a tabela usuarios
            $table->string('nomeProjeto');
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade'); // Chave estrangeira para a tabela clientes
            $table->string('contatoEmpresa')->nullable();
            $table->enum('status', ['Ativo', 'Inativo'])->default('Ativo');
            $table->foreignId('analista_id')->constrained('funcionarios')->onDelete('set null'); // Chave estrangeira para a tabela funcionarios
            $table->foreignId('programador_id')->constrained('funcionarios')->onDelete('set null'); // Chave estrangeira para a tabela funcionarios
            $table->text('observacoes')->nullable();
            $table->date('dataInicial');
            $table->date('dataFinal')->nullable();
            $table->timestamps(); // Timestamps (created_at, updated_at)
        });
    }

    public function down()
    {
        Schema::dropIfExists('projetos');
    }
}
