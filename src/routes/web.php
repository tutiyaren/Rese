<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SlackController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DiligenceController;
use Illuminate\Support\Facades\Artisan;

Route::group(['prefix' => '/', 'as' =>'log'], function() {
    Route::middleware('auth')->group(function () {

        //ホーム
        Route::get('', [SlackController::class, 'work'])->name('.eng');
                
        Route::post('start', [SlackController::class, 'work_start'])->name('.start');
        Route::post('end', [SlackController::class, 'work_end'])->name('.end');

        Route::post('start_rest', [SlackController::class, 'start_rest'])->name('.start_rest');
        Route::post('end_rest', [SlackController::class, 'end_rest'])->name('.end_rest');

        //日付一覧
        Route::get('attendance', [AttendanceController::class, 'data'])->name('.atten');

        //ユーザーごとの勤怠表
        Route::get('diligence', [DiligenceController::class, 'diligence'])->name('.diligence');

        //ユーザー一覧ページ
        Route::get('users', [UsersController::class, 'users'])->name('.users');
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

