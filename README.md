## Test Books App

Simple Rest API application for the book library which allow to track what books they have.
(only books, without any other dependencies like clients, etc.)

### Requirements

Test Books App requires the following dependencies :

- [PHP](https://www.php.net/releases/8.3/en.php)
- [Composer](https://getcomposer.org/)

### Installation (Docker)

1. Create a local .env file
`cp .env.example .env`

Provide it with the required settings, i.e.
DB hostname (equals to the DB container name `test-books-db`),
DB user, etc.

2. Create and start containers :
`docker compose up -d`

3. Execute an interactive shell on the app container :
`docker exec -it test-books-app bash`

Run the following commands :

```bash
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed
```

^Z

### Installation (Manual)

1. Install Composer dependencies :
`composer install`

2. Create the database and provide connection details in the .env file.

3. Generate app's key :
`php artisan key:generate`

4. Run database migrations :
`php artisan migrate`

5. Run database seeders :
`php artisan db:seed`

### After installation

Navigate to the app's homepage:

- [if run via Laravel's build-in server](http://127.0.0.1:8000)
- [if run via Docker](http://localhost)

### Available CLI-commands

- `php artisan serve` : run the Laravel's build-in server
- `php artisan test` : run tests
- `php artisan optimize:clear` : clear cache
