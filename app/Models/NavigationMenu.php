<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class NavigationMenu extends Model
{
    use HasTranslations;

    protected $fillable = [
        'name',
        'location',
        'is_active',
    ];

    public $translatable = [
        'name',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(NavigationItem::class)->orderBy('order_column');
    }

    public function rootItems(): HasMany
    {
        return $this->hasMany(NavigationItem::class)
            ->whereNull('parent_id')
            ->orderBy('order_column');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByLocation($query, $location)
    {
        return $query->where('location', $location);
    }
}
