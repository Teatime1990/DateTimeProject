# DateTimeProject

## Project Background
This API is used to deal with calculate days, weekday, complete weeks between two datetime and difference between two datetime from different timezone.

## Intro to the project
This API is developed by Lumen based on Laravel7.0. Programming language is PHP7.2.5+.

## Development Guidelines
These guidelines help new developers understand the project structure and develop together in the same standards and specifications.

## Development Structure
* /DateTimeAPI - includes files created by running 'composer create-project laravel/lumen DateTimeAPI'.
* /DateTimeAPI/app/Http - source codes of controllers.
* /DateTimeAPI/routes - source codes of routers.
* /DateTimeAPI/tests - inlcudes all Unit Tests to help develop in a safe and smooth environment.
* /DateTimeAPI/composer.json - Specifies the app info, dependencies, scripts and other configs used in the project.

## Project setup
Make sure Composer and PHP7.2.5+ are installed on computer. If not, go to [PHP](https://www.php.net/downloads.php) and [Composer](https://getcomposer.org/) to install. 

## Install Packages
cd in your project directory
```
composer install
```

## Define Environment File
at the root of your project directory
```
cp .env.example .env
```
configure .env depending on your own environment

### Compiles locally for development
```
php -S localhost:3000 -t public
```
