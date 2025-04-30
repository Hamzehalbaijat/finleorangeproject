<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trip extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'bus_id',
        'passenger_id',
        'pickup_location',
        'pickup_latitude',
        'pickup_longitude',
        'destination',
        'destination_latitude',
        'destination_longitude',
        'status'
    ];

    protected $casts = [
        'pickup_latitude' => 'decimal:8',
        'pickup_longitude' => 'decimal:8',
        'destination_latitude' => 'decimal:8',
        'destination_longitude' => 'decimal:8',
    ];

    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }

    public function passenger()
    {
        return $this->belongsTo(User::class, 'passenger_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    public function scopeActive($query)
    {
        return $query->whereIn('status', ['waiting', 'on_board']);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'dropped_off');
    }
}