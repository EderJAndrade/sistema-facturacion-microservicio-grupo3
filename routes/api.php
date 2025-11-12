<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ClienteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Cliente;

// Registro de cliente (público)
Route::post('/clientes', [ClienteController::class, 'store']);

// Login (genera token Sanctum)
Route::post('/login', function (Request $request) {
    $cliente = Cliente::where('email', $request->email)->first();

    if (!$cliente || !Hash::check($request->password, $cliente->password)) {
        return response()->json(['message' => 'Credenciales incorrectas'], 401);
    }

    $token = $cliente->createToken('api-token')->plainTextToken;

    return response()->json(['token' => $token, 'cliente' => $cliente], 200);
});

// CRUD protegido por token
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('clientes', ClienteController::class)->except(['store']);
});
