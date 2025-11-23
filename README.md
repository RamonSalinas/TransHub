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
```

# 🚀 # Instalação e Configuração
 
Este documento descreve **todos os passos necessários** para instalar, configurar e executar o projeto **TransHub** utilizando **Laravel Sail + Docker**, incluindo **erros comuns**, **soluções**, e **ajustes obrigatórios no docker-compose.yml** caso os containers não subam.

---

# 🧭 1. Requisitos
- Docker instalado
- Docker Compose instalado
- Git instalado
- Servidor Linux (Ubuntu recomendado)

---

# 🚀 2. Clonar o Repositório
```bash
git clone https://github.com/RamonSalinas/TransHub.git
cd TransHub
```

---

# 📝 3. Criar arquivo `.env`
```bash
cp .env.example .env
```

O arquivo funcional final está descrito no final deste documento.

---

# 📦 4. Instalar dependências via container Composer (Laravel Sail)
```bash
docker run --rm \
  -u "$(id -u):$(id -g)" \
  -v "$(pwd):/var/www/html" \
  -w /var/www/html \
  laravelsail/php82-composer:latest \
  composer install --ignore-platform-reqs
```

---

# 🔐 5. Ajustar Permissões (OBRIGATÓRIO)
Se você não fizer isso, o Laravel quebrará com erros como:
`file_put_contents(): Permission denied`
```bash
sudo chown -R $USER:$USER .
sudo chmod -R 775 .
sudo chmod -R 777 storage bootstrap/cache
```

---

# 🧱 6. Subir Containers com Sail
```bash
./vendor/bin/sail up -d
```

---

# ⚠️ Possíveis Erros e Soluções Imediatas

## ❗ Erro 1 — Porta 80 já está em uso
```
Error starting userland proxy: listen tcp4 0.0.0.0:80: bind: address already in use
```
### ✔ Solução: alterar porta do container APP no `composer.yml`:
```yaml
services:
  laravel.test:
    ports:
      - "8085:80"
```

---

## ❗ Erro 2 — MySQL não sobe porque porta 3306 já está em uso
Trocar apenas a porta EXTERNA:
```yaml
services:
  mysql:
    ports:
      - "3307:3306"
```
No `.env`, mantenha:
```
DB_HOST=mysql
DB_PORT=3306
```

---

## ❗ Erro 3 — APP_KEY ausente
```
No application encryption key has been specified
```
### ✔ Gerar nova key:
```bash
./vendor/bin/sail artisan key:generate
```
Se erro de permissão → repetir permissões do passo 5.

---

## ❗ Erro 4 — Tabela `sessions` não existe
```
SQLSTATE[42S02]: Table 'laravel.sessions' doesn't exist
```
### ✔ Rodar migrações
```bash
./vendor/bin/sail artisan migrate
```

---
```
#6.1 Criar o Banco de Dados (Migrações e Seeds)
---
./vendor/bin/sail artisan migrate --seed


Se quiser resetar completamente:

./vendor/bin/sail artisan migrate:fresh --seed


```




## ❗ Erro 5 — Cache do Laravel desatualizado
```
APP_URL não muda
Config antiga permanece
```
### ✔ Limpar caches
```bash
./vendor/bin/sail artisan config:clear
./vendor/bin/sail artisan cache:clear
./vendor/bin/sail artisan config:cache
```

---

# ⭐ 7. Reiniciar Containers
```bash
./vendor/bin/sail down
./vendor/bin/sail up -d
```

---

# 🔑 8. Versão Final do `.env` Funcional
```
APP_NAME=TransHub
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8085

APP_KEY=
APP_LOCALE=pt_BR
APP_FALLBACK_LOCALE=pt_BR
APP_FAKER_LOCALE=pt_BR

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password

SESSION_DRIVER=database
SESSION_LIFETIME=120

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database

REDIS_CLIENT=phpredis
REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=log
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

VITE_APP_NAME="${APP_NAME}"
```
Após editar:
```bash
./vendor/bin/sail artisan key:generate
```

---

# 🧭 9. Acessar o Sistema
Localmente:
```
http://localhost:8085
```
Servidor:
```
http://SEU-IP:8085
```

---


# 🧰 10. Ajustes Avançados no `compose.yml`



## 🔧 Se o APP não subir: editar bloco `laravel.test`:
```yaml
laravel.test:
  build:
    context: ./vendor/laravel/sail/runtimes/8.4
    dockerfile: Dockerfile
  image: sail-8.4/app
  ports:
    - "8085:80"            # <<< ALTERE AQUI SE A PORTA ESTIVER OCUPADA
    - "5173:5173"
  volumes:
    - .:/var/www/html
  extra_hosts:
    - "host.docker.internal:host-gateway"
```

## 🔧 Se o MySQL não subir:
```yaml
mysql:
  image: mysql/mysql-server:8.0
  ports:
    - "3307:3306"           # <<< ALTERAR APENAS A PORTA EXTERNA
  environment:
    MYSQL_ROOT_PASSWORD: password
    MYSQL_DATABASE: laravel
    MYSQL_USER: sail
    MYSQL_PASSWORD: password
```

---

# 🎉 Instalação Finalizada
Seu ambiente Laravel + Sail agora está **100% funcional**, com todas as falhas previstas, solucionadas e documentadas.

