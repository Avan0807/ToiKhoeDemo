<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AppointmentsController;
use App\Models\Appointment;
use App\Http\Controllers\UsersController;

// Authentication Routes
Route::group(['prefix' => 'api/auth'], function () {
    Route::post('/register', 'Auth\RegisterController@apiRegister');
    Route::post('/login', 'Auth\LoginController@apilogin');
    Route::post('/login/doctor', 'Auth\LoginController@apidoctorLogin');
    Route::post('/logout', 'Auth\LoginController@apilogout');
});

// User Routes
Route::group(['prefix' => 'api/user'], function () {
    Route::post('/{userID}/upload-avatar', 'UsersController@apiuploadAvatar');
    Route::get('/{userID}/get-avatar', 'UsersController@apigetAvatarByUserId');
    Route::put('/{userID}/address', 'UsersController@apiupdateAddress');
});
Route::get('/users/{userID}', [UsersController::class, 'apiGetUserByID']);

// Doctors Routes
Route::group(['prefix' => 'api/doctors'], function () {
    Route::get('/', 'GetdoctorsController@apihome')->middleware('auth:sanctum');
    Route::get('/all', 'DoctorsController@apigetAllDoctors');
    Route::get('/{doctorID}', 'DoctorsController@apigetDoctorsByDoctorId');
});

// Products Routes
Route::group(['prefix' => 'api/products'], function () {
    Route::get('/', 'ProductController@apigetAllProducts');
    Route::get('/{id}', 'ProductController@apigetProductById');
});

// Appointments Routes
Route::group(['prefix' => 'api/appointments'], function () {
    Route::get('/', 'AppointmentsController@apigetAllAppointments');
    Route::get('/{userID}', 'AppointmentsController@apigetAppointmentsByUser');
    Route::post('/{userID}', 'AppointmentsController@apicreateAppointment');
    Route::get('/upcoming/{userID}', 'AppointmentsController@apigetCurrentAppointments');
    Route::put('/cancel/{userID}/{appointmentID}', 'AppointmentsController@apicancelAppointment');
    //Update status
    // Route::put('/{appointmentID}/confirm', 'AppointmentsController@apiConfirmAppointment');
});
Route::post('appointments/{userID}/create', [AppointmentsController::class, 'apicreateAppointment']);
//Update status
Route::put('/appointments/{appointmentID}/confirm', [AppointmentsController::class, 'apiConfirmAppointment']);
Route::put('/appointments/{appointmentID}/complete', [AppointmentsController::class, 'apiCompleteAppointment']);
//Get appointmet buy DoctorID
Route::get('/appointments/doctor/{doctorID}/all', [AppointmentsController::class, 'apiGetAllAppointmentsByDoctor']);
Route::get('/appointments/doctor/{doctorID}/recent', [AppointmentsController::class, 'apiGetRecentAppointments']);
Route::delete('/appointments/{appointmentID}/reject', [AppointmentsController::class, 'apiDeleteAppointment']);


// Cart Routes
Route::group(['prefix' => 'api/cart'], function () {
    Route::get('/{userID}', 'CartController@apigetUserCart');
    Route::post('/add', 'CartController@apiaddProductToCart')->middleware('auth:sanctum');
    Route::delete('/{userId}/{productId}', 'CartController@apiremoveFromCartByUser');
    Route::put('/{userId}/{productId}', 'CartController@apiupdateUserCartQuantity');
});


// Posts Routes
Route::group(['prefix' => 'api/posts'], function () {
    Route::get('/', 'PostController@apigetAllPosts');
    Route::get('/{slug}', 'PostController@apigetPostBySlug');
});

// Default User Route
Route::middleware('auth:sanctum')->get('/api/user', function (Request $request) {
    return $request->user();
});
