##Create Enviroment

1. Copy file .env.example to .env
```
cd backend
cp .env.example to .env
```

2. Build docker
```
docker-composer up -d --build
```

3. Composer install
```
docker-compose exec php sh
composer install
php artisan key:generate
php artisan config:clear
```

4. Migrate database
```
docker-compose exec php sh
php artisan migrate
php artisan db:seed
```

- frontend: ```localhost:3000```
- backend: ```localhost:8080```
- phpmyadmin: ```localhost:8090```
- Datasabe:
```
  server: mysql
  username: thinhnd
  password: 12345678
```