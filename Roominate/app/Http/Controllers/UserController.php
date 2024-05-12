<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('some-middleware')->except(['store']);
    }
     
    public function index()
    {
        return User::all();
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function store(StoreUserRequest $request) 
    {
        \Log::info('Registering a new user with email: ' . $request->email);
        $validatedData = $request->validated();  // The validated data is already handled by StoreUserRequest

        // Hash the password after validation
        $validatedData['password'] = Hash::make($validatedData['password']);

        $user = User::create($validatedData);

        return response()->json(['user' => $user, 'message' => 'User successfully registered'], 201);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'email' => 'string|email|unique:users,email,' . $user->id,
            'password' => 'sometimes|required|string|min:6'
        ]);

        $user->fill($request->only(['first_name', 'last_name', 'email', 'role']));

        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return response()->json($user);
    }

    public function destroy($id)
    {
        User::destroy($id);
        return response()->json(null, 204);
    }
}
