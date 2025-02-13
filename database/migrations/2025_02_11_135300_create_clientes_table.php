<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->bigIncrements('CODIGO');
            $table->string('NOME', 90)->nullable();
            $table->string('NOME_FANTASIA', 90)->nullable();
            $table->float('COD_TIPO_PESSOA')->nullable();
            $table->string('ENDERECO', 60)->nullable();
            $table->string('COMPLEMENTO', 45)->nullable();
            $table->float('COD_BAIRRO')->nullable();
            $table->float('COD_CIDADE')->nullable();
            $table->float('COD_UF')->nullable();
            $table->float('COD_PAIS')->nullable();
            $table->string('CEP', 15)->nullable();
            $table->string('FONE1', 15)->nullable();
            $table->string('FONE2', 15)->nullable();
            $table->string('RAMAL1', 10)->nullable();
            $table->string('RAMAL2', 10)->nullable();
            $table->string('TEL0800', 20)->nullable();
            $table->string('CONTATO1', 60)->nullable();
            $table->string('CONTATO2', 60)->nullable();
            $table->string('CELULAR1', 20)->nullable();
            $table->string('CELULAR2', 20)->nullable();
            $table->string('EMAIL', 120)->nullable();
            $table->string('CPF_CNPJ', 20)->nullable();
            $table->string('INSC_ESTADUAL', 20)->nullable();
            $table->text('OBS')->nullable();
            $table->string('EMAIL2', 120)->nullable();
            $table->string('NUMERO', 10)->nullable();
            $table->string('SALA_LOJA', 20)->nullable();
            $table->string('HOME_PAGE', 25)->nullable();
            $table->string('DDD', 10)->nullable();
            $table->string('DDI', 10)->nullable();
            $table->date('DATA_CADASTRO')->nullable();
            $table->date('DATA_ALTERACAO')->nullable();
            $table->text('SERVICOS')->nullable();
            $table->float('N_ATENDIMENTOS')->nullable();
            $table->float('COD_FUNCIONARIO')->nullable();
            $table->string('IMPRIMIR', 3)->nullable();
            $table->binary('FOTO')->nullable();
            $table->string('FLAG_CONTATO', 1)->nullable();
            $table->date('DATA_NASC')->nullable();
            $table->string('TIPO_CLIENTE', 3)->nullable();
            $table->float('LIMITE_CREDITO')->nullable();
            $table->integer('MES_ANIVERSARIO')->nullable();
            $table->date('DATA_ULTIMA_COMPRA')->nullable();
            $table->date('DATA_ULTIMO_SERVICO')->nullable();
            $table->string('RESTRICAO_INTERNA', 1)->nullable();
            $table->integer('NUM_OCORRENCIAS')->nullable();
            $table->integer('NUM_OCORRENCIAS_PEND')->nullable();
            $table->string('NOTIF_CLIENTE', 1)->nullable();
            $table->date('ULTIMO_CONTATO')->nullable();
            $table->float('COD_ALTERNATIVO')->nullable();
            $table->string('CONTROLA_FIDELIDADE', 1)->nullable();
            $table->string('MOTIVO_RESTRICAO', 150)->nullable();
            $table->float('TOTAL_PONTOS')->nullable();
            $table->float('TOTAL_CREDITO')->nullable();
            $table->string('LISTA_NEGRA', 1)->nullable();
            $table->text('MOTIVO_LISTA_NEGRA_EXCLUSAO')->nullable();
            $table->date('DATA_ULT_CONTATO')->nullable();
            $table->float('COD_STATUS_TRANSMISSAO')->nullable();
            $table->string('SUPORTE_BLOQUEADO', 1)->nullable();
            $table->float('COD_CATEGORIA_CLIENTE')->nullable();
            $table->string('CODIGO_ANTERIOR', 45)->nullable();
            $table->string('INTEGRADO_BOLETO', 1)->nullable();
            $table->string('ID_CLI_PLATAFORMA', 45)->nullable();
            $table->string('SENHA', 45)->nullable();
            $table->string('USUARIO', 120)->nullable();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}