<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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
    return 'Olá, mundo';
});

$router->group(['prefix' => 'api'], function() use ($router) {
    // Listagem de posts
    $router->get('/posts', 'PostController@index');

    // Criação de post
    $router->post('/posts/new', 'PostController@create');

    // Lista dados de um post específico
    $router->get('/posts/{slug}', 'PostController@show');

    // Remoção de post específico
    $router->delete('/posts/{slug}', 'PostController@delete');

    // Atualiza post específico
    $router->put('/posts/{slug}', 'PostController@update');
});