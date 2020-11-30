#!/bin/bash

echo Uploading Application container 
docker-compose up -d

echo Copying the configuration example file
docker exec -it schedule_laravel-app_1 cp .env.example .env

echo Install dependencies
docker exec -it schedule_laravel-app_1 composer install

echo Generate key
docker exec -it schedule_laravel-app_1 php artisan key:generate

echo Make migrations
docker exec -it schedule_laravel-app_1 php artisan migrate

#echo Make seeds
#docker exec -it schedule_laravel-app_1 php artisan db:seed

echo Install node dependencies
docker exec -it schedule_laravel-app_1 npm install

echo Build assets
docker exec -it schedule_laravel-app_1 npm run dev

echo Information of new containers
docker ps -a