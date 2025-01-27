<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('NOME', 'SENHA');

        try {
            $usuario = Usuario::where('NOME', $credentials['NOME'])->first();
            if ($usuario) {
                if (Hash::check($credentials['SENHA'], $usuario->SENHA)) {
                    Auth::login($usuario);
                    $token = 0; // Gerar token futuramente
                    return response()->json(['token' => $token]);
                } else {
                    return response()->json(['message' => 'Usuário ou senha inválidos.'], 401);
                }
            } else {
                return response()->json(['message' => 'Usuário ou senha inválidos.'], 401);
            }
        } catch (QueryException $e) {
            return response()->json(['message' => 'Erro ao conectar ao banco de dados. Tente novamente mais tarde.'], 500);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro desconhecido. Tente novamente mais tarde.'], 500);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Desconectado com sucesso.']);
    }
}
