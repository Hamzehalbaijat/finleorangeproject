<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complex;
use App\Models\Trip; // Make sure to import the Trip model
use App\Models\Payment; // Import Payment model if needed for recent payments
use App\Models\Notification; // Import Notification model if needed
use App\Models\Bus;
class PassengerController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth'); // Ensure user is authenticated
    }

    public function dashboard()
{
    $passenger = auth()->user();
    $complexes = Complex::all();
    
    // Add this query to get available buses
    $availableBuses = Bus::where('status1', 'On the way')
                       ->where('status2', 'Has empty seats')
                       ->with(['driver', 'complex'])
                       ->get();
    
    $activeTripsCount = Trip::where('user_id', $passenger->id)
                          ->whereIn('status', ['waiting', 'on_board'])
                          ->count();
    
    $unreadNotificationsCount = $passenger->unreadNotifications()->count();
    
    // $upcomingTrips = Trip::where('user_id', $passenger->id)
    //                    ->where('departure_time', '>=', now())
    //                    ->where('departure_time', '<=', now()->addDays(7))
    //                    ->orderBy('departure_time')
    //                    ->get();
    
    $recentPayments = Payment::where('user_id', $passenger->id)
                           ->orderBy('created_at', 'desc')
                           ->take(5) 
                           ->get();
    
    return view('passenger.dashboard', compact(
        'complexes',
        'activeTripsCount',
        'unreadNotificationsCount',
        // 'upcomingTrips',
        'recentPayments',
        'availableBuses' 
    ));
}
    
    public function activeTrips()
    {
        $passenger = auth()->user();
        
        $activeTrips = Trip::where('user_id', $passenger->id)
                         ->whereIn('status', ['waiting', 'on_board'])
                         ->with(['bus', 'bus.driver', 'bus.complex'])
                         ->get();
        
        return view('passenger.trips.active', [
            'activeTrips' => $activeTrips
        ]);
    }
    
    // Add more passenger-specific methods
}