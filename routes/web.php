<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\UserTypeController;
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

Auth::routes();

Route::middleware('auth')
    ->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('user-types', UserTypeController::class);
    Route::get('user-types-list', [UserTypeController::class, 'user_types'])->name('user-types-list');
    Route::resource('users', UserController::class);
    Route::get('users-list', [UserController::class, 'list'])->name('users-list');
    });

