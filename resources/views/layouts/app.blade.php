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

    <style>
        /* Custom Bootstrap Overrides */
        .navbar-custom {
            background: linear-gradient(90deg, #fd7e14 0%, #0d6efd 100%);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .footer-custom {
            background-color: #343a40;
        }
        
        .float-animation {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
            100% { transform: translateY(0px); }
        }
    </style>

    @stack('styles')
</head>
<body class="bg-light">
    <div class="d-flex flex-column min-vh-100">
     @php
    $user = auth()->user();
@endphp

@includeWhen($user, 'layouts.navigation.' . ($user->role ?? 'guest'))
        
        <!-- Hero Section -->
        @hasSection('hero-section')
            @yield('hero-section')
        @endif
        
        <!-- Page Content -->
        <main class="flex-grow-1">
            <div class="container py-4">
                @include('layouts.partials.header')
                @yield('content')
            </div>
        </main>
        
        @include('layouts.partials.footer')
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')
</body>
</html>