<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GetdoctorsController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DoctorsController;
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

// Logout
Route::post('/logout', [LoginController::class, 'logout']);

// Get list doctor
// Route::middleware('auth:sanctum')->get('/doctors', [GetdoctorsController::class, 'home']);
Route::middleware('auth:sanctum')->get('/doctors', [GetdoctorsController::class, 'home']);


//Get product
Route::get('/products', [ProductController::class, 'getAllProducts']);
Route::get('/products/{id}', [ProductController::class, 'getProductById']);


//Get doctors controller
Route::get('/alldoctors', [DoctorsController::class, 'getAllDoctors']);
