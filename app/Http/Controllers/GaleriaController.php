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
                'url' => '/images/galeria/alunos.jpg',
                'tipo' => 'foto'
            ],
            [
                'titulo' => 'Processamento de Mensagens WhatsApp',
                'descricao' => 'Algoritmo em Python processando 10.847 mensagens',
                'url' => '/images/galeria/whatssap.png',
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
                'descricao' => 'Demonstração completa do sistema TransHUB',
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
            'email' => 'ramon.franco@ufob.edu.br',
            'telefone' => '(77) 98252-1234',
            'responsavel' => 'Professor Responsável Ramon Adrian Salinas Franco',
            'github' => 'https://github.com/RamonSalinas/TransHUB'
        ];

        return view('galeria.index', compact('fotos', 'videos', 'contato'));
    }
}