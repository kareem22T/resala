<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteering_destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'description',
        'brief',
        'url',
        'image_id'
    ];

    protected $timestamps = false;


    public function volunteers()
    {
        return $this->hasMany(Volunteer::class);
    }

    public function thumbnail()
    {
        return $this->belongsTo(Image::class, 'image_id');
    }

}
