<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusRoute extends Model
{
    use HasFactory;

    protected $fillable = [
        'departure_id',
        'destination_id',
        'costs',
        'duration',
        'departure_time',

    ];

    // A BusRoute belongs to a Departure Location
    public function departure()
    {
        return $this->belongsTo(Location::class, 'departure_id');
    }

    // A BusRoute belongs to a Destination Location
    public function destination()
    {
        return $this->belongsTo(Location::class, 'destination_id');
    }


    // Relationship with Location (Departure)
    public function departureLocation()
    {
        return $this->belongsTo(Location::class, 'departure_id');
    }

    // Relationship with Location (Destination)
    public function destinationLocation()
    {
        return $this->belongsTo(Location::class, 'destination_id');
    }
}
