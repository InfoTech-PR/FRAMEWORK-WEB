<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function serviceOrders()
    {
        return $this->hasMany(ServiceOrder::class, 'COD_CLIENTE', 'CODIGO');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'COD_BAIRRO', 'CODIGO');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'COD_CIDADE', 'CODIGO');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'COD_UF', 'CODIGO');
    }

    protected $table = 'clientes';
}
