# Tools must install on PC before starting
```
1. Git
2. Docker
```

# Editor
    • PhpStorm

# Clone project
```
git clone https://github.com/ducthinh1606/training_app_thinh.git
```

# Development environment
```
1. Environment: Docker
2. Language: PHP 7.4, Reactjs
3. DB: Mysql 5.7, phpmyadmin
5. Framework: Laravel 8
```

# Documentation Useful tools
```
- API design tool: openApi 3.0
- Flow charts and ER diagrams: drawio
- UI design: figma
```

# Procedure to deploy for the first time

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
php artisan route:cache
```

5. Migrate database
```
docker-compose exec backend sh
php artisan migrate
php artisan db:seed
```

# Update project when something change

1. Database
```
docker-compose exec backend sh
php artisan migrate
```

2. Cache
```
docker-compose exec backend sh
php artisan cache:clear
php artisan config:clear
php artisan route:cache
php artisan view:clear
```

3. Package update
```
docker-compose exec backend sh
composer update
```

4. .env config
```
cd backend
cp .env.example .env
```

# Docker commands for frequent use
Start up containers.
```
$ docker-compose up -d
```
Stop containers.
```
$ docker-compose stop
```
Delete stopped containers.
```
$ docker-compose rm
```
Stop and delete containers.
```
$ docker-compose down
```

# Naming & coding rules
```
1. Naming rules
    - Namespace : Use in Class declaration files
    - Folder    : hyphencase
    - Class     : PascalCase and same as file name
    - Interface : PascalCase and same as file name
    - Abstract  : PascalCase and same as file name
    - Function  : camelCase and starts with a verb
    - Variable  : camelCase
    - Constant  : UPPER_CASE
2. Coding rules
    - Use PSR-2 convention
```

# Api rules
```
    - Compliant RESTful api
```
| Method name | Action           | URL      | CRUD | Method |
|:------------|:-----------------|:---------| :--- |:-------|
| index       | show all items   | /index   | R| GET    |
| show        | show detail item | /show    | R | GET    |
| store       | create an item   | /store   | C | POST   |
| update      | update an item   | /update  | U | PUT    |
| destroy     | delete an item   | /destroy | D | DELETE |

# Formatter rules
```
[JavaScript, SCSS]
    - Use Prettier and Eslint.
    - Indentation with spaces.
    - Two spaces on a tab

[PHP]
    - Indentation with spaces.
    - Four spaces on a tab
```

# Git rules
```
    - Always checkout from develop branch to code
    - Naming branch:
        • feature: feature/(feature_name)
        • bug: bugfix/(bug_name)
    - Review code before merge
    - Merge/Rebase target branch into current branch before create pull request
    - Make sure the program runs, there is no error in the logic you fix before pushing
    - Before create pull request, delete debug code, comment code
```

# Git commands for frequent use
Push a new branch
```
• git push --set-upstream origin {branch_name}
```
Push
```
• git push origin {branch_name}
```
Pull
```
• git pull origin {branch_name}
```
Add
```
• git add .
```
Commit
```
• git commit -m "{message}"
```

# Url for using app
- frontend: ```localhost:3000```
- backend: ```localhost:8080```
- phpmyadmin: ```localhost:8090```
- Database:
```
  server: mysql
  username: thinhnd
  password: 12345678
```

# How to debug
```
    1. Open /backend/app/Exceptions/Handler.php
    2. Add dd($e); to the first line of function render
    3. Send request again
```