<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Orange Academy Bus System'))</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        /* Base Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        
        /* Navbar Styles */
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        /* Carousel Styles */
        .carousel-indicators button {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin: 0 5px;
            background-color: rgba(255,255,255,0.5);
        }
        
        .carousel-indicators .active {
            background-color: #fff;
        }
        
        .carousel-caption {
            background: rgba(0, 0, 0, 0.5);
            padding: 20px;
            border-radius: 5px;
            bottom: 40px;
        }
        
        .carousel-caption h2 {
            font-size: 2.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        
        /* Search Box Styles */
        .search-box {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(5px);
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        
        /* Map Styles */
        #routeMap {
            height: 450px;
            width: 100%;
            border-radius: 8px;
            border: 1px solid #ddd;
            background-color: #f5f5f5;
        }
        
        .route-info-card {
            background: white;
            padding: 10px;
            border-radius: 5px;
            margin-top: 10px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        
        /* Card Styles */
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        .card-header {
            border-bottom: none;
        }
        
        /* Table Styles */
        .table-hover tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.05);
        }
        
        /* Button Styles */
        .btn {
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 6px;
            transition: all 0.3s;
        }
        
        .btn-outline-primary:hover {
            color: white;
        }
        
        /* Badge Styles */
        .badge {
            font-weight: 500;
            padding: 5px 10px;
        }
        
        /* Footer Styles */
        footer {
            background-color: #343a40;
            color: white;
        }
        
        /* Utility Classes */
        .bg-orange {
            background-color: #fd7e14 !important;
        }
        
        .btn-outline-orange {
            color: #fd7e14;
            border-color: #fd7e14;
        }
        
        .btn-outline-orange:hover {
            background-color: #fd7e14;
            color: white;
        }
        
        .text-orange {
            color: #fd7e14 !important;
        }
        
        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .carousel-caption h2 {
                font-size: 1.8rem;
            }
            
            .search-box {
                padding: 15px !important;
            }
        }
    </style>

    @stack('styles')
</head>
<body class="bg-light">
    <div class="d-flex flex-column min-vh-100">
        @includeWhen(auth()->check(), 'layouts.navigation.' . auth()->user()->role)
        
        <!-- Hero Section -->
        @hasSection('hero-section')
            @yield('hero-section')
        @endif
        
        <!-- Page Content -->
        <main class="flex-grow-1 py-4">
            @unless(isset($noContainer) && $noContainer)
            <div class="container">
                @yield('content')
            </div>
            @else
                @yield('content')
            @endunless
        </main>
        
        @include('layouts.partials.footer')
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')
</body>
</html>