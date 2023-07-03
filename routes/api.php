<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OefeningController;
use App\Http\Controllers\PrestatiesController;
use App\Http\Controllers\AuthenticationController;


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
Route::apiResource('oefeningen', OefeningController::class)->only(['index', 'show']);
Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {

// PROTECTED ROUTES
    Route::apiResource('oefeningen', OefeningController::class)->except(['index', 'show']);
    Route::apiResource('prestatie', PrestatiesController::class);
    Route::get('/mijnprestaties/{id}', [PrestatiesController::class, 'index']);
    Route::get('profile', function(Request $request) { return auth()->user();});
    Route::post('/logout', [AuthenticationController::class, 'logout']);

});