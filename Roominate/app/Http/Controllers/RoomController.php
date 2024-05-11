<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        return Room::all();
    }

    public function show($id)
    {
        return Room::findOrFail($id);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'building_id' => 'required|integer|exists:buildings,id',
            'floor' => 'required|integer',
            'number' => 'required|max:50',
            'capacity' => 'required|integer'
        ]);

        $room = Room::create($validated);
        return response()->json($room, 201);
    }

    public function update(Request $request, $id)
    {
        $room = Room::findOrFail($id);
        $room->update($request->all());
        return response()->json($room, 200);
    }

    public function destroy($id)
    {
        Room::destroy($id);
        return response()->json(null, 204);
    }
}
