<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContasPagar extends Model
{
    use HasFactory;

    protected $table = 'contas_pagar';

    public function status()
    {
        return $this->belongsTo(StatusConta::class, 'COD_SITUACAO', 'CODIGO');
    }
}
