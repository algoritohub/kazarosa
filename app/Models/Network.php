<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Network extends Model
{
    protected $fillable = ['usuario', 'postagem', 'descricao', 'curtidas', 'data', 'status'];
}
