<?php

namespace App\Http\Controllers;

use App\Models\Funcionarios;

class FuncionarioController extends Controller {
    public function index() {
        $funcionarios = Funcionarios::all(['nome']);
        if ($funcionarios->isEmpty()){
            return "Não há nada cadastrado no banco!";
        }
        return response()->json($funcionarios);
    }
}