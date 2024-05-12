<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;


class ReservationController extends Controller
{
    public function index()
    {
        return Reservation::all();
    }

    public function show($id)
    {
        return Reservation::findOrFail($id);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'room_id' => 'required|integer|exists:rooms,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date'
        ]);

        $reservation = Reservation::create($validated);
        return response()->json($reservation, 201);
    }

    public function update(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
            $validated = $request->validate([
                'user_id' => 'required|integer|exists:users,id',
                'room_id' => 'required|integer|exists:rooms,id',
                'start_time' => 'required|date',
                'end_time' => 'required|date'
            ]);
        $reservation->update($request->all());
        return response()->json($reservation, 200);
    }

    public function destroy($id)
    {
        Reservation::destroy($id);
        return response()->json(null, 204);
    }

    public function downloadConfirmation($id)
    {
        $reservation = Reservation::findOrFail($id);
        $pdf = PDF::loadView('reservation-confirmation', compact('reservation'));
        return $pdf->download('reservation-confirmation-' . $id . '.pdf');
    }
}
