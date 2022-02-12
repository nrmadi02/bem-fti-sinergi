<?php

use App\Http\Controllers\app\ListAnggotaController;
use App\Http\Controllers\app\VerifiedUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

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

// Main Page Route

Route::group(['middleware' => 'auth:sanctum', 'verified'],function(){
    Route::group(['middleware' => 'verifieduser'],function(){
        Route::group(['middleware' => 'roleuser'],function(){
            Route::get('/bem-fti/verified-user', [ListAnggotaController::class, 'ListVerifiedUser'])->name('verified-user');
            Route::get('/bem-fti/list-verified-user', [ListAnggotaController::class, 'getListVerifiedUser'])->name('list-verified-user');
            Route::get('/bem-fti/verified-user/{id}', [VerifiedUserController::class, 'VerifiedUser'])->name('verif-user');
            Route::get('/bem-fti/unverified-user/{id}', [VerifiedUserController::class, 'UnverifiedUser'])->name('unverif-user');
        });

        Route::get('/bem-fti', [DashboardController::class, 'dashboardEcommerce'])->name('dashboard');
    });
});
