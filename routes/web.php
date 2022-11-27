<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resources([
    'products' => App\Http\Controllers\ProductController::class,
    'attributes' => App\Http\Controllers\AttributeController::class,
]);

Route::patch('products/addAttr/{id}', ['as' => 'products.addattr', 'uses' => 'App\Http\Controllers\ProductController@addAttr']);
