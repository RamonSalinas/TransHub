<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GaleriaController extends Controller
{
    public function index()
    {
        $fotos = [
            [
                'titulo' => 'Laboratório de Dados - Alunos em Ação',
                'descricao' => 'Estudantes analisando dados reais do transporte público',
                'url' => '/images/galeria/laboratorio.jpg',
                'tipo' => 'foto'
            ],
            [
                'titulo' => 'Processamento de Mensagens WhatsApp',
                'descricao' => 'Algoritmo em Python processando 1.847 mensagens',
                'url' => '/images/galeria/alunos.jpg',
                'tipo' => 'foto'
            ],

            [
                'titulo' => 'Depoimento da comunidade',
                'descricao' => 'Pessoas da comunidade contam sua experiência',
                'url' => '/images/galeria/comunidade.jpg',
                'tipo' => 'foto'
            ],
            // Adicione mais fotos conforme tiver
        ];

        $videos = [
            [
                'titulo' => 'Vídeo Demonstrativo do Projeto',
                'descricao' => 'Demonstração completa do sistema TransUFOB',
                'url' => 'https://www.youtube.com/embed/L9xs2N4vs_w',
                'tipo' => 'video'
            ],
            [
                'titulo' => 'Depoimento dos Estudantes',
                'descricao' => 'Alunos contam sua experiência no projeto',
                'url' => 'https://www.youtube.com/embed/Wlb2UHcOk4Q',
                'tipo' => 'video'
            ],
  


        ];

        $contato = [
            'email' => 'transufob@ufob.edu.br',
            'telefone' => '(77) 99999-9999',
            'responsavel' => 'Professor Responsável Ramon Adrian Salinas Franco',
            'github' => 'https://github.com/seu-usuario/transufob'
        ];

        return view('galeria.index', compact('fotos', 'videos', 'contato'));
    }
}