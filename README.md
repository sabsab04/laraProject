# LaraProject

<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
    </a>
</p>

<p align="center">
    <a href="https://github.com/mjouins/laraProject/actions/workflows/deploy.yml">
        <img src="https://github.com/mjouins/laraProject/actions/workflows/deploy.yml/badge.svg" alt="Deploy to Production">
    </a>
    <img src="https://img.shields.io/badge/Laravel-12-red" alt="Laravel">
    <img src="https://img.shields.io/badge/PHP-8.3-blue" alt="PHP">
    <img src="https://img.shields.io/badge/Docker-Development-blue" alt="Docker">
    <img src="https://img.shields.io/badge/Vite-Frontend-purple" alt="Vite">
</p>

# Descrizione del Progetto

LaraProject è un'applicazione web Laravel configurata con un ambiente di sviluppo moderno e completamente containerizzato.

Il progetto include:

- ambiente di sviluppo locale con Docker
- stack Laravel + MySQL + Nginx
- pipeline frontend con Vite
- supporto DevContainer per VSCode
- CI/CD con GitHub Actions
- deploy automatico in produzione tramite SSH

L'obiettivo della configurazione è fornire:

- un ambiente di sviluppo identico per tutti i membri del gruppo
- sviluppo locale isolato dal server online
- deploy automatico dopo merge su `main`
- una struttura Laravel pulita e facilmente estendibile

# Workflow di Sviluppo

Ogni membro del gruppo deve:

1. Creare un branch personale partendo da `main`
2. Lavorare in locale tramite Docker
3. Fare push del proprio branch
4. Aprire una Pull Request
5. Fare merge su `main`

Dopo il merge, il server viene aggiornato automaticamente tramite GitHub Actions.

⚠️ Non lavorare direttamente sul branch `main`.

# Requisiti

Per lavorare al progetto servono:

- Docker Desktop
- Docker Compose
- Visual Studio Code (consigliato)

Estensioni VSCode consigliate:

- Dev Containers

Il progetto include già una configurazione DevContainer completa con:

- estensioni Laravel
- supporto Tailwind
- IntelliSense PHP
- ESLint
- Prettier
- formatter automatici

# Apertura del Progetto nel DevContainer

Dopo aver clonato la repository:

```bash
git clone https://github.com/mjouins/laraProject.git
```

aprire la cartella con VSCode e selezionare:

```text
Reopen in Container
```

VSCode creerà automaticamente l’ambiente di sviluppo completo.

# Avvio dell'Ambiente di Sviluppo

Avviare i container con:

```bash
docker compose -f docker-compose.dev.yml up --build
```

Applicazione Laravel:

```text
http://localhost:8000
```

Vite Dev Server:

```text
http://localhost:5173
```

Spegnere i container:

```bash
docker compose -f docker-compose.dev.yml down
```

# Servizi Docker

| Servizio | Descrizione                       |
| -------- | --------------------------------- |
| app      | Container PHP-FPM Laravel         |
| vite     | Server Vite per sviluppo frontend |
| nginx    | Reverse proxy Nginx               |
| db       | Database MySQL                    |

# File Environment

Environment di sviluppo:

```text
.env.dev
```

Environment di produzione:

```text
.env.prod
```

I file `.env` sono ignorati da Git per motivi di sicurezza.

# Database

Durante lo sviluppo il database MySQL gira all’interno dei container Docker.

La configurazione viene caricata automaticamente da:

```text
.env.dev
```

I dati vengono mantenuti tramite Docker Volumes.

# Deploy in Produzione

Il deploy in produzione è completamente automatizzato tramite GitHub Actions.

Quando viene eseguito un merge su:

```text
main
```

GitHub Actions:

1. Si connette via SSH al relay server
2. Dal relay server si connette al server universitario
3. Esegue automaticamente lo script di deploy

L’ambiente di produzione gira senza Docker.

# Script di Deploy

Il deploy viene eseguito tramite:

```bash
./deploy.sh
```

Lo script:

- aggiorna il repository
- installa le dipendenze Composer
- installa le dipendenze Node
- compila gli asset Vite
- crea le cartelle cache di Laravel
- sistema i permessi
- pulisce la cache Laravel
- esegue le migration

# URL Produzione

```text
https://tweban.dii.univpm.it/~grp_04/laraProject/public
```

# Comandi Utili

## Laravel

```bash
php artisan migrate

php artisan optimize:clear

php artisan route:list
```

## Docker

```bash
docker compose -f docker-compose.dev.yml up --build

docker compose -f docker-compose.dev.yml down
```

## Frontend

```bash
npm run dev

npm run build
```

# Tecnologie Utilizzate

- Laravel 12
- PHP 8.3
- Docker
- Docker Compose
- MySQL 8
- Nginx
- Vite
- GitHub Actions
- VSCode DevContainers

# Licenza

Questo progetto è distribuito sotto licenza MIT.
