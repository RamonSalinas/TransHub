<?php

namespace App\Http\Controllers;

use App\Models\Atraso;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class RelatorioController extends Controller
{
    public function index()

    {

        $total_ocorrencias = Atraso::count();
        $media_atraso = Atraso::avg('tempo_atraso_minutos');
        $pontos_criticos = Atraso::selectRaw('ponto_critico, COUNT(*) as total')
            ->groupBy('ponto_critico')
            ->orderByDesc('total')
            ->get();
        $data_geracao = now()->format('d/m/Y H:i');
    

        $estatisticas = [
            'total_ocorrencias' => Atraso::count(),
            'media_atraso' => Atraso::avg('tempo_atraso_minutos'),
            'ponto_mais_critico' => Atraso::selectRaw('ponto_critico, COUNT(*) as total')
                ->groupBy('ponto_critico')
                ->orderByDesc('total')
                ->first(),
            'linha_mais_afetada' => Atraso::selectRaw('linha, COUNT(*) as total')
                ->groupBy('linha')
                ->orderByDesc('total')
                ->first(),
        ];

        $dadosGraficos = [
            'por_periodo' => Atraso::selectRaw('periodo, COUNT(*) as total')
                ->groupBy('periodo')
                ->get(),
            'por_linha' => Atraso::selectRaw('linha, COUNT(*) as total')
                ->groupBy('linha')
                ->get(),
        ];

        // Adicionar a data de geração
        $data_geracao = now()->format('d/m/Y H:i');

//        return view('relatorios.index', compact('estatisticas', 'dadosGraficos', 'data_geracao'));
        return view('relatorios.index', compact('total_ocorrencias', 'media_atraso', 'pontos_criticos', 'data_geracao'));

    }

    public function gerarPdf()
    {
        $dados = [
            'total_ocorrencias' => Atraso::count(),
            'media_atraso' => Atraso::avg('tempo_atraso_minutos'),
            'pontos_criticos' => Atraso::selectRaw('ponto_critico, COUNT(*) as total, AVG(tempo_atraso_minutos) as media')
                ->groupBy('ponto_critico')
                ->orderByDesc('total')
                ->get(),
            'data_geracao' => now()->format('d/m/Y H:i'),
            'projeto' => 'TransHUB - Sistema de Monitoramento de Mobilidade'
        ];

        // Configurar o PDF para retrato e margens menores
        $pdf = Pdf::loadView('relatorios.pdf', $dados)
            ->setPaper('a4', 'portrait')
            ->setOption('margin-top', 10)
            ->setOption('margin-bottom', 10)
            ->setOption('margin-left', 10)
            ->setOption('margin-right', 10);

        return $pdf->download('relatorio-transufob-' . now()->format('Y-m-d') . '.pdf');
    }
}