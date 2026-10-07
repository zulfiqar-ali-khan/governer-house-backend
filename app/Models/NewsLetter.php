<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsLetter extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'date',
        'thumnail_image',
        'description',
        'status',
    ];
}
