<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SlackController;

Route::group(['prefix' => '/', 'as' =>'log'], function() {
    Route::middleware('auth')->group(function () {
        Route::get('', [SlackController::class, 'work'])->name('.eng');
        Route::post('', [SlackController::class, 'work_time']);
        Route::post('', [SlackController::class, 'work_start'])->name('.start');
        Route::post('', [SlackController::class, 'work_end'])->name('.end');
        Route::get('attendance', [SlackController::class, 'data'])->name('.atten');
        Route::post('attendance', [SlackController::class, 'data_time']);
    });
});





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

