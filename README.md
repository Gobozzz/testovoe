# REST API Профиля, Ответы на теорию ниже. 

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

## Теория

### Объясните разницу между @extends и @include в Blade шаблонах

@extends используется для создания иерархии шаблонов, где дочерний шаблон наследует структуру родительского.

@include вставляет один шаблон в другой, как кусок кода.

## Что такое сервис-провайдер?

Сервис-провайдер - это класс, который инструктирует Laravel, как регистрировать и загружать различные сервисы в
контейнер приложения.

## Как работает система маршрутизации в Laravel?

1. Загрузка маршрутов.Laravel загружает маршруты из соответствующих файлов:

routes/web.php — для веб-интерфейса (с сессиями, CSRF-защитой)

routes/api.php — для API (без состояния, с префиксом /api)

2. Сопоставление с шаблоном. Маршрутизатор проходит по всем зарегистрированным маршрутам и ищет совпадение по:

HTTP методу (GET, POST и т.д.)

Шаблону URL

Условиям (where-условия для параметров)

Поддомену (если указан)

3. Извлечение параметров
   Если маршрут содержит параметры в фигурных скобках, например /users/{id}, Laravel извлекает их из URL.

4. Привязка моделей. Если в параметре указана модель (например, User $user), Laravel автоматически делает запрос в базу
   и подставляет модель.

5. Применение middleware. Все middleware, указанные для маршрута, выполняются по цепочке.

6. Вызов обработчика. Наконец, выполняется либо замыкание, либо метод контроллера.

## В чем разница между get() и first() в Eloquent?

first() возвращает одну модель, а get() возвращает коллекцию моделей, даже если запрос вернул только одну запись.

## Как создать миграцию для таблицы users с полями: имя, email, пароль, статус?

Вызываем команду:

`php artisan make:migration create_users_table`

```php
$table->string('name');
$table->string('email')->unique();
$table->string('password');
$table->string('status'); // далее обычно в casts привязываю к Enum
```

## Напишите запрос для получения всех активных пользователей с сортировкой по дате регистрации

```php
// Если просто:
$activeUsers = User::where('status', 'active')
                   ->orderBy('created_at', 'desc')
                   ->get();

// А так можно создать скоуп в модели User:
public function scopeActive($query)
{
    return $query->where('status', 'active');
}

// И уже потом в запросах использовать его.
$activeUsers = User::active()->latest()->get();
```

## Как реализовать отношение "один ко многим" между пользователями и их постами?

Создаем миграцию для постов:
```php
Schema::create('posts', function (Blueprint $table) {
        $table->id();
        
        // Внешний ключ для связи с пользователем
        $table->foreignId('user_id')
              ->constrained()
              ->onDelete('cascade');
              
// ... тут еще нужные поля, индексы и прочее
```

Далее модель User:
````php
class User extends Model
{
    /**
     * Отношение "один ко многим" с постами
     * Один пользователь может иметь много постов
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
````

Модель Post:
```php
class Post extends Model
{
   
    /**
     * Обратная связь к пользователю
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
```



