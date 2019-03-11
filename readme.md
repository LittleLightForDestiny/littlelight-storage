### Little Light Storage Server

This is Little Light's storage server code

To run it you will need
- php 7.1ish (not sure if 7.0 works)
- mongoDB server
- apache or nginx

### Install
clone this repo <br/> 
copy .env.example to .env <br/> 
replace these with your mongodb connection info <br/> 
```
MONGODB_DATABASE=
MONGODB_USERNAME=
MONGODB_PASSWORD=
```

replace these with your bungie API Key info
```
BUNGIE_API_KEY=
BUNGIE_CLIENT_ID=
```

change ./storage and ./bootstrap/cache permissions to 775

and then run
```
composer install
php artisan key:generate
```

