<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class NewAndEvent extends Model
{
    use HasFactory;

    protected $table = 'new_and_events';

    protected $fillable = [
        'type',
        'title',
        'author',
        'mint',
        'slug',
        'date',
        'thumnail_image',
        'cover_image',
        'description',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->title);
            }
        });

        static::updating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->title);
            }
        });
    }
}
