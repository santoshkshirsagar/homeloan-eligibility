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

Route::get('offers', [App\Http\Controllers\ProfileController::class, 'offers'])->name('offers');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin');
    Route::resource('user','App\Http\Controllers\UserController');
    Route::resource('application', 'App\Http\Controllers\ApplicationController');
    Route::resource('bank', 'App\Http\Controllers\BankController');
    Route::resource('page','App\Http\Controllers\PageController');
});

