<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GovernorMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'name',
        'designation',
        'from',
        'short_description',
        'description',
        'image',
        'active',
    ];
}
