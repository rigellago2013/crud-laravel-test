<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactsController;

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
Route::post('contacts/create', 'ContactsController@store')->name('contacts/create');
Route::get('contacts/{id}', 'ContactsController@show');
Route::post('contacts/edit', 'ContactsController@edit')->name('contacts/edit');
Route::delete('contacts/{id}', 'ContactsController@destroy');