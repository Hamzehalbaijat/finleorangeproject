@extends('layouts.passenger')

@section('title', 'Active Trips')

@section('header', 'My Active Trips')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-orange text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fas fa-clock me-2"></i> Active Trips
                        </h4>
                        <a href="{{ route('passenger.trips.index') }}" class="btn btn-sm btn-light">
                            <i class="fas fa-history me-1"></i> View All Trips
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    @if($activeTrips->isEmpty())
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            You don't have any active trips right now. 
                            <a href="{{ route('passenger.trips.search') }}" class="text-orange">Search for buses</a> to book a new trip.
                        </div>
                    @else
                        <div class="row">
                            @foreach($activeTrips as $trip)
                            <div class="col-md-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">
                                            <i class="fas fa-bus me-2 text-orange"></i>
                                            {{ $trip->bus->plate_number }}
                                        </h5>
                                        <span class="badge bg-{{ $trip->status === 'on_board' ? 'primary' : 'warning' }}">
                                            {{ ucfirst($trip->status) }}
                                        </span>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Pickup</h6>
                                                <p class="mb-1"><strong>Location:</strong> {{ $trip->pickup_location }}</p>
                                                <p class="mb-1"><strong>Time:</strong> {{ $trip->bus->departure_time }}</p>
                                                <p class="mb-0"><strong>Complex:</strong> {{ $trip->bus->complex->name }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Destination</h6>
                                                <p class="mb-1"><strong>Location:</strong> {{ $trip->destination }}</p>
                                                <p class="mb-1"><strong>ETA:</strong> {{ $trip->bus->estimated_arrival_time }}</p>
                                                <p class="mb-0"><strong>Status:</strong> 
                                                    @if($trip->status === 'on_board')
                                                        On the way
                                                    @else
                                                        Waiting at complex
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                        
                                        <hr>
                                        
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <p class="mb-0"><strong>Driver:</strong> {{ $trip->bus->driver->name }}</p>
                                                <p class="mb-0"><strong>Amount Paid:</strong> JOD {{ number_format($trip->bus->fee, 2) }}</p>
                                            </div>
                                            <div>
                                                <a href="{{ route('passenger.trips.show', $trip->id) }}" class="btn btn-sm btn-orange">
                                                    <i class="fas fa-eye me-1"></i> View Details
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .bg-orange {
        background-color: #fd7e14;
    }
    .btn-orange {
        background-color: #fd7e14;
        color: white;
    }
    .btn-orange:hover {
        background-color: #e67312;
        color: white;
    }
    .text-orange {
        color: #fd7e14;
    }
    .card {
        transition: transform 0.2s;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
</style>
@endpush