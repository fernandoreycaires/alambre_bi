<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Token;

class AuthController extends Controller
{
    /**
     * Registrar um novo usuário
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->accessToken;

        return response()->json([
            'user' => $user,
            'access_token' => $token,
        ], 201);
    }

    /**
     * Fazer login e obter o token JWT
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (!auth()->attempt($credentials)) {
            return response()->json(['error' => 'Credenciais inválidas'], 401);
        }

        $token = auth()->user()->createToken('auth_token')->accessToken;

        return response()->json([
            'user' => auth()->user(),
            'access_token' => $token,
        ]);
    }

    /**
     * Obter o usuário autenticado
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    /**
     * Fazer logout (revogar o token)
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' => 'Deslogado com sucesso']);
    }

    /**
     * Listar os usuários
     */

    public function users()
    {
        $users = User::all();
        return response()->json($users);
    }
}