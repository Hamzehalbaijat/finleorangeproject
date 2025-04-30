<?php
// app/Http/Controllers/DriverController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:driver']);
    }

    public function dashboard()
    {
        return view('driver.dashboard');
    }
    
    // Add more driver-specific methods
}