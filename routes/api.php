<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
});

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
