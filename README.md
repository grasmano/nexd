

## Installation guide

1. git clone https://github.com/grasmano/nexd.git

2. run "composer install"

3. create database "CREATE DATABASE DB_NAME;" and configure Database Details (make database connection by adding database name, username and password in .env config file of your project)

4. run "npm install"

5. run migration "php artisan migrate"

6. run "npm run dev"

7. run "php artisan serve"

8 open http://127.0.0.1:8000/ link in browser and (if need) run "php artisan key:generate"

