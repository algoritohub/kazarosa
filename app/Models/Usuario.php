<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $fillable = ['nome', 'email', 'senha', 'cidade', 'estado', 'bio', 'imagem', 'stts', 'nickname', 'atuacao', 'link', 'nascimento', 'tipo', 'telefone'];
}
