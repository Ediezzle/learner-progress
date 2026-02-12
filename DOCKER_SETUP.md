# Docker Setup for Laravel App

This directory contains Docker configuration files to run the Laravel application in containers.

## Files

- **Dockerfile** - Defines the PHP-FPM image with all required extensions
- **docker-compose.yml** - Orchestrates the app, nginx, and node services
- **docker/nginx/conf.d/app.conf** - Nginx configuration
- **.dockerignore** - Specifies files to exclude from Docker build context

## Prerequisites

- [Docker](https://www.docker.com/products/docker-desktop) installed on your machine
- [Docker Compose](https://docs.docker.com/compose/install/) installed

## Quick Start

1. **Clone/navigate to project directory:**

   ```bash
   cd /Users/edmoremandikiyana/Dev/learner-progress
   ```

2. **Copy environment file:**

   ```bash
   cp .env.example .env
   ```

3. **Build and start containers:**

   ```bash
   docker-compose up -d --build
   ```

4. **Install dependencies (if not already done):**

   ```bash
   docker-compose exec app composer install
   ```

5. **Generate app key:**

   ```bash
   docker-compose exec app php artisan key:generate
   ```

6. **Run migrations:**

   ```bash
   docker-compose exec app php artisan migrate --seed
   ```

7. **Install Node dependencies:**

   ```bash
   docker-compose exec node npm install
   ```

8. **Run Vite Dev server:**

   ```bash
   docker-compose exec node npm run dev
   ```

9. **Access the application:**
   - Application: http://localhost

## Useful Commands

```bash
# View logs
docker-compose logs -f app

# Run artisan commands
docker-compose exec app php artisan <command>

# Run npm commands
docker-compose exec node npm <command>

# Run Vite build
docker-compose exec node npm run dev

# Run tests. N.B see test cases section below first
docker-compose exec app php artisan test

# Access app container shell
docker-compose exec app bash

# Stop containers
docker-compose down

# Stop and remove volumes
docker-compose down -v
```

## Environment Variables

Update your `.env` file with:

```
DB_CONNECTION=sqlite
DB_DATABASE=database/school_system.sqlite
```

## Services

- **app** - PHP 8.2 FPM application server with SQLite support
- **nginx** - Web server (listening on port 80)
- **node** - Node.js development server for Vite and npm

## Test Cases

1. **Copy .env.pipeline file to .env.testing:**

   ```bash
   cp .env.pipeline .env.testing
   ```

2. **Generate app key for tests:**

   ```bash
   docker-compose exec app php artisan key:generate --env=testing
   ```

3. **Generate app key for tests:**

   ```bash
   docker-compose exec app php artisan test --env=testing
   ```
