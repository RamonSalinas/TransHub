<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Atraso;

class AtrasoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Dados baseados na sua análise (1.847 mensagens)
        $dados = [
            [
                'linha' => '15', 
                'ponto_critico' => 'Bairro da Feira', 
                'tempo_atraso_minutos' => 35, 
                'periodo' => 'manha', 
                'data_ocorrencia' => '2025-01-15',
                'mensagem_original' => 'Ônibus 15 atrasado no Bairro da Feira'
            ],
            [
                'linha' => '15A', 
                'ponto_critico' => 'Praça das Corujas', 
                'tempo_atraso_minutos' => 42, 
                'periodo' => 'tarde', 
                'data_ocorrencia' => '2025-01-15',
                'mensagem_original' => '15A parado na Praça das Corujas'
            ],
            [
                'linha' => '15', 
                'ponto_critico' => 'Acesso UFOB', 
                'tempo_atraso_minutos' => 28, 
                'periodo' => 'noite', 
                'data_ocorrencia' => '2025-01-16',
                'mensagem_original' => 'Demora no acesso à UFOB'
            ],
            [
                'linha' => '15A', 
                'ponto_critico' => 'Bairro da Feira', 
                'tempo_atraso_minutos' => 50, 
                'periodo' => 'manha', 
                'data_ocorrencia' => '2025-01-16',
                'mensagem_original' => 'Superlotação no Bairro da Feira'
            ],
            [
                'linha' => '15', 
                'ponto_critico' => 'Praça das Corujas', 
                'tempo_atraso_minutos' => 33, 
                'periodo' => 'tarde', 
                'data_ocorrencia' => '2025-01-17',
                'mensagem_original' => 'Trânsito na Praça das Corujas'
            ],
            // Adicione mais dados conforme sua análise real
        ];

        foreach ($dados as $dado) {
            Atraso::create($dado);
        }

        $this->command->info('✅ Dados de atrasos inseridos com sucesso!');
    }
}