<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function index()
    {
        $trips = Trip::with(['bus', 'passenger'])->get();
        return view('passenger.trips.index', compact('trips'));
    }

    public function show(Trip $trip)
    {
        $trip->load(['bus', 'passenger', 'payment', 'review']);
        return view('trips.show', compact('trip'));
    }

    public function create()
    {
        return view('trips.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'bus_id' => 'required|exists:buses,id',
            'passenger_id' => 'required|exists:users,id',
            'pickup_location' => 'required|string',
            'pickup_latitude' => 'required|numeric',
            'pickup_longitude' => 'required|numeric',
            'destination' => 'required|string',
            'destination_latitude' => 'required|numeric',
            'destination_longitude' => 'required|numeric',
            'status' => 'required|in:waiting,on_board,dropped_off',
        ]);

        Trip::create($validated);

        return redirect()->route('trips.index')->with('success', 'Trip created successfully.');
    }

    // Add other methods as needed (edit, update, destroy)

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Trip $trip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trip $trip)
    {
        //
    }
}
