<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\Auth\ProfileController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Post\PostController as AdminPostController;

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

Route::get('/', HomeController::class)->name('home');
Route::get('/c/{categorySlug}', [PostController::class, 'index'])->name('user.post.index');
Route::get('/c/{categorySlug}/p/{id}', [PostController::class, 'show'])->name('user.post.show');

// Admin
Route::group([
    'prefix' => 'admin',
    'as' => 'admin.'
], function () {
    // Admin with middleware guest
    Route::middleware(['guest'])->group(function () {
        // login
        Route::view('login', 'admin.auth.login')->name('login.index');
        Route::post('login', [AuthController::class, 'login'])->name('login.login');
        // forgot password
        Route::view('forgot-password', 'admin.auth.forgot-password')->name('forgot-password');
        Route::post('forgot-password', [ForgotPasswordController::class, 'sendMail'])->name('forgot-password.send');
        // reset password
        Route::view('response-reset-password', 'admin.auth.reset-password')->name('reset-password');
        Route::put('reset-password', [ResetPasswordController::class, 'process'])->name('reset-password.process');
    });
    // Admin with middleware auth
    Route::middleware(['auth'])->group(function () {
        // logout
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
        // profile
        Route::view('/profile', 'admin.profile.index')->name('profile');
        Route::put('/profile/update-info', [ProfileController::class, 'updateInfo'])->name('profile.updateInfo');
        Route::put('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
        // admin index
        Route::view('/', 'admin.index')->name('index');
        // admin categories
        Route::resource('categories', CategoryController::class)->except('show');
        // admin post
        Route::resource('posts', AdminPostController::class);
        // Route::put('/posts/update-status/{id}', UpdateStatusController::class)->name('posts.update-status');
        // Route::post('/posts/upload-image', [UploadImageController::class, 'upload'])->name('posts.upload-image');
    });
});
