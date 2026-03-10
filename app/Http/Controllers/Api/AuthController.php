<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Utils\ManejoData;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController //extends Controller
{
    // LOGIN
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'nullable|required_without:name|email',
            'name' => 'nullable|required_without:email|string',
            'password' => 'required|string'
        ]);

        $field = $request->filled('email') ? 'email' : 'name';

        $user = User::where($field, $request->$field)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            $arregloRetorno = ManejoData::armarDevolucion(400, true, "Credenciales inválidas", null, "Credenciales inválidas");
            return response()->json($arregloRetorno, $arregloRetorno['code']);
        }

        $user->tokens()->delete();//solo una sesion

        // Crear Access Token (1 hora)
        $accessToken = $user->createToken(
            'access_token',
            ['api'],
            // now()->addMinutes(1)
            now()->addHour()
        )->plainTextToken;

        // Crear Refresh Token (7 días)
        $refreshToken = $user->createToken(
            'refresh_token',
            ['refresh'],
            now()->addDays(7)
        )->plainTextToken;

        $arregloRetorno = ManejoData::armarDevolucion(200, true, "login success", 
        [
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken,
            'expires_in' => 3600,
            'user' => $user
        ]);

        return response()->json($arregloRetorno, $arregloRetorno['code']);
    }

    // REFRESH TOKEN (con rotación segura)
    public function refresh(Request $request)
    {
        $request->validate([
            'refresh_token' => 'required'
        ]);

        $token = PersonalAccessToken::findToken($request->refresh_token);

        if (!$token || !$token->can('refresh')) {
            $arregloRetorno = ManejoData::armarDevolucion(400, true, "Refresh token inválido", null, "Refresh token inválido");
            return response()->json($arregloRetorno, $arregloRetorno['code']);
        }

        $user = $token->tokenable;

        // 🔥 Eliminar refresh token usado
        $token->delete();

        // 🔥 Eliminar access tokens anteriores
        $user->tokens()
            ->where('name', 'access_token')
            ->delete();

        // Nuevo access token
        $newAccessToken = $user->createToken(
            'access_token',
            ['api'],
            now()->addHour()
        )->plainTextToken;

        // Nuevo refresh token
        $newRefreshToken = $user->createToken(
            'refresh_token',
            ['refresh'],
            now()->addDays(7)
        )->plainTextToken;

        $arregloRetorno = ManejoData::armarDevolucion(200, true, "login success", 
        [
            'access_token' => $newAccessToken,
            'refresh_token' => $newRefreshToken,
            'expires_in' => 3600,
            'user' => $user
        ]);

        return response()->json($arregloRetorno, $arregloRetorno['code']);
    }

    // LOGOUT
    public function logout(Request $request)
    {
        //todos los dispositivos
        $request->user()->tokens()->delete();
        // //elimina solo un dispositivo
        // $request->user()->currentAccessToken()->delete();

        $arregloRetorno = ManejoData::armarDevolucion(200, true, "Sesión cerrada correctamente", null);
        return response()->json($arregloRetorno, $arregloRetorno['code']);
    }
}
