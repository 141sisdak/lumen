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
    return $router->app->version();
});

$router->get('/books', 'BookController@getAll');
$router->post('/books', 'BookController@nuevoBook');
$router->get('/books/{id_book}', 'BookController@getBookById');//{id_book} tiene que corresponde con el mismo nombre del parametro del método que lo vaya a controlar
$router->put('/books/{id_book}', 'BookController@update');
$router->delete('/books/{id_book}', 'BookController@delete');
