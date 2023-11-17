<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'email',
        'phone',
        'branch_id',
        'donation_destination_id',
        'city',
        'address',
        'dob',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function destination()
    {
        return $this->belongsTo(Volunteering_destination::class, 'donation_destination_id');
    }
}
