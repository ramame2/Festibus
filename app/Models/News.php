<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    // Optionally specify the table name if it differs from the default plural name
    protected $table = 'news';

    // Optionally specify the fillable fields
    protected $fillable = ['title', 'content', 'created_at'];
}

