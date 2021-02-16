<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'v1/sms'], function () use ($router) {
    $router->post('send', ['middleware' => 'auth', 'uses' => 'SmsController@send']);
    $router->post('get/{table}', ['middleware' => 'auth', 'uses'=> 'SmsController@getLog']);
});
