# Laravel API for support frontend development

### Before start working please install 
##### php 7.2 
##### composer
##### MySql
##### create a database "web_ninja"


## run the following commands

```
cp .env.example .env
```

```
composer install
```

```
php artisan migrate
```

```
php artisan key:generate
```

```
php artisan passport:install
```

```
php artisan sleepingowl:install
```

```
php artisan db:seed
```

```
php artisan serve
```
### Getting Started for development

headers for api requests

'headers' => [

    'Accept' => 'application/json',

    'Authorization' => 'Bearer ' <accessToken>,

]

