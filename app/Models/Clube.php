<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clube extends Model
{
    protected $fillable = ['id_user', 'plano', 'desconto', 'horas', 'stts', 'turno', 'inicio', 'dias', 'codigo'];
}
