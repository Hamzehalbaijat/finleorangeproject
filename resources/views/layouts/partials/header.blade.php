<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('passenger.dashboard') }}">
            <img src="{{ asset('images/Gojologo.png') }}" alt="Logo" class="me-2" style="height: 40px;">
            <span class="d-none d-sm-inline">Orange Bus</span>
        </a>

        <!-- Mobile Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Links -->
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('passenger.trips.index') }}">
                        <i class="bi bi-bus-front me-1"></i> رحلاتي
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('passenger.payments.index') }}">
                        <i class="bi bi-credit-card me-1"></i> الدفعات
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('passenger.reviews.index') }}">
                        <i class="bi bi-star me-1"></i> التقييمات
                    </a>
                </li>
            </ul>

            <!-- Profile Dropdown -->
            <div class="dropdown">
                <a class="btn btn-light dropdown-toggle" href="#" role="button" 
                   id="profileDropdown" data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle me-1"></i>
                    {{ Auth::user()->name ?? 'Guest' }}
                </a>

                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route('passenger.profile.show') }}">
                        <i class="bi bi-person me-2"></i> الملف الشخصي
                    </a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="bi bi-box-arrow-right me-2"></i> تسجيل الخروج
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>