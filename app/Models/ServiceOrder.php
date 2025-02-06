<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceOrder extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function client()
    {
        return $this->belongsTo(Client::class, 'COD_CLIENTE', 'CODIGO');
    }

    public function status()
    {
        return $this->belongsTo(StatusSO::class, 'COD_STATUS', 'CODIGO');
    }

    public function modal()
    {
        return $this->belongsTo(ModalSO::class, 'COD_MODAL', 'CODIGO');
    }

    public function modality()
    {
        return $this->belongsTo(ModalitySO::class, 'COD_MODALIDADE', 'CODIGO');
    }

    public function dispatch()
    {
        return $this->belongsTo(DispatchSO::class, 'COD_DESPACHO', 'CODIGO');
    }

    public function ship()
    {
        return $this->belongsTo(Ship::class, 'COD_NAVIO', 'CODIGO');
    }

    public function type()
    {
        return $this->belongsTo(ServiceTypeOS::class, 'COD_TIPO_OS', 'CODIGO');
    }

    protected $table = 'ordem_lap';
}
