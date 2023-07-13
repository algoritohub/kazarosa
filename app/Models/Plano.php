<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plano extends Model
{
    protected $fillable = ['plano', 'nome', 'valor', 'horas', 'salas_free', 'horas_min', 'desconto', 'salas_desconto'];
}
