<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $fillable = ['titulo', 'descricao', 'datas', 'hora', 'quantidade', 'entrada', 'valor', 'imagem', 'status', 'link'];
}
