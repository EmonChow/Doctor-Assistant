<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\PasswordResetController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function (Request $request) {
    return response()->json(['hello' => 'world']);
});

Route::middleware('guest')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/forget-password', [PasswordResetController::class, 'forgotPassword']);
    Route::post('/reset-password', [PasswordResetController::class, 'resetPassword']);

});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/change-email', [AuthController::class, 'changeEmailAddress']);
    Route::get('/get-current-user', [AuthController::class, 'currentUser']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/change-password', [PasswordResetController::class, 'changePassword']);


});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
