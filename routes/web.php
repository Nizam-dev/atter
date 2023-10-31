<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginRegister;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\TweetsController;
use App\Http\Controllers\User\ProfilController;
use App\Http\Controllers\User\NotifController;
use App\Http\Controllers\User\SettingController;
use App\Http\Controllers\User\LRTC;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\TweetController as AdminTweetController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

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

Route::get('/', function () {
    return redirect('login');
});
Route::get('login', [LoginRegister::class,'index']);
Route::post('login', [LoginRegister::class,'login']);
Route::post('register', [LoginRegister::class,'register']);
Route::get('logout', [LoginRegister::class,'logout']);




Auth::routes(['login'=>false,'register'=>false]);

Route::middleware(['role:admin'])->group(function () {
    Route::get('admin', [AdminHomeController::class,'index']);
    Route::get('admin/tweet', [AdminTweetController::class,'index']);
    Route::get('admin/comments', [AdminCommentController::class,'index']);
    Route::get('admin/user', [AdminUserController::class,'index']);

});


Route::middleware(['role:admin,user'])->group(function () {
    Route::get('home', [HomeController::class,'index']);
    Route::get('notifikasi', [NotifController::class,'index']);
    Route::get('setting', [SettingController::class,'index']);
    Route::post('setting/password', [SettingController::class,'password']);
    Route::post('setting/email', [SettingController::class,'email']);
    Route::post('tweet/post', [TweetsController::class,'post']);
    Route::post('updateprofil',  [ProfilController::class,'update']);

    
    Route::get('like/{id}', [LRTC::class,'like']);
    Route::get('retweet/{id}', [LRTC::class,'retweet']);
    Route::get('undoretweet/{id}', [LRTC::class,'undo_retweet']);
    Route::post('quotetweet/{id}', [LRTC::class,'quote_retweet']);
    Route::get('addfollow/{id}', [LRTC::class,'follow']);
    Route::post('addkomentar/{id}', [LRTC::class,'komentar']);
    
});
Route::get('/@{username}',  [ProfilController::class,'index']);