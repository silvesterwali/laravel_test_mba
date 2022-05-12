# How to use

This web app build on the top of laravel and vue. And how to run the application in development just follow the step below:

-   clone this repository

```bash
   git clone https://github.com/silvesterwali/laravel_test_mba.git
```

## Backend

-   install the laravel via cmd

```bash
composer install
```

-   create seeder for module

```
php artisan module:seed
```

-   run php server

```bash
php artisan serve
```

## Frontend

-   open anoter cmd

```bash
  npm run install

```

-   watch the frontend file

```bash
npm run watch
```

## Test

In this app only backend implement the test

-   running test for backend
    before running test make sure you have another database for testing. just replace the database name in `phpunit.xml`

```bash
php artisan test
```
