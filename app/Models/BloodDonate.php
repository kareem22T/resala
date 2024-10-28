<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodDonate extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "age",
        "blood_type",
        "seen_by_an_admin",
        "address"
    ];
}
