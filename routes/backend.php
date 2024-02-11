<?php
use App\Http\Controllers\ShortenUrlController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\UserController;
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

Route::group([
    'middleware' => 'isAdmin'
], function ($router) {
        Route::get('dashboard', [DashBoardController::class, 'index'])->name('dashboard');
        Route::resource('users',UserController::class);
        Route::resource('shortenurl',ShortenUrlController::class);
        Route::get('/{shortUrl}', [ShortenUrlController::class, 'redirectShortUrl'])->name('shortenedurls.redirect');
        Route::get('get-data',[ShortenUrlController::class, 'userGetData'])->name('userGetData');
});

