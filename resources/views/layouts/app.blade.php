

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TransUFOB - @yield('title', 'Sistema de Monitoramento')</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        .navbar-brand {
            font-weight: bold;
        }
        .nav-link {
            font-weight: 500;
        }
        .nav-link.active {
            background-color: #0d6efd;
            color: white !important;
            border-radius: 5px;
        }
        .card {
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        #map { 
            height: 500px; 
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Menu de Navegação -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                🚍 TransUFOB
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" 
                           href="{{ route('dashboard') }}">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('relatorios*') ? 'active' : '' }}" 
                           href="{{ route('relatorios') }}">
                            <i class="bi bi-file-earmark-pdf"></i> Relatórios
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('galeria') ? 'active' : '' }}" 
                           href="{{ route('galeria') }}">
                            <i class="bi bi-images"></i> Galeria & Contato
                        </a>
                    </li>
                </ul>
                
                <span class="navbar-text">
                    <i class="bi bi-geo-alt"></i> Barreiras/BA
                </span>
            </div>
        </div>
    </nav>

    <!-- Conteúdo Principal -->
    <div class="container-fluid mt-4">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-light mt-5 py-4">
        <div class="container text-center">
            <p class="mb-0">
                &copy; 2025 TransUFOB - Projeto Educacional Transformador
                <br>
                <small>Desenvolvido com Laravel Sail & Bootstrap</small>
            </p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    @yield('scripts')
</body>
</html>
