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

// // rotta per index pages: lista di tutte le pagine
// Route::get('/pages', function () {
//     return view('admin.pages.index');
// })->name('admin.pages.index');
// // rotta per create pages: creazione nuova pagina
// Route::get('/pages/create', function () {
//     return view('admin.pages.create');
// })->name('admin.pages.create');
// // rotta per edit pages: modifica pagina esistente
// Route::get('/pages/{page}/edit', function () {
//     return view('admin.pages.edit');
// })->name('admin.pages.edit');
// // rotta per edit pages: modifica pagina esistente
// Route::get('/pages/{page}/show', function () {
//     return view('admin.pages.show');
// })->name('admin.pages.show');
//
// Route::get('/photos', function () {
//     return view('admin.photos.index');
// })->name('admin.photos.index');
//
// Route::get('/photos/create', function () {
//     return view('admin.photos.create');
// })->name('admin.photos.create');
//
// Route::get('/photos/{photo}/show', function () {
//     return view('admin.photos.show');
// })->name('admin.photos.show');
//
// Route::get('/pages/{photo}/edit', function () {
//     return view('admin.photos.edit');
// })->name('admin.photos.edit');

Route::prefix('admin')
->namespace('Admin')
->name('admin.')
->middleware('auth')
->group(function () {
    Route::resource('pages', 'PageController');
});
