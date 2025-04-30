<?php
// app/Http/Controllers/BusController.php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Complex;
use App\Models\User;
use Illuminate\Http\Request;

class BusController extends Controller
{
    public function index()
    {
        $buses = Bus::with(['driver', 'complex'])->get();
        return view('passenger.buses.index', compact('buses'));
    }

    public function create()
    {
        $drivers = User::where('role', 'driver')->get();
        $complexes = Complex::all();
        return view('passenger.buses.create', compact('drivers', 'complexes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'driver_id' => 'required|exists:users,id',
            'complex_id' => 'required|exists:complexes,id',
            'plate_number' => 'required|string|unique:buses',
            'departure_time' => 'required|date_format:H:i',
            'estimated_arrival_time' => 'required|date_format:H:i|after:departure_time',
            'from_location' => 'required|string',
            'to_location' => 'required|string',
            'total_capacity' => 'required|integer|min:1',
            'fee' => 'required|numeric|min:0',
            'status1' => 'required|in:Being packed,On the way,Reached',
            'status2' => 'required|in:Full,Has empty seats',
        ]);

        Bus::create($validated);

        return redirect()->route('buses.index')->with('success', 'Bus created successfully.');
    }

    public function show(Bus $bus)
    {
        $bus->load(['driver', 'complex', 'passengers', 'reviews']);
        return view('passenger.buses.show', compact('bus'));
    }

    public function edit(Bus $bus)
    {
        $drivers = User::where('role', 'driver')->get();
        $complexes = Complex::all();
        return view('passenger.buses.edit', compact('bus', 'drivers', 'complexes'));
    }

    public function update(Request $request, Bus $bus)
    {
        $validated = $request->validate([
            'driver_id' => 'required|exists:users,id',
            'complex_id' => 'required|exists:complexes,id',
            'plate_number' => 'required|string|unique:buses,plate_number,' . $bus->id,
            'departure_time' => 'required|date_format:H:i',
            'estimated_arrival_time' => 'required|date_format:H:i|after:departure_time',
            'from_location' => 'required|string',
            'to_location' => 'required|string',
            'total_capacity' => 'required|integer|min:1',
            'occupied_seats' => 'integer|min:0|max:total_capacity',
            'fee' => 'required|numeric|min:0',
            'status1' => 'required|in:Being packed,On the way,Reached',
            'status2' => 'required|in:Full,Has empty seats',
        ]);

        $bus->update($validated);

        return redirect()->route('buses.index')->with('success', 'Bus updated successfully.');
    }

    public function destroy(Bus $bus)
    {
        $bus->delete();
        return redirect()->route('buses.index')->with('success', 'Bus deleted successfully.');
    }

    public function updateLocation(Request $request, Bus $bus)
    {
        $validated = $request->validate([
            'current_latitude' => 'required|numeric',
            'current_longitude' => 'required|numeric',
        ]);

        $bus->update($validated);

        return response()->json(['message' => 'Location updated successfully']);
    }
}