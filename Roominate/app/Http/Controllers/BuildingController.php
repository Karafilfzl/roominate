<?php
// Inside app/Http/Controllers/BuildingController.php

namespace App\Http\Controllers;

use App\Models\Building;
use Illuminate\Http\Request;

class BuildingController extends Controller
{
    public function index()
    {
        return Building::all();
    }

    public function show($id)
    {
        return Building::findOrFail($id);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'address' => 'required|max:255'
        ]);

        $building = Building::create($validated);
        return response()->json($building, 201);
    }

    public function update(Request $request, $id)
    {
        $building = Building::findOrFail($id);
        $building->update($request->all());
        return response()->json($building, 200);
    }

    public function destroy($id)
    {
        Building::destroy($id);
        return response()->json(null, 204);
    }
}
