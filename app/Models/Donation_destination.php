<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation_destination extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'title',
        'description'
    ];
}
