<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation_by_representative extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'type',
        'name',
        'phone',
        'address',
        'seen_by_an_admin'
    ];

    protected $table = 'donations_by_representative';

}
