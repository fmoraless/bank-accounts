<?php

use App\Http\Controllers\AccountController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

/*Route::apiResource('accounts', AccountController::class);*/
Route::middleware(['auth:sanctum'])->group(function () {
    //Route::apiResource('accounts', AccountController::class);
});

Route::get('accounts/{account}', [AccountController::class, 'show'])
    ->name('api.v1.accounts.show');
Route::get('accounts', [AccountController::class, 'index'])
    ->name('api.v1.accounts.index');
Route::post('accounts', [AccountController::class, 'store'])
    ->name('api.v1.accounts.store');
