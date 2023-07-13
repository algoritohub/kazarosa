<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CadastroContatoLading extends FormRequest
{
    public function rules()
    {
        return [
            'nome'     => ['required'],
            'telefone' => ['required'],
            'email'    => ['required', 'email'],
        ];
    }

    public function messages()
    {
        return [
            'nome.required'     => 'O nome é de preencimento obrigatório!',
            'telefone.required' => 'O telefone é de preencimento obrigatório!',
            'email.required'    => 'O e-mail é de preencimento obrigatório!',
            'email.email'       => 'O campo precisa de um e-mail válido!',
        ];
    }
}
