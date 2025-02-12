<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable {
    use HasApiTokens, Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'id'; 
    protected $fillable = [
        'name',
        'password',
        'email',
        'imageProfile',
    ];
    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'password' => 'string',
        'email' => 'string',
        'imageProfile' => 'string',
    ];
    
    public function funcionario() {
        return $this->belongsTo(Funcionario::class, 'funcionario_id', 'id'); 
    }

    public function projetos() {
        return $this->hasMany(Projeto::class, 'usuario_id');
    }
}
