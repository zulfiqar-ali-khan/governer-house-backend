<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlobalImpact extends Model
{
    use HasFactory;

    protected $fillable = [
        'heading',
        'description',
        'order',
        'active',
    ];
}
