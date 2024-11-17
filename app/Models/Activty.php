<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activty extends Model
{
    use HasFactory;
    public $table = 'activties';

    protected $fillable = [
        'id',
        'title',
        'description',
        'brief',
        'url',
        'image_id'
    ];

    public $timestamps = false;
    public function thumbnail()
    {
        return $this->belongsTo(Image::class, 'image_id');
    }

}
