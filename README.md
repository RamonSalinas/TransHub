# 📊 Sistema de Monitoramento de Atrasos

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

<p align="center">
<img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white">
<img src="https://img.shields.io/badge/Docker-2496ED?style=for-the-badge&logo=docker&logoColor=white">
<img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white">
</p>

---

## 🚀 Sobre o Projeto
Sistema desenvolvido em **Laravel + Sail (Docker)** para monitoramento e gestão de atrasos em processos organizacionais.  
Conta com **dashboard em tempo real**, **acompanhamento de ocorrências**, **notificações** e **relatórios estatísticos**.

<p align="center">
<img src="https://via.placeholder.com/800x400/4F46E5/FFFFFF?text=Dashboard+Monitoramento+Atrasos">
</p>

---

## ✨ Funcionalidades Principais
- 📋 Cadastro e gestão de atrasos  
- ⏰ Monitoramento em tempo real  
- 📈 Relatórios e estatísticas  
- 🔔 Sistema de notificações  
- 👥 Gestão de usuários  
- 🔐 Autenticação integrada  

---

## 🛠️ Tecnologias Utilizadas

| Tecnologia | Versão | Finalidade |
|-----------|--------|------------|
| **Laravel** | 10.x | Framework principal |
| **Sail** | 1.x | Ambiente Docker |
| **MySQL** | 8.0 | Banco de dados |
| **Redis** | 7.x | Cache e filas |
| **Bootstrap** | 5.x | Interface |
| **Chart.js** | 4.x | Visualização de gráficos |

---

## 🏗️ Estrutura do Projeto

```text
sistema-monitoramento-atrasos/
├── app/
│   ├── Models/
│   ├── Http/
│   └── Services/
├── config/
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   ├── views/
│   └── assets/
└── tests/
🚀 Instalação e Configuração
Pré-requisitos
Docker & Docker Compose

Git

4GB RAM mínimo

📥 Passo a Passo

# 1. Clone o repositório
git clone https://github.com/seu-usuario/sistema-monitoramento-atrasos.git
cd sistema-monitoramento-atrasos

# 2. Configure o ambiente
cp .env.example .env

# 3. Instale as dependências PHP
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs

# 4. Inicie os containers
./vendor/bin/sail up -d

# 5. Configure a aplicação
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate --seed
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev


🌐 Acesso
URL: http://localhost

Usuário: admin@sisatrasos.com

Senha: password123

🐳 Comandos Sail
Comando	Descrição
sail up -d	Inicia containers
sail down	Para containers
sail artisan [cmd]	Executa Artisan
sail npm [cmd]	Executa NPM
sail shell	Acessa container
sail logs	Visualiza logs
🗃️ Banco de Dados
Tabelas Principais
atrasos - Registro de ocorrências

usuarios - Gestão de acesso

projetos - Cadastro de projetos

notificacoes - Sistema de alertas

Migrations
bash
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan migrate:rollback
./vendor/bin/sail artisan migrate:fresh --seed
🧪 Testes
bash
# Executar testes
./vendor/bin/sail test

# Testes com cobertura
./vendor/bin/sail test --coverage

# Testes específicos
./vendor/bin/sail test --testsuite=Unit
./vendor/bin/sail test --testsuite=Feature
🔧 Configuração
Variáveis de Ambiente Críticas
env
APP_NAME="Sistema Monitoramento Atrasos"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=monitoramento
DB_USERNAME=sail
DB_PASSWORD=password

REDIS_HOST=redis
📈 Roadmap
✅ Concluído
Estrutura Laravel + Sail

Sistema de autenticação

CRUD de atrasos

Dashboard básico

🚧 Em Desenvolvimento
Relatórios avançados

Notificações em tempo real

API REST

Exportação de dados

📅 Planejado
App mobile

Integração com e-mail

Análises preditivas

Painel administrativo

🤝 Contribuição
Obrigado por considerar contribuir para o Sistema de Monitoramento de Atrasos!

Guia de Contribuição
Fork o projeto

Crie uma branch: git checkout -b feature/nova-funcionalidade

Commit: git commit -m 'Add nova funcionalidade'

Push: git push origin feature/nova-funcionalidade

Abra um Pull Request

Código de Conduta
Para garantir uma comunidade acolhedora, revise e cumpra o Código de Conduta do Laravel.

Empresas Especializadas
Curotec

DevSquad

Redberry

Active Logic

🔒 Segurança
Se você descobrir uma vulnerabilidade de segurança, envie um e-mail para Taylor Otwell via taylor@laravel.com.

📄 Licença
Este projeto está sob a licença MIT. Veja LICENSE para detalhes.

👨‍💻 Desenvolvedor
Seu Nome

GitHub: @seu-usuario

Email: seu.email@exemplo.com

📞 Suporte
📧 Email: suporte@sisatrasos.com

🐛 Issues: GitHub Issues

📚 Documentação: Wiki

<div align="center">
⭐️ Deixe uma estrela se este projeto te ajudou!
Próxima atualização: Sistema de notificações em tempo real 🚀

</div>
📋 Comandos de Desenvolvimento
Desenvolvimento
bash
# Ambiente
./vendor/bin/sail up -d
./vendor/bin/sail npm run dev

# Banco
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan db:seed

# Cache
./vendor/bin/sail artisan cache:clear
./vendor/bin/sail artisan config:clear
./vendor/bin/sail artisan route:clear
./vendor/bin/sail artisan view:clear

# Otimização
./vendor/bin/sail artisan optimize
Produção
bash
./vendor/bin/sail npm run build
./vendor/bin/sail artisan config:cache
./vendor/bin/sail artisan route:cache
./vendor/bin/sail artisan view:cache
Backup
bash
./vendor/bin/sail artisan db:backup
./vendor/bin/sail artisan db:restore
<p align="center"> <sub>Desenvolvido com ❤️ usando Laravel + Sail</sub> </p>