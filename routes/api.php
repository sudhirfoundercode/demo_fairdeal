<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\{PublicApiController,Blue36Controller,Green36Controller};

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/auto_result_insert', [blue36Controller::class, 'auto_result_insert'])->name('auto_result_insert');
Route::post('/auto_result_insert', [Green36Controller::class, 'green_auto_result_insert'])->name('green_auto_result_insert');


Route::controller(PublicApiController::class)->group(function () {
    Route::post('/login', 'Login');
    Route::get('/profile/{id}', 'Profile');
});



/// blue 36 Route ////
Route::controller(Blue36Controller::class)->group(function () {
Route::get('/blue_36_results','blue36_result_store');
Route::any('/blue_36_bet', 'blue36_bet');
Route::get('/blue_36_last_result','blue36_last13_result');
Route::get('/blue_36_result','blue36_result_index');
Route::get('/blue_36_bet_history','blue36_bet_history');
Route::get('/blue_36_win_amount','blue36_win_amount');

Route::get('/blue36-betlogs', 'getLatestBetLogs');
Route::get('/blue36-betlogs-amount', 'getLatestBetLogsAmount');
Route::post('/admin_prediction3', 'admin_prediction3')->name('admin_prediction3');
});


Route::controller(Green36Controller::class)->group(function () {
Route::get('/green_36_results','green36_result_store');
Route::any('/green_36_bet', 'green36_bet');
Route::get('/green_36_last_result','green36_last13_result');
Route::get('/green_36_result','green36_result_index');
Route::get('/green_36_bet_history','green36_bet_history');
Route::get('/green_36_win_amount','green36_win_amount');

Route::get('/green36-betlogs', 'getLatestBetLogs');
Route::get('/green36-betlogs-amount', 'getLatestBetLogsAmount');
Route::post('/admin_prediction3', 'admin_prediction3')->name('admin_prediction3');
});



