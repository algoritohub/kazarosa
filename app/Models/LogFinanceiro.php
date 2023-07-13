<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogFinanceiro extends Model
{
    protected $fillable = ['codigo', 'tipo', 'data', 'valor', 'vantagem', 'stts', 'mes'];
}
