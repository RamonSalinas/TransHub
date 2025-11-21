<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Atraso extends Model
{
    use HasFactory;

    protected $fillable = [
        'linha',
        'ponto_critico', 
        'tempo_atraso_minutos',
        'periodo',
        'data_ocorrencia',
        'mensagem_original'
    ];

    protected $casts = [
        'data_ocorrencia' => 'date',
    ];
}