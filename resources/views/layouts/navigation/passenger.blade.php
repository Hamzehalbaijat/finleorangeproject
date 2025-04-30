<nav x-data="{ open: false }" class="bg-white shadow-sm">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('passenger.dashboard') }}" class="flex items-center">
                        <x-application-logo class="block h-10 w-auto fill-current text-orange-600" />
                        <span class="ml-2 text-xl font-bold text-orange-600 hidden md:block">Orange Bus</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-2 sm:-my-px sm:ml-8 sm:flex">
                    <x-nav-link :href="route('passenger.dashboard')" :active="request()->routeIs('passenger.dashboard')">
                        <i class="fas fa-home mr-2"></i> {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('passenger.trips.index')" :active="request()->routeIs('passenger.trips.*')">
                        <i class="fas fa-bus mr-2"></i> {{ __('My Trips') }}
                    </x-nav-link>
                    <x-nav-link :href="route('passenger.payments.index')" :active="request()->routeIs('passenger.payments.*')">
                        <i class="fas fa-credit-card mr-2"></i> {{ __('Payments') }}
                    </x-nav-link>
                    <x-nav-link :href="route('passenger.reviews.index')" :active="request()->routeIs('passenger.reviews.*')">
                        <i class="fas fa-star mr-2"></i> {{ __('Reviews') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-700 hover:text-orange-600 focus:outline-none transition duration-150 ease-in-out">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-orange-100 flex items-center justify-center text-orange-600">
                                    <i class="fas fa-user"></i>
                                </div>
                                <span class="ml-2">{{ Auth::user()->name }}</span>
                            </div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-gray-500">
                            {{ __('Manage Account') }}
                        </div>

                        <x-dropdown-link :href="route('passenger.profile.show')" class="group">
                            <i class="fas fa-user mr-2 text-gray-400 group-hover:text-orange-500"></i> 
                            <span class="group-hover:text-orange-600">{{ __('Profile') }}</span>
                        </x-dropdown-link>

                        <div class="border-t border-gray-100 my-1"></div>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" class="group"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                <i class="fas fa-sign-out-alt mr-2 text-gray-400 group-hover:text-orange-500"></i>
                                <span class="group-hover:text-orange-600">{{ __('Log Out') }}</span>
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-orange-600 hover:bg-orange-50 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white shadow-lg">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('passenger.dashboard')" :active="request()->routeIs('passenger.dashboard')">
                <i class="fas fa-home mr-3"></i> {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('passenger.trips.index')" :active="request()->routeIs('passenger.trips.*')">
                <i class="fas fa-bus mr-3"></i> {{ __('My Trips') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('passenger.payments.index')" :active="request()->routeIs('passenger.payments.*')">
                <i class="fas fa-credit-card mr-3"></i> {{ __('Payments') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('passenger.reviews.index')" :active="request()->routeIs('passenger.reviews.*')">
                <i class="fas fa-star mr-3"></i> {{ __('Reviews') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-2 border-t border-gray-200">
            <div class="flex items-center px-4">
                <div class="shrink-0">
                    <div class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center text-orange-600">
                        <i class="fas fa-user"></i>
                    </div>
                </div>

                <div class="ml-3">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1 px-4">
                <!-- Account Management -->
                <x-responsive-nav-link :href="route('passenger.profile.show')">
                    <i class="fas fa-user mr-3"></i> {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        <i class="fas fa-sign-out-alt mr-3"></i> {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

<style>
    /* Navigation Link Styles */
    .nav-link {
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
        border-radius: 0.375rem;
        font-weight: 500;
        color: #4b5563;
        transition: all 0.2s ease-in-out;
    }
    
    .nav-link:hover {
        color: #ea580c;
        background-color: #ffedd5;
    }
    
    .nav-link.active {
        color: #ea580c;
        background-color: #ffedd5;
    }
    
    .nav-link i {
        width: 1.25rem;
        text-align: center;
    }
    /* Dropdown Styles */
    .dropdown-content {
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        border-radius: 0.375rem;
        border: 1px solid #e5e7eb;
    }
    
    .dropdown-link {
        padding: 0.5rem 1rem;
        display: flex;
        align-items: center;
        color: #4b5563;
        transition: all 0.2s ease-in-out;
    }
    
    .dropdown-link:hover {
        color: #ea580c;
        background-color: #ffedd5;
    }
    
    /* Mobile Menu Styles */
    .responsive-nav-link {
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
        color: #4b5563;
        transition: all 0.2s ease-in-out;
    }
    
    .responsive-nav-link:hover {
        color: #ea580c;
        background-color: #ffedd5;
    }
    
    .responsive-nav-link.active {
        color: #ea580c;
        background-color: #ffedd5;
    }
    
    .responsive-nav-link i {
        width: 1.25rem;
        text-align: center;
    }
</style>