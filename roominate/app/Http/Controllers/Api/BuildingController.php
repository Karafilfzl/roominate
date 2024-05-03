<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Building;
use Illuminate\Http\Request;

class BuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buildings = Building::all();
        return response()->json($buildings);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'address' => 'required|max:255',
        ]);
        
        $building = Building::create($validatedData);
        return response()->json($building, 201);  
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $building = Building::find($id);
        if ($building) {
            return response()->json(['message' => 'Building not found'], 404);
        }
        return response()->json($building);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $building = Building::find($id);
        if (!$building) {
            return response()->json(['message' => 'Building not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'address' => 'required|max:255',
        ]);

        $building->update($validatedData);
        return response()->json($building);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $building = Building::find($id);
        if (!$building) {
            return response()->json(['message' => 'Building not found'], 404);
        }

        $building->delete();
        return response()->json(['message' => 'Building deleted']);
    }
}
