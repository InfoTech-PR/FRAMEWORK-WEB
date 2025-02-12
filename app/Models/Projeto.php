<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_id', 
        'nomeProjeto', 
        'cliente_id', 
        'contatoEmpresa', 
        'status', 
        'analista_id', 
        'programador_id', 
        'observacoes', 
        'dataInicial', 
        'dataFinal'
    ];

    // Relação com o usuário
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    // Relação com o cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    // Relação com o analista
    public function analista()
    {
        return $this->belongsTo(Funcionario::class, 'analista_id');
    }

    // Relação com o programador
    public function programador()
    {
        return $this->belongsTo(Funcionario::class, 'programador_id');
    }
}
