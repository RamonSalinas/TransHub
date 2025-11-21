<?php

namespace App\Http\Controllers;

use App\Models\Atraso;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $dadosAtrasos = Atraso::selectRaw('
            COUNT(*) as total,
            AVG(tempo_atraso_minutos) as media_atraso,
            periodo,
            ponto_critico,
            linha
        ')
        ->groupBy('periodo', 'ponto_critico', 'linha')
        ->get();

        $pontosCriticos = Atraso::selectRaw('
            ponto_critico,
            COUNT(*) as total_ocorrencias,
            AVG(tempo_atraso_minutos) as tempo_medio
        ')
        ->groupBy('ponto_critico')
        ->orderByDesc('total_ocorrencias')
        ->get();

        return view('dashboard', compact('dadosAtrasos', 'pontosCriticos'));
    }
}