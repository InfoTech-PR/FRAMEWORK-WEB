<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Controller;

class AuthController extends Controller {
    public function login(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('name', 'password');

        try {
            $usuario = Usuario::where('name', $credentials['name'])->first();
            if ($usuario) {
                if (Hash::check($credentials['password'], $usuario->password)) {
                    Auth::login($usuario);
                    $token = $usuario->createToken('YourAppName')->plainTextToken;

                    return response()->json([
                        'token' => $token,
                        'userData' => $usuario->name,
                        'userAbilityRules' => 'admin',
                        'userEmail' => $usuario->email,
                        'userProfile' => $usuario->imageProfile
                    ]);
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

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Desconectado com sucesso.']);
    }
}
