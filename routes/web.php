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

Route::get('/form', function () {
    return view('form');
})->name('form');

Route::get('/admin', function () {
    return view('admin.dashboard');
})->name('admin');

Route::resource('user', 'App\Http\Controllers\UserController');
Route::resource('application', 'App\Http\Controllers\ApplicationController');
Route::resource('bank', 'App\Http\Controllers\BankController');