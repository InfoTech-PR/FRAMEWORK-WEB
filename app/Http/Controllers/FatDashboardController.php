<?php

namespace App\Http\Controllers;

use App\Models\ContasPagar;
use App\Models\StatusConta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FatDashboardController extends Controller
{
    public function faturamento_geral()
    {
        $fat = ContasPagar::with('status')->select('COD_SITUACAO', DB::raw('
        CASE 
            WHEN NUM_OS IS NOT NULL AND NUM_NFS IS NOT NULL THEN "Ordens de Serviço e Nota Fiscal de Serviço"
            WHEN NUM_OS IS NOT NULL AND NUM_NFS IS NULL THEN "Ordens de Serviço"
            WHEN NUM_OS IS NULL AND NUM_NFS IS NOT NULL THEN "Nota Fiscal de Serviço apenas"
            ELSE "Sem vínculo"
        END as tipo_conta
    '), DB::raw('SUM(valor) as total'))->groupBy('tipo_conta', 'COD_SITUACAO')->get();

        return response()->json([
            'fat' => $fat,
        ]);
    }
}
