<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\TimeslotController;
use App\Http\Controllers\EventController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// User routes
Route::apiResource('users', UserController::class);

// Building routes
Route::apiResource('buildings', BuildingController::class);

// Room routes
Route::apiResource('rooms', RoomController::class);

// Reservation routes
Route::apiResource('reservations', ReservationController::class);

// Course routes
Route::apiResource('courses', CourseController::class);

// Timeslot routes
Route::apiResource('timeslots', TimeslotController::class);

// Event routes
Route::apiResource('events', EventController::class);