<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Nfs;
use App\Models\ServiceNFS;
use App\Models\StatusNFS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NFSDashboardController extends Controller
{
  public function clientes_nfs()
  {
    $graphData = Nfs::with('client')->select('COD_CLIENTE', DB::raw('SUM(valor_total) as total'))->groupBy('COD_CLIENTE')->get();

    $totalNfs = Nfs::with('client')->count();

    $startDate = Nfs::whereNotNull('DATA_CRIACAO')->orderBy('DATA_CRIACAO')->first()->DATA_CRIACAO;
    $finalDate = Nfs::orderBy('DATA_CRIACAO', 'desc')->first()->DATA_CRIACAO;

    return response()->json([
      'data' => $graphData,
      'totalNfs' => $totalNfs,
      'dates' => ['startDate' => $startDate, 'finalDate' => $finalDate],
      'code' => 200,
      'message' => 'Dados recuperados com sucesso!'
    ]);
  }

  //Retorna os dados para o gráfico com um filtro de data vindo da requisição
  public function clientes_nfs_date(Request $request)
  {
    $request->validate([
      'startDate' => 'required',
      'finalDate' => 'required|after_or_equal:startDate'
    ]);

    $graphData = Nfs::with('client')->select('COD_CLIENTE', DB::raw('SUM(valor_total) as total'))->where('DATA_CRIACAO', '>=', $request->startDate)->where('DATA_CRIACAO', '<=', $request->finalDate)->orWhereNull('DATA_CRIACAO')->groupBy('COD_CLIENTE')->get();

    $totalNfs = Nfs::with('client')->select('COD_CLIENTE', DB::raw('SUM(valor_total) as total'))->where('DATA_CRIACAO', '>=', $request->startDate)->where('DATA_CRIACAO', '<=', $request->finalDate)->orWhereNull('DATA_CRIACAO')->count();
    $startDate = $request->startDate;
    $finalDate = $request->finalDate;

    return response()->json([
      'data' => $graphData,
      'totalNfs' => $totalNfs,
      'dates' => ['startDate' => $startDate, 'finalDate' => $finalDate],
      'code' => 200,
      'message' => 'Dados recuperados com sucesso!'
    ]);
  }
  public function nfs_cliente($id)
  {
    $nfs = Nfs::with('client')->with('status')->select('CODIGO', 'DATA_CRIACAO', 'NUM_NFS', 'NOME', 'COD_CLIENTE', 'NOME_FANTASIA', 'COD_SITUACAO_NFS', 'SUB_TOTAL_ITENS', 'VALOR_TOTAL')->where('COD_CLIENTE', $id)->get();
    if (!isset($nfs)) {
      return response()->json([
        'message' => "Nenhuma nota fiscal foi encontrada",
      ])->setStatusCode(404);
    }

    $client = Client::select('CODIGO', 'NOME', 'NOME_FANTASIA')->where('CODIGO', $id)->first();
    if (!isset($client)) {
      return response()->json([
        'message' => "Cliente não encontrado",
      ])->setStatusCode(404);
    }

    $allStatus = StatusNFS::all();
    if (!isset($allStatus)) {
      return response()->json([
        'message' => "Erro ao recuperar os status",
      ])->setStatusCode(404);
    }

    return response()->json([
      'nfs' => $nfs,
      'client' => $client,
      'allStatus' => $allStatus,
    ])->setStatusCode(200);
  }

  public function nfs_detail($id)
  {
    $nfs = Nfs::where('CODIGO', $id)->with(['services', 'client', 'status', 'responsible', 'city', 'state'])->first();
    $client = $nfs->client->with(['district', 'city', 'state'])->first();
    $services = ServiceNFS::with('type')->where('COD_NFS', $id)->get();
    return response()->json([
      'nfs' => $nfs,
      'client' => $client,
      'services' => $services,
    ])->setStatusCode(200);
  }
}
