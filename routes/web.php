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

Auth::routes();
Route::get('lang/{lang}', 'LanguageController@switchLang')->name('lang.switch');

Route::get('/home', 'HomeController@index')->name('home');

// Account Controller
Route::resource('/account', 'AccountController');
Route::get('/account/{id}/restore', 'AccountController@restore')->name('account.restore');
Route::get('/account/{id}/permanent', 'AccountController@deletePermanent')->name('account.deletePermanent');

// Transaction Controller
Route::get('/account/{accountId}/add', 'TransactionController@create')->name('transaction.create');
Route::post('/account/{accountId}/add', 'TransactionController@store')->name('transaction.store');
