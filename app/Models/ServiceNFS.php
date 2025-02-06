<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceNFS extends Model
{
    use HasFactory;

    protected $table = 'prod_nfs';

    public function type()
    {
        return $this->belongsTo(ServiceTypeNFS::class, 'COD_DESCRICAO_SERVICO', 'CODIGO');
    }
}
