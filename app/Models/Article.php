<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable = [
        "author_id",
        "title",
        "content",
        "type",
        "thumbnail_path"
    ];

    protected $dates = [
        'post_date', 'post_date_gmt', 'post_modified', 'post_modified_gmt',
    ];
}
