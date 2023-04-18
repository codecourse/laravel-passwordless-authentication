<?php

use App\Actions\SendMagicLink;
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

Route::view('/auth/login', 'auth.login')->middleware('guest');
Route::post('/auth/login', SendMagicLink::class)->name('auth.login')->middleware('guest');
