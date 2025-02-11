<?php

namespace App\Http\Controllers;

use App\Models\Funcionarios;

class FuncionarioController extends Controller {
    public function index() {
        $funcionarios = Funcionarios::all(['nome']);
        return response()->json($funcionarios);
    }
}