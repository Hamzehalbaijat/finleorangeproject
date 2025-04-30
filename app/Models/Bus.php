<?php

// app/Models/Bus.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bus extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'driver_id',
        'complex_id',
        'plate_number',
        'departure_time',
        'estimated_arrival_time',
        'from_location',
        'to_location',
        'current_latitude',
        'current_longitude',
        'total_capacity',
        'occupied_seats',
        'fee',
        'status1',
        'status2'
    ];

    protected $casts = [
        'departure_time' => 'datetime:H:i',
        'estimated_arrival_time' => 'datetime:H:i',
    ];

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function complex()
    {
        return $this->belongsTo(Complex::class);
    }

    public function passengers()
    {
        return $this->belongsToMany(User::class, 'passenger_bus', 'bus_id', 'passenger_id')
            ->withPivot(['pickup_location', 'pickup_latitude', 'pickup_longitude', 
                        'destination', 'destination_latitude', 'destination_longitude', 
                        'status'])
            ->withTimestamps()
            ->using(\App\Models\PassengerBus::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function getAvailableSeatsAttribute()
    {
        return $this->total_capacity - $this->occupied_seats;
    }
}