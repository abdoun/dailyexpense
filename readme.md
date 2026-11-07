# Dailyexpense

Dailyexpense is a Laravel application. It requires PHP 8.3 or newer and is
configured for PHP 8.4 with Laravel 13.

## Local setup

1. Install PHP 8.4 with the PDO MySQL, mbstring, OpenSSL, and fileinfo extensions,
   plus Composer.
2. Install PHP dependencies:

   ```sh
   composer install
   ```

3. Create a local environment file and generate an application key:

   ```sh
   cp .env.example .env
   php artisan key:generate
   ```

4. Create a MySQL database and import **one** of the SQL dumps in `info/`.
   The dumps use different database names: `daily_expeniture.sql` targets
   `daily_expeniture`, while `dailyex1_penses.sql` targets `dailyex1_penses`.
   Set `DB_DATABASE` in `.env` to the database you imported, and set its
   connection credentials there.
5. Run the application with the existing `public_html` document root:

   ```sh
   php -S 127.0.0.1:8000 -t public_html server.php
   ```

The included SQL files are legacy data dumps, not Laravel migration files.
Import one into an empty database; do not run `php artisan migrate` against an
imported dump. Neither dump includes the `authors`, `category`, and `cat_id`
tables used by the thesaurus pages, so those pages need their separate legacy
data/schema.

For production, point the web server document root at `public_html`, set
`APP_DEBUG=false`, generate a unique `APP_KEY`, and configure database
credentials and writable `storage/` directories for the deployment.

## Tests

Run the application tests with:

```sh
composer test
```
