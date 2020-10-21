# Bookstore API
---------------------------

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)


Clone the repository

    git clone https://github.com/sabbir268/eduly-bookstore.git

Switch to the repo folder

    cd eduly-bookstore

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Generate a new passport keys

    php artisan passport:install

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate
    
Run the database seeder to create roles & admin

    php artisan db:seed

Start the local development server

    php artisan serve

You can now access the server at http://127.0.0.1:8000

# Testing API

Run the laravel development server

    php artisan serve

The api can now be accessed at

    http://localhost:8000/api
**Test api with postman:**
Open the url in browser (*Postman install require*)
    https://www.getpostman.com/collections/a569c11587d603553198
**API documentation & example in postaman web**
https://documenter.getpostman.com/view/4965611/TVYCALPS


Request headers

| **Required** 	| **Key**              	| **Value**            	|
|----------	|------------------	|------------------	|
| Yes      	| Content-Type     	| application/json 	|
| Optional 	| Authorization    	| Bearer {token}    |

