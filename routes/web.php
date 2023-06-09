<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
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


Route::get('/', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/verify', [LoginController::class, 'verify'])->name('login.verify');
Route::post('/search-user', [LoginController::class, 'searchUser']);
Route::middleware('auth')
    ->group(callback: function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
    Route::resource('user-types', UserTypeController::class);
    Route::get('user-types-list', [UserTypeController::class, 'user_types'])->name('user-types-list');
    Route::resource('users', UserController::class);
    Route::get('users-list', [UserController::class, 'list'])->name('users-list');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    });

