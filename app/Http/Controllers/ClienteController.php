<?php

namespace App\Http\Controllers;

use App\Models\Cliente;

class ClienteController extends Controller {
    public function index() {
        $clientes = Cliente::all(['nome']);
        return response()->json($clientes);
    }
}