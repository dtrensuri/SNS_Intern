<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\FacebookController;

use App\Http\Controllers\TwitterController2;

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
    return redirect(route('user.view'));
})->name('index');

Route::name('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('.login_page');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::name('user')->middleware('auth')->group(function () {
    Route::prefix('post')->group(function () {
        Route::get('view', function () {
            return view('user.post.view');
        })->name('.view');

        Route::get('create', function () {
            return view('user.post.create');
        })->name('.create');
        Route::post('tweets', [TwitterController2::class, 'postTweet']);
        Route::get('tweets/delete/{id}', [TwitterController2::class, 'deleteTweet']);
    });
    Route::get('/logout', [AuthController::class, 'logout'])->name('.logout');

    Route::name('.setting')->prefix('setting')->group(function () {
        Route::get('channel-settings', [SettingController::class, 'createChannelSetting'])->name('.channel');
    });

    Route::get('fb-access', [FacebookController::class, 'OAUth2Client']);
    Route::get('fb-post', [FacebookController::class, 'showListPost']);
    Route::get('autoUpdate', [FacebookController::class, 'autoUpdateFacebookData']);
});
