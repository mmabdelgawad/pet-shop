## Installation

Before cloning this repository, make sure you have docker installed on your machine. If you don't have docker installed, you can download it from [here](https://www.docker.com/products/docker-desktop)

* Clone the repository 
* Run `docker-compose up -d` to start docker containers 
* Run `docker exec -it petshop_app bash` to enter the app container 
* Inside th app container you need to run 

```bash
cp .env.example .env
php artisan key:generate
composer install
php artisan migrate --seed
npm install
```

## Backend
Implemented backend functionalities:
* Auth
  * Login
  * Logout
  * Forgot / Reset Password
* User Orders Listing
* Brand Listing
* Categories Listing
* Promotions Listing

> * You can run unit tests by running `./vendor/bin/pest` inside the app container.
> 
> * To access swagger documentation, open `http://localhost/api/documentation` in your browser


## Frontend
Implemented frontend functionalities :
* Auth
  * Login
  * Logout

> To access frontend, open `http://localhost` in your browser

## Level Challenge

* BACS Implementation, for more information please go to `packages/buckhill/bacs-payment/README.md`