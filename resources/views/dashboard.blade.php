
@extends('layouts.app')



@section('title', 'Dashboard - TransHUB RASF')


@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    #map { 
        height: 500px; 
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    
    .leaflet-popup-content {
        font-family: 'Segoe UI', Arial, sans-serif;
    }
    
    .custom-popup {
        padding: 15px;
        min-width: 220px;
    }
    
    .popup-title {
        font-weight: 700;
        color: #2c5aa0;
        margin-bottom: 8px;
        font-size: 1.1em;
    }
    
    .popup-stats {
        font-size: 0.9em;
        color: #666;
        line-height: 1.4;
    }

    .card {
        box-shadow: 0 6px 25px rgba(0,0,0,0.08);
        border: none;
        border-radius: 16px;
        margin-bottom: 25px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 35px rgba(0,0,0,0.15);
    }

    .card-header {
        border-radius: 16px 16px 0 0 !important;
        border: none;
        padding: 20px 25px;
        font-weight: 600;
    }

    .stat-card {
        border-radius: 16px;
        border: none;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: scale(1.05);
    }

    .stat-card .card-body {
        padding: 25px 20px;
    }

    .chart-container {
        position: relative;
        height: 300px;
        padding: 20px;
    }

    .gradient-bg-primary {
        background: linear-gradient(135deg, #2c5aa0, #4a7bc8);
    }

    .gradient-bg-warning {
        background: linear-gradient(135deg, #f39c12, #f1c40f);
    }

    .gradient-bg-danger {
        background: linear-gradient(135deg, #e74c3c, #e67e22);
    }

    .gradient-bg-success {
        background: linear-gradient(135deg, #27ae60, #2ecc71);
    }

    .metric-value {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 5px;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .metric-label {
        font-size: 0.9rem;
        opacity: 0.9;
        font-weight: 500;
    }

    .trend-indicator {
        display: inline-flex;
        align-items: center;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-left: 10px;
    }

    .trend-up {
        background: rgba(46, 204, 113, 0.2);
        color: #27ae60;
    }

    .trend-down {
        background: rgba(231, 76, 60, 0.2);
        color: #c0392b;
    }

    .chart-legend {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-top: 20px;
    }

    .legend-item {
        display: flex;
        align-items: center;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .legend-color {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        margin-right: 8px;
    }

    .custom-tooltip {
        background: rgba(255, 255, 255, 0.95);
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        backdrop-filter: blur(10px);
    }
</style>
@endsection

@section('content')



<!-- HERO BANNER ULTRA IMPACTANTE -->
<div class="hero-impact mb-5"
     style="
        background: radial-gradient(circle at 20% 20%, #0a1930, #0e233d, #102d4d);
        border-radius: 22px;
        padding: 70px 50px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 15px 45px rgba(0,0,0,0.4);
     ">

    <!-- EFEITO DE LUZ AZUL -->
    <div style="
        position: absolute;
        top: -120px;
        right: -80px;
        width: 380px;
        height: 380px;
        border-radius: 50%;
        background: rgba(0,150,255,0.25);
        filter: blur(120px);
        z-index: 1;
     "></div>

    <!-- EFEITO DE LUZ VERDE -->
    <div style="
        position: absolute;
        bottom: -120px;
        left: -80px;
        width: 300px;
        height: 300px;
        border-radius: 50%;
        background: rgba(0,255,170,0.20);
        filter: blur(120px);
        z-index: 1;
     "></div>

    <div class="row align-items-center position-relative" style="z-index: 3;">
        
        <!-- Texto e descrição -->
        <div class="col-lg-7 col-md-7 text-white">
            
            <h1 class="fw-bold"
                style="
                    font-size: 3rem;
                    line-height: 1.2;
                    text-shadow: 0 4px 10px rgba(0,0,0,0.4);
                ">
                TransHUB – Inteligência para <br>
                Monitoramento do Transporte Público
            </h1>

            <p class="mt-3"
               style="
                    font-size: 1.25rem;
                    max-width: 680px;
                    opacity: 0.9;
                    line-height: 1.6;
               ">
                Plataforma inteligente que analisa atrasos em tempo real,
                identifica padrões críticos, apresenta desempenho por linha
                e oferece visualização geográfica avançada para decisões precisas.
            </p>

            <!-- Botões -->
            <div class="mt-4">

                <a href="#map"
                   class="btn btn-primary btn-lg me-3 px-5 py-3"
                   style="
                        border-radius: 14px;
                        background: linear-gradient(135deg, #007bff, #00c6ff);
                        border: none;
                        box-shadow: 0 4px 18px rgba(0,150,255,0.6);
                        font-weight: 600;
                   ">
                   Ver Mapa Interativo
                </a>

                <a href="{{ route('relatorios') }}"
   class="btn btn-outline-light btn-lg px-5 py-3"
   style="
        border-radius: 14px;
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255,255,255,0.5);
        font-weight: 600;
   ">
   Relatórios Avançados
</a>

            </div>
        </div>

        <!-- Imagem principal (flutuante com brilho) -->
        <div class="col-lg-5 col-md-5 text-center d-none d-md-block">
            <img src="/images/galeria/onibuszaul.png"
                 alt="Dashboard Smart Mobility"
                 style="
                    width: 100%;
                    max-width: 430px;
                    margin-top: 20px;
                    border-radius: 18px;
                    box-shadow: 0 12px 35px rgba(0,0,0,0.55);
                    transform: perspective(1000px) rotateY(-8deg);
                    transition: transform 0.4s ease;
                 "
                 onmouseover="this.style.transform='perspective(1000px) rotateY(0deg) scale(1.02)'"
                 onmouseout="this.style.transform='perspective(1000px) rotateY(-8deg)'">
        </div>

    </div>

</div>
























<div class="container-fluid mt-4">
    <!-- Cartões com Estatísticas -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card gradient-bg-primary text-white">
                <div class="card-body text-center">
                    <div class="metric-value">{{ $totalOcorrencias }}</div>
                    <div class="metric-label">Total de Ocorrências </div>
                    <div class="mt-2">
                        <small>+15.4% vs último mês</small>
                        <span class="trend-indicator trend-up">↑</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card gradient-bg-warning text-white">
                <div class="card-body text-center">
                    <div class="metric-value">{{ number_format($mediaAtraso, 0) }}<small>min</small></div>
                    <div class="metric-label">Atraso Médio</div>
                    <div class="mt-2">
                        <small>-5% vs último mês</small>
                        <span class="trend-indicator trend-down">↓</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card gradient-bg-danger text-white">
                <div class="card-body text-center">
                    <div class="metric-value">{{ $pontoMaisCritico->total ?? 0 }}</div>
                    <div class="metric-label">{{ Str::limit($pontoMaisCritico->ponto_critico ?? 'N/A', 15) }}</div>
                    <div class="mt-2">
                        <small>Ponto Mais Crítico</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card gradient-bg-success text-white">
                <div class="card-body text-center">
                    <div class="metric-value">{{ $atrasosPorLinha->count() }}</div>
                    <div class="metric-label">Linhas Monitoradas</div>
                    <div class="mt-2">
                        <small>100% cobertura</small>
                        <span class="trend-indicator trend-up">✓</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráficos Melhorados -->
    <div class="row mb-4">
        <div class="col-xl-6 col-lg-12">
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">📈 Distribuição por Período do Dia</h5>
                    <span class="badge bg-light text-primary">24h</span>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="graficoPeriodo"></canvas>
                    </div>
                    <div class="chart-legend">
                        <div class="legend-item">
                            <div class="legend-color" style="background: #4bc0c0;"></div>
                            <span>Manhã (35%)</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background: #ff6384;"></div>
                            <span>Tarde (65%)</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background: #ff9f40;"></div>
                            <span>Noite (85%)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-12">
            <div class="card">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">🚍 Performance por Linha</h5>
                    <span class="badge bg-light text-success">{{ $atrasosPorLinha->count() }} linhas</span>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="graficoLinhas"></canvas>
                    </div>
                    <div class="chart-legend">
                        <div class="legend-item">
                            <div class="legend-color" style="background: #4bc0c0;"></div>
                            <span>Linha 15</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background: #9966ff;"></div>
                            <span>Linha 15A</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background: #ff9f40;"></div>
                            <span>Linha 20</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráfico de Tendência Temporal -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">📊 Evolução Semanal - Padrão de Atrasos</h5>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="height: 350px;">
                        <canvas id="graficoTendencia"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
       
<!-- Mapa Interativo de Barreiras -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5>🗺️ Mapa Interativo - Pontos Críticos de Atraso em Barreiras/BA</h5>
            </div>
            <div class="card-body">
                <div id="map" style="height: 500px; border-radius: 8px;"></div>
                
                <!-- Legenda -->
                <div class="mt-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Legenda dos Pontos:</h6>
                            <div class="d-flex align-items-center mb-1">
                                <div style="width: 20px; height: 20px; background-color: #ff4444; border-radius: 50%; margin-right: 10px;"></div>
                                <span>Alto índice de atrasos (> 40min)</span>
                            </div>
                            <div class="d-flex align-items-center mb-1">
                                <div style="width: 20px; height: 20px; background-color: #ffaa00; border-radius: 50%; margin-right: 10px;"></div>
                                <span>Médio índice de atrasos (20-40min)</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <div style="width: 20px; height: 20px; background-color: #44ff44; border-radius: 50%; margin-right: 10px;"></div>
                                <span>Baixo índice de atrasos (< 20min)</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6>Estatísticas do Mapa:</h6>
                            <div id="map-stats">
                                <small>Pontos críticos carregados: <span id="total-pontos">0</span></small><br>
                                <small>Área coberta: Centro de Barreiras</small><br>
                                <small>Fonte: OpenStreetMap</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>













        <!-- Tabela de Dados -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>📋 Últimos Registros de Atraso</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Linha</th>
                                        <th>Ponto Crítico</th>
                                        <th>Atraso (min)</th>
                                        <th>Período</th>
                                        <th>Data</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(App\Models\Atraso::latest()->take(5)->get() as $atraso)
                                    <tr>
                                        <td>{{ $atraso->linha }}</td>
                                        <td>{{ $atraso->ponto_critico }}</td>
                                        <td>{{ $atraso->tempo_atraso_minutos }}</td>
                                        <td>{{ $atraso->periodo }}</td>
                                        <td>{{ $atraso->data_ocorrencia->format('d/m/Y') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    </body>
</html>
    @endsection

@section('scripts')







    <script>
// Gráfico de Tendência Temporal - Linha Suave
const ctxTendencia = document.getElementById('graficoTendencia').getContext('2d');
    new Chart(ctxTendencia, {
        type: 'line',
        data: {
            labels: ['Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
            datasets: [{
                label: 'Atrasos Diários',
                data: [12, 18, 25, 28, 42, 15, 8],
                borderColor: '#2c5aa0',
                backgroundColor: 'rgba(44, 90, 160, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#2c5aa0',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2,
                pointRadius: 6,
                pointHoverRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                tooltip: {
                    mode: 'index',
                    intersect: false,
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0,0,0,0.05)'
                    },
                    title: {
                        display: true,
                        text: 'Número de Atrasos'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            },
            interaction: {
                intersect: false,
                mode: 'nearest'
            }
        }
    });



        // Dados para os gráficos (convertendo coleção Laravel para arrays)
        const periodos = {!! $atrasosPorPeriodo->pluck('periodo') !!};
        const totaisPorPeriodo = {!! $atrasosPorPeriodo->pluck('total') !!};
        
        const linhas = {!! $atrasosPorLinha->pluck('linha') !!};
        const mediasPorLinha = {!! $atrasosPorLinha->pluck('media') !!};

        // Gráfico de Atrasos por Período
        const ctxPeriodo = document.getElementById('graficoPeriodo').getContext('2d');
        new Chart(ctxPeriodo, {
            type: 'bar',
            data: {
                labels: periodos,
                datasets: [{
                    label: 'Quantidade de Atrasos',
                    data: totaisPorPeriodo,
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true
                    }
                }
            }
        });

        // Gráfico de Tempo Médio por Linha
        const ctxLinhas = document.getElementById('graficoLinhas').getContext('2d');
        new Chart(ctxLinhas, {
            type: 'pie',
            data: {
                labels: linhas,
                datasets: [{
                    data: mediasPorLinha,
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>


<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    // Inicializar o mapa centrado em Barreiras/BA
    var map = L.map('map').setView([-12.1520, -44.9910], 13);

    // Adicionar camada do OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        maxZoom: 18
    }).addTo(map);

    // Coordenadas reais dos pontos críticos em Barreiras
    var pontosCriticos = [
        {
            nome: "Bairro da Feira",
            lat: -12.1390,
            lng: -44.9850,
            atrasoMedio: 35,
            ocorrencias: 45,
            linha: "15, 15A",
            periodoCritico: "Manhã (7h-8h)"
        },
        {
            nome: "Praça das Corujas", 
            lat: -12.1480,
            lng: -44.9950,
            atrasoMedio: 42,
            ocorrencias: 38,
            linha: "15A",
            periodoCritico: "Tarde (18h-19h)"
        },
        {
            nome: "Acesso UFOB - Campus",
            lat: -12.1450,
            lng: -44.9880,
            atrasoMedio: 28,
            ocorrencias: 32,
            linha: "15, 15A",
            periodoCritico: "Noite (22h-23h)"
        },
        {
            nome: "Centro - Av. ACM",
            lat: -12.1520,
            lng: -44.9910,
            atrasoMedio: 25,
            ocorrencias: 28,
            linha: "15, 20",
            periodoCritico: "Manhã (7h-9h)"
        },
        {
            nome: "Bairro Vila Brasil",
            lat: -12.1350,
            lng: -44.9800,
            atrasoMedio: 38,
            ocorrencias: 22,
            linha: "15A",
            periodoCritico: "Tarde (17h-18h)"
        }
    ];

    // Função para definir cor baseada no atraso médio
    function getColorByAtraso(atrasoMedio) {
        if (atrasoMedio > 40) return '#ff4444';
        if (atrasoMedio > 20) return '#ffaa00';
        return '#44ff44';
    }

    // Função para definir tamanho baseado nas ocorrências
    function getSizeByOcorrencias(ocorrencias) {
        return Math.max(8, Math.min(20, ocorrencias / 2));
    }

    // Adicionar marcadores para cada ponto crítico
    var totalPontos = 0;
    
    pontosCriticos.forEach(function(ponto) {
        var cor = getColorByAtraso(ponto.atrasoMedio);
        var tamanho = getSizeByOcorrencias(ponto.ocorrencias);
        
        // Criar ícone personalizado
        var iconePersonalizado = L.divIcon({
            className: 'custom-marker',
            html: `<div style="
                background-color: ${cor};
                width: ${tamanho}px;
                height: ${tamanho}px;
                border-radius: 50%;
                border: 3px solid white;
                box-shadow: 0 2px 5px rgba(0,0,0,0.3);
            "></div>`,
            iconSize: [tamanho, tamanho],
            iconAnchor: [tamanho/2, tamanho/2]
        });

        // Adicionar marcador ao mapa
        var marker = L.marker([ponto.lat, ponto.lng], {icon: iconePersonalizado})
            .addTo(map)
            .bindPopup(`
                <div class="custom-popup">
                    <div class="popup-title">📍 ${ponto.nome}</div>
                    <div class="popup-stats">
                        <strong>Atraso Médio:</strong> ${ponto.atrasoMedio} minutos<br>
                        <strong>Ocorrências:</strong> ${ponto.ocorrencias} registros<br>
                        <strong>Linhas Afetadas:</strong> ${ponto.linha}<br>
                        <strong>Período Crítico:</strong> ${ponto.periodoCritico}
                    </div>
                </div>
            `);

        totalPontos++;
    });

    // Atualizar estatísticas do mapa
    document.getElementById('total-pontos').textContent = totalPontos;

    // Adicionar controle de camadas
    L.control.layers(null, null, { position: 'topright' }).addTo(map);

    // Adicionar escala
    L.control.scale({ imperial: false, position: 'bottomleft' }).addTo(map);

    // Adicionar marcação da UFOB
    var ufobMarker = L.marker([-12.144722, -44.990278])
        .addTo(map)
        .bindPopup(`
            <div class="custom-popup">
                <div class="popup-title">🎓 UFOB - Campus Barreiras</div>
                <div class="popup-stats">
                    <strong>Principal destino</strong><br>
                    dos estudantes
                </div>
            </div>
        `);

    console.log('Mapa de Barreiras carregado com sucesso!');
</script>




@endsection







