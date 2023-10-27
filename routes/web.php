<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::name('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    });
    Route::post('/login', function () { })->name('login');
});

Route::name('user')->group(function () {
    Route::prefix('post')->group(function () {
        Route::get('view', function () {
            return view('user.post.view');
        })->name('.view');
        Route::get('create', function () {
            return view('user.post.create');
        })->name('.create');
    });
});