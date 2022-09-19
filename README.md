# Booker app

## Описание
Это тестовое задание для компании SmartData

## Требования к установке
- PHP 8.1.0
- MySQL 5.7.36
- Composer
- Node.js
- Laravel 9.0.1
## Установка и запуск
- Склонировать проект<br>

        git clone
- Создать базу данных
- Ввести в файл .env параметры БД
- Установить зависимости php<br>
    
        composer install

- Установить зависимости node.js<br>
    
        npm install

- Создать таблицы в БД
        
        php artisan migrate

- Заполнить таблицы тестовыми данными

        php artisan seed:all

- Запустить сборку css, js

        npm run build
        npm run dev

- Запустить laravel
        
        php artisan serve
