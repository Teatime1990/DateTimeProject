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
configure .env depending on your own environment. 
May need the following command to add App_key in env file
```
php artisan key:generate
```

## Compiles locally for development
```
php -S localhost:3000 -t public
```

## Run Unit Tests
```
vendor/bin/phpunit
```

# API Feature Description (How to use this API)
Url template to call this API is localhost:3000/api/DateTimeAPI/Modenumber?Parameters

Modenumber is an int from 1 to 4. 

## Mode 1
Return result of days between datetimes.

### Parameter requirement: 
* firstDate=YYYY-MM-DD HH:MM:SS
* secondDate=YYYY-MM-DD HH:MM:SS
* (Optional) convert=OPTIONS (seoncds,minutes,hours,years)

An example1 of calling this API in Mode 1: localhost:3000/api/DateTimeAPI/1?firstDate=2020-08-13 12:00:33&secondDate=2020-08-14 23:55:12

An example2 of calling this API in Mode 1: localhost:3000/api/DateTimeAPI/1?firstDate=2020-08-13 12:00:33&secondDate=2020-08-14 23:55:12&convert=seconds

### Deviation of Mode 1
The result is rounding in ten decimal places.

## Mode 2
Return result of weekdays between datetimes.

### Parameter requirement: 
* firstDate=YYYY-MM-DD HH:MM:SS
* secondDate=YYYY-MM-DD HH:MM:SS
* (Optional) convert=OPTIONS (seoncds,minutes,hours,years)

An example1 of calling this API in Mode 2: localhost:3000/api/DateTimeAPI/2?firstDate=2020-08-13 12:00:33&secondDate=2020-09-14 23:55:12

An example2 of calling this API in Mode 2: localhost:3000/api/DateTimeAPI/2?firstDate=2020-08-13 12:00:33&secondDate=2020-09-14 23:55:12&convert=minutes

## Mode 3
Return with result of complete weeks between datetimes.

### Parameter requirement: 
* firstDate=YYYY-MM-DD HH:MM:SS
* secondDate=YYYY-MM-DD HH:MM:SS
* (Optional) convert=OPTIONS (seoncds,minutes,hours,years)

An example1 of calling this API in Mode 3: localhost:3000/api/DateTimeAPI/3?firstDate=2020-08-13 12:00:33&secondDate=2020-10-24 23:55:12

An example2 of calling this API in Mode 3: localhost:3000/api/DateTimeAPI/3?firstDate=2020-08-13 12:00:33&secondDate=2020-10-24 23:55:12&convert=years

## Mode 4
Return with result of days between datetimes in different timezone.

### Parameter requirement: 
* firstDate=YYYY-MM-DD HH:MM:SS
* firstTimeZone=TIMEZONE
* secondDate=YYYY-MM-DD HH:MM:SS
* secondTimeZone=TIMEZONE

An example of calling this API in Mode 4: localhost:3000/api/DateTimeAPI/4?firstDate=2020-08-13 12:00:33&secondDate=2020-08-14 23:55:12&firstTimeZone=PDT&secondTimeZone=AEST

