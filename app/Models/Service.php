<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Service extends Model
{
    use HasTranslations;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'short_description',
        'price',
        'duration',
        'type',
        'is_active',
    ];

    public $translatable = [
        'name',
        'slug',
        'description',
        'short_description',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];



    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'related_service_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }
}
