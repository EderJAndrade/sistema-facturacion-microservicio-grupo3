<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClienteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => 'sometimes|string|max:100',
            'email' => 'sometimes|email|unique:clientes,email,' . $this->cliente,
            'password' => 'nullable|min:6',
            'ruc' => 'nullable|string|max:13|unique:clientes,ruc,' . $this->cliente,
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'tipo_cliente' => 'in:Individual,Empresa',
            'limite_credito' => 'numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre no puede tener más de 100 caracteres.',

            'email.email' => 'El correo electrónico debe tener un formato válido.',
            'email.unique' => 'Este correo electrónico ya está registrado.',

            'password.min' => 'La contraseña debe tener al menos :min caracteres.',

            'ruc.max' => 'El RUC no puede tener más de 13 caracteres.',
            'ruc.unique' => 'El RUC ya está registrado.',

            'telefono.max' => 'El teléfono no puede tener más de 20 caracteres.',

            'direccion.max' => 'La dirección no puede tener más de 255 caracteres.',

            'tipo_cliente.in' => 'El tipo de cliente debe ser "Individual" o "Empresa".',

            'limite_credito.numeric' => 'El límite de crédito debe ser un número.',
            'limite_credito.min' => 'El límite de crédito no puede ser negativo.',
        ];
    }
}
