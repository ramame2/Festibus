<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // Specify the table name
    protected $table = 'contacts';

    // Specify the fillable fields
    protected $fillable = ['naam', 'nummer', 'email', 'bericht'];
}
