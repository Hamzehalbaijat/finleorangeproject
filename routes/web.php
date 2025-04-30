<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\PassengerController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ComplexController;
use Illuminate\Support\Facades\Auth;
use app\Http\Middleware\CheckRole;




// use App\Http\Middleware\CheckRole;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
|
*/

// ******************** GUEST ROUTES ******************** //
// Authentication
Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/', [AuthenticatedSessionController::class, 'store']);

Route::post('login', [AuthenticatedSessionController::class, 'store']);

Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    
Route::post('register', [RegisteredUserController::class, 'store']);



// ******************** AUTHENTICATED ROUTES ******************** //
// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
    
    // Profile Routes

    // Passenger Routes
    Route::middleware(['auth', 'checkrole:passenger'])->prefix('passenger')->name('passenger.')->group(function () {
        Route::get('/dashboard', [PassengerController::class, 'dashboard'])->name('dashboard');
        Route::get('/trips/search', [PassengerController::class, 'index'])->name('passenger.trips.search');

        // Trips
        Route::get('/trips', [TripController::class, 'index'])->name('trips.index');
        Route::get('/trips/search', [TripController::class, 'search'])->name('trips.search');
        Route::get('/trips/{trip}', [TripController::class, 'show'])->name('trips.show');
        Route::get('/trips/book/{bus}', [TripController::class, 'book'])->name('trips.book');
        Route::post('/trips', [TripController::class, 'store'])->name('trips.store');
        Route::get('/trips/active', [TripController::class, 'active'])->name('trips.active');
        
        // Payments
        Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
        Route::get('/payments/history', [PaymentController::class, 'history'])->name('payments.history');
        Route::post('/payments/nfc', [PaymentController::class, 'processNfc'])->name('payments.nfc');
        
        // Reviews
        Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
        Route::post('/reviews/{bus}', [ReviewController::class, 'store'])->name('reviews.store');
        Route::post('/reviews/{bus}', [ReviewController::class, 'create'])->name('reviews.create');
        Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
        
        // Notifications
        Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.show');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::get('/buses/{bus}', [BusController::class, 'show'])->name('buses.show');
        Route::get('/buses', [BusController::class, 'index'])->name('buses.index');

    });
    
    // Driver Routes
    Route::middleware(['role:driver'])->prefix('driver')->name('driver.')->group(function () {
        Route::get('/dashboard', [DriverController::class, 'dashboard'])->name('dashboard');
        Route::get('/schedule', [DriverController::class, 'schedule'])->name('schedule');
        Route::get('/passengers', [DriverController::class, 'passengers'])->name('passengers');
    });
    
    // Admin Routes
    Route::middleware(['checkrole:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        
        // Buses Management
        Route::resource('buses', BusController::class);
        
        // Users Management
        Route::resource('users', UserController::class);
        
        // Reports
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    });
});

// Fallback Route
Route::fallback(function () {
    return view('errors.404');
});
