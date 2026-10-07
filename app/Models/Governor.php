<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Governor extends Model
{
    protected $table = 'governors';
    protected $fillable = ['name', 'position', 'description', 'image', 'from', 'to', 'is_present'];
}
