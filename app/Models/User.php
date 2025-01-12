<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function canEdit(User $user)
    {
        return $this->isAdmin() || $this->id === $user->id;
    }

public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

}
