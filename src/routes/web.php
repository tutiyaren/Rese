<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\DoneController;
use App\Http\Controllers\StateController;



//topページ(shop-all)
Route::get('/', [ShopController::class, 'list'])->name('list');
Route::post('/favorite/toggle/{id}', [ShopController::class, 'favorite'])->name('favorite.toggle');

//お店の詳細ページ
Route::get('/detail/{id}', [ShopController::class, 'detail'])->name('detail');
Route::post('/detail/{id}/store', [ShopController::class, 'store']);

Route::get('/done', [DoneController::class, 'done'])->name('done');
Route::get('/thanks', [DoneController::class, 'thanks']);
Route::get('/guest', [StateController::class, 'guest'])->name('guest');
Route::get('/member', [StateController::class, 'member']);

Route::middleware('auth')->group(function () {
    Route::get('/mypage', [MypageController::class, 'mypage']);
    //Route::view('/login', 'login')->name('login');
});


//Route::get('/login', [AuthenticatedSessionController::class, 'login']);
//Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');



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

//Route::get('/', function () {
    //return view('welcome');
//});