# Journal

## Project requirements

- git
- docker
- composer
- npm

## Launch site
Clone repository 
```
git clone git@github.com:ctrlVadim/journal.git
```

Install composer packages
```
composer install
```

Create .env file
```
cp .env.example .env
```

Run docker
```
docker-compose up -d
```
##### Now our site is running on this [address](http://127.0.0.1:60000)

## Database seeding
In [.env](.env) file change `DB_HOST` value to `127.0.0.1`

Run migrations
```
php artisan migrate
```

Run seeders (10 rows in each column)
```
php artisan db:seed --class=DatabaseSeeder
```

In [.env](.env) file change `DB_HOST` to name of 
your database's container (`mysql`)
