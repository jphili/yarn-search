## Ravelry Yarn Search API
This is a work in progress project.

The idea behind this project is to simplify the Ravelry Search for myself. I want to search yarns in a specific color, that are available near me; if possible, I also want to see the price range the yarn is sold in. I want to create lists/collections, for example a shopping list for a specific knitting project I am planning. I can create multiple lists for myself and save yarns to them. 



## Available Features (WIP)
- [x]  Register and Login user via API (POST)
- [x]  CRUD for collections
- [x]  Ravelry API Service Setup
- [ ]  Extract yarn data from Ravelry's yarn and stash resources
- [ ]  CRUD for yarns
- [ ]  Write tests
- [ ]  Optimization: Better Filtering (DataFilterService)
- [ ]  Feature: Show buying options near me



## Planned technical stack
Laravel REST API as backend, React as frontend. Redis for caching Ravelry API responses.



## How to run it

- get Ravelry API Credentials
- ```git clone``` project
- start Docker
- ```cp .env.example .env``` + set variables up (Ravelry credentials, etc.)
- Run ```
    docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs```

- Run ```./vendor/bin/sail up -d``` in project folder
- Create app key: ```./vendor/bin/sail artisan key:generate```
- Migrate database: ```./vendor/bin/sail artisan migrate```
- ```./vendor/bin/sail npm install```
- ```./vendor/bin/sail npm run dev```


Use for example Thunder Client in VSCode to test API endpoints.