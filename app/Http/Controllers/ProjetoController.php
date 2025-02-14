<?php

namespace App\Http\Controllers;

use App\Models\Projeto;
use App\Models\Cliente;
use App\Models\Funcionarios;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProjetoController extends Controller {
    public function store(Request $request) {
        try {
            $request->validate([
                'DATA_CADASTRO' => 'nullable|date',
                'DATA_ALTERACAO' => 'nullable|date',
                'COD_FUNCIONARIO_RESP' => 'nullable|numeric ',
                'NOME_PROJETO' => 'nullable|string|max:90',
                'COD_CLIENTE' => 'nullable|string|max:90',
                'CONTATO_EMPRESA' => 'nullable|string|max:90',
                'COD_PROGRAMADOR_CHEFE' => 'nullable|string|max:90',
                'OBSERVACOES' => 'nullable|string',
                'COD_STATUS_SOFTWARE' => 'nullable|numeric',
                'NOTIF_CLIENTE' => 'nullable|string|max:1',
                'NOTIF_PROGRAMADOR' => 'nullable|string|max:1',
                'DATA_INICIAL' => 'nullable|date',
                'DATA_FINAL' => 'nullable|date',
                'NUM_DEPENDENCIAS' => 'nullable|numeric',
                'COD_ANALISTA_RESP' => 'nullable|string|max:90',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Dados inválidos.',
                'errors' => $e->errors()
            ], 422);
        }

        $cliente = Cliente::where('NOME', $request->COD_CLIENTE)->first();
        if (!$cliente) {
            return response()->json([
                'message' => 'Cliente não encontrado!',
                'errors' => [
                    'COD_CLIENTE' => ['Cliente com o nome informado não encontrado.']
                ]
            ], 404);
        }

        $analista = Funcionarios::where('NOME', $request->COD_ANALISTA_RESP)->first();
        if (!$analista) {
            return response()->json([
                'message' => 'Analista não encontrado!',
                'errors' => [
                    'COD_ANALISTA_RESP' => ['Analista com o nome informado não encontrado.']
                ]
            ], 404);
        }

        $programador = Funcionarios::where('NOME', $request->COD_PROGRAMADOR_CHEFE)->first();
        if (!$programador) {
            return response()->json([
                'message' => 'Programador não encontrado!',
                'errors' => [
                    'COD_FUNCIONARIO_RESP' => ['Programador com o nome informado não encontrado.']
                ]
            ], 404);
        }

        $codigoCliente = $cliente->CODIGO;
        $codigoAnalista = $analista->CODIGO;
        $codigoProgramador = $programador->CODIGO;
        $ultimoCodigo = Projeto::max('CODIGO');
        $novoCodigo = $ultimoCodigo + 1;

        $projeto = Projeto::create([
            'CODIGO' => $novoCodigo,
            'DATA_CADASTRO' => $request->DATA_CADASTRO,
            'DATA_ALTERACAO' => $request->DATA_ALTERACAO,
            'COD_FUNCIONARIO_RESP' => $request->COD_FUNCIONARIO_RESP,
            'NOME_PROJETO' => $request->NOME_PROJETO,
            'COD_CLIENTE' => $codigoCliente,    
            'CONTATO_EMPRESA' => $request->CONTATO_EMPRESA,
            'COD_PROGRAMADOR_CHEFE' => $codigoProgramador,
            'OBSERVACOES' => $request->OBSERVACOES,
            'COD_STATUS_SOFTWARE' => $request->COD_STATUS_SOFTWARE,
            'NOTIF_CLIENTE' => $request->NOTIF_CLIENTE,
            'NOTIF_PROGRAMADOR' => $request->NOTIF_PROGRAMADOR,
            'DATA_INICIAL' => $request->DATA_INICIAL,
            'DATA_FINAL' => $request->DATA_FINAL,
            'NUM_DEPENDENCIAS' => $request->NUM_DEPENDENCIAS,
            'COD_ANALISTA_RESP' => $codigoAnalista,
        ]);

        return response()->json([
            'message' => 'Projeto criado com sucesso!',
            'projeto' => $projeto
        ], 201);
    }
}