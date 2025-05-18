<?php
// app/Http/Controllers/Auth/RegisteredUserController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Providers\RouteServiceProvider;
class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

   public function store(Request $request)
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'phone' => ['required', 'string', 'max:20', 'unique:users'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'role' => ['required', 'in:passenger,driver'],
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'password' => Hash::make($request->password),
        'role' => $request->role,
    ]);

    event(new Registered($user));
    Auth::login($user);

    // التوجيه حسب الدور المحدد
    return $request->role === 'driver' 
        ? redirect()->route('driver.dashboard')->with('success', 'تم تسجيل السائق بنجاح!')
        : redirect()->route('passenger.dashboard')->with('success', 'تم تسجيل الراكب بنجاح!');
}
}