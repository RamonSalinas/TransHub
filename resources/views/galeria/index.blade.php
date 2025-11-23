@extends('layouts.app')

@section('title', 'Galeria & Contato - TransHUB')

@section('content')
<div class="row">
    <div class="col-12">
        <h1><i class="bi bi-images"></i> Galeria do Projeto </h1>
        <p class="lead">Fotos, vídeos e informações de contato do projeto TransHUB</p>
    </div>
</div>

<!-- Seção de Fotos -->
<div class="row mb-5">
    <div class="col-12">
        <h3 class="mb-3"><i class="bi bi-camera"></i> Fotos do Projeto</h3>
    </div>
    
    @foreach($fotos as $foto)
    <div class="col-md-4 mb-4">
        <div class="card">
            <img src="{{ $foto['url'] }}" 
                 class="card-img-top" 
                 alt="{{ $foto['titulo'] }}"
                 style="height: 200px; object-fit: cover;"
                 onerror="this.src='https://via.placeholder.com/300x200/007bff/ffffff?text=Imagem+Indispon%C3%ADvel'">
            <div class="card-body">
                <h5 class="card-title">{{ $foto['titulo'] }}</h5>
                <p class="card-text">{{ $foto['descricao'] }}</p>
            </div>
        </div>
    </div>
    @endforeach
    


<!-- Seção de Vídeos -->
<div class="row mb-5">
    <div class="col-12">
        <h3 class="mb-3"><i class="bi bi-play-btn"></i> Vídeos Demonstrativos</h3>
    </div>
    
    @foreach($videos as $video)
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $video['titulo'] }}</h5>
                <p class="card-text">{{ $video['descricao'] }}</p>
                
                <div class="ratio ratio-16x9">
                    <iframe src="{{ $video['url'] }}" 
                            title="{{ $video['titulo'] }}" 
                            allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<!-- Seção de Contato -->
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4><i class="bi bi-envelope"></i> Contato do Projeto</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Informações de Contato</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="bi bi-envelope"></i> 
                                <strong>Email:</strong> {{ $contato['email'] }}
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-telephone"></i> 
                                <strong>Telefone:</strong> {{ $contato['telefone'] }}
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-person"></i> 
                                <strong>Responsável:</strong> {{ $contato['responsavel'] }}
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-github"></i> 
                                <strong>GitHub:</strong> 
                                <a href="{{ $contato['github'] }}" target="_blank">
                                    Acessar Repositório
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h5>Formulário de Contato</h5>
                        <form>
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="nome" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="mensagem" class="form-label">Mensagem</label>
                                <textarea class="form-control" id="mensagem" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-send"></i> Enviar Mensagem
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h4><i class="bi bi-info-circle"></i> Sobre o Projeto</h4>
            </div>
            <div class="card-body">
                <p>O <strong>TransHUB</strong> é um projeto educacional que transforma dados reais do transporte público em oportunidades de aprendizagem.</p>
                
                <h6>Principais Objetivos:</h6>
                <ul>
                    <li>Monitorar atrasos do transporte</li>
                    <li>Engajar estudantes em projetos reais</li>
                    <li>Promover cidadania digital</li>
                    <li>Gerar dados para melhorias urbanas</li>
                </ul>
                
                <div class="alert alert-warning">
                    <i class="bi bi-lightbulb"></i>
                    <strong>Dica:</strong> Use este projeto em suas aulas!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection