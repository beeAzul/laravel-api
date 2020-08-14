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

8 - 