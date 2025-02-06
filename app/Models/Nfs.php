<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nfs extends Model
{
    use HasFactory;

    protected $table = 'nota_fiscal_servicos';

    public function responsible()
    {
        return $this->belongsTo(Responsible::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'COD_CLIENTE', 'CODIGO');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'COD_CIDADE', 'CODIGO');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'COD_ESTADO', 'CODIGO');
    }

    public function status()
    {
        return $this->belongsTo(StatusNFS::class, 'COD_SITUACAO_NFS', 'CODIGO');
    }

    public function services()
    {
        return $this->hasMany(ServiceNFS::class, 'COD_NFS', 'CODIGO');
    }
}
