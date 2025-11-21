<?php

namespace App\Http\Controllers;

use App\Models\Atraso;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Estatísticas gerais
        $totalOcorrencias = Atraso::count();
        $mediaAtraso = Atraso::avg('tempo_atraso_minutos');
        $pontoMaisCritico = Atraso::selectRaw('ponto_critico, COUNT(*) as total')
            ->groupBy('ponto_critico')
            ->orderByDesc('total')
            ->first();

        // Dados para gráficos
        $atrasosPorPeriodo = Atraso::selectRaw('periodo, COUNT(*) as total, AVG(tempo_atraso_minutos) as media')
            ->groupBy('periodo')
            ->get();

        $atrasosPorLinha = Atraso::selectRaw('linha, COUNT(*) as total, AVG(tempo_atraso_minutos) as media')
            ->groupBy('linha')
            ->get();

        $pontosCriticos = Atraso::selectRaw('ponto_critico, COUNT(*) as total_ocorrencias, AVG(tempo_atraso_minutos) as tempo_medio')
            ->groupBy('ponto_critico')
            ->orderByDesc('total_ocorrencias')
            ->get();

        return view('dashboard', compact(
            'totalOcorrencias',
            'mediaAtraso',
            'pontoMaisCritico',
            'atrasosPorPeriodo',
            'atrasosPorLinha',
            'pontosCriticos'
        ));
    }
}