<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\TimeslotController;
use App\Http\Controllers\EventController;
use App\Models\User;

Route::post('/auth/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json([
            'message' => 'The provided credentials are incorrect.'
        ], 401);
    }

    $tokenResult = $user->createToken('API Token');
    $token = $tokenResult->plainTextToken;

    return response()->json([
        'token' => $token,
        'user' => $user->email
    ]);
});
Route::post('/register', [UserController::class, 'store']);

Route::middleware('auth:sanctum')->group(function (){
    // Retrieve user information
    Route::get('/user', function (Request $request) {
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
});