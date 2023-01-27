## Installation

composer install
php artisan migrate
php artisan passport:install

## How to run?

php artisan serve

## API routes

- [GET] /api/me
- [POST] /oauth/token
- [GET] /api/users
- [POST] /api/users
- [GET] /api/users/{id}
- [PATCH] /api/users/{id}
- [DELETE] /api/users/{id}
- [GET] /api/users/{id}/payments
- [POST] /api/users/{id}/payments