<?php


use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DoctorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\DrugController;
use App\Http\Controllers\FileManagerController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PrescriptionHelpers\DoseController;
use App\Http\Controllers\PrescriptionHelpers\DrugAdviceController;
use App\Http\Controllers\PrescriptionHelpers\DrugStrengthController;
use App\Http\Controllers\PrescriptionHelpers\DrugTypesController;

use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PatientController;

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
    Route::get('/auth-history', [AuthController::class, 'authHistory']);
    Route::delete('/auth-history/{id}', [AuthController::class, 'deleteAuthHistory']);
    Route::get('/get-current-user', [AuthController::class, 'currentUser']);
    Route::post('/change-email', [AuthController::class, 'changeEmailAddress']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/change-password', [PasswordResetController::class, 'changePassword']);

    Route::apiResource('role', RoleController::class);
    Route::get('/permissions', [RoleController::class, 'getAllPermission']);


    // File Upload
    Route::post('/file-upload', [FileManagerController::class, 'store']);
    Route::get('/files', [FileManagerController::class, 'index']);


    Route::apiResources([
        'drugs' => DrugController::class,
        'doses' => DoseController::class,
        'drug-advices' => DrugAdviceController::class,
        'drug-strength' => DrugStrengthController::class,
        'drug-type' => DrugTypesController::class,
        'schedules' => ScheduleController::class,
        'appointment' => AppointmentController::class,
        'department' => DepartmentController::class,
        'doctor' => DoctorController::class,
        'patient' => PatientController::class,
    ]);

    Route::get('/schedule-by-user/{user_id}', [ScheduleController::class, 'getScheduleByUser']);
});

