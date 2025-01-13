<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GetdoctorsController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DoctorsController;
use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CartController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', [RegisterController::class, 'apiRegister']);

// Login
Route::post('/login', [LoginController::class, 'login']);
// Doctor login
Route::post('/login/doctor', [LoginController::class, 'doctorLogin']);

// Logout
Route::post('/logout', [LoginController::class, 'logout']);

// Upload user avt
Route::post('/user/{userID}/upload-avatar', [UsersController::class, 'uploadAvatar']);
Route::get('/user/{userID}/get-avatar', [UsersController::class, 'getAvatarByUserId']);



// Get list doctor
// Route::middleware('auth:sanctum')->get('/doctors', [GetdoctorsController::class, 'home']);
Route::middleware('auth:sanctum')->get('/doctors', [GetdoctorsController::class, 'home']);


//Get product
Route::get('/products', [ProductController::class, 'getAllProducts']);
Route::get('/products/{id}', [ProductController::class, 'getProductById']);


//Get doctors controller
Route::get('/alldoctors', [DoctorsController::class, 'getAllDoctors']);
Route::get('/doctors/{doctorID}', [DoctorsController::class, 'getDoctorsByDoctorId']);


//Get Appointment

Route::get('/appointments', [AppointmentsController::class, 'getAllAppointments']);
Route::get('/appointments/{userID}', [AppointmentsController::class, 'getAppointmentsByUser']);
Route::post('/appointments/{userID}', [AppointmentsController::class, 'createAppointment']);
Route::get('/appointments/upcoming/{userID}', [AppointmentsController::class, 'getCurrentAppointments']);
// Route::get('/appointments/all/{userID}', [AppointmentsController::class, 'getAllAppointmentsByUser']);
Route::put('/appointments/cancel/{userID}/{appointmentID}', [AppointmentsController::class, 'cancelAppointment']);


// Get Cart

Route::get('/cart/{userID}', [CartController::class, 'getUserCart']);
