<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::post('/login', [App\Http\Controllers\Api\LoginController::class, 'login']);  
use App\Http\Controllers\Api\AuthController;

Route::middleware('auth:sanctum')->post('/logout', [App\Http\Controllers\Api\LoginController::class, 'logout']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('employees', [App\Http\Controllers\Api\EmployeeController::class, 'index']);  
});