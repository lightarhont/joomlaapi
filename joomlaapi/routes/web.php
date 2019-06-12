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

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->post('login', 'AuthController@index');

$app->post('register', 'RegisterController@index');

$app->post('remind_pass', 'RemindPassController@index');

$app->get('test', 'TestController@index');