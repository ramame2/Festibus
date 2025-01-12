<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class AboutInfo extends Model
{
    protected $fillable = [
        'phone', 'location', 'email', 'opening_hours',
    ];

    // Ensure this is properly added
    protected $casts = [
        'opening_hours' => 'array',
    ];
}


