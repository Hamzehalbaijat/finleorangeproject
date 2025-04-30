@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation.passenger')

    
        @hasSection('header')
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        @yield('header')
                    </h2>
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-600">
                            <i class="fas fa-wallet mr-1"></i> 
                            JOD {{ number_format(auth()->user()->balance, 2) }}
                        </span>
                        <a href="{{ route('passenger.notifications.index') }}" class="relative">
                            <i class="fas fa-bell text-xl text-gray-600 hover:text-orange-600"></i>
                            @if($unreadNotificationsCount > 0)
                                <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                    {{ $unreadNotificationsCount }}
                                </span>
                            @endif
                        </a>
                    </div>
                </div>
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main class="pb-12">
            @yield('hero-section')
            <div class="py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
@endsection