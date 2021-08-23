<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    UserController,
    ArticleController,
    RegisterController,
    LoginController,
    LogoutController,
    ForgotController,
    ResetController,
};

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

Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::get('logout', [LogoutController::class, 'logout'])->name('logout');
Route::get('forgot',[ForgotController::class, 'index'])->name('forgot');
Route::get('reset/{token}', [ResetController::class, 'index'])->name('reset ');

Route::post('register', [RegisterController::class, 'register'])->name('post.register');
Route::post('login', [LoginController::class, 'login'])->name('post.login');
Route::post('forgot', [ForgotController::class, 'store'])->name('post.forgot');
Route::post('reset', [ResetController::class, 'reset'])->name('post.reset');

Route::get('profile/{user}', [UserController::class, 'profile'])->name('user.profile');

Route::resource('articles', ArticleController::class)->except('index');

Route::get('/', [ArticleController::class, 'index']);


/*Route::get('structures', function () {

    $fruits = ['pomme', 'orange', 'mandarine', 'citron'];

    $data = [
        'number'=> 2,
        'fruits' => $fruits,
    ];
    return view('structures', $data);
});

Route::get('test', function () {
    return view('test')->withTitle('Laravel');
});

Route::get('test2', function () {
    return view('test2')->withTitle('Php');
});*/
