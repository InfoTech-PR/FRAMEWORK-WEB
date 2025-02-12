<?php

namespace App\Http\Controllers;

use App\Models\Projeto;
use Illuminate\Http\Request;

class ProjetoController extends Controller {
    public function store(Request $request) {
        $request->validate([
            'CODIGO' => 'required|numeric|unique:projeto,CODIGO',
            'DATA_CADASTRO' => 'nullable|date',
            'DATA_ALTERACAO' => 'nullable|date',
            'COD_FUNCIONARIO_RESP' => 'nullable|numeric',
            'NOME_PROJETO' => 'nullable|string|max:90',
            'COD_CLIENTE' => 'nullable|numeric',
            'CONTATO_EMPRESA' => 'nullable|string|max:90',
            'COD_PROGRAMADOR_CHEFE' => 'nullable|numeric',
            'OBSERVACOES' => 'nullable|string',
            'COD_STATUS_SOFTWARE' => 'nullable|numeric',
            'NOTIF_CLIENTE' => 'nullable|string|max:1',
            'NOTIF_PROGRAMADOR' => 'nullable|string|max:1',
            'DATA_INICIAL' => 'nullable|date',
            'DATA_FINAL' => 'nullable|date',
            'NUM_DEPENDENCIAS' => 'nullable|numeric',
            'COD_ANALISTA_RESP' => 'nullable|numeric',
        ]);

        $projeto = Projeto::create([
            'CODIGO' => $request->CODIGO,
            'DATA_CADASTRO' => $request->DATA_CADASTRO,
            'DATA_ALTERACAO' => $request->DATA_ALTERACAO,
            'COD_FUNCIONARIO_RESP' => $request->COD_FUNCIONARIO_RESP,
            'NOME_PROJETO' => $request->NOME_PROJETO,
            'COD_CLIENTE' => $request->COD_CLIENTE,
            'CONTATO_EMPRESA' => $request->CONTATO_EMPRESA,
            'COD_PROGRAMADOR_CHEFE' => $request->COD_PROGRAMADOR_CHEFE,
            'OBSERVACOES' => $request->OBSERVACOES,
            'COD_STATUS_SOFTWARE' => $request->COD_STATUS_SOFTWARE,
            'NOTIF_CLIENTE' => $request->NOTIF_CLIENTE,
            'NOTIF_PROGRAMADOR' => $request->NOTIF_PROGRAMADOR,
            'DATA_INICIAL' => $request->DATA_INICIAL,
            'DATA_FINAL' => $request->DATA_FINAL,
            'NUM_DEPENDENCIAS' => $request->NUM_DEPENDENCIAS,
            'COD_ANALISTA_RESP' => $request->COD_ANALISTA_RESP,
        ]);

        return response()->json([
            'message' => 'Projeto criado com sucesso!',
            'projeto' => $projeto
        ], 201);
    }
}
