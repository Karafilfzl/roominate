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

// Registers a new user
Route::post('/register', [UserController::class, 'store']);

// Authenticates a user and issues a token
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

// Grouping protected routes
Route::middleware('auth:sanctum')->group(function (){
    // Retrieve user information
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Instead of using the use statement, directly use the full namespace in the route definition
    Route::apiResource('reservations', '\App\Http\Controllers\ReservationController');


    // Admin specific routes
    Route::group(['middleware' => ['role:admin']], function() {
        Route::apiResource('users', UserController::class);
    });

    // Accessible to users with 'manage buildings' permission
    Route::group(['middleware' => ['permission:manage buildings']], function() {
        Route::apiResource('buildings', BuildingController::class);
    });

    // General user accessible routes
    Route::apiResource('rooms', RoomController::class);
    Route::apiResource('reservations', ReservationController::class);
    Route::apiResource('courses', CourseController::class);
    Route::apiResource('timeslots', TimeslotController::class);
    Route::apiResource('events', EventController::class);
});

// Route not found
Route::fallback(function(){
    return response()->json(['message' => 'Route not found'], 404);
});
