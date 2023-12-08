<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Home_slider extends Model
{
    use HasFactory;

    protected $fillable = [
        "slide_path",
        "sort"
    ];

    protected $table = "home_slider";
}
