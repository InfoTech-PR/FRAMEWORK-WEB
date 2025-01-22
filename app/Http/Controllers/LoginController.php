<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('name', 'password');
        try {
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                // $token = $user->createToken('YourAppName')->plainTextToken;
                $token = 0;
                return response()->json(['token' => $token]);
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
