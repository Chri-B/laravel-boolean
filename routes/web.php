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

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// rotta per index pages: lista di tutte le pagine
Route::get('/pages', function () {
    return view('admin.pages.index');
})->name('admin.pages.index');
// rotta per create pages: creazione nuova pagina
Route::get('/pages/create', function () {
    return view('admin.pages.create');
})->name('admin.pages.create');
