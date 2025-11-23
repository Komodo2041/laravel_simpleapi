<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// ->middleware('auth:sanctum')
Route::get('/company', [\App\Http\Controllers\API\CompanyController::class, 'company']);
Route::post('/company/add', [\App\Http\Controllers\API\CompanyController::class, 'add']);
Route::delete('/company/delete/{id}', [\App\Http\Controllers\API\CompanyController::class, 'destroy']);
Route::post('/company/update/{id}', [\App\Http\Controllers\API\CompanyController::class, 'update']);

Route::post('/worker/add', [\App\Http\Controllers\API\WorkerController::class, 'add']);
Route::post('/worker/delete/{id}', [\App\Http\Controllers\API\WorkerController::class, 'destroy']);
Route::post('/worker/update/{id}', [\App\Http\Controllers\API\WorkerController::class, 'update']);