<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntradaSaida extends Model
{
    protected $fillable = ['nome', 'valor', 'tipo', 'registro', 'stts', 'valor_venda', 'quantidade', 'total'];
}
