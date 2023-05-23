<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PoliticalPartyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoterController;
use App\Http\Controllers\PoliticalPartieController;
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
    Route::post('connection', [HomeController::class, 'changeConnection'])->name('connection');
    Route::get('main', [MainController::class, 'index'])->name('main.index');
    Route::get('main/municipalities', [MainController::class, 'municipalities'])->name('main.municipalities');
    Route::get('main/search-voter', [MainController::class, 'searchVoter'])->name('main.search-voter');
    Route::post('main/save-vote', [MainController::class, 'saveVote'])->name('main.save-vote');
    Route::get('main/dashboard', [MainController::class, 'dashboard'])->name('main.dashboard');

    // Partidos politicos
    Route::resource('political-parties', PoliticalPartyController::class);
    Route::get('political-parties-list', [PoliticalPartyController::class, 'list']);


    Route::resource('voters', VoterController::class);
    Route::get('voters-list', [VoterController::class, 'list'])->name('voters-list');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    });

