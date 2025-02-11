<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id('codigo'); 
            $table->string('nome', 90)->nullable();
            $table->string('nome_fantasia', 90)->nullable();
            $table->float('cod_tipo_pessoa')->nullable();
            $table->string('endereco', 60)->nullable();
            $table->string('complemento', 45)->nullable();
            $table->float('cod_bairro')->nullable();
            $table->float('cod_cidade')->nullable();
            $table->float('cod_uf')->nullable();
            $table->float('cod_pais')->nullable();
            $table->string('cep', 15)->nullable();
            $table->string('fone1', 15)->nullable();
            $table->string('fone2', 15)->nullable();
            $table->string('ramal1', 10)->nullable();
            $table->string('ramal2', 10)->nullable();
            $table->string('tel0800', 20)->nullable();
            $table->string('contato1', 60)->nullable();
            $table->string('contato2', 60)->nullable();
            $table->string('celular1', 20)->nullable();
            $table->string('celular2', 20)->nullable();
            $table->string('email', 120)->nullable();
            $table->string('cpf_cnpj', 20)->nullable();
            $table->string('insc_estadual', 20)->nullable();
            $table->text('obs')->nullable();
            $table->string('email2', 120)->nullable();
            $table->string('numero', 10)->nullable();
            $table->string('sala_loja', 20)->nullable();
            $table->string('home_page', 25)->nullable();
            $table->string('ddd', 10)->nullable();
            $table->string('ddi', 10)->nullable();
            $table->date('data_cadastro')->nullable();
            $table->date('data_alteracao')->nullable();
            $table->text('servicos')->nullable();
            $table->float('n_atendimentos')->nullable();
            $table->float('cod_funcionario')->nullable();
            $table->string('imprimir', 3)->nullable();
            $table->longText('foto')->nullable();
            $table->string('flag_contato', 1)->nullable();
            $table->date('data_nasc')->nullable();
            $table->string('tipo_cliente', 3)->nullable();
            $table->float('limite_credito')->nullable();
            $table->integer('mes_aniversario')->nullable();
            $table->date('data_ultima_compra')->nullable();
            $table->date('data_ultimo_servico')->nullable();
            $table->string('restricao_interna', 1)->nullable();
            $table->integer('num_ocorrencias')->nullable();
            $table->integer('num_ocorrencias_pend')->nullable();
            $table->string('notif_cliente', 1)->nullable();
            $table->date('ultimo_contato')->nullable();
            $table->float('cod_alternativo')->nullable();
            $table->string('controla_fidelidade', 1)->nullable();
            $table->string('motivo_restricao', 150)->nullable();
            $table->float('total_pontos')->nullable();
            $table->float('total_credito')->nullable();
            $table->string('lista_negra', 1)->nullable();
            $table->text('motivo_lista_negra_exclusao')->nullable();
            $table->date('data_ult_contato')->nullable();
            $table->float('cod_status_transmissao')->nullable();
            $table->string('suporte_bloqueado', 1)->nullable();
            $table->float('cod_categoria_cliente')->nullable();
            $table->string('codigo_anterior', 45)->nullable();
            $table->string('integrado_boleto', 1)->nullable();
            $table->string('id_cli_plataforma', 45)->nullable();
            $table->string('senha', 45)->nullable();
            $table->string('usuario', 120)->nullable();
            $table->timestamps(); // Cria as colunas created_at e updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
