<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TalkToGovernor extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference_number',
        'name',
        'email',
        'mobile_number',
        'cnic',
        'district',
        'category',
        'subject',
        'message',
        'document',
        'images',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function getImagesListAttribute(): array
    {
        if (is_array($this->images)) {
            return $this->images;
        }

        if (is_string($this->images)) {
            $decoded = json_decode($this->images, true);
            return is_array($decoded) ? $decoded : [];
        }

        return [];
    }
}
