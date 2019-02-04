# Productsup Test Project

## Setup

1. Clone project with `git clone https://github.com/ezra-obiwale/productsup.git`
2. Copy `.env.example` to `.env`
3. Install dependencies with `composer install`
4. Run `php artisan key:generate`
5. Set the security token in the `.env` file
6. Create a `database.sqlite` file
7. Point `DB_DATABASE` in the `.env` file to the path to the `database.sqlite` file
8. Run `php artisan migrate`
9. Start the server with `php artisan serve`

## Dependencies

- barryvdh/laravel-cors: To allow CORS access to resource
- mpociot/laravel-apidoc-generator: To generate api documentation
- ramsey/uuid: To create UUIDs for each model
- spatie/laravel-query-builder: For filtering
