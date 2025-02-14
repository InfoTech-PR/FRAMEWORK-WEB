<?php

namespace App\Http\Controllers;

use App\Models\Cliente;

class ClienteController extends Controller {
    public function index() {
        $clientes = Cliente::all(['NOME']);
        if ($clientes->isEmpty()){
            return "Não há nada cadastrado no banco!";
        }
        return response()->json($clientes);
    }
}