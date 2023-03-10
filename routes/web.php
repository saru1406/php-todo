<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemoController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\BookmarkController;

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
});

Auth::routes();

Route::resource('memos',MemoController::class, ['only' => ['index','show','edit','store','update','destroy']]);
Route::get('/mypage', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
Route::patch('/mypage', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
Route::delete('/mypage', [App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');
Route::resource('tags',TagController::class, ['only' => ['index','edit','store','update','destroy']]);
Route::resource('bookmarks',BookmarkController::class, ['only' => ['index','store','destroy']]);