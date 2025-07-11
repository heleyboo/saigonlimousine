<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class NavigationItem extends Model implements Sortable
{
    use HasTranslations, SortableTrait;

    protected $fillable = [
        'navigation_menu_id',
        'label',
        'url',
        'target',
        'parent_id',
        'order_column',
        'is_active',
        'custom_attributes',
    ];

    public $translatable = [
        'label',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'custom_attributes' => 'array',
    ];

    public function navigationMenu(): BelongsTo
    {
        return $this->belongsTo(NavigationMenu::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(NavigationItem::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(NavigationItem::class, 'parent_id')->orderBy('order_column');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeRoot($query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeByMenu($query, $menuId)
    {
        return $query->where('navigation_menu_id', $menuId);
    }

    public function getFullUrlAttribute(): string
    {
        if (str_starts_with($this->url, 'http')) {
            return $this->url;
        }
        
        return url($this->url);
    }
}
