<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Success
Route::get("/types", 'MasterType@get'); //admin and clients
Route::get("/type", 'MasterType@find'); //admin and clients
Route::post("/type", 'MasterType@create'); //admin
Route::put("/type", 'MasterType@update'); //admin
Route::delete("/type", 'MasterType@delete'); //admin

// Success
Route::get("/rooms", 'MasterRoom@get'); //admin
Route::get("/rooms/{status}", 'MasterRoom@getByStatus'); //admin
Route::get("/room", 'MasterRoom@find'); //admin
Route::post("/room", 'MasterRoom@create'); //admin
Route::put("/room", 'MasterRoom@update'); //admin
Route::delete("/room", 'MasterRoom@delete'); //admin

// Success
Route::get('/book', 'BookMaster@book_find'); //admin
Route::post('/book', 'BookMaster@book'); //clients
Route::post('/book/failed', 'BookMaster@del_book'); //admin

// Success
Route::get('/books', 'BookMaster@books'); //admin
Route::get('/books/{status}', 'BookMaster@getByStatus'); //admin

// Success
Route::post('/check_in', 'TransactionMaster@check_in'); //admin
Route::post('/check_out', 'TransactionMaster@check_out'); //admin
