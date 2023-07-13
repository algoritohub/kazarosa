<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    protected $fillable = ['nome', 'descricao', 'minimo', 'valor', 'img1', 'img2', 'img3', 'img4', 'img5', 'stts', 'dual', 'turno', 'diaria'];
}