<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    use HasFactory;

    // Definindo a tabela associada ao model
    protected $table = 'projeto';

    // Definindo a chave primária (se não for o padrão 'id')
    protected $primaryKey = 'CODIGO';

    // Desabilitar a auto-incrementação, já que 'CODIGO' é um float e não é auto-incremental
    public $incrementing = false;

    // Definindo os campos que podem ser preenchidos (mass assignment)
    protected $fillable = [
        'CODIGO',
        'DATA_CADASTRO',
        'DATA_ALTERACAO',
        'COD_FUNCIONARIO_RESP',
        'NOME_PROJETO',
        'COD_CLIENTE',
        'CONTATO_EMPRESA',
        'COD_PROGRAMADOR_CHEFE',
        'OBSERVACOES',
        'COD_STATUS_SOFTWARE',
        'NOTIF_CLIENTE',
        'NOTIF_PROGRAMADOR',
        'DATA_INICIAL',
        'DATA_FINAL',
        'NUM_DEPENDENCIAS',
        'COD_ANALISTA_RESP'
    ];

    // Definindo os campos que devem ser tratados como data
    protected $dates = [
        'DATA_CADASTRO',
        'DATA_ALTERACAO',
        'DATA_INICIAL',
        'DATA_FINAL',
    ];
}
