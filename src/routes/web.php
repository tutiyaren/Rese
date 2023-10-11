<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\DoneController;
use App\Http\Controllers\QrcodeController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\RepresentativeController;
use App\Http\Controllers\AdminController;


//topページ(shop-all)
Route::get('/', [ShopController::class, 'list'])->name('list');
Route::post('/favorite/toggle/{id}', [ShopController::class, 'favorite'])->name('favorite.toggle');

//お店の詳細ページ
Route::get('/detail/{id}', [ShopController::class, 'detail'])->name('detail');
Route::post('/detail/{id}/store', [ShopController::class, 'store']);

//予約完了ページ
Route::get('/done', [DoneController::class, 'done'])->name('done');
//会員登録終了ページ
Route::get('/thanks', [DoneController::class, 'thanks']);
//未ログイン時
Route::get('/guest', [StateController::class, 'guest'])->name('guest');
//ログイン時
Route::get('/member', [StateController::class, 'member']);

Route::middleware(['auth'])->group(function () {
    //マイページ
    Route::get('/mypage', [MypageController::class, 'mypage'])->name('mypage');
    Route::delete('/mypage/delete/{id}', [MypageController::class, 'delete'])->name('mypage.delete');
    Route::patch('/mypage/update/{id}', [MypageController::class, 'update'])->name('mypage.update');
    //レビューページ
    Route::get('/review/{id}', [MypageController::class, 'review'])->name('review');
    Route::post('/review/{id}/store', [MypageController::class, 'store']);
    //レビュー送信完了ページ
    Route::get('/send', [DoneController::class, 'send'])->name('send');
    //QRCode
    Route::get('/generateQRCode/{id}', [QrcodeController::class, 'generateQrCode'])->name('generateQRCode');
    //Stripeページ
    Route::get('/stripe/{id}', [StripeController::class, 'stripe'])->name('stripe');
    Route::post('/stripe/{id}/checkout', [StripeController::class, 'store'])->name('stripe.checkout');
    //Stripe完了ページ
    Route::get('/payment', [StripeController::class, 'payment'])->name('payment');
});

//店舗代表者のログイン
Route::get('/representative_login', [RepresentativeController::class, 'show'])->name('representative_login');
Route::post('/representative_login', [RepresentativeController::class, 'login'])->name('login_submit');
//店舗代表者ページ
Route::middleware(['auth:representatives'])->group(function () {
    //店舗代表者トップページ
    Route::get('/representative/{id}', [RepresentativeController::class, 'representative'])->name('representative');
    //店舗代表者予約一覧ページ
    Route::get('/representative/{id}/booking/{shop_id}', [RepresentativeController::class, 'booking'])->name('booking');
    //店舗代表者更新ページ
    Route::get('representative/{id}/update/{shop_id}', [RepresentativeController::class, 'update'])->name('update');
    //店舗代表者更新
    Route::patch('representative/{id}/update/{shop_id}/refresh', [RepresentativeController::class, 'refresh'])->name('refresh');
    //店舗情報作成ページ
    Route::get('representative/{id}/make', [RepresentativeController::class, 'make'])->name('make');
    //店舗情報作成
    Route::post('representative/{id}/produce', [RepresentativeController::class, 'produce'])->name('produce');
    //リマインダー
    Route::get('representative/{id}/reminder', [RepresentativeController::class, 'reminder'])->name('reminder');
});


//管理者のログイン
Route::get('/admin_login', [AdminController::class, 'show'])->name('admin_login');
Route::post('/admin_login', [AdminController::class, 'login'])->name('login_submit');
//管理者ページ
Route::middleware(['auth:admins'])->group(function () {
    //店舗代表者作成
    Route::get('/admin', [AdminController::class, 'admin'])->name('admin');
    Route::post('/admin/create', [AdminController::class, 'create'])->name('create');
    //お知らせメール
    Route::get('/admin/mail', [AdminController::class, 'mail'])->name('mail');
    Route::post('/admin.sendnotification', [AdminController::class, 'sendUserNotification']);
});


//Route::get('/login', [AuthenticatedSessionController::class, 'login'])->name('login');
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