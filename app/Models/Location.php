<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'latitude',
        'longitude'
    ];

    // Locations can be the departure of many BusRoutes
    public function departures()
    {
        return $this->hasMany(BusRoute::class, 'departure_id');
    }

    // Locations can be the destination of many BusRoutes
    public function destinations()
    {
        return $this->hasMany(BusRoute::class, 'destination_id');
    }


    public function departureRoutes()
    {
        return $this->hasMany(BusRoute::class, 'departure_id');
    }

    public function destinationRoutes()
    {
        return $this->hasMany(BusRoute::class, 'destination_id');
    }
}
