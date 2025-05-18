@extends('layouts.app')
@section('title', 'Login')
@section('content')
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-light shadow-lg rounded-4">
                    <div class="card-body p-5 text-center">

                        <div class="mb-5">
                            <h2 class="fw-bold mb-3 text-primary">Welcome Back</h2>
                            <p class="text-muted">Sign in to continue your journey with us.</p>
                        </div>

                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-floating mb-4">
                                <input type="email" id="email" name="email" class="form-control form-control-lg rounded-pill" placeholder="name@example.com" value="{{ old('email') }}" required autofocus autocomplete="username" />
                                <label for="floatingInputEmail" class="form-label">{{ __('Email Address') }}</label>
                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                            </div>

                            <div class="form-floating mb-4">
                                <input type="password" id="password" name="password" class="form-control form-control-lg rounded-pill" placeholder="Password" required autocomplete="current-password" />
                                <label for="floatingPassword" class="form-label">{{ __('Password') }}</label>
                                <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                            </div>

                            <div class="form-check d-flex justify-content-start mb-4">
                                <input class="form-check-input me-2 rounded" type="checkbox" id="remember_me" name="remember" />
                                <label class="form-check-label text-muted" for="remember_me">{{ __('Keep me logged in') }}</label>
                            </div>

                            <div class="d-grid mb-3">
                                <button class="btn btn-primary btn-lg rounded-pill" type="submit">{{ __('Log In') }}</button>
                            </div>

                            <div class="text-center">
                                @if (Route::has('password.request'))
                                    <p class="mb-2"><a href="{{ route('password.request') }}" class="text-body-secondary">{{ __('Forgot your password?') }}</a></p>
                                @endif
                                <p class="mb-0">Don't have an account? <a href="{{ route('register') }}" class="text-primary fw-semibold">Sign up here</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection