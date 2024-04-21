<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Authentication Routes
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
});

// Public Features Routes
Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::get('active-users', [MemberController::class, 'getActiveUsers']);
});

// Admin Features Routes
// Route::group([
//     'middleware' => 'api',
// ], function ($router) {
// });

// Profile Routes
Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::post('register', [ProfileController::class, 'register']);   
    Route::post('me', [ProfileController::class, 'me']);
});