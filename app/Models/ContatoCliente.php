<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContatoCliente extends Model
{
    protected $fillable = ['nome', 'email', 'telefone', 'registro', 'stts', 'tipo', 'estado', 'sala'];
}
