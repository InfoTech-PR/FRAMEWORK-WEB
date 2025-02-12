<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionarios extends Model {
    use HasFactory;
    protected $primaryKey = 'CODIGO';
    public $incrementing = false;

    protected $fillable = [
        'NOME',
        'N_CARTEIRA',
        'DATA_NASCIMENTO',
        'DATA_ADMISSAO',
        'DATA_DEMISSAO',
        'OBS',
        'COD_BAIRRO',
        'COD_UF',
        'COD_PAIS',
        'COMPLEMENTO',
        'APELIDO',
        'DDD',
        'DDI',
        'FONE1',
        'FONE2',
        'CELULAR1',
        'CELULAR2',
        'EMAIL',
        'HOME_PAGE',
        'NUM_DEPENDENTES',
        'DADOS_CURRICULARES',
        'DATA_CRIACAO',
        'DATA_ALTERACAO',
        'FOTO',
        'ATIVO',
        'CPF',
        'RG',
        'RESERVISTA',
        'TIPO_CARTEIRA_MOTOR',
        'CEP',
        'AGENDA_APARECE',
        'COMISSAO_VENDA',
        'COD_FUNCIONARIO',
        'IMP',
        'NUMERO',
        'MOPP',
        'DIRECAO',
        'AUTORIZANTE',
        'COD_CIDADE',
        'COD_DEPARTAMENTO',
        'COD_FUNCAO',
        'ENDERECO',
        'SALARIO',
        'SENHA_PONTO',
        'MES_ANIVERSARIO',
        'COMISSAO_PF',
        'COMISSAO_PJ',
        'PERCENTUAL_PRAZOS',
        'PROGRAMADOR_S_N'
    ];

    protected $guarded = [];

    protected $casts = [
        'DATA_NASCIMENTO' => 'date',
        'DATA_ADMISSAO' => 'date',
        'DATA_DEMISSAO' => 'date',
        'DATA_CRIACAO' => 'date',
        'DATA_ALTERACAO' => 'date',
        'FOTO' => 'binary',
        'ATIVO' => 'float',
        'NUM_DEPENDENTES' => 'float',
        'COD_BAIRRO' => 'float',
        'COD_UF' => 'float',
        'COD_PAIS' => 'float',
        'COD_CIDADE' => 'float',
        'COD_DEPARTAMENTO' => 'float',
        'COD_FUNCAO' => 'float',
        'SALARIO' => 'float',
        'COMISSAO_VENDA' => 'float',
        'COMISSAO_PF' => 'float',
        'COMISSAO_PJ' => 'float',
        'PERCENTUAL_PRAZOS' => 'float',
        'AGENDA_APARECE' => 'float',
        'MOPP' => 'float',
        'DIRECAO' => 'float',
        'AUTORIZANTE' => 'float',
        'COD_FUNCIONARIO' => 'float',
    ];

    public $timestamps = true;
    
     public function projetos() {
        return $this->hasMany(Projeto::class, 'programador_id'); // Se for programador
    }

    public function projetosAnalista() {
        return $this->hasMany(Projeto::class, 'analista_id'); // Se for analista
    }
    
    public function usuario() {
        return $this->hasOne(Usuario::class, 'COD_FUNCIONARIO', 'CODIGO');
    }
}