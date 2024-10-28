<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;
    protected $fillable = [
        "title",
        "content",
        "intro",
        "thumbnail_path",
        "date_from",
        "date_to",
        "created_at",
    ];

}
