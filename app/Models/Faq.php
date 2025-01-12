<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
use HasFactory;

// The table associated with the model (optional if it follows Laravel's conventions)
protected $table = 'faqs';

// The attributes that are mass assignable
protected $fillable = [
'question',
'answer',
'category',
];
}
