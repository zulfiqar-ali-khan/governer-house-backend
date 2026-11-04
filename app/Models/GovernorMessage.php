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
        'to',
        'short_description',
        'description',
        'political_career',
        'public_leadership',
        'education_description',
        'education_degree',
        'family_background',
        'ancestry_tree',
        'roles_of_governor',
        'born',
        'education',
        'previous_office',
        'also_serves_as',
        'image',
        'active',
    ];

    protected $casts = [
        'ancestry_tree' => 'array',
        'roles_of_governor' => 'array',
        'active' => 'boolean',
    ];

    public function getAncestryListAttribute(): array
    {
        if (is_array($this->ancestry_tree)) {
            return $this->ancestry_tree;
        }
        if (is_string($this->ancestry_tree)) {
            $decoded = json_decode($this->ancestry_tree, true);
            return is_array($decoded) ? $decoded : [];
        }
        return [];
    }

    public function getRolesListAttribute(): array
    {
        if (is_array($this->roles_of_governor)) {
            return $this->roles_of_governor;
        }
        if (is_string($this->roles_of_governor)) {
            $decoded = json_decode($this->roles_of_governor, true);
            return is_array($decoded) ? $decoded : [];
        }
        return [];
    }
}
