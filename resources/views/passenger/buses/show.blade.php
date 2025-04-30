@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Bus Details: {{ $bus->plate_number }}</h4>
                        @auth
                            @if(auth()->user()->role === 'admin')
                                <div>
                                    <a href="{{ route('buses.edit', $bus) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>

                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p><strong>Plate Number:</strong> {{ $bus->plate_number }}</p>
                            <p><strong>Driver:</strong> {{ $bus->driver->name }}</p>
                            <p><strong>Complex:</strong> {{ $bus->complex->name }}</p>
                            <p><strong>Current Location:</strong> 
                                @if($bus->current_latitude && $bus->current_longitude)
                                    <a href="https://maps.google.com/?q={{ $bus->current_latitude }},{{ $bus->current_longitude }}" target="_blank">
                                        View on Map
                                    </a>
                                @else
                                    Not available
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Departure Time:</strong> {{ $bus->departure_time }}</p>
                            <p><strong>Estimated Arrival:</strong> {{ $bus->estimated_arrival_time }}</p>
                            <p><strong>Route:</strong> {{ $bus->from_location }} → {{ $bus->to_location }}</p>
                            <p><strong>Fee:</strong> ${{ number_format($bus->fee, 2) }}</p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p><strong>Capacity:</strong> 
                                <span class="{{ $bus->occupied_seats >= $bus->total_capacity ? 'text-danger' : 'text-success' }}">
                                    {{ $bus->occupied_seats }}/{{ $bus->total_capacity }}
                                </span>
                            </p>
                            <p><strong>Status:</strong> 
                                <span class="badge badge-{{ $bus->status1 == 'Reached' ? 'success' : ($bus->status1 == 'On the way' ? 'warning' : 'info') }}">
                                    {{ $bus->status1 }}
                                </span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Availability:</strong> 
                                <span class="badge badge-{{ $bus->status2 == 'Full' ? 'danger' : 'success' }}">
                                    {{ $bus->status2 }}
                                </span>
                            </p>
                            <p><strong>Passengers:</strong> {{ $bus->passengers->count() }}</p>
                        </div>
                    </div>

                    @if($bus->reviews->count() > 0)
                    <div class="mb-4">
                        <h5>Reviews</h5>
                        <div class="d-flex align-items-center mb-3">
                            @php
                                $averageRating = $bus->reviews->avg('rating');
                                $reviewCount = $bus->reviews->count();
                            @endphp
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star{{ $i <= round($averageRating) ? ' text-warning' : ' text-secondary' }}"></i>
                            @endfor
                            <span class="ml-2">{{ number_format($averageRating, 1) }} ({{ $reviewCount }} reviews)</span>
                        </div>
                        
                        <div class="mb-3">
                            <a href="{{ route('reviews.index', $bus) }}" class="btn btn-sm btn-outline-primary">
                                View All Reviews
                            </a>
                            @auth
                                @if(auth()->user()->role === 'passenger' && !$bus->reviews->where('user_id', auth()->id())->count())
                                    <a href="{{ route('reviews.create', $bus) }}" class="btn btn-sm btn-primary ml-2">
                                        Write a Review
                                    </a>
                                @endif
                            @endauth
                        </div>
                    </div>
                    @else
                    <div class="alert alert-info">
                        No reviews yet for this bus.
                        @auth
                            @if(auth()->user()->role === 'passenger')
                                <a href="{{ route('reviews.create', $bus) }}" class="btn btn-sm btn-primary ml-2">
                                    Be the first to review
                                </a>
                            @endif
                        @endauth
                    </div>
                    @endif

                    @if($bus->passengers->count() > 0)
                    <div class="mt-4">
                        <h5>Passengers</h5>
                        <ul class="list-group">
                            @foreach($bus->passengers as $passenger)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $passenger->name }}
                                    <span class="badge badge-primary badge-pill">
                                        Seat {{ $loop->iteration }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection