## Dr Assistant

A software to help doctor for taking patient appointment and making prescription easily

## Software Architecture

It's follows API driven database first approach architecture.
Even through it's API driven, but we customize vite engine in a significant way, so it can act and run parallel with
Laravel SSR inside Laravel Blade Template.
The system can also share laravel and vue route together, so we can use SSR where SEO is mandatory.

## Installation

### General Installation

Please check out the environment details to run this system in your server or local pc

- PHP 8.1.7 or later
- Mysql 8.0 or later
- Node 18 or later
- Composer 2.3 or later

```
cd <project_root>
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate
php artisan serve # to run the php application at the port of 8000
# in another terminal
npm install
npm run dev # it will serve the front end at the port of 3000
```

### Docker Installation
will add later
