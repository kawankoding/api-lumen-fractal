<?php

$app->post('register', 'AuthController@register');
$app->post('login', 'AuthController@login');

$app->get('users/all', 'UserController@all');
$app->get('users/profile/{id}', [
    'middleware'    => 'auth',
    'uses'          => 'UserController@show',
]);

$app->get('users/me', [
    'middleware'    => 'auth',
    'uses'          => 'UserController@mySelf',
]);

$app->get('books/all', 'BookController@all');
