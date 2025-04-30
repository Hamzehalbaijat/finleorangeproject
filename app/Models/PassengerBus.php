<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PassengerBus extends Model
{
    use SoftDeletes;

    protected $table = 'passenger_bus';

    protected $fillable = [
        'passenger_id',
        'bus_id',
        'pickup_location',
        'pickup_latitude',
        'pickup_longitude',
        'destination',
        'destination_latitude',
        'destination_longitude',
        'status',
    ];

    public function passenger()
    {
        return $this->belongsTo(User::class, 'passenger_id');
    }

    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }
}
