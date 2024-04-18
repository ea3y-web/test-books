## Test Books App

Simple Rest API application for the book library which allow to track what books they have.
(only books, without any other dependencies like clients, etc.)

### Requirements

Test Books App requires the following dependencies :

- [PHP](https://www.php.net/releases/8.3/en.php)
- [Composer](https://getcomposer.org/)

### Installation (Docker)

1. Provide required settings in the .env file.

I.e. App's URL, DB hostname (equals to the DB container name), etc.

2. Create and start containers :
`docker compose up -d`

3. Execute an interactive shell on the app container :
`docker exec -it test-books-app bash`

And run the following commands :

```bash
composer install
php artisan migrate
php artisan db:seed
```

^Z

### Installation (Manual)

1. Install Composer dependencies :
`composer install`

2. Create the database and provide connection details in the .env file.

3. Run database migrations :
`php artisan migrate`

4. Run database seeders :
`php artisan db:seed`

### After installation

Navigate to the books index URL:

- [if app is run via Laravel's build-in server](http://127.0.0.1:8000)
- [if app is run via Docker](http://localhost)

### Available CLI-commands

- `php artisan serve` : run the Laravel's build-in server
- `php artisan test` : run tests
- `php artisan optimize:clear` : clear cache
