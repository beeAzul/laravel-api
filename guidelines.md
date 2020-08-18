1 - Install Laravel installer with command :
<pre>composer global require laravel/installer</pre>

2 - Install Laravel Framework with command : <br>
`$ laravel new ApplicationName`

3 - Edit .env file to configure database

4 - Create database + create table with laravel command:<br>
<pre>#In database console
CREATE DATABASE `laravel-api` DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

# In terminal, at the root of the project
$ php artisan migrate
</pre>
5 - Install JSON Web Token Authentication for Laravel:
doc : https://jwt-auth.readthedocs.io/en/develop/laravel-installation/
<pre>
$ composer require tymon/jwt-auth</pre>
publish package to config file:
<pre>php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"</pre>
Generate secret key if not present in .env file:
<pre>php artisan jwt:secret</pre>

Update User model :<br>
Implement the Tymon\JWTAuth\Contracts\JWTSubject contract on your User model, which requires that you implement the 2 methods `getJWTIdentifier()` and `getJWTCustomClaims()`.

Edit config/auth.php to configure gards type and driver.

6 - Creation of new Route and new Controller for the Registration and Login.<br>
Controller:
<pre>
$ php artisan make:controller AuthController
</pre>

Routes:
<pre>
// In routes/api.php file
Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');
</pre>


7 - Creation of UserRegistrerRequest and UserLoginRequest for Form Validation:
<pre>
$ php artisan make:request UserRegisterRequest
$ php artisan make:request UserLoginRequest
</pre>

8 - Creation of User and logout routes

9 - Installation of Cors package:<br/>
Docs : https://github.com/fruitcake/laravel-cors
<pre>$ composer require fruitcake/laravel-cors</pre>

#### 10 - Making CRUD
##### a - Creation of table Topics and Post  
    <pre>
    $ php artisan make:model Posts -m
    $ php artisan make:model Topics -m
    
    $ php artisan migrate:fresh
    </pre>
##### b - Creation of models Relationships
see app/Posts and app/Topics files:  
   - A topics belong to a User  
   - A Topics can have many Posts
   - A Post belong to a User
   - A Posts belong to a Topic
   
##### c Creation of Trait to order datas
see app/Traits/Orderable.php file  
to use it, import it in a model, see app/Topis.php


##### d Creation of Routes to create/post/update/delete Posts and Topics
We create a group of Routes because all Routes start by the topics prefix  
see routes\api.php   

##### e Creation of Posts and Topics controllers
see app/Http/Controllers/TopicController.php
see app/Http/Controllers/PostController.php

##### f Use a Resource for Topics and Posts
Resources are used to format response into json type.
<pre>
$ php artisan make:resource Topic
$ php artisan make:resource Post
</pre>

##### Creation of Topic Request for validation
We create a TopicCreateValidation to validate information from forms.

##### c
##### c
   


