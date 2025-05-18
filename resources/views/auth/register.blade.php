@extends('layouts.app')
@section('title', 'Login')
@section('content')
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-light shadow-lg rounded-4">
                    <div class="card-body p-5 text-center">

                        <div class="mb-5">
                            <h2 class="fw-bold mb-3 text-success">Join Us</h2>
                            <p class="text-muted">Create your account and start exploring!</p>
                        </div>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            {{-- Name Input --}}
                            <div class="form-floating mb-4">
                                <input type="text" id="name" name="name" class="form-control form-control-lg rounded-pill @error('name') is-invalid @enderror" placeholder="Your Name" value="{{ old('name') }}" required autofocus autocomplete="name" />
                                <label for="name">{{ __('Your Name') }}</label>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Email Input --}}
                            <div class="form-floating mb-4">
                                <input type="email" id="email" name="email" class="form-control form-control-lg rounded-pill @error('email') is-invalid @enderror" placeholder="name@example.com" value="{{ old('email') }}" required autocomplete="username" />
                                <label for="email">{{ __('Email Address') }}</label>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Phone Input --}}
                            <div class="form-floating mb-4">
                                <input type="text" id="phone" name="phone" class="form-control form-control-lg rounded-pill @error('phone') is-invalid @enderror" placeholder="Your Phone Number" value="{{ old('phone') }}" required autocomplete="tel" />
                                <label for="phone">{{ __('Phone Number') }}</label>
                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Password Input --}}
                            <div class="form-floating mb-4">
                                <input type="password" id="password" name="password" class="form-control form-control-lg rounded-pill @error('password') is-invalid @enderror" placeholder="Password" required autocomplete="new-password" />
                                <label for="password">{{ __('Create Password') }}</label>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Confirm Password Input --}}
                            <div class="form-floating mb-4">
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control form-control-lg rounded-pill @error('password_confirmation') is-invalid @enderror" placeholder="Confirm Password" required autocomplete="new-password" />
                                <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                                @error('password_confirmation')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Role Selection --}}
                            <div class="form-floating mb-4">
                                <select id="role" name="role" class="form-select form-select-lg rounded-pill @error('role') is-invalid @enderror" required>
                                    <option value="" disabled selected>{{ __('Select your role') }}</option>
                                    <option value="passenger" {{ old('role') == 'passenger' ? 'selected' : '' }}>{{ __('Passenger') }}</option>
                                    <option value="driver" {{ old('role') == 'driver' ? 'selected' : '' }}>{{ __('Driver') }}</option>
                                </select>
                                <label for="role">{{ __('Role') }}</label>
                                @error('role')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            <div class="d-grid mb-3">
                                <button class="btn btn-success btn-lg rounded-pill" type="submit">{{ __('Register') }}</button>
                            </div>

                            <div class="text-center">
                                <p class="mb-0">Already have an account? <a href="{{ route('login') }}" class="text-primary fw-semibold">Log in here</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Make sure this path is correct for your Bootstrap installation --}}
    <script src="{{ asset('path/to/bootstrap.bundle.min.js') }}"></script>

</body>
</html>