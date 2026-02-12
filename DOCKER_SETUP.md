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

3. **Set up database configuration values:**

4. **Build and start containers:**

    ```bash
    docker-compose up -d --build
    ```

5. **Install dependencies (if not already done):**

    ```bash
    docker-compose exec app composer install
    ```

6. **Generate app key:**

    ```bash
    docker-compose exec php artisan key:generate

7. **Run migrations:**

    ```bash
    docker-compose exec app php artisan migrate
    ```

8. **Seed the database:**

    ```bash
    docker-compose exec app php artisan db:seed
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

# Run tests
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
