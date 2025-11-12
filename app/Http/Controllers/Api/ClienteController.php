<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Models\Cliente;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller
{
    // Listar todos los clientes
    public function index()
    {
        return response()->json(Cliente::all(), 200);
    }

    // Crear un nuevo cliente
    public function store(StoreClienteRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $cliente = Cliente::create($data);

        return response()->json([
            'message' => 'Cliente creado exitosamente.',
            'cliente' => $cliente
        ], 201);
    }

    // Mostrar un cliente por ID
    public function show($id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json(['message' => 'Cliente no encontrado.'], 404);
        }

        return response()->json($cliente, 200);
    }

    // Actualizar un cliente existente
    public function update(UpdateClienteRequest $request, $id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json(['message' => 'Cliente no encontrado.'], 404);
        }

        $data = $request->validated();

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $cliente->update($data);

        return response()->json([
            'message' => 'Cliente actualizado correctamente.',
            'cliente' => $cliente
        ], 200);
    }

    // Eliminar un cliente
    public function destroy($id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json(['message' => 'Cliente no encontrado.'], 404);
        }

        $cliente->delete();

        return response()->json(['message' => 'Cliente eliminado correctamente.'], 200);
    }
}

