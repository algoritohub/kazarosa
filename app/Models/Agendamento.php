<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    protected $fillable = ['user', 'sala', 'tempo', 'horario', 'dia', 'codigo', 'stts', 'valor', 'desconto', 'tipo'];
}
