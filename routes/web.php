<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\EvaluationController;

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

Route::get('/', [AuthController::class, 'indexSignIn']);
Route::post('signin', [AuthController::class, 'actionSignIn']);
Route::get('signout', [AuthController::class, 'actionSignOut']);

Route::get('signin-from-semestea', [AuthController::class, 'actionSignFromOther']);
Route::get('404', function(){
    return view('errors/404');
});

Route::get('soon', function(){
    return view('cooming-soon');
});

Route::middleware(['my.auth'])->group(function () {
    Route::get('dashboard', [AuthController::class, 'indexDashboard']);
    Route::get('welcome', [AuthController::class, 'indexWelcome']);
    Route::post('password', [AuthController::class, 'actionChangePassword']);

    Route::resource('evaluation', EvaluationController::class);
});