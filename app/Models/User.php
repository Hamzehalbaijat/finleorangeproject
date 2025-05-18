<?php

// app/Models/User.php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use  Notifiable,  SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role',
        'balance'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

   public function isPassenger()
{
    return $this->role === 'passenger';
}

public function isDriver()
{
    return $this->role === 'driver';
}

public function isAdmin()
{
    return $this->role === 'admin';
}
    public function notifications()
    {
        return $this->hasMany(\App\Models\Notification::class);
    }

    public function unreadNotifications()
    {
        return $this->notifications()->where('is_read', false);
    }
    public function buses()
{
    return $this->belongsToMany(Bus::class, 'passenger_bus', 'passenger_id', 'bus_id')
        ->withPivot([
            'pickup_location',
            'pickup_latitude',
            'pickup_longitude',
            'destination',
            'destination_latitude',
            'destination_longitude',
            'status'
        ])
        ->withTimestamps()
        ->using(\App\Models\PassengerBus::class);
}

}