<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'CODIGO';

    protected $fillable = [
        'CODIGO',
        'COD_FUNCIONARIO',
        'NOME',
        'SENHA',
        'EMAIL',
        'FOTO',
    ];

    protected $hidden = [
        'SENHA',
    ];

    // protected function casts(): array
    // {
    //     return [
    //         'email_verified_at' => 'datetime',
    //         'password' => 'hashed',
    //     ];
    // }

    protected $casts = [
        'CODIGO' => 'float',
        'COD_FUNCIONARIO' => 'float',
        'NOME' => 'string',
        'SENHA' => 'string',
        'EMAIL' => 'string',
        'FOTO' => 'string',
    ];
}
