<?php

use Illuminate\Support\Facades\Route;


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
    return view('welcome');
})->name('top');

require __DIR__.'/auth.php';

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


//お問い合わせ
Route::get('contact/create', [App\Http\Controllers\ContactController::class, 'create'])->name('contact.create');
Route::post('contact/store', [App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');


//ログイン後の通常のユーザー画面
Route::middleware(['verified'])->group(function(){

    Route::post('post/comment/store',[App\Http\Controllers\CommentController::class, 'store'])->name('comment.store');
    Route::get('post/mypost',[App\Http\Controllers\PostController::class, 'mypost'])->name('post.mypost');
    Route::get('post/mycomment', [App\Http\Controllers\PostController::class, 'mycomment'])->name('post.mycomment');
    Route::resource('post', App\Http\Controllers\PostController::class);

});

// プロフィール編集用ルート設定を追加
Route::get('profile/{user}/edit',[App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('profile/{user}',[App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');


//管理者用画面
Route::middleware(['can:admin'])->group(function(){
    Route::get('profile/index', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');

    //ユーザー一覧
    Route::get('profile/index', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::delete('profile/{user}',[App\Http\Controllers\ProfileController::class, 'delete'])->name('profile.delete');

    //追加
    Route::patch('roles/{user}/attach', [App\Http\Controllers\RoleController::class, 'attach'])->name('role.attach');
    Route::patch('roles/{user}/detach', [App\Http\Controllers\RoleController::class, 'detach'])->name('role.detach');
});







