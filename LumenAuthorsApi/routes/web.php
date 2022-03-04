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

$router->get('/authors', 'AuthorController@getAll');
$router->post('/authors', 'AuthorController@nuevoAutor');
$router->get('/authors/{id_autor}', 'AuthorController@getAutorById');//{id_autor} tiene que corresponde con el mismo nombre del parametro del método que lo vaya a controlar
$router->put('/authors/{id_autor}', 'AuthorController@update');
$router->delete('/authors/{id_autor}', 'AuthorController@delete');

