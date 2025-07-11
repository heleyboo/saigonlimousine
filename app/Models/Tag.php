<?php

namespace App\Models;

use Spatie\Tags\Tag as SpatieTag;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Tag extends SpatieTag implements Sortable
{
    use SortableTrait;

    protected $fillable = [
        'name',
        'slug',
        'type',
        'order_column',
    ];





    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeActive($query)
    {
        return $query->whereNotNull('name');
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%{$search}%");
    }


}
