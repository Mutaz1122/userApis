<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\userApiController;
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
Route::post('/auth/login', [UserController::class, 'loginUser']);

Route::post('/auth/register', [UserController::class, 'createUser']);
Route::get('/users', [userApiController::class, 'index']);
Route::get('/users/{id}', [userApiController::class, 'show']);
Route::post('/users/create', [userApiController::class, 'create']);
Route::delete('/users/{id}', [userApiController::class, 'destroy']);
Route::post('/users/{id}', [userApiController::class, 'update']);





