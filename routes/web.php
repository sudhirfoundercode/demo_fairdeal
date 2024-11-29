<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PlayerController;



use App\Http\Controllers\AuthController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\{RoleController,PermissionController};
use App\Http\Controllers\Blue36Controller;
use App\Http\Controllers\Green36Controller;
use App\Http\Controllers\JackpotController;

// Define the route
Route::post('/bonus-settings/update', [JackpotController::class, 'update']);


// Auth Login Controller
Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'auth_index')->name('auth.index');
    Route::post('/AuthLogin', 'AuthLogin')->name('AuthLogin');
    Route::get('/AuthLogout', 'AuthLogout')->name('AuthLogout')->middleware('auth');

    Route::get('/ChangePasswordIndex', 'ChangePasswordIndex')->name('ChangePasswordIndex')->middleware('auth');
    Route::Post('/ChangePassword', 'ChangePassword')->name('ChangePassword')->middleware('auth');


});

// Dashboard Controller
Route::controller(DashboardController::class)->group(function () {
    Route::get('/dashboard', 'Dashboard')->name('Dashboard');
    Route::get('/insert', 'insert')->name('insert');
});


// Players Controller
Route::controller(PlayerController::class)->group(function () {
    Route::get('/player-index', 'player_index')->name('player.index');
    Route::post('/PlayerStore', 'PlayerStore')->name('PlayerStore');
    Route::post('/wallet-store-{id}', 'wallet_store')->name('wallet.store');
	Route::post('/wallet/subtract/{id}', 'wallet_subtract')->name('wallet.subtract');

});



//Timmer36Controller
Route::controller(Blue36Controller::class)->group(function () {
   
    Route::any('/blue36_bets_histroy', 'bets_blue')->name('blue36.bets');
    Route::any('/blue36_results', 'results_blue')->name('blue36.results');
   
});

Route::any('/blue36', [Blue36Controller::class, 'index_blue'])->name('blue36.index');
Route::get('/fetch_blue_36', [Blue36Controller::class, 'fetch_blue_36'])->name('fetch_blue_36');


Route::controller(Green36Controller::class)->group(function () {
   
    Route::any('/green36_bets_histroy', 'bets_green')->name('green36.bets');
    Route::any('/green36_results', 'results_green')->name('green36.results');
    
});

Route::any('/green36', [Green36Controller::class, 'index_green'])->name('green36.index');
Route::get('/fetch_green_36', [Green36Controller::class, 'fetch_green_36'])->name('fetch_green_36');



