<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperStokezController;
use App\Http\Controllers\StokezController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\AdjustController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\GameHistoryController;
use App\Http\Controllers\TurnOverReportController;
use App\Http\Controllers\PlayerHistoryController;
use App\Http\Controllers\TransactionReportController;
use App\Http\Controllers\IdPasswordChangeController;
use App\Http\Controllers\BlockUnblockController;
use App\Http\Controllers\AssignRoleController;
use App\Http\Controllers\ResultHistoryController;
use App\Http\Controllers\InstantWinController;
use App\Http\Controllers\SecurityController;
use App\Http\Controllers\StokezSettingController;
use App\Http\Controllers\GameSummaryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlayerSecurityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\{RoleController,PermissionController};
use App\Http\Controllers\SpinController;
use App\Http\Controllers\AndarBaharController;
use App\Http\Controllers\TripleChanceController;
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

//   Super Stokez Controller
Route::controller(SuperStokezController::class)->group(function () {
    Route::get('/super-stokez-index', 'super_stokez_index')->name('super.stokez.index');
    Route::post('/SuperStokezStore','SuperStokezStore')->name('SuperStokezStore');
});

// Stokez controller
Route::controller(StokezController::class)->group(function () {
    Route::get('/stokez-index', 'stokez_index')->name('stokez.index');
    Route::post('/StokezStore', 'StokezStore')->name('StokezStore');
});

// Players Controller
Route::controller(PlayerController::class)->group(function () {
    Route::get('/player-index', 'player_index')->name('player.index');
    Route::post('/PlayerStore', 'PlayerStore')->name('PlayerStore');
    Route::post('/wallet-store-{id}', 'wallet_store')->name('wallet.store');
	Route::post('/wallet/subtract/{id}', 'wallet_subtract')->name('wallet.subtract');

});


// Agent Controller
Route::controller(AgentController::class)->group(function () {
    Route::get('/agent-index', 'agent_index')->name('agent.index');
    Route::post('/agentStore', 'agentStore')->name('agentStore');
});

// Transfer Controller
Route::controller(TransferController::class)->group(function () {
    Route::get('/transfer-index', 'transfer_index')->name('transfer.index');
});

// AdjustPoint Controller
Route::controller(AdjustController::class)->group(function () {
    Route::get('/adjust-index', 'adjust_index')->name('adjust.index');
});


// Setting Controller
Route::controller(SettingController::class)->group(function () {
    Route::get('/setting-index', 'setting_index')->name('setting.index');
});

// Game History Controller
Route::controller(GameHistoryController::class)->group(function () {
    Route::get('/gameHistory-index', 'gameHistory_index')->name('gameHistory.index');
});

// Turn Over Report Controller
Route::controller(TurnOverReportController::class)->group(function () {
    Route::get('/turnOverReport-index', 'turnOverReport_index')->name('turnOverReport.index');
});

// Player History Controller
Route::controller(PlayerHistoryController::class)->group(function () {
    Route::get('/playerHistory-index', 'playerHistory_index')->name('playerHistory.index');
});

// Transaction Report Controller
Route::controller(TransactionReportController::class)->group(function () {
    Route::get('/transactionReport-index', 'transactionReport_index')->name('transactionReport.index');
});

// ID/Password Change Controller
Route::controller(IdPasswordChangeController::class)->group(function () {
    Route::get('/idPasswordChange-index', 'idPasswordChange_index')->name('idPasswordChange.index');
});

// Block Unblock Controller
Route::controller(BlockUnblockController::class)->group(function () {
    Route::get('/blockUnblock-index', 'blockUnblock_index')->name('blockUnblock.index');
});

// Assign Role Controller
Route::controller(AssignRoleController::class)->group(function () {
    Route::get('/assignRole-index', 'assignRole_index')->name('assignRole.index');
});

// Result History Controller
Route::controller(ResultHistoryController::class)->group(function () {
    Route::get('/resultHistory-index', 'resultHistory_index')->name('resultHistory.index');
});

// Instant Win Controller
Route::controller(InstantWinController::class)->group(function () {
    Route::get('/instantWin-index', 'instantWin_index')->name('instantWin.index');
});

// Security Controller
Route::controller(SecurityController::class)->group(function () {
    Route::get('/security-index', 'security_index')->name('security.index');
});

// Stokez Setting Controller
Route::controller(StokezSettingController::class)->group(function () {
    Route::get('/stokezSetting-index', 'stokezSetting_index')->name('stokezSetting.index');
});

// Game Summary Controller
Route::controller(GameSummaryController::class)->group(function () {
    Route::get('/gameSummary-index', 'gameSummary_index')->name('gameSummary.index');
});



// Player Security Controller
Route::controller(PlayerSecurityController::class)->group(function () {
    Route::get('/playerSecurity-index', 'playerSecurity_index')->name('playerSecurity.index');
});



// Role
Route::resource('roles', RoleController::class)->names([
    'index' => 'roles.store'
]);

// PermissionController
Route::resource('permissions', PermissionController::class)->names([
    'index' => 'permissions.store'
]);





//SPin
Route::controller(SpinController::class)->group(function () {
   
    Route::any('/spin_adminresults', 'adminresults')->name('spin.adminresults');
    Route::any('/spin_bets_history', 'bets')->name('spin.bets');
    Route::any('/spin_results', 'results')->name('spin.results');
    //Route::post('/admin_prediction', 'admin_prediction2')->name('admin_prediction2');
    Route::post('/fetch2', 'fetch_data2')->name('fetch_data2');
});
Route::any('/spin', [SpinController::class, 'index'])->name('spin.index');
Route::post('/spin-update',[SpinController::class, 'spin_update'])->name('spin.update');


//Blue36Controller
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




