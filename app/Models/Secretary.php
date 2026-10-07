<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Secretary extends Model
{
    protected $table = 'secretaries';
    protected $fillable = ['name', 'position', 'description', 'image', 'from', 'to', 'is_present'];
}
