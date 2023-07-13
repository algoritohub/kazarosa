<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LogRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => ['required', 'email'],
            'senha' => ['required', 'min:8', 'max:16']
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'O usuário é de preencimento obrigatório!',
            'email.email' => 'O usuário precisa ser um e-mail válido!',
            'senha.required' => 'Senha é obrigatória!',
            'senha.min' => 'A senha precisa ter no mínimo :min caractéres!',
            'senha.max' => 'A senha precisa ter no máximo :max caractéres!'
        ];
    }
}
