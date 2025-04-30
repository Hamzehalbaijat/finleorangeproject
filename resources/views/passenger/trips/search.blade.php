@extends('layouts.passenger')

@section('title', 'Search Results')

@section('header', 'Available Bus Trips')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-4 mb-4">
            <!-- Filters -->
            <div class="card">
                <div class="card-header bg-orange text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-filter me-2"></i> Filters
                    </h5>
                </div>
                <div class="card-body">
                    <form id="filterForm">
                        <div class="mb-3">
                            <label class="form-label">Departure Time</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="morning" name="time[]" value="morning" checked>
                                <label class="form-check-label" for="morning">
                                    <i class="fas fa-sun me-1"></i> Morning (5AM - 12PM)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="afternoon" name="time[]" value="afternoon" checked>
                                <label class="form-check-label" for="afternoon">
                                    <i class="fas fa-cloud-sun me-1"></i> Afternoon (12PM - 5PM)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="evening" name="time[]" value="evening" checked>
                                <label class="form-check-label" for="evening">
                                    <i class="fas fa-moon me-1"></i> Evening (5PM - 12AM)
                                </label>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Bus Status</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="hasSeats" name="status[]" value="has_seats" checked>
                                <label class="form-check-label" for="hasSeats">
                                    <i class="fas fa-chair me-1"></i> Has Available Seats
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="almostFull" name="status[]" value="almost_full" checked>
                                <label class="form-check-label" for="almostFull">
                                    <i class="fas fa-exclamation-triangle me-1"></i> Almost Full
                                </label>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Price Range</label>
                            <div id="priceSlider" class="mb-2"></div>
                            <div class="d-flex justify-content-between">
                                <span id="minPrice">0 JOD</span>
                                <span id="maxPrice">20 JOD</span>
                            </div>
                            <input type="hidden" id="minPriceInput" name="min_price" value="0">
                            <input type="hidden" id="maxPriceInput" name="max_price" value="20">
                        </div>
                        
                        <button type="submit" class="btn btn-orange w-100">
                            <i class="fas fa-filter me-1"></i> Apply Filters
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Complex Information -->
            <div class="card mt-4">
                <div class="card-header bg-orange text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-map-marker-alt me-2"></i> Bus Complex
                    </h5>
                </div>
                <div class="card-body">
                    <h6 class="card-title">{{ $fromComplex->name }}</h6>
                    <p class="card-text text-muted small">
                        <i class="fas fa-location-dot me-1"></i> {{ $fromComplex->location }}
                    </p>
                    <p class="card-text">{{ $fromComplex->description }}</p>
                    
                    <div class="mt-3">
                        <img src="{{ asset('storage/' . $fromComplex->image) }}" alt="{{ $fromComplex->name }}" class="img-fluid rounded">
                    </div>
                    
                    <div class="mt-3">
                        <a href="#" class="btn btn-sm btn-outline-orange w-100" data-bs-toggle="modal" data-bs-target="#complexMapModal">
                            <i class="fas fa-map me-1"></i> View on Map
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <!-- Search Results -->
            <div class="card">
                <div class="card-header bg-orange text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-bus me-2"></i> Available Buses
                        <span class="badge bg-white text-orange ms-2">{{ $buses->count() }}</span>
                    </h5>
                    <div>
                        <span class="me-2">{{ $from }} → {{ $to }}</span>
                    </div>
                </div>
                
                <div class="card-body">
                    @if($buses->isEmpty())
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            No buses found for your search criteria. Please try different filters or check back later.
                        </div>
                    @else
                        <div class="list-group">
                            @foreach($buses as $bus)
                            <div class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <div class="mb-1">
                                        <h5 class="mb-1">
                                            <i class="fas fa-bus text-orange me-2"></i>
                                            {{ $bus->plate_number }}
                                            <span class="badge bg-{{ $bus->status2 === 'Has empty seats' ? 'success' : 'warning' }} ms-2">
                                                {{ $bus->status2 }}
                                            </span>
                                        </h5>
                                        <small class="text-muted">
                                            <i class="fas fa-user-tie me-1"></i> Driver: {{ $bus->driver->name }}
                                        </small>
                                    </div>
                                    <div class="text-end">
                                        <h5 class="text-orange mb-1">JOD {{ number_format($bus->fee, 2) }}</h5>
                                        <small class="text-muted">
                                            {{ $bus->occupied_seats }}/{{ $bus->total_capacity }} seats
                                        </small>
                                    </div>
                                </div>
                                
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <p class="mb-1">
                                            <i class="fas fa-clock me-1 text-orange"></i>
                                            <strong>Departure:</strong> {{ $bus->departure_time }}
                                        </p>
                                        <p class="mb-1">
                                            <i class="fas fa-map-marker-alt me-1 text-orange"></i>
                                            {{ $bus->complex->name }}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="mb-1">
                                            <i class="fas fa-clock me-1 text-orange"></i>
                                            <strong>Arrival:</strong> {{ $bus->estimated_arrival_time }}
                                        </p>
                                        <p class="mb-1">
                                            <i class="fas fa-map-marker-alt me-1 text-orange"></i>
                                            {{ $bus->to_location }}
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <div>
                                        <span class="badge bg-{{ $bus->status1 === 'Being packed' ? 'info' : ($bus->status1 === 'On the way' ? 'primary' : 'success') }}">
                                            {{ $bus->status1 }}
                                        </span>
                                    </div>
                                    <div>
                                        <a href="{{ route('passenger.trips.book', $bus->id) }}" class="btn btn-sm btn-orange">
                                            <i class="fas fa-ticket-alt me-1"></i> Book Now
                                        </a>
                                        <button class="btn btn-sm btn-outline-orange" data-bs-toggle="modal" data-bs-target="#busDetailsModal{{ $bus->id }}">
                                            <i class="fas fa-info-circle me-1"></i> Details
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Bus Details Modal -->
                            <div class="modal fade" id="busDetailsModal{{ $bus->id }}" tabindex="-1" aria-labelledby="busDetailsModalLabel{{ $bus->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-orange text-white">
                                            <h5 class="modal-title" id="busDetailsModalLabel{{ $bus->id }}">
                                                <i class="fas fa-bus me-2"></i> Bus Details
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h6>Bus Information</h6>
                                                    <ul class="list-group list-group-flush mb-3">
                                                        <li class="list-group-item d-flex justify-content-between">
                                                            <span>Plate Number:</span>
                                                            <strong>{{ $bus->plate_number }}</strong>
                                                        </li>
                                                        <li class="list-group-item d-flex justify-content-between">
                                                            <span>Driver:</span>
                                                            <strong>{{ $bus->driver->name }}</strong>
                                                        </li>
                                                        <li class="list-group-item d-flex justify-content-between">
                                                            <span>Capacity:</span>
                                                            <strong>{{ $bus->total_capacity }} seats</strong>
                                                        </li>
                                                        <li class="list-group-item d-flex justify-content-between">
                                                            <span>Available:</span>
                                                            <strong>{{ $bus->total_capacity - $bus->occupied_seats }} seats</strong>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6>Trip Information</h6>
                                                    <ul class="list-group list-group-flush mb-3">
                                                        <li class="list-group-item d-flex justify-content-between">
                                                            <span>Route:</span>
                                                            <strong>{{ $bus->from_location }} → {{ $bus->to_location }}</strong>
                                                        </li>
                                                        <li class="list-group-item d-flex justify-content-between">
                                                            <span>Departure:</span>
                                                            <strong>{{ $bus->departure_time }}</strong>
                                                        </li>
                                                        <li class="list-group-item d-flex justify-content-between">
                                                            <span>Arrival:</span>
                                                            <strong>{{ $bus->estimated_arrival_time }}</strong>
                                                        </li>
                                                        <li class="list-group-item d-flex justify-content-between">
                                                            <span>Fee:</span>
                                                            <strong class="text-orange">JOD {{ number_format($bus->fee, 2) }}</strong>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            
                                            <div class="mt-3">
                                                <h6>Current Status</h6>
                                                <div class="alert alert-{{ $bus->status1 === 'Being packed' ? 'info' : ($bus->status1 === 'On the way' ? 'primary' : 'success') }}">
                                                    <i class="fas fa-info-circle me-2"></i>
                                                    <strong>{{ $bus->status1 }}</strong> - 
                                                    {{ $bus->status2 === 'Full' ? 'This bus is currently full' : 'This bus has available seats' }}
                                                </div>
                                            </div>
                                            
                                            @if($bus->status2 === 'Has empty seats')
                                            <div class="mt-3 text-center">
                                                <a href="{{ route('passenger.trips.book', $bus->id) }}" class="btn btn-orange btn-lg w-100">
                                                    <i class="fas fa-ticket-alt me-2"></i> Book This Bus
                                                </a>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                        <div class="mt-3">
                            {{ $buses->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Complex Map Modal -->
<div class="modal fade" id="complexMapModal" tabindex="-1" aria-labelledby="complexMapModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-orange text-white">
                <h5 class="modal-title" id="complexMapModalLabel">
                    <i class="fas fa-map me-2"></i> {{ $fromComplex->name }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="complexMap" style="height: 400px; width: 100%;"></div>
                <div class="mt-3">
                    <p><i class="fas fa-location-dot me-1 text-orange"></i> <strong>Address:</strong> {{ $fromComplex->location }}</p>
                    <p><i class="fas fa-phone me-1 text-orange"></i> <strong>Contact:</strong> +962 {{ $fromComplex->phone }}</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="https://www.google.com/maps?q={{ $fromComplex->latitude }},{{ $fromComplex->longitude }}" 
                   target="_blank" class="btn btn-orange">
                    <i class="fas fa-external-link-alt me-1"></i> Open in Google Maps
                </a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize complex map modal
    const complexMap = new google.maps.Map(document.getElementById('complexMap'), {
        center: {lat: {{ $fromComplex->latitude }}, lng: {{ $fromComplex->longitude }}},
        zoom: 15
    });
    
    new google.maps.Marker({
        position: {lat: {{ $fromComplex->latitude }}, lng: {{ $fromComplex->longitude }}},
        map: complexMap,
        title: '{{ $fromComplex->name }}'
    });
    
    // Price range slider
    const priceSlider = document.getElementById('priceSlider');
    const minPrice = document.getElementById('minPrice');
    const maxPrice = document.getElementById('maxPrice');
    const minPriceInput = document.getElementById('minPriceInput');
    const maxPriceInput = document.getElementById('maxPriceInput');
    
    noUiSlider.create(priceSlider, {
        start: [0, 20],
        connect: true,
        range: {
            'min': 0,
            'max': 20
        },
        step: 1
    });
    
    priceSlider.noUiSlider.on('update', function(values, handle) {
        if (handle) {
            maxPrice.textContent = values[handle] + ' JOD';
            maxPriceInput.value = values[handle];
        } else {
            minPrice.textContent = values[handle] + ' JOD';
            minPriceInput.value = values[handle];
        }
    });
    
    // Filter form submission
    document.getElementById('filterForm').addEventListener('submit', function(e) {
        e.preventDefault();
        // Here you would typically make an AJAX request to filter the results
        // For now, we'll just show an alert
        alert('Filters applied! (This would refresh the results in a real application)');
    });
});
</script>
@endpush

@push('styles')
<style>
    .btn-orange {
        background-color: #fd7e14;
        color: white;
    }
    .btn-orange:hover {
        background-color: #e67312;
        color: white;
    }
    .btn-outline-orange {
        color: #fd7e14;
        border-color: #fd7e14;
    }
    .btn-outline-orange:hover {
        background-color: #fd7e14;
        color: white;
    }
    .bg-orange {
        background-color: #fd7e14;
    }
    .text-orange {
        color: #fd7e14;
    }
    .list-group-item:hover {
        background-color: #f8f9fa;
    }
    .noUi-connect {
        background: #fd7e14;
    }
</style>
@endpush
@endsection