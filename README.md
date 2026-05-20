# Laravel Project Template

This template was designed to make Laravel development feel modern, reproducible, and production-safe while keeping the setup understandable and customizable.

Production-ready Laravel + Docker development environment with:

- Laravel + PHP-FPM
- MySQL
- Vite frontend integration
- Dockerized development & production environments
- Devcontainers for Vscode (for intelliSense)
- GitHub Actions CI/CD deployment
- Hot reload development workflow
- Automated production deployments
- Nginx reverse proxy (setup on host machine)

# Table of Contents

- [Laravel Project Template](#laravel-project-template)
- [Table of Contents](#table-of-contents)
- [Features](#features)
  - [Development Environment](#development-environment)
  - [Production Environment](#production-environment)
  - [CI/CD](#cicd)
- [Stack Overview](#stack-overview)
- [Requirements](#requirements)
  - [Local Development](#local-development)
- [Local Development Setup](#local-development-setup)
  - [1. Clone Repository](#1-clone-repository)
  - [2. Configure Environment](#2-configure-environment)
  - [3. Start Development Environment](#3-start-development-environment)
- [Development Services](#development-services)
- [Devcontainer Usage](#devcontainer-usage)
- [Production Deployment](#production-deployment)
  - [Production Environment Variables](#production-environment-variables)
- [Start Production Stack](#start-production-stack)
- [GitHub Actions Deployment](#github-actions-deployment)
- [Suggested Production Server Setup](#suggested-production-server-setup)
- [Useful Commands](#useful-commands)
  - [Rebuild Containers](#rebuild-containers)
  - [Stop Containers](#stop-containers)
  - [Laravel Artisan](#laravel-artisan)
  - [NPM](#npm)

# Features

## Development Environment

- Full Dockerized local development
- Hot reload with Vite
- Devcontainers support
- Isolated services
- Shared code mounting
- Automatic dependency installation
- Automatic Laravel migrations
- Database readiness waiting
- Local IntelliSense support

## Production Environment

- Optimized production Docker images
- Separate production compose stack
- Production Nginx configuration
- Laravel cache optimization
- Non-dev Composer dependencies
- Automatic restart policies
- GitHub Actions deployment pipeline

## CI/CD

Push to GitHub → automatic deployment to server.

The workflow:

1. Connects to server through SSH
2. Pulls latest repository changes
3. Rebuilds containers
4. Restarts production stack

# Stack Overview

```text
Internet
    ↓
Cloudflare
    ↓
Host Nginx Reverse Proxy
    ↓
Docker Nginx Container
    ↓
Laravel PHP-FPM Container
    ↓
MySQL Container
```

# Requirements

## Local Development

Install:

- Docker
- Docker Compose
- VSCode (recommended)
- Dev Containers extension (recommended)

# Local Development Setup

## 1. Clone Repository

```bash
git clone https://github.com/mjouins/laravel-project-template.git
cd laravel-project-template
```

## 2. Configure Environment

Inside `backend/`:

```bash
cp .env.example .env.dev
```

Generate Laravel app key:

```bash
docker compose -f docker-compose.dev.yml run --rm app php artisan key:generate
```

## 3. Start Development Environment

```bash
docker compose -f docker-compose.dev.yml up --build
```

# Development Services

| Service | URL                                            |
| ------- | ---------------------------------------------- |
| Laravel | [http://localhost:8000](http://localhost:8000) |
| Vite    | [http://localhost:5173](http://localhost:5173) |
| MySQL   | localhost:3306                                 |

# Devcontainer Usage

Open the project in VSCode:

```text
F1 → Dev Containers: Reopen in Container
```

This gives:

- PHP inside container
- Composer installed
- Node installed
- Git configured
- Consistent environment across machines

# Production Deployment

## Production Environment Variables

Create:

```text
backend/.env.prod
```

Example:

```env
APP_NAME=Laravel
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com

APP_KEY=base64:YOUR_KEY

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=your_password
```

# Start Production Stack

```bash
docker compose -f docker-compose.prod.yml up -d --build
```

# GitHub Actions Deployment

The project supports automatic deployment through GitHub Actions.

Required GitHub repository secrets:

| Secret          | Description            |
| --------------- | ---------------------- |
| SERVER_IP       | Server IP or domain    |
| SERVER_USER     | SSH deployment user    |
| SSH_PRIVATE_KEY | Private deployment key |

# Suggested Production Server Setup

Recommended architecture:

```text
Host Machine
├── Nginx Reverse Proxy
├── Cloudflare
└── Docker
    ├── Laravel Stack
    └── MySQL
```

The host machine handles:

- SSL termination
- Reverse proxying
- Multiple services/domains
- Cloudflare integration

Docker handles:

- Application isolation
- Reproducibility
- Dependency management

# Useful Commands

## Rebuild Containers

```bash
docker compose -f docker-compose.dev.yml up --build
```

## Stop Containers

```bash
docker compose -f docker-compose.dev.yml down
```

## Laravel Artisan

```bash
docker compose -f docker-compose.dev.yml exec app php artisan migrate
```

## NPM

```bash
docker compose -f docker-compose.dev.yml exec vite npm install
```
