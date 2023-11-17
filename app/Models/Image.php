<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'path'
    ];

    public $timestamps = false;

    public function destinations()
    {
        return $this->hasMany(Volunteer::class);
    }
}
