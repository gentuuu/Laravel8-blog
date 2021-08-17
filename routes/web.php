<?php

use GuzzleHttp\Middleware;
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

//pierwszy sposób
// Route::get('/localization/{language}', App\Http\Controllers\LocalizationController::class)->name('localization.switch');

//drugi sposób
Route::get('/localization/{language}', [App\Http\Controllers\LocalizationController::class, 'switch'])->name('localization.switch');

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [\App\Http\Controllers\BlogController::class, 'home'])->name('blog.home');

Auth::routes([
    'register' => false
]);

Route::group(['prefix' => 'dashboard', 'middleware' => ['web', 'auth']], function(){
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/categories/select', [App\Http\Controllers\CategoryController::class, 'select'])->name('categories.select');
    Route::resource('/categories', App\Http\Controllers\CategoryController::class);

    Route::get('/tags/select', [App\Http\Controllers\TagController::class, 'select'])->name('tags.select');
    Route::resource('/tags', App\Http\Controllers\TagController::class)->except(['show']);

    Route::resource('/posts', App\Http\Controllers\PostController::class);

    Route::group(['prefix' => 'filemanager'], function () {
        Route::get('/index', [\App\Http\Controllers\FileManagerController::class, 'index'])->name('filemanager.index');
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });

    Route::get('/roles/select', [App\Http\Controllers\RoleController::class, 'select'])->name('roles.select');
    Route::resource('/roles', App\Http\Controllers\RoleController::class);

    Route::resource('/users', App\Http\Controllers\UserController::class)->except(['show']);
});
