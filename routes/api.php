<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\FamilyMemberController;
use App\Http\Controllers\FamilyController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [ProfileController::class, 'profile']);
    Route::post('/profile/personal', [ProfileController::class, 'updatePersonal']);
    Route::post('/profile/business', [ProfileController::class, 'updateBusiness']);
    Route::post('/profile/marital', [ProfileController::class, 'updateMarital']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::get('/states', [LocationController::class, 'states']);
Route::get('/districts/{state_id}', [LocationController::class, 'districts']);
Route::get('/sub-districts/{district_id}', [LocationController::class, 'subDistricts']);

Route::middleware('auth:sanctum')->post('/family-member/add',[FamilyMemberController::class, 'store']);
Route::middleware('auth:sanctum')->get('/family/list',[FamilyController::class, 'list']);
