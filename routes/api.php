<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AuditorController;
use App\Http\Controllers\TaskController;
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

Route::prefix('auditor')->group(function(){
    Route::post('token', [AuditorController::class, 'getToken']);
    Route::delete('token', [AuditorController::class, 'deleteToken']);
});

Route::resource('auditor', AuditorController::class)->only(['show']);
Route::resource('agenda', AgendaController::class)->only(['index, show, put']);
Route::resource('task', TaskController::class)->only(['show, put']);

