<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RobotController;
use App\Http\Controllers\FactionController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/robots', [RobotController::class, 'index']);
Route::post('/robots', [RobotController::class, 'store']);
Route::put('/robots/{id}', [RobotController::class, 'update']);
Route::delete('/robots/{id}', [RobotController::class, 'destroy']);


Route::get('/factions', [FactionController::class, 'index']);
Route::post('/factions', [FactionController::class, 'store']);
Route::put('/factions/{id}', [FactionController::class, 'update']);
Route::delete('/factions/{id}', [FactionController::class, 'destroy']);

