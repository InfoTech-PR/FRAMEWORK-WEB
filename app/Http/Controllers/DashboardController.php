<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ModalitySO;
use App\Models\ModalSO;
use App\Models\ServiceOrder;
use App\Models\ServiceTypeOS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\ServiceOrderRepository;

class DashboardController extends Controller
{

    private $serviceOrderRepository;

    public function __construct(ServiceOrderRepository $serviceOrderRepository)
    {
        $this->serviceOrderRepository = $serviceOrderRepository;
    }

    //Retorna os dados para o gráfico de todas as ordens de serviço
    public function clientes_os()
    {
        $totalOrders = $this->serviceOrderRepository->getAll()->count();

        $dates = $this->serviceOrderRepository->getStartAndFinalDate();
        $startDate = $dates['startDate'];
        $finalDate = $dates['finalDate'];

        $chartData = $this->serviceOrderRepository->getClientsXServiceOrders($startDate, $finalDate);

        return response()->json([
            'data' => $chartData,
            'totalOrders' => $totalOrders,
            'dates' => ['startDate' => $startDate, 'finalDate' => $finalDate],
            'message' => 'Dados recuperados com sucesso!'
        ]);
    }

    //Retorna os dados para o gráfico com um filtro de data vindo da requisição
    public function clientes_os_date(Request $request)
    {
        $request->validate([
            'startDate' => 'required',
            'finalDate' => 'required|after_or_equal:startDate'
        ]);

        $chartData = $this->serviceOrderRepository->getClientsXServiceOrders($request->startDate, $request->finalDate);
        $totalOrders = $this->serviceOrderRepository->getAll()->count();
        $startDate = $request->startDate;
        $finalDate = $request->finalDate;

        return response()->json([
            'data' => $chartData,
            'totalOrders' => $totalOrders,
            'dates' => ['startDate' => $startDate, 'finalDate' => $finalDate],
            'message' => 'Dados recuperados com sucesso!'
        ]);
    }

    public function os_cliente($id)
    {
        $orders = $this->serviceOrderRepository->getServiceOrderByClientId($id);
        if (!isset($orders)) {
            return response()->json(['message' => "Nenhuma ordem de serviço foi encontrada",])->setStatusCode(404);
        }

        $dataChart = $this->serviceOrderRepository->getServiceOrdersXClient($id);
        if (!isset($dataChart)) {
            return response()->json(['message' => "Erro ao recuperar os dados para o gráfico",])->setStatusCode(404);
        }

        $client = Client::select('CODIGO', 'NOME', 'NOME_FANTASIA')->where('CODIGO', $id)->first();
        if (!isset($client)) {
            return response()->json(['message' => "Cliente não encontrado",])->setStatusCode(404);
        }

        $modals = ModalSO::all();
        $modalities = ModalitySO::all();
        $serviceTypes = ServiceTypeOS::all();
        if (!isset($modals) || !isset($modalities) || !isset($serviceTypes)) {
            return response()->json(['message' => "Erro ao recuperar modais, modalidades ou tipos de o.s",])->setStatusCode(404);
        }

        return response()->json([
            'data' => $dataChart,
            'modals' => $modals,
            'modalities' => $modalities,
            'serviceTypes' => $serviceTypes,
            'client' => $client,
            'orders' => $orders,
        ])->setStatusCode(200);
    }

    public function os_cliente_filter(Request $request, $id)
    {
        $request->validate([
            'modalSelect',
            'modalitySelect',
            'serviceTypeSelect',
        ]);

        $orders = $this->serviceOrderRepository->getServiceOrderByClientId($id, $request->modalSelect, $request->modalitySelect, $request->ServiceTypeSelect);

        if (!isset($orders)) {
            return response()->json(['message' => "Nenhuma ordem de serviço foi encontrada",])->setStatusCode(404);
        }

        $dataChart = $this->serviceOrderRepository->getServiceOrdersXClient($id, $request->modalSelect, $request->modalitySelect, $request->serviceTypeSelect);

        if (!isset($dataChart)) {
            return response()->json(['message' => "Erro ao recuperar os dados para o gráfico",])->setStatusCode(404);
        }

        $client = Client::select('CODIGO', 'NOME', 'NOME_FANTASIA')->where('CODIGO', $id)->first();
        if (!isset($client)) {
            return response()->json(['message' => "Cliente não encontrado",])->setStatusCode(404);
        }

        $modals = ModalSO::all();
        $modalities = ModalitySO::all();
        $serviceTypes = ServiceTypeOS::all();
        if (!isset($modals) || !isset($modalities) || !isset($serviceTypes)) {
            return response()->json(['message' => "Erro ao recuperar modais, modalidades ou tipos de o.s",])->setStatusCode(404);
        }

        return response()->json([
            'data' => $dataChart,
            'modals' => $modals,
            'modalities' => $modalities,
            'serviceTypes' => $serviceTypes,
            'client' => $client,
            'orders' => $orders,
        ])->setStatusCode(200);
    }

    public function os_detail($id)
    {
        $serviceOrder = $this->serviceOrderRepository->getServiceOrderById($id);
        if (!isset($serviceOrder)) {
            return response()->json(['message' => "Ordem de serviço não encontrada!",])->setStatusCode(404);
        }

        return response()->json(['serviceOrder' => $serviceOrder,])->setStatusCode(200);
    }
}
