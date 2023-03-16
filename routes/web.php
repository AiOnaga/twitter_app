<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TweetController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // /home ツイート一覧表示+ツイート新規投稿
    Route::get('/home',[TweetController::class,'index'])->name('tweet.index');
    Route::post('/tweets',[TweetController::class,'store'])->name('tweet.store');
    // // /{userID}/likes ユーザーのいいね一覧表示
    Route::get('/users/{userId}/likes',[UserController::class,'likes'])->name('user.likes');
    // // /{userId}/following そのユーザーのフォローしているユーザー一覧
    Route::get('/users/{userId}/followings',[UserController::class,'followings'])->name('user.followig');

    Route::post('/users/{userId}/followings',[UserController::class,'follow'])->name('user.follow');
    Route::delete('/users/{userId}/followings',[UserController::class,'unfollow'])->name('user.unfollow');
    // // /{userId}/followers そのユーザーをフォローしている一覧
    Route::get('/users/{userId}/followers',[UserController::class,'followers'])->name('user.followers');

});

// // /{userId}/posts/{postId} ツイート詳細表示（自分のも同じURL）
Route::get('/users/{userId}/posts/{postId}',[UserController::class,'tweet'])->name('user.tweet.show');
// // /{userId} ユーザープロフィール表示
Route::get('/users/{userId}',[UserController::class,'show'])->name('user.show');

