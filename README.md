Login: admin@admin.com
password: admin

![imagem](https://user-images.githubusercontent.com/78623134/168915877-0baf0196-b5d7-4c8c-ba4c-b6a6a55a8c10.png)
![imagem](https://user-images.githubusercontent.com/78623134/168576504-aa3c0d58-0d2e-4801-9282-ef40783116a1.png)
![imagem](https://user-images.githubusercontent.com/78623134/168576613-2078bc22-aa1e-4bf3-9242-80eedb20cfac.png)
![imagem](https://user-images.githubusercontent.com/78623134/168576734-efde8402-934a-4f45-8c85-65f71a7a07c8.png)
![imagem](https://user-images.githubusercontent.com/78623134/168576779-24670bbf-57fe-4d7c-a89e-b3cef7902dda.png)
![imagem](https://user-images.githubusercontent.com/78623134/168576902-612afc19-6314-4108-a312-ee3afaf8ee27.png)
![imagem](https://user-images.githubusercontent.com/78623134/168577096-7f5330d1-ac2f-4b0d-932b-9a3a716f786d.png)

CMD{
    1- composer global require laravel/installer 
    2- criar a pata com o projecto.... "blog" 
}
3- composer require laravel/ui:^2.4
4- php artisan ui vue --auth
5.1. npm install 
5.2. PASTA RESOURCES/SASS/APP.CSS
    // Bootstrap Icons
@import '~bootstrap-icons/font/bootstrap-icons.css';
5.3. npm i bootstrap-icons
5.4. npm run dev

6- http://localhost/phpmyadmin/index.php <---create db
6.1. ENV. 
DB_DATABASE=cesae

7- php artisan make:model Category -a
php artisan make:seeder UsersTableSeeder
php artisan make:factory PostFactory
php artisan make:model Post
php artisan make:controller HelloWorldController --resource

8- php artisan migrate:fresh --seed
php artisan migrate

9- php artisan serve

OBS:
composer dump-autoload
php artisan optimize:clear
--------------
CONTROL + C ... stop server

https://github.com/fzaninotto/Faker
