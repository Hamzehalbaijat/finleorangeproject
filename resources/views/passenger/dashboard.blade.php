@extends('layouts.passenger')

@section('title', 'Passenger Dashboard')

@section('hero-section')
<div class="hero-section">
    <!-- Modern Carousel with Gradient Overlay -->
    <div id="jordanHeroSlider" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#jordanHeroSlider" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#jordanHeroSlider" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#jordanHeroSlider" data-bs-slide-to="2"></button>
        </div>
        
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('images/img1.jpeg') }}" class="d-block w-100" alt="Jordan Buses">
                <div class="carousel-overlay"></div>
                <div class="carousel-caption animate__animated animate__fadeInUp">
                    <h2 class="display-4 mb-3 fw-bold">Comfortable Travel Across Jordan</h2>
                    <p class="lead">Find the best bus routes between cities</p>
                    <a href="#search-section" class="btn btn-primary btn-lg mt-3 scroll-button">
                        <i class="fas fa-search me-2"></i> Plan Your Trip
                    </a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/img2.jpeg') }}" class="d-block w-100" alt="Bus Stations">
                <div class="carousel-overlay"></div>
                <div class="carousel-caption animate__animated animate__fadeInUp">
                    <h2 class="display-4 mb-3 fw-bold">Modern Bus Stations</h2>
                    <p class="lead">Easy access to all major cities</p>
                    <a href="#search-section" class="btn btn-primary btn-lg mt-3 scroll-button">
                        <i class="fas fa-search me-2"></i> Plan Your Trip
                    </a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/img3.jpeg') }}" class="d-block w-100" alt="Payment Options">
                <div class="carousel-overlay"></div>
                <div class="carousel-caption animate__animated animate__fadeInUp">
                    <h2 class="display-4 mb-3 fw-bold">Multiple Payment Options</h2>
                    <p class="lead">Cash or NFC - Your choice</p>
                    <a href="#search-section" class="btn btn-primary btn-lg mt-3 scroll-button">
                        <i class="fas fa-search me-2"></i> Plan Your Trip
                    </a>
                </div>
            </div>
        </div>
        
        <button class="carousel-control-prev" type="button" data-bs-target="#jordanHeroSlider" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#jordanHeroSlider" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    
    <!-- Search Section with Floating Effect -->
    <div id="search-section" class="search-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="search-box p-4 shadow-lg rounded-3">
                        <h4 class="mb-4 text-center text-primary">
                            <i class="fas fa-route me-2"></i> خط سير الرحلة
                        </h4>
                        <form id="tripSearchForm" action="{{ route('passenger.trips.search') }}" method="GET">
                            <div class="row g-3 align-items-end">
                                <div class="col-md-4">
                                    <label for="from" class="form-label fw-bold">نقطة الانطلاق</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-primary text-white">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </span>
                                        <select class="form-select form-select-lg" id="from" name="from" required>
                                            <option value="">اختر نقطة الانطلاق</option>
                                            @foreach($complexes as $complex)
                                                <option value="{{ $complex->id }}" data-lat="{{ $complex->latitude }}" data-lng="{{ $complex->longitude }}">
                                                    {{ $complex->name }} - {{ $complex->location }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="to" class="form-label fw-bold">الوجهة</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-primary text-white">
                                            <i class="fas fa-flag-checkered"></i>
                                        </span>
                                        <select class="form-select form-select-lg" id="to" name="to" required>
                                            <option value="">اختر الوجهة</option>
                                            @foreach($complexes as $complex)
                                                <option value="{{ $complex->id }}" data-lat="{{ $complex->latitude }}" data-lng="{{ $complex->longitude }}">
                                                    {{ $complex->name }} - {{ $complex->location }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" id="useCurrentLocation" class="btn btn-outline-primary w-100 h-100 d-flex flex-column justify-content-center align-items-center">
                                        <i class="fas fa-location-arrow mb-2"></i>
                                        <span>الموقع الحالي</span>
                                    </button>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary btn-gradient w-100 h-100 d-flex flex-column justify-content-center align-items-center">
                                        <i class="fas fa-search mb-2"></i>
                                        <span>بحث</span>
                                    </button>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="multiBusTrip" name="multi_bus">
                                        <label class="form-check-label" for="multiBusTrip">رحلات متعددة الباصات</label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Map and Buses Section -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white border-0">
                        <h5 class="mb-0">
                            <i class="fas fa-map-marked-alt text-primary me-2"></i>
                            Route Map
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <div id="routeMap" class="map-container rounded-bottom"></div>
                        <div id="routeInfo" class="p-3">
                            <div class="alert alert-info mb-0 rounded-0 rounded-bottom">
                                <i class="fas fa-info-circle me-2"></i> اختر نقاط الانطلاق والوجهة لعرض المسار
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-bus me-2"></i> الباصات المتاحة
                        </h5>
                    </div>  
                    <div class="card-body p-0">
                        <div id="availableBusesList" class="buses-list">
                            <div class="list-group list-group-flush">
                                @forelse($availableBuses as $bus)
                                <div class="list-group-item bus-item" data-bus-id="{{ $bus->id }}" data-lat="{{ $bus->current_latitude }}" data-lng="{{ $bus->current_longitude }}">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="mb-1 fw-bold">{{ $bus->plate_number }}</h6>
                                            <small class="text-muted d-block">
                                                <i class="fas fa-user me-1"></i> السائق: {{ $bus->driver->name }}
                                            </small>
                                            <small class="text-muted d-block">
                                                <i class="fas fa-clock me-1"></i> المغادرة: {{ $bus->departure_time }}
                                            </small>
                                            <small class="text-muted d-block">
                                                <i class="fas fa-money-bill-wave me-1"></i> الأجرة: {{ $bus->fee }} دينار
                                            </small>
                                        </div>
                                        <span class="badge rounded-pill bg-{{ $bus->status2 == 'Full' ? 'danger' : 'success' }}">
                                            {{ $bus->status2 == 'Full' ? 'كامل' : 'مقاعد متاحة' }}
                                        </span>
                                    </div>
                                    <button class="btn btn-sm btn-primary mt-2 w-100 select-bus" data-bus-id="{{ $bus->id }}">
                                        <i class="fas fa-check me-1"></i> اختر هذا الباص
                                    </button>
                                </div>
                                @empty
                                <div class="list-group-item text-center py-4">
                                    <i class="fas fa-bus-slash fa-2x mb-2 text-muted"></i>
                                    <p class="mb-0">لا توجد باصات متاحة حالياً</p>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 
@section('content')
<div class="container py-5">
    <!-- Quick Stats Cards -->
    <div class="row mb-5">
        <div class="col-md-4 mb-4">
            <div class="card stat-card balance-card h-100">
                <div class="card-body text-center">
                    <div class="stat-icon bg-primary-light">
                        <i class="fas fa-wallet text-primary"></i>
                    </div>
                    <h3 class="card-title text-primary mt-3">
                        Your Balance
                    </h3>
                    <p class="display-5 fw-bold">JOD {{ number_format(auth()->user()->balance, 2) }}</p>
                    <a href="{{ route('passenger.payments.index') }}" class="btn btn-primary btn-sm mt-2">
                        <i class="fas fa-plus me-1"></i> Add Funds 
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card stat-card trips-card h-100">
                <div class="card-body text-center">
                    <div class="stat-icon bg-success-light">
                        <i class="fas fa-bus text-success"></i>
                    </div>
                    <h3 class="card-title text-success mt-3">
                        Active Trips
                    </h3>
                    <p class="display-5 fw-bold">{{ $activeTripsCount }}</p>
                    <a href="{{ route('passenger.trips.active') }}" class="btn btn-success btn-sm mt-2">
                        <i class="fas fa-eye me-1"></i> View Trips
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card stat-card notifications-card h-100">
                <div class="card-body text-center">
                    <div class="stat-icon bg-info-light">
                        <i class="fas fa-bell text-info"></i>
                    </div>
                    <h3 class="card-title text-info mt-3">
                        Notifications
                    </h3>
                    <p class="display-5 fw-bold">{{ $unreadNotificationsCount }}</p>
                    <a href="{{ route('passenger.notifications.index') }}" class="btn btn-info btn-sm mt-2">
                        <i class="fas fa-bell me-1"></i> View Alerts
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Upcoming Trips Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">
                            <i class="fas fa-calendar-alt text-primary me-2"></i> Upcoming Trips
                        </h3>
                        <a href="{{ route('passenger.trips.index') }}" class="btn btn-sm btn-outline-primary">
                            View All <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if($upcomingTrips->isEmpty())
                        <div class="empty-state text-center py-4">
                            <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No Upcoming Trips</h5>
                            <p class="text-muted">Search for buses to book your journey</p>
                            <a href="#search-section" class="btn btn-primary btn-sm scroll-button">
                                <i class="fas fa-search me-1"></i> Search Buses
                            </a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Bus</th>
                                        <th>Route</th>
                                        <th>Departure</th>
                                        <th>Arrival</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($upcomingTrips as $trip)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="bus-icon me-3">
                                                    <i class="fas fa-bus"></i>
                                                </div>
                                                <div>
                                                    <strong>{{ $trip->bus->plate_number }}</strong><br>
                                                    <small class="text-muted">Driver: {{ $trip->bus->driver->name }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="route-direction">
                                                <span class="from">{{ $trip->bus->from_location }}</span>
                                                <i class="fas fa-arrow-right mx-2 text-muted"></i>
                                                <span class="to">{{ $trip->bus->to_location }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="departure-info">
                                                <span class="time">{{ $trip->bus->departure_time }}</span><br>
                                                <small class="text-muted">{{ $trip->bus->complex->name }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="arrival-info">
                                                <span class="time">{{ $trip->bus->estimated_arrival_time }}</span><br>
                                                <small class="text-muted">{{ $trip->destination }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            @if($trip->status === 'waiting')
                                                <span class="badge bg-warning rounded-pill px-3 py-2">
                                                    <i class="fas fa-clock me-1"></i> Waiting
                                                </span>
                                            @elseif($trip->status === 'on_board')
                                                <span class="badge bg-primary rounded-pill px-3 py-2">
                                                    <i class="fas fa-bus me-1"></i> On Board
                                                </span>
                                            @else
                                                <span class="badge bg-success rounded-pill px-3 py-2">
                                                    <i class="fas fa-check-circle me-1"></i> Completed
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('passenger.trips.show', $trip->id) }}" class="btn btn-sm btn-outline-primary rounded-pill">
                                                <i class="fas fa-eye me-1"></i> Details
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <!-- Recent Payments Section -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">
                            <i class="fas fa-credit-card text-primary me-2"></i> Recent Payments
                        </h3>
                        <a href="{{ route('passenger.payments.history') }}" class="btn btn-sm btn-outline-primary">
                            View All <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if($recentPayments->isEmpty())
                        <div class="empty-state text-center py-4">
                            <i class="fas fa-money-bill-wave fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No Payment History</h5>
                            <p class="text-muted">Your payment transactions will appear here</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Method</th>
                                        <th>Bus</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentPayments as $payment)
                                    <tr>
                                        <td>
                                            <div class="payment-date">
                                                <div class="date">{{ $payment->created_at->format('M d, Y') }}</div>
                                                <div class="time text-muted">{{ $payment->created_at->format('H:i') }}</div>
                                            </div>
                                        </td>
                                        <td class="fw-bold">
                                            JOD {{ number_format($payment->amount, 2) }}
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark rounded-pill px-3">
                                                {{ strtoupper($payment->payment_method) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="bus-info">
                                                <div class="plate-number">{{ $payment->bus->plate_number }}</div>
                                                <div class="route text-muted small">
                                                    {{ $payment->bus->from_location }} → {{ $payment->bus->to_location }}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($payment->status === 'completed')
                                                <span class="badge bg-success rounded-pill px-3 py-2">
                                                    <i class="fas fa-check-circle me-1"></i> Completed
                                                </span>
                                            @elseif($payment->status === 'pending')
                                                <span class="badge bg-warning rounded-pill px-3 py-2">
                                                    <i class="fas fa-clock me-1"></i> Pending
                                                </span>
                                            @else
                                                <span class="badge bg-danger rounded-pill px-3 py-2">
                                                    <i class="fas fa-times-circle me-1"></i> Failed
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<style>
    /* Hero Section Styles */
    .hero-section {
        position: relative;
    }
    
    .carousel-item img {
        height: 70vh;
        object-fit: cover;
        filter: brightness(0.8);
    }
    
    .carousel-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.7) 100%);
    }
    
    .carousel-caption {
        bottom: 30%;
        text-align: left;
        padding-left: 5%;
        padding-right: 50%;
    }
    
    .carousel-caption h2 {
        font-size: 3rem;
        text-shadow: 2px 2px 8px rgba(0,0,0,0.8);
        line-height: 1.2;
    }
    
    .carousel-caption p {
        font-size: 1.5rem;
        text-shadow: 1px 1px 4px rgba(0,0,0,0.8);
    }
    
    .scroll-button {
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
    
    /* Search Section Styles */
    .search-section {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        position: relative;
        z-index: 10;
        margin-top: -50px;
    }
    
    .search-box {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: none;
        transition: all 0.3s ease;
    }
    
    .search-box:hover {
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        transform: translateY(-5px);
    }
    
    .btn-gradient {
        background: linear-gradient(to right, #4e54c8, #8f94fb);
        color: white;
        border: none;
    }
    
    /* Map Styles */
    .map-container {
        height: 500px;
        width: 100%;
        border-radius: 8px;
        overflow: hidden;
    }
    
    /* Buses List Styles */
    .buses-list {
        max-height: 500px;
        overflow-y: auto;
    }
    
    .buses-list::-webkit-scrollbar {
        width: 5px;
    }
    
    .buses-list::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    
    .buses-list::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
    }
    
    .buses-list::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
    
    .bus-item {
        transition: all 0.3s ease;
        border-left: 3px solid transparent;
    }
    
    .bus-item:hover {
        background-color: #f8f9fa;
        border-left: 3px solid #4e54c8;
    }
    
    /* Stats Cards */
    .stat-card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
        background: white;
    }
    
    .stat-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
    
    .stat-icon {
        width: 70px;
        height: 70px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 30px;
    }
    
    .balance-card .stat-icon {
        background-color: rgba(13, 110, 253, 0.1);
    }
    
    .trips-card .stat-icon {
        background-color: rgba(25, 135, 84, 0.1);
    }
    
    .notifications-card .stat-icon {
        background-color: rgba(13, 202, 240, 0.1);
    }
    
    /* Table Styles */
    .table-hover tbody tr {
        transition: all 0.3s ease;
    }
    
    .table-hover tbody tr:hover {
        transform: translateX(5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    
    .bus-icon {
        width: 40px;
        height: 40px;
        background-color: #f8f9fa;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #4e54c8;
    }
    
    /* Empty State Styles */
    .empty-state {
        padding: 40px 0;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 992px) {
        .carousel-caption {
            padding-right: 5%;
        }
        
        .carousel-caption h2 {
            font-size: 2rem;
        }
        
        .carousel-caption p {
            font-size: 1.2rem;
        }
    }
    
    @media (max-width: 768px) {
        .carousel-item img {
            height: 50vh;
        }
        
        .search-box {
            padding: 20px;
        }
        
        .carousel-caption {
            bottom: 20%;
        }
        
        .carousel-caption h2 {
            font-size: 1.8rem;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDwyPBQ7a79jd2KazJQYbTwPoRW5mayNrk&libraries=places,directions,geometry"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize the map with Jordan view
    const map = new google.maps.Map(document.getElementById('routeMap'), {
        center: {lat: 31.9454, lng: 35.9284}, // Center of Jordan
        zoom: 7,
        mapTypeId: 'roadmap',
        styles: [
            {
                "featureType": "poi",
                "stylers": [{ "visibility": "off" }]
            },
            {
                "featureType": "transit",
                "elementType": "labels.icon",
                "stylers": [{ "visibility": "off" }]
            }
        ],
        zoomControl: true,
        gestureHandling: 'cooperative'
    });

    const directionsService = new google.maps.DirectionsService();
    const directionsRenderer = new google.maps.DirectionsRenderer({
        map: map,
        suppressMarkers: true,
        polylineOptions: {
            strokeColor: '#4e54c8',
            strokeOpacity: 0.8,
            strokeWeight: 5
        }
    });

    // Marker icons
    const startMarkerIcon = {
        url: "https://maps.google.com/mapfiles/ms/icons/green-dot.png",
        scaledSize: new google.maps.Size(40, 40)
    };
    
    const endMarkerIcon = {
        url: "https://maps.google.com/mapfiles/ms/icons/red-dot.png",
        scaledSize: new google.maps.Size(40, 40)
    };
    
    const busMarkerIcon = {
        url: "https://maps.google.com/mapfiles/ms/icons/blue-dot.png",
        scaledSize: new google.maps.Size(32, 32)
    };

    let markers = [];
    
    function clearMarkers() {
        markers.forEach(marker => marker.setMap(null));
        markers = [];
    }

    // Show initial Jordan map with no route
    function showInitialMap() {
        directionsRenderer.setMap(null);
        clearMarkers();
        map.setCenter({lat: 31.9454, lng: 35.9284});
        map.setZoom(7);
        
        document.getElementById('routeInfo').innerHTML = `
            <div class="alert alert-info mb-0">
                <i class="fas fa-info-circle me-2"></i>
                Select departure and destination to view available routes
            </div>
        `;
    }

    // Calculate and display route
    function calculateAndDisplayRoute(fromId, toId, fromName, toName) {
        const fromSelect = document.getElementById('from');
        const toSelect = document.getElementById('to');
        
        const fromOption = fromSelect.querySelector(`option[value="${fromId}"]`);
        const toOption = toSelect.querySelector(`option[value="${toId}"]`);
        
        const fromLat = parseFloat(fromOption.dataset.lat);
        const fromLng = parseFloat(fromOption.dataset.lng);
        const toLat = parseFloat(toOption.dataset.lat);
        const toLng = parseFloat(toOption.dataset.lng);
        
        document.getElementById('routeInfo').innerHTML = `
            <div class="text-center py-2">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-2">Finding routes from ${fromName} to ${toName}...</p>
            </div>
        `;
        
        directionsService.route({
            origin: {lat: fromLat, lng: fromLng},
            destination: {lat: toLat, lng: toLng},
            travelMode: 'DRIVING',
            provideRouteAlternatives: false,
            unitSystem: google.maps.UnitSystem.METRIC
        }, function(response, status) {
            if (status === 'OK') {
                directionsRenderer.setMap(map);
                directionsRenderer.setDirections(response);
                clearMarkers();
                
                const route = response.routes[0];
                const leg = route.legs[0];
                
                // Add start marker
                markers.push(new google.maps.Marker({
                    position: leg.start_location,
                    map: map,
                    title: 'Departure: ' + fromName,
                    icon: startMarkerIcon
                }));
                
                // Add end marker
                markers.push(new google.maps.Marker({
                    position: leg.end_location,
                    map: map,
                    title: 'Destination: ' + toName,
                    icon: endMarkerIcon
                }));
                
                // Add bus markers for available trips
                @foreach($availableBuses as $bus)
                    markers.push(new google.maps.Marker({
                        position: {lat: {{ $bus->current_latitude }}, lng: {{ $bus->current_longitude }}},
                        map: map,
                        title: 'Bus: ' + '{{ $bus->plate_number }}',
                        icon: busMarkerIcon
                    }));
                @endforeach
                
                document.getElementById('routeInfo').innerHTML = `
                    <div class="alert alert-light">
                        <i class="fas fa-info-circle me-2"></i>
                        The route shown is approximate and may not represent the exact bus path
                    </div>
                    <div class="route-info-card mt-2">
                        <div class="d-flex justify-content-between">
                            <span><i class="fas fa-road me-2"></i> ${leg.distance.text}</span>
                            <span><i class="fas fa-clock me-2"></i> ${leg.duration.text}</span>
                        </div>
                    </div>
                `;
                
                const bounds = new google.maps.LatLngBounds();
                bounds.extend(leg.start_location);
                bounds.extend(leg.end_location);
                map.fitBounds(bounds);
                
            } else {
                console.error('Directions request failed:', status);
                document.getElementById('routeInfo').innerHTML = `
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Could not find route from ${fromName} to ${toName}. Please check your locations and try again.
                    </div>
                `;
                showInitialMap();
            }
        });
    }

    // Show initial map when page loads
    showInitialMap();

    // Form submission handler
    document.getElementById('tripSearchForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const fromId = document.getElementById('from').value;
        const toId = document.getElementById('to').value;
        const fromName = document.getElementById('from').options[document.getElementById('from').selectedIndex].text;
        const toName = document.getElementById('to').options[document.getElementById('to').selectedIndex].text;
        
        if (fromId && toId) {
            if(fromId === toId) {
                alert('Departure and destination cannot be the same');
                return;
            }
            calculateAndDisplayRoute(fromId, toId, fromName, toName);
        } else {
            alert('Please select both departure and destination');
        }
    });

    // Current location button handler
    document.getElementById('useCurrentLocation').addEventListener('click', function() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const userLat = position.coords.latitude;
                const userLng = position.coords.longitude;
                
                // Find the nearest complex to the user's location
                let nearestComplex = null;
                let minDistance = Infinity;
                
                const fromSelect = document.getElementById('from');
                const options = fromSelect.options;
                
                for (let i = 0; i < options.length; i++) {
                    if (options[i].value) {
                        const complexLat = parseFloat(options[i].dataset.lat);
                        const complexLng = parseFloat(options[i].dataset.lng);
                        
                        const distance = google.maps.geometry.spherical.computeDistanceBetween(
                            new google.maps.LatLng(userLat, userLng),
                            new google.maps.LatLng(complexLat, complexLng)
                        );
                        
                        if (distance < minDistance) {
                            minDistance = distance;
                            nearestComplex = options[i];
                        }
                    }
                }
                
                if (nearestComplex) {
                    fromSelect.value = nearestComplex.value;
                    // Animate the selection
                    fromSelect.classList.add('animate__animated', 'animate__pulse');
                    setTimeout(() => {
                        fromSelect.classList.remove('animate__animated', 'animate__pulse');
                    }, 1000);
                }
            }, function(error) {
                alert('Error getting your location: ' + error.message);
            });
        } else {
            alert('Geolocation is not supported by your browser');
        }
    });

    // If search parameters exist in URL, show the route immediately
    @if(request()->has('from') && request()->has('to'))
        const fromId = "{{ request('from') }}";
        const toId = "{{ request('to') }}";
        const fromName = document.querySelector(`#from option[value="${fromId}"]`).text;
        const toName = document.querySelector(`#to option[value="${toId}"]`).text;
        
        if(fromId && toId && fromId !== toId) {
            calculateAndDisplayRoute(fromId, toId, fromName, toName);
        }
    @endif
    
    // Smooth scroll for buttons
    document.querySelectorAll('.scroll-button').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                window.scrollTo({
                    top: target.offsetTop - 20,
                    behavior: 'smooth'
                });
            }
        });
    });
});
</script>
@endpush