<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/**
* Rutas para trabajar con métodos propios parecidos a los de 
* la clase Collections de Laravel
*/
Route::get('/collections1', ['uses' => 'CollectionsController@collections1']);
Route::get('/collections2', ['uses' => 'CollectionsController@collections2']);
Route::get('/collections3', ['uses' => 'CollectionsController@collections3']);
Route::get('/collections4', ['uses' => 'CollectionsController@collections4']);
Route::get('/collections5', ['uses' => 'CollectionsController@collections5']);
Route::get('/collections6', ['uses' => 'CollectionsController@collections6']);
/*
*Trabajando con la Clase Colleciton de Laravel
*/
Route::get('/collect', ['uses' => 'CollectionsController2@collections']);
Route::get('/collect/{metodo}', ['uses' => 'CollectionsController2@metodos']);
/**
* ejemplo libro refactoring tocolecction
*/
Route::get('/example1', ['uses' => 'ExampleController@example']);
Route::get('/example2', ['uses' => 'ExampleController@example2']);
Route::get('/binaryToDecimal', ['uses' => 'ExampleController@binaryToDecimal']);
Route::get('/github', ['uses' => 'ExampleController@github']);

Route::get('/rememorando', ['uses' => 'ExampleController@rememorando']);
Route::get('/binaryToDecimal/{binaryNumber}', ['uses' => 'CollectionsController3@binaryToDecimal']);
Route::get('/github2/{user?}', ['uses' => 'ApisController@github']);
Route::get('/puntuacionGit/{user?}', ['uses' => 'ApisController@puntuacionTotal']);
Route::get('/format', ['uses' => 'ApisController@formatter']);
Route::get('/funContains', ['uses' => 'ApisController@funContains']);
Route::get('/firstContains', ['uses' => 'ApisController@firstContains']);
Route::get('/macros', ['uses' => 'TrabajandoDatosController@macros']);
Route::get('/zip', ['uses' => 'TrabajandoDatosController@comparandoColecciones']);
Route::get('/lookup', ['uses' => 'TrabajandoDatosController@lookupTable']);
Route::get('/users', ['uses' => 'UsersController@usersForm']);
Route::get('/contactos', ['uses' => 'TrabajandoDatosController@contactos']);
Route::get('/rangking', ['uses' => 'TrabajandoDatosController@rangking']);

