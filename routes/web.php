<?php

use Illuminate\Support\Facades\Route;
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
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckRole;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Redirect the root URL to the login page

// ====================== GUEST ROUTES ====================== //
// Routes that are accessible to users who are NOT logged in.
// The 'guest' middleware redirects authenticated users away from these pages.
Route::middleware('guest')->group(function () {
    // Authentication Routes
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    // Registration Routes
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);

    // Add any other routes that should only be accessible to guests here
    // Example: Forgot password routes, reset password routes, etc.
});

// ====================== AUTHENTICATED ROUTES ====================== //
// Routes that are only accessible to users who ARE logged in.
// The 'auth' middleware redirects unauthenticated users to the 'login' route.
Route::middleware('auth')->group(function () {
    // Logout Route
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // General Authenticated User Routes (if any apply to all logged-in users regardless of role)
    // Example: A common dashboard or profile view before role-specific redirection

    // User Profile Routes (Often shared among authenticated users, or can be role-specific if needed)
   


    // ====================== ROLE-SPECIFIC AUTHENTICATED ROUTES ====================== //
    // Routes that require the user to be logged in AND have a specific role.
    // The 'auth' middleware ensures they are logged in, and 'checkrole' verifies the role.

    // Passenger Routes
   // Passenger Routes Group (fixed)
Route::middleware(['auth','checkrole:passenger'])
    ->prefix('passenger')
    ->name('passenger.')
    ->group(function () {
        
        // Dashboard
        Route::get('/dashboard', [PassengerController::class, 'dashboard'])->name('dashboard');

        // Trip Management
        Route::prefix('/trips')->name('trips.')->group(function () {
            Route::get('/', [TripController::class, 'index'])->name('index');
            Route::get('/search', [TripController::class, 'search'])->name('search');
            Route::get('/{trip}', [TripController::class, 'show'])->name('show');
            Route::get('/book/{bus}', [TripController::class, 'book'])->name('book');
            Route::post('/', [TripController::class, 'store'])->name('store');
            Route::get('/active', [TripController::class, 'active'])->name('active');
        });

        // Payment Management
        Route::prefix('/payments')->name('payments.')->group(function () {
            Route::get('/', [PaymentController::class, 'index'])->name('index');
            Route::get('/history', [PaymentController::class, 'history'])->name('history');
            Route::post('/nfc', [PaymentController::class, 'processNfc'])->name('nfc');
        });

        // Review Management
        Route::prefix('/reviews')->name('reviews.')->group(function () {
            Route::get('/', [ReviewController::class, 'index'])->name('index');
            Route::post('/{bus}', [ReviewController::class, 'store'])->name('store');
            Route::delete('/{review}', [ReviewController::class, 'destroy'])->name('destroy');
        });

        // Bus Information
        Route::prefix('/buses')->name('buses.')->group(function () {
            Route::get('/', [BusController::class, 'index'])->name('index');
            Route::get('/{bus}', [BusController::class, 'show'])->name('show');
        });

        // Passenger Profile Routes (correct placement)
        Route::prefix('/profile')->name('profile.')->group(function () {
            Route::get('/', [ProfileController::class, 'show'])->name('show');
            Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
            Route::patch('/update', [ProfileController::class, 'update'])->name('update');
        });

    }); // End of passenger group

        // Notifications
        Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

        // If passenger profile is different, move the profile group here
        // Route::middleware(['checkrole:passenger'])->prefix('passenger')->name('passenger.')->group(function () {
        //     Route::prefix('/profile')->name('profile.')->group(function () {
        //         Route::get('/', [PassengerProfileController::class, 'edit'])->name('edit');
        //         // ... update, destroy specific to passenger
        //     });
        // });
 

    // Driver Routes
    Route::middleware(['checkrole:driver'])->prefix('driver')->name('driver.')->group(function () {
        Route::get('/dashboard', [DriverController::class, 'dashboard'])->name('dashboard');
        Route::get('/schedule', [DriverController::class, 'schedule'])->name('schedule');
        Route::get('/passengers', [DriverController::class, 'passengers'])->name('passengers');

         // If driver profile is different, define it here
        // Route::prefix('/profile')->name('profile.')->group(function () {
        //     Route::get('/', [DriverProfileController::class, 'edit'])->name('edit');
        //     // ... update, destroy specific to driver
        // });
    });

    // Admin Routes
    Route::middleware(['checkrole:admin'])->prefix('admin')->name('admin.')->group(function () {
        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // Resource Management (Ensure these controllers have appropriate logic for admin actions)
        Route::resource('buses', BusController::class);
        Route::resource('users', UserController::class); // Be cautious with user management, ensure proper authorization within the controller

        // Reports
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

        // If admin profile is different, define it here
        // Route::prefix('/profile')->name('profile.')->group(function () {
        //     Route::get('/', [AdminProfileController::class, 'edit'])->name('edit');
        //     // ... update, destroy specific to admin
        // });
    });
});

// ====================== FALLBACK ROUTE ====================== //
// This route will catch any undefined routes and show a 404 page.
Route::fallback(function () {
    return response()->view('errors.404', [], 404); // Using response() to set the status code
});