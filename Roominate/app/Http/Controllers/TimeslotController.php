<?php

namespace App\Http\Controllers;

use App\Models\Timeslot;
use Illuminate\Http\Request;

class TimeslotController extends Controller
{
    public function index()
    {
        return Timeslot::all();
    }

    public function show($id)
    {
        return Timeslot::findOrFail($id);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i'
        ]);

        $timeslot = Timeslot::create($validated);
        return response()->json($timeslot, 201);
    }

    public function update(Request $request, $id)
    {
        $timeslot = Timeslot::findOrFail($id);
        $timeslot->update($request->all());
        return response()->json($timeslot, 200);
    }

    public function destroy($id)
    {
        Timeslot::destroy($id);
        return response()->json(null, 204);
    }
}
