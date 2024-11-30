<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\{PublicApiController,Blue36Controller,Green36Controller,FuntargetController};

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/auto_result_insert_blue', [blue36Controller::class, 'auto_result_insert_blue'])->name('auto_result_insert_blue');
Route::post('/auto_result_insert_green', [Green36Controller::class, 'auto_result_insert_green'])->name('green_auto_result_insert_green');


Route::controller(PublicApiController::class)->group(function () {
    Route::post('/login', 'Login');
    Route::get('/profile/{id}', 'Profile');
});

///// Fun Target Route /////

Route::get('/fun_result',[FuntargetController::class,'fun_result']);
Route::post('/fun_target_bet',[FuntargetController::class, 'fun_target_bet']);
Route::get('/fun_bet_history',[FuntargetController::class, 'fun_bet_history']);
Route::get('/fun_last_result',[FuntargetController::class,'fun_last10_result']);
Route::get('/fun_win_amount',[FuntargetController::class,'fun_win_amount']);
//Route::get('/fun_result_index',[FuntargetController::class,'fun_result_index']);
Route::controller(FuntargetController::class)->group(function () {
 Route::post('/auto_spin_ad_result_insert', 'auto_spin_ad_result_insert');
    Route::get('/spin-betlogs', 'getLatestBetLogs');
    Route::get('/spin-betlogs-amount', 'getLatestBetLogsAmount');
    Route::post('/admin_prediction4', 'admin_prediction4')->name('admin_prediction4');
    
});

/// blue 36 Route ////

Route::controller(Blue36Controller::class)->group(function () {
Route::get('/blue_36_results','blue36_result_store');
Route::any('/blue_36_bet', 'blue36_bet');
Route::get('/blue_36_last_result','blue36_last13_result');
Route::get('/blue_36_result','blue36_result_index');
Route::get('/blue_36_bet_history','blue36_bet_history');
Route::get('/blue_36_win_amount','blue36_win_amount');

Route::get('/blue36-betlogs', 'getLatestBetLogs_blue');
Route::get('/blue36-betlogs-amount', 'getLatestBetLogsAmount_blue');
Route::post('/admin_prediction3', 'admin_prediction3')->name('blue_admin_prediction3');
});

// Green36 game route///

Route::controller(Green36Controller::class)->group(function () {
Route::get('/green_36_results','green36_result_store');
Route::any('/green_36_bet', 'green36_bet');
Route::get('/green_36_last_result','green36_last13_result');
Route::get('/green_36_result','green36_result_index');
Route::get('/green_36_bet_history','green36_bet_history');
Route::get('/green_36_win_amount','green36_win_amount');

Route::get('/green36-betlogs', 'getLatestBetLogs');
Route::get('/green36-betlogs-amount', 'getLatestBetLogsAmount');
Route::post('/admin_prediction3', 'admin_prediction3')->name('green_admin_prediction3');
});



