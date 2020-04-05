<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Действия после клонирования репозитория

- в openserver в доменах включить *"Ручное + Автопоиск"*, и прописать имя домена, ссылающиеся на папку *public*
![Image of OpenServer](https://sun9-49.userapi.com/4jqBIgXiNmWDzVZ5_2eGF-bsHKPtzFnUPDtncw/6p-lKdD1DXk.jpg)
- включить **redis** и **mongodb**
- ```composer install```
- скопироват **.env.example** в **.env**
- ```php artisan key:generate```
- создать пустую базу в mongo
- сконфигурировать **.env** файл (в том числе *mongodb* и *redis*)
- ```php artisan migrate --seed```
- ```npm install```
- ```npm run dev```

