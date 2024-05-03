<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Timeslot;
use Illuminate\Http\Request;

class TimeslotController extends Controller
{
    public function index()
    {
        $timeslots = Timeslot::all();
        return response()->json($timeslots);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time'
        ]);

        $timeslot = Timeslot::create($validatedData);
        return response()->json($timeslot, 201);
    }

    public function show($id)
    {
        $timeslot = Timeslot::find($id);
        if (!$timeslot) {
            return response()->json(['message' => 'Timeslot not found'], 404);
        }
        return response()->json($timeslot);
    }

    public function update(Request $request, $id)
    {
        $timeslot = Timeslot::find($id);
        if (!$timeslot) {
            return response()->json(['message' => 'Timeslot not found'], 404);
        }

        $validatedData = $request->validate([
            'start_time' => 'date_format:H:i',
            'end_time' => 'date_format:H:i|after:start_time'
        ]);

        $timeslot->update($validatedData);
        return response()->json($timeslot);
    }

    public function destroy($id)
    {
        $timeslot = Timeslot::find($id);
        if (!$timeslot) {
            return response()->json(['message' => 'Timeslot not found'], 404);
        }

        $timeslot->delete();
        return response()->json(['message' => 'Timeslot deleted']);
    }
}