<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuncionariosTable extends Migration {
    public function up() {
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->float('CODIGO')->primary();
            $table->string('NOME', 60)->nullable()->default(null);
            $table->string('N_CARTEIRA', 45)->nullable()->default(null);
            $table->date('DATA_NASCIMENTO')->nullable()->default(null);
            $table->date('DATA_ADMISSAO')->nullable()->default(null);
            $table->date('DATA_DEMISSAO')->nullable()->default(null);
            $table->text('OBS')->nullable()->default(null);
            $table->float('COD_BAIRRO')->nullable()->default(null);
            $table->float('COD_UF')->nullable()->default(null);
            $table->float('COD_PAIS')->nullable()->default(null);
            $table->string('COMPLEMENTO', 80)->nullable()->default(null);
            $table->string('APELIDO', 45)->nullable()->default(null);
            $table->string('DDD', 10)->nullable()->default(null);
            $table->string('DDI', 10)->nullable()->default(null);
            $table->string('FONE1', 10)->nullable()->default(null);
            $table->string('FONE2', 10)->nullable()->default(null);
            $table->string('CELULAR1', 15)->nullable()->default(null);
            $table->string('CELULAR2', 15)->nullable()->default(null);
            $table->string('EMAIL', 45)->nullable()->default(null);
            $table->string('HOME_PAGE', 45)->nullable()->default(null);
            $table->float('NUM_DEPENDENTES')->nullable()->default(null);
            $table->text('DADOS_CURRICULARES')->nullable()->default(null);
            $table->date('DATA_CRIACAO')->nullable()->default(null);
            $table->date('DATA_ALTERACAO')->nullable()->default(null);
            $table->binary('FOTO')->nullable()->default(null);
            $table->float('ATIVO')->nullable()->default(null);
            $table->string('CPF', 15)->nullable()->default(null);
            $table->string('RG', 15)->nullable()->default(null);
            $table->string('RESERVISTA', 15)->nullable()->default(null);
            $table->string('TIPO_CARTEIRA_MOTOR', 30)->nullable()->default(null);
            $table->string('CEP', 20)->nullable()->default(null);
            $table->float('AGENDA_APARECE')->nullable()->default(null);
            $table->float('COMISSAO_VENDA')->nullable()->default(null);
            $table->float('COD_FUNCIONARIO')->nullable()->default(null);
            $table->string('IMP', 10)->nullable()->default(null);
            $table->string('NUMERO', 10)->nullable()->default(null);
            $table->float('MOPP')->nullable()->default(null);
            $table->float('DIRECAO')->nullable()->default(null);
            $table->float('AUTORIZANTE')->nullable()->default(null);
            $table->float('COD_CIDADE')->nullable()->default(null);
            $table->float('COD_DEPARTAMENTO')->nullable()->default(null);
            $table->float('COD_FUNCAO')->nullable()->default(null);
            $table->string('ENDERECO', 60)->nullable()->default(null);
            $table->float('SALARIO')->nullable()->default(null);
            $table->string('SENHA_PONTO', 60)->nullable()->default(null);
            $table->integer('MES_ANIVERSARIO')->nullable()->default(null);
            $table->float('COMISSAO_PF')->nullable()->default(null);
            $table->float('COMISSAO_PJ')->nullable()->default(null);
            $table->float('PERCENTUAL_PRAZOS')->nullable()->default(null);
            $table->string('PROGRAMADOR_S_N', 1)->nullable()->default(null);

            $table->timestamps();  
        });
    }

    public function down() {
        Schema::dropIfExists('funcionarios');
    }
}
