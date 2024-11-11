<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();



Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/companies/data', [App\Http\Controllers\CompanyController::class, 'getdata'])->name('companies.data');
    Route::resource('companies', App\Http\Controllers\CompanyController::class);
    Route::get('/employees/data', [App\Http\Controllers\EmployeeController::class, 'getdata'])->name('employees.data');
    Route::resource('employees', App\Http\Controllers\EmployeeController::class);
});
