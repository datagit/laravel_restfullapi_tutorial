```bash
# Laravel API Tutorial: How to Build and Test a RESTful API
# https://www.toptal.com/laravel/restful-laravel-api-tutorial

# https://viblo.asia/p/laravel-beauty-recipes-best-practices-6BAMYk9Evnjz
composer require barryvdh/laravel-debugbar --dev
composer require rap2hpoutre/laravel-log-viewer

# updated docker-compose ->
docker-compose down && docker-compose up -d
# check connection to DB
php artisan tinker
DB::connection()->getPdo()

# make model and migration
php artisan make:model Article -m
# -> add fields in database/migrations/2021_06_05_095917_create_articles_table.php
php artisan migrate

# make seeder for Article
php artisan make:seeder ArticlesTableSeeder
# -> update database/seeds/ArticlesTableSeeder.php
php artisan db:seed --class=ArticlesTableSeeder

php artisan make:seeder UsersTableSeeder
# -> update database/seeds/UsersTableSeeder.php

# -> database/seeds/DatabaseSeeder.php
php artisan db:seed

php artisan make:controller ArticleController

php artisan make:migration --table=users adds_api_token_to_users_table
# -> database/migrations/2021_06_06_072717_adds_api_token_to_users_table.php
php artisan migrate

# -> app/Http/Controllers/Auth/RegisterController.php
# register
curl -X POST http://localhost:8000/api/register \
 -H "Accept: application/json" \
 -H "Content-Type: application/json" \
 -d '{"name": "John5", "email": "john.doe5@toptal.com", "password": "toptal123", "password_confirmation": "toptal123"}'

# -> app/Http/Controllers/Auth/LoginController.php
# login
curl -X POST localhost:8000/api/login \
  -H "Accept: application/json" \
  -H "Content-type: application/json" \
  -d "{\"email\": \"admin@test.com\", \"password\": \"toptal\" }"

# -> routes/api.php
# https://laravel.com/docs/5.8/api-authentication
http://127.0.0.1:8000/api/user?api_token=PN1MeRkUB7Xx064lT2O7poprUuP3ut0jFXHjD5SWOtOX2btY217jPHOT3Ajo
http://127.0.0.1:8000/api/articles?api_token=PN1MeRkUB7Xx064lT2O7poprUuP3ut0jFXHjD5SWOtOX2btY217jPHOT3Ajo

# Swagger
# doc ngu ->: https://viblo.asia/p/l5-swagger-in-laravel-rest-apis-m68Z0x1AZkG
# -> https://blog.quickadminpanel.com/laravel-api-documentation-with-openapiswagger/
# -> https://www.youtube.com/watch?v=TWwqV7thb58
# https://github.com/DarkaOnLine/L5-Swagger/blob/master/tests/storage/annotations/OpenApi/Anotations.php


# doc to fixed API Token Authentication -> https://github.com/DarkaOnLine/L5-Swagger/issues/318
composer require darkaonline/l5-swagger
php artisan vendor:publish --provider "L5Swagger\L5SwaggerServiceProvider"

# -> generate doc
php artisan l5-swagger:generate


# config -> Xdebug 3, Docker, Laravel, VScode
# https://dev.to/getjv/xdebug-3-docker-laravel-vscode-52bi
# -> http://localhost/

docker exec -it backend php artisan
```
