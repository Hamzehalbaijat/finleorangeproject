@extends('layouts.app')

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
    </div>
    <!-- End of Hero Section -->
@endsection
@section('content')
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
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
<style>
      /* Keep original styles, add Leaflet-specific adjustments */
    .map-container {
        height: 500px;
        width: 100%;
        border-radius: 8px;
        overflow: hidden;
        z-index: 1;
    }

    .leaflet-routing-container {
        display: none; /* We'll show info in our own panel */
    }

    .leaflet-marker-icon {
        filter: drop-shadow(2px 2px 2px rgba(0,0,0,0.3));
    }

    /* Add custom marker pulse animation */
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.2); }
        100% { transform: scale(1); }
    }
    
    .bus-marker {
        animation: pulse 2s infinite;
    }
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
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Leaflet Map
    const map = L.map('routeMap').setView([31.9454, 35.9284], 7);
    
    // Add OpenStreetMap tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Map Objects
    let routingControl = null;
    let currentMarkers = [];
    let busMarkers = [];

    // Custom Icons
    const startIcon = L.icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });

    const endIcon = L.icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });

    const busIcon = L.icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });

    // Clear existing route and markers
    function clearMap() {
        if (routingControl) {
            map.removeControl(routingControl);
            routingControl = null;
        }
        currentMarkers.forEach(marker => map.removeLayer(marker));
        currentMarkers = [];
    }

    // Clear bus markers
    function clearBusMarkers() {
        busMarkers.forEach(marker => map.removeLayer(marker));
        busMarkers = [];
    }

    // Show initial Jordan map
    function showInitialMap() {
        clearMap();
        clearBusMarkers();
        map.setView([31.9454, 35.9284], 7);
        document.getElementById('routeInfo').innerHTML = `
            <div class="alert alert-info mb-0 rounded-0 rounded-bottom">
                <i class="fas fa-info-circle me-2"></i> اختر نقاط الانطلاق والوجهة لعرض
            </div>
        `;
    }

    // Main route calculation function
    function calculateAndDisplayRoute(fromId, toId, fromName, toName) {
        const fromSelect = document.getElementById('from');
        const toSelect = document.getElementById('to');
        
        const fromOption = fromSelect.querySelector(`option[value="${fromId}"]`);
        const toOption = toSelect.querySelector(`option[value="${toId}"]`);
        
        const fromLat = parseFloat(fromOption.dataset.lat);
        const fromLng = parseFloat(fromOption.dataset.lng);
        const toLat = parseFloat(toOption.dataset.lat);
        const toLng = parseFloat(toOption.dataset.lng);

        // Show loading state
        document.getElementById('routeInfo').innerHTML = `
            <div class="text-center py-2">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-2">Finding routes from ${fromName} to ${toName}...</p>
            </div>
        `;

        // Clear previous map elements
        clearMap();
        clearBusMarkers();

        // Add start and end markers
        const startMarker = L.marker([fromLat, fromLng], { icon: startIcon })
            .bindPopup(`<b>${fromName}</b>`)
            .addTo(map);
        currentMarkers.push(startMarker);

        const endMarker = L.marker([toLat, toLng], { icon: endIcon })
            .bindPopup(`<b>${toName}</b>`)
            .addTo(map);
        currentMarkers.push(endMarker);

        // Add bus markers
        @foreach($availableBuses as $bus)
            const busMarker = L.marker([{{ $bus->current_latitude }}, {{ $bus->current_longitude }}], {
                icon: busIcon,
                className: 'bus-marker'
            }).bindPopup(`
                <b>{{ $bus->plate_number }}</b><br>
                {{ $bus->driver->name }}<br>
                {{ $bus->departure_time }}
            `).addTo(map);
            busMarkers.push(busMarker);
        @endforeach

        // Setup routing control
        routingControl = L.Routing.control({
            waypoints: [
                L.latLng(fromLat, fromLng),
                L.latLng(toLat, toLng)
            ],
            routeWhileDragging: false,
            show: false,
            addWaypoints: false,
            draggableWaypoints: false,
            fitSelectedRoutes: true,
            lineOptions: {
                styles: [{ color: '#4e54c8', opacity: 0.8, weight: 5 }]
            },
            createMarker: () => null
        }).addTo(map);

        // Handle route found
        routingControl.on('routesfound', function(e) {
            const route = e.routes[0];
            const distance = (route.summary.totalDistance / 1000).toFixed(1) + ' km';
            const time = Math.floor(route.summary.totalTime / 60) + ' دقيقة';

            document.getElementById('routeInfo').innerHTML = `
                <div class="alert alert-light rounded-0">
                    <i class="fas fa-info-circle me-2"></i> المسار المعروض تقريبي وقد لا يمثل مسار الباص الدقيق
                </div>
                <div class="route-info-card p-3">
                    <div class="d-flex justify-content-between">
                        <span><i class="fas fa-road me-2"></i> ${distance}</span>
                        <span><i class="fas fa-clock me-2"></i> ${time}</span>
                    </div>
                </div>
            `;

            // Adjust map view
            const bounds = L.latLngBounds([fromLat, fromLng], [toLat, toLng]);
            map.fitBounds(bounds.pad(0.2));
        });

        // Handle routing errors
        routingControl.on('routingerror', function(e) {
            document.getElementById('routeInfo').innerHTML = `
                <div class="alert alert-danger rounded-0">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    تعذر العثور على مسار من ${fromName} إلى ${toName}
                </div>
            `;
            showInitialMap();
        });
    }

    // Form Submission Handler
    document.getElementById('tripSearchForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const fromId = document.getElementById('from').value;
        const toId = document.getElementById('to').value;
        const fromName = document.getElementById('from').selectedOptions[0].text;
        const toName = document.getElementById('to').selectedOptions[0].text;
        
        if (fromId && toId) {
            if (fromId === toId) {
                alert('لا يمكن أن تكون نقطة البداية والنهاية نفسها');
                return;
            }
            calculateAndDisplayRoute(fromId, toId, fromName, toName);
        } else {
            alert('الرجاء اختيار كل من نقطة البداية والوجهة');
        }
    });

    // Current Location Handler
    document.getElementById('useCurrentLocation').addEventListener('click', function() {
        map.locate({
            setView: false,
            enableHighAccuracy: true
        }).on('locationfound', function(e) {
            const userLat = e.latitude;
            const userLng = e.longitude;
            
            let nearestComplex = null;
            let minDistance = Infinity;
            
            const options = document.getElementById('from').options;
            
            for (let i = 0; i < options.length; i++) {
                if (options[i].value) {
                    const complexLat = parseFloat(options[i].dataset.lat);
                    const complexLng = parseFloat(options[i].dataset.lng);
                    
                    const distance = map.distance(
                        [userLat, userLng],
                        [complexLat, complexLng]
                    );
                    
                    if (distance < minDistance) {
                        minDistance = distance;
                        nearestComplex = options[i];
                    }
                }
            }
            
            if (nearestComplex) {
                document.getElementById('from').value = nearestComplex.value;
                document.getElementById('from').dispatchEvent(new Event('change'));
                
                // Add visual feedback
                const fromSelect = document.getElementById('from');
                fromSelect.classList.add('animate__animated', 'animate__pulse');
                setTimeout(() => {
                    fromSelect.classList.remove('animate__animated', 'animate__pulse');
                }, 1000);
            }
        }).on('locationerror', function(e) {
            alert('خطأ في الحصول على الموقع: ' + e.message);
        });
    });

    // Initial Map Setup
    showInitialMap();

    // Handle Initial Search Parameters
    @if(request()->has('from') && request()->has('to'))
        const fromId = "{{ request('from') }}";
        const toId = "{{ request('to') }}";
        const fromName = document.querySelector(`#from option[value="${fromId}"]`).text;
        const toName = document.querySelector(`#to option[value="${toId}"]`).text;
        
        if (fromId && toId && fromId !== toId) {
            calculateAndDisplayRoute(fromId, toId, fromName, toName);
        }
    @endif

    // Smooth Scroll for Buttons
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