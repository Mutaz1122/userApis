<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\authController;
use App\Http\Controllers\user\UserController;
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

// routes prefix , auth controller, name convintion of lohin

Route::prefix('auth')->group(function () {
    Route::post('/login', [authController::class, 'login']);
    Route::post('/register', [authController::class, 'register']);
});




// routes:: resource api

Route::resource('users', UserController::class);

// Route::get('/users', [userController::class, 'index']);
// Route::get('/users/{user}', [userController::class, 'show']);
// Route::post('/users', [userController::class, 'create']);
// Route::delete('/users/{user}', [userController::class, 'destroy']);
// Route::put('/users/{user}', [userController::class, 'update']);


// company name, describ, logo, size, market size 




