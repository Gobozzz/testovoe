# REST API Профиля

Тестовое задание, разработка REST API для профиля пользователя с авторизацией и регистрацией.

Стек: Laravel 12, MySQL 8, Sanctum.

## Как развернуть проект у себя

### Для первого разворота

- `git clone https://github.com/Gobozzz/testovoe.git testovoe` 
- `cd testovoe`
- `docker compose up -d --build`
- `docker compose exec php bash`
- `composer setup`
- `php artisan storage:link`

### Для последующих разворотов

`docker compose up -d`

### env.example -> .env

`cp .env.example .env`

### Laravel App
- URL: http://localhost
