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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', '\App\Http\Controllers\ApplicationController@index');
Route::get('get-district-list', [\App\Http\Controllers\ApplicationController::class, 'getDistrictList']);
Route::get('get-upazila-list', [\App\Http\Controllers\ApplicationController::class, 'getUpazilaList']);
Route::post('application/store', '\App\Http\Controllers\ApplicationController@store');

Route::get('/dashboard', \App\Http\Controllers\DashboardController::class)->middleware(['auth'])->name('dashboard');

Route::resource('password-update', \App\Http\Controllers\PasswordUpdateController::class)
    ->only(['create','store']);
Route::resource('profile-update', \App\Http\Controllers\ProfileUpdateController::class)
    ->only(['create','store']);

Route::middleware('auth')->group(function(){
    Route::resource('user', \App\Http\Controllers\UserController::class);
    Route::get('user/portal/{user}', [\App\Http\Controllers\UserController::class, 'portal'])->name('user.portal');

    Route::resource('password-update', \App\Http\Controllers\PasswordUpdateController::class)
        ->only(['create','store']);
    Route::resource('profile-update', \App\Http\Controllers\ProfileUpdateController::class)
        ->only(['create','store']);
        Route::resource('exam-list', \App\Http\Controllers\Admin\ExamListController::class);
        Route::resource('university-list', \App\Http\Controllers\Admin\UniversityListController::class);
        Route::resource('board', \App\Http\Controllers\Admin\BoardController::class);
        Route::resource('application', \App\Http\Controllers\Admin\ApplicationController::class);
});

Route::get('portal/{user}', \App\Http\Controllers\PortalController::class)->name('portal');


require __DIR__.'/auth.php';
