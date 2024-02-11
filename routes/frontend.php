<?php

use App\Http\Controllers\HomeController;
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


//Route::get('/', function () {
//    return view('back-end.dashboard');
//});

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
// Route::get('/', function () {
//     return view('front-end.pages.home.index');
// });

Route::get('/', [HomeController::class, 'frontendHome'])->name('frontend.index');

