# LaraProject

<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
    </a>
</p>

<p align="center">
    <img src="https://img.shields.io/badge/Laravel-12-red" alt="Laravel">
    <img src="https://img.shields.io/badge/PHP-8.3-blue" alt="PHP">
    <img src="https://img.shields.io/badge/Docker-Development-blue" alt="Docker">
    <img src="https://img.shields.io/badge/Vite-Frontend-purple" alt="Vite">
</p>

---

## About The Project

LaraProject is a Laravel application configured with:

- Docker-based local development
- Vite frontend asset pipeline
- MySQL database
- Nginx reverse proxy
- GitHub Actions deployment workflow
- Automatic production deployment through SSH

The project is designed to provide:

- a clean local development environment
- a reproducible deployment setup
- separation between development infrastructure and production hosting

---

# Project Structure

```text
laraProject/
├── app/
├── bootstrap/
├── config/
├── database/
├── public/
├── resources/
├── routes/
├── storage/
├── tests/
│
├── artisan
├── composer.json
├── package.json
├── vite.config.js
│
├── docker-compose.dev.yml
├── Dockerfile.dev
├── entrypoint.sh
│
├── nginx/
│   ├── Dockerfile
│   ├── default.conf.template
│   └── entrypoint.sh
│
├── deploy.sh
└── README.md
```

---

# Local Development

## Requirements

- Docker
- Docker Compose

---

## Start Development Environment

```bash
docker compose -f docker-compose.dev.yml up --build
```

Application:

```text
http://localhost:8000
```

Vite Dev Server:

```text
http://localhost:5173
```

---

# Development Services

| Service | Description               |
| ------- | ------------------------- |
| app     | PHP-FPM Laravel container |
| vite    | Vite development server   |
| nginx   | Nginx reverse proxy       |
| db      | MySQL database            |

---

# Environment Files

Development environment:

```text
.env.dev
```

Production environment:

```text
.env.prod
```

---

# Database

The MySQL database runs inside Docker during development.

Connection values are loaded automatically from:

```text
.env.dev
```

Database data is persisted through Docker volumes.

---

# Production Deployment

Production deployment is handled through GitHub Actions over SSH.

The production server runs:

- PHP
- Composer
- Node.js
- npm

without Docker.

---

## Manual Deployment

```bash
./deploy.sh
```

Deployment script automatically:

- pulls latest changes
- installs Composer dependencies
- installs Node dependencies
- builds Vite assets
- clears Laravel caches
- runs migrations

---

# GitHub Actions Deployment

Production deployment is triggered automatically on push to:

```text
main
```

Required GitHub Secrets:

| Secret          | Description                |
| --------------- | -------------------------- |
| SERVER_IP       | Production server IP       |
| SERVER_USER     | SSH username               |
| SSH_PRIVATE_KEY | Private SSH deployment key |

---

# Production URL

Example university hosting structure:

```text
https://tweban.dii.univpm.it/~grp_04/laraProject/public
```

---

# Useful Commands

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

---

# Technologies

- Laravel
- PHP 8.3
- Docker
- MySQL 8
- Nginx
- Vite
- GitHub Actions

---

# License

This project is open-source and available under the MIT license.
