<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(["domain" => env('APP_URL', 'http://localhost:8000/admin')], function () {

    Route::get('/', 'Api\HomeController@index');


Route::group(['prefix' => 'v2', 'middleware' => ['auth:api']], function () {
    Route::get('/user', 'Api\UserController@get');
    
    /* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
    });

    /pedidos (GET, POST)
    /pedidos/:id (GET, PUT, DELETE)
   //clientes (GET, POST)
    /clientes/:id (GET, PUT, DELETE) */
}); 
}); 