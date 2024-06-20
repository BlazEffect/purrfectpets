# Интернет-магазин PurrfectPets

Добро пожаловать в PurrfectPets API, backend для интернет-магазина продажи зоотоваров. Этот проект построен на Laravel и предоставляет API.

## Содержание

- [Требования](#требования)
- [Установка](#установка)
- [Конфигурация](#конфигурация)
- [Запуск](#запуск)

## Требования

- PHP >= 8.2
- Composer
- MySQL
- Laravel 10

## Установка

1. Клонировать репозиторий:

    ```bash
    git clone https://github.com/BlazEffect/purrfectpets.git
    ```

2. Перейти в директорию проекта:

    ```bash
    cd purrfectpets
    ```

3. Установить зависимости:

    ```bash
    composer install
    ```

4. Создайте файл `.env` на основе `.env.example`:

    ```bash
    cp .env.example .env
    ```

5. Сгенерировать ключ приложения:

    ```bash
    php artisan key:generate
    ```

## Конфигурация

1. Настройте параметры подключения к базе данных в файле `.env`:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=purrfectpets
    DB_USERNAME=yourusername
    DB_PASSWORD=yourpassword
    ```

2. Настроить параметры почтового сервера в файле `.env`:
    
    ```env
    MAIL_MAILER=smtp
    MAIL_HOST=smtp.gmail.com
    MAIL_PORT=587
    MAIL_USERNAME="youremail"
    MAIL_PASSWORD="yourtoken"
    MAIL_FROM_ADDRESS="youraddress"
    MAIL_FROM_NAME="yourname"
    ```

3. Выполните миграции для создания таблиц:

    ```bash
    php artisan migrate
    ```

## Запуск

1. Запустите локальный сервер разработки:

    ```bash
    php artisan serve
    ```

2. API будет доступен по адресу `http://127.0.0.1:8000`.

3. Документация Swagger будет доступа по адресу `http://127.0.0.1:8000/api/docs`.
