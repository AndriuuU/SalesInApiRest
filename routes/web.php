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
})->name('index');

// Route::resource('offers', 'API\OffersController');
// Route::resource('articles', 'API\articlesController');



Auth::routes();


Route::get('ofertas/show','OffersController@index')->name('offers.index');

Route::get('noticias/show','ArticlesController@index')->name('articles.index');