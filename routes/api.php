<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use App\Http\Controllers\TenantController;

// Minimal OAuth route for token issuance
Route::post('/oauth/token', [AccessTokenController::class, 'issueToken']);

// Your app routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:api')->get('profile', [AuthController::class, 'profile']);
Route::post('tenants', [TenantController::class, 'store']);
