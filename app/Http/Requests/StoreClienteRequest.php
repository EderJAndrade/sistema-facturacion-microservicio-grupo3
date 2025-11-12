<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|unique:clientes,email',
            'password' => 'required|min:6',
            'ruc' => 'nullable|string|max:13|unique:clientes,ruc',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'tipo_cliente' => 'in:Individual,Empresa',
            'limite_credito' => 'numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre no puede tener más de 100 caracteres.',

            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe tener un formato válido.',
            'email.unique' => 'Este correo electrónico ya está registrado.',

            'password.required' => 'La contraseña es obligatoria.',
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

