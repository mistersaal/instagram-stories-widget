<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Действия после клонирования репозитория

- в openserver в доменах включить "Ручное + Автопоиск", и прописать имя домена, ссылающиеся на папку public
![Image of OpenServer](https://sun9-49.userapi.com/4jqBIgXiNmWDzVZ5_2eGF-bsHKPtzFnUPDtncw/6p-lKdD1DXk.jpg)
- ```composer install```
- скопироват .env.example в .env
- ```php artisan key:generate```
- создать пустую базу
- сконфигурировать .env файл
- ```php artisan migrate --seed```
- ```npm install```
- ```npm run dev```

## Пример данных об историях

```$xslt
http://instagram-stories-widget/highlights/31486096301

    [
        {
            "id": 17851607701915192,
            "title": "test2",
            "preview": "https://scontent-arn2-1.cdninstagram.com/v/t51.12442-15/e35/c0.587.1080.1080a/s150x150/91399399_214543699856167_3119381776959804400_n.jpg?_nc_ht=scontent-arn2-1.cdninstagram.com&_nc_cat=107&_nc_ohc=p_E4RNiQ6_UAX9aDtnS&oh=68b546ea3fff3e2830808b5400debe16&oe=5E838599",
            "link": "https://www.instagram.com/stories/highlights/17851607701915192",
            "stories": [
                {
                    "url": "https://scontent-arn2-2.cdninstagram.com/v/t50.12441-16/91424896_603112747079756_5636534366765539518_n.mp4?_nc_ht=scontent-arn2-2.cdninstagram.com&_nc_cat=108&_nc_ohc=26FXsU8OiU4AX9u64Df&oe=5E832098&oh=251e0eb8ebf816fbaed8751957c8a83c",
                    "isVideo": true
                },
                {
                    "url": "https://scontent-arn2-1.cdninstagram.com/v/t51.12442-15/e35/91350682_2551742055075390_4338711755414610074_n.jpg?_nc_ht=scontent-arn2-1.cdninstagram.com&_nc_cat=106&_nc_ohc=E8qcHVr0oSQAX9GfDP9&oh=43c569ace8bcd25cc729f108c0907558&oe=5E8341ED",
                    "isVideo": false
                },
                {
                    "url": "https://scontent-arn2-1.cdninstagram.com/v/t51.12442-15/e35/91399399_214543699856167_3119381776959804400_n.jpg?_nc_ht=scontent-arn2-1.cdninstagram.com&_nc_cat=107&_nc_ohc=p_E4RNiQ6_UAX9aDtnS&oh=c95b8f684bfaf2e98d898555ebab9226&oe=5E832E4B",
                    "isVideo": false
                }
            ]
        },
        {
            "id": 17874396223567824,
            "title": "test",
            "preview": "https://scontent-arn2-1.cdninstagram.com/v/t51.12442-15/e35/c0.587.1080.1080a/s150x150/82894124_195035088394953_7013364763523042045_n.jpg?_nc_ht=scontent-arn2-1.cdninstagram.com&_nc_cat=109&_nc_ohc=06xngFG0t6AAX9WQ2Ai&oh=a6072eaf975437c6e84fa10774909936&oe=5E8373BD",
            "link": "https://www.instagram.com/stories/highlights/17874396223567823",
            "stories": [
                {
                    "url": "https://scontent-arn2-1.cdninstagram.com/v/t51.12442-15/e35/82894124_195035088394953_7013364763523042045_n.jpg?_nc_ht=scontent-arn2-1.cdninstagram.com&_nc_cat=109&_nc_ohc=06xngFG0t6AAX9WQ2Ai&oh=08db752180889e7586269acbefd38cf5&oe=5E834F6F",
                    "isVideo": false
                }
            ]
        }
    ]
```

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[British Software Development](https://www.britishsoftware.co)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- [UserInsights](https://userinsights.com)
- [Fragrantica](https://www.fragrantica.com)
- [SOFTonSOFA](https://softonsofa.com/)
- [User10](https://user10.com)
- [Soumettre.fr](https://soumettre.fr/)
- [CodeBrisk](https://codebrisk.com)
- [1Forge](https://1forge.com)
- [TECPRESSO](https://tecpresso.co.jp/)
- [Runtime Converter](http://runtimeconverter.com/)
- [WebL'Agence](https://weblagence.com/)
- [Invoice Ninja](https://www.invoiceninja.com)
- [iMi digital](https://www.imi-digital.de/)
- [Earthlink](https://www.earthlink.ro/)
- [Steadfast Collective](https://steadfastcollective.com/)
- [We Are The Robots Inc.](https://watr.mx/)
- [Understand.io](https://www.understand.io/)
- [Abdel Elrafa](https://abdelelrafa.com)
- [Hyper Host](https://hyper.host)
- [Appoly](https://www.appoly.co.uk)
- [OP.GG](https://op.gg)

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
