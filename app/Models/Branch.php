<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'location',
        'address',
        'phone',
        'iframe',
    ];

    protected $table = 'branchs';

    public $timestamps = false;

    public function volunteers()
    {
        return $this->hasMany(Volunteer::class);
    }
}
