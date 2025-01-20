<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class LoginController extends Controller {
    public function index() {
        return view('home');
    }

    public function login(Request $request) {
        $credentials = $request->only('name', 'password');
        try {
            if (Auth::attempt($credentials)) {
                return response()->json(['redirect' => '/home']);
            } else {
                return response()->json(['message' => 'Usuário ou senha inválidos.'], 401);
            }
        } catch (QueryException $e) {
            return response()->json(['message' => 'Erro ao conectar ao banco de dados. Tente novamente mais tarde.'], 500);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro desconhecido. Tente novamente mais tarde.'], 500);
        }
    }

    public function logout() {
        Auth::logout();
        return view('home');
    }
}
