<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PhotoController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikePhotoController;

use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
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

Route::get('/', function () {
    return view('layouts.app');
})->name('home');
// });

// Route::get('/login', function(){
//     return view('pages.login');
// })->name('login');

// Route::get('/register', function(){
//     return view('pages.register');
// });

Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
Route::post('/register', [RegisterController::class, 'processRegister'])->name('register.process');

Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'processLogin'])->name('login.process');

Route::get('/logout', function () {
    Auth::logout();
    Alert::success('Berhasil Keluar');
    return redirect()->route('login.index');
})->name('logout');

Route::get('/', [PhotoController::class, 'home'])->name('home');

Route::controller(PhotoController::class)->middleware('auth')->name('photo.')->group(function () {
    Route::get('/photo/{photo_id}', 'index')->name('index');
    Route::get('/post', 'postPhoto')->name('post');
    Route::post('/post', 'postPhotoProcess')->name('postProcess');
    Route::put('/photo/{photo_id}', 'updatePhoto')->name('update');
    Route::delete('/photo/{photo_id}', 'deletePhoto')->name('delete');
});

Route::controller(LikePhotoController::class)->middleware('auth')->name('like_photo.')->group(function () {
    Route::post('/like', 'like')->name('like');
    Route::post('/unlike', 'unlike')->name('unlike');
});

Route::controller(CommentController::class)->middleware('auth')->name('comment.')->group(function () {
    Route::post('/comment', 'post')->name('post');
    Route::put('/comment/{comment_id}', 'updateComment')->name('update');
});
Route::controller(ProfileController::class)->name('profile.')->group(function () {
    Route::get('/profile', 'index')->name('index');
    Route::get('/profile/{user_id}', 'people')->name('people');
    Route::put('/profile', 'updateProfile')->name('update');
});
