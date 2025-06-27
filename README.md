# Library App

Создать API для библиотеки, позволяющий управлять книгами, бронированием, ролями пользователей (admin, user) и системой авторизации. Проект должен быть полностью контейнеризирован в Docker, с настроенным CI/CD процессом и деплоем на VPS.

## Авторизация

- Admin 
-- phone : 998971234567
-- password : 1234567
- User 
-- phone : 998971234568
-- password : 1234567

## Документация Swagger

- http://localhost:8000/api/documentation

## Как развернуть проект

### 1. Клонируем проект
```bash
git https://github.com/bekmurzaevse/library_app.git
```

### 2. Заходим в папку
```bash
cd library_app
```

### 3. Создаём файл .env
```bash
cp .env.example .env
```

### 4. Даём нужные права
```bash
chmod -R 775 storage bootstrap/cache
```

### 5. Запускаем docker контейнеры
```bash
docker compose up -d
```

### 6. Открываем контейнер php
```bash
docker exec -it project_php bash
```

### 7. Выполняем следующие команды
```bash
composer install
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
php artisan l5-swagger:generate
```

## Дополнительная информация о контейнерах

- **project_nginx**: nginx контейнер (http://localhost:8000)
- **project_php**: php контейнер где работает сам проект
- **project_postgres**: база данных PostgreSQL, порт: 5432
- **project_pgadmin**: Панель управление для базы данных (http://localhost:5050)
- **project_redis**: служит для хранение кешов а также запуски очередей, порт: 6379

## Полезные команды

```bash
# Остановка контейнеров
docker compose down

# Просмотр логов
docker compose logs

# Перезапуск контейнеров
docker compose restart

# Вход в контейнер PHP
docker exec -it project_php bash
```

## Доступ к сервисам

После успешного запуска проекта:
- **Приложение**: http://localhost:8000
- **pgAdmin (управление БД)**: http://localhost:5050

## Работа с проектом

### Запуск тестов

```bash
docker exec -it project_php bash
php artisan test
```

### Работа с миграциями

```bash
php artisan migrate:fresh --seed
```

## Устранение неполадок

1. **Проблемы с правами доступа**: убедитесь, что директории `storage` и `bootstrap/cache` имеют права 775
2. **Ошибки подключения к базе данных**: проверьте настройки в файле `.env`
3. **Проблемы с контейнерами**: выполните `docker compose down` и `docker compose up -d`
