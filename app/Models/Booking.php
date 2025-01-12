<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'departure',
        'user_id',
        'destination',
        'departure_time',
        'price',
        'name',
        'email',
        'number_of_people',
        'total_price',
        'payment_method',
        'departure_date',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

