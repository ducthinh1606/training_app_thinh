##Create Enviroment

1. Copy file .env.example to .env
```
cd backend
cp .env.example .env
```

2. Build docker
```
docker-compose up -d --build
```

3. Change permission
```
docker-compose exec nginx sh
chmod -R 777 /var/www/html/storage
exit
```

4. Composer install
```
docker-compose exec backend sh
composer install
php artisan key:generate
php artisan config:clear
```

5. Migrate database
```
docker-compose exec backend sh
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